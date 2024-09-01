<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\ImageRequest;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use App\Models\Image;

use App\Models\Stage;


class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stage_id= $_GET['Stage'];

        $user_id = Auth::id();

        $stage = Stage::find($stage_id);

        if($stage != null){

            if($stage->user_id == $user_id){
                $images= $stage->images;
            }else{
                return redirect()->route('admin.days.index');
            }

        }else{
            return redirect()->route('admin.days.index');
        }


        return view('admin.images.index', compact('images'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stage_id= $_GET['Stage'];

        $user_id = Auth::id();

        $stage = Stage::find($stage_id);

        if($stage != null){

            if($stage->user_id == $user_id){
                return view('admin.images.create', compact('stage_id'));
            }else{
                return redirect()->route('admin.days.index');
            }

        }else{
            return redirect()->route('admin.days.index');
        }


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ImageRequest $request)
    {

        $stage_id= $_GET['Stage'];

        $form_data= $request->all();

        $user_id = Auth::id();

        $stage = Stage::find($stage_id);

        if($stage->user_id == $user_id){

            if (count($request->file()['images']) > 1){

                for($i = 0; $i <= count($request->file()); $i++){

                    DB::table('images')->insert([
                        'image' => Storage::put('uploads', $form_data['images'][$i]),
                        'image_name' => $request->file('images')[$i]->getClientOriginalName(),
                    ]);

                    $image = Image::where('image_name', $request->file('images')[$i]->getClientOriginalName())->get();

                    $image_id = $image[0]->id;

                    $stage = Stage::find($stage_id);

                    $stage->images()->attach($image_id);

                }

            }else{

                $new_image = new Image();

                $new_image->image = Storage::put('uploads', $form_data['images'][0]);

                $new_image->image_name = $request->file('images')[0]->getClientOriginalName();

                $new_image->save();

                $image = Image::where('image_name', $request->file('images')[0] ->getClientOriginalName())->get();

                $image_id = $image[0]->id;

                $stage = Stage::find($stage_id);

                $stage->images()->attach($image_id);

            }

        }else{
            return redirect()->route('admin.days.index');
        }


        return redirect()->route('admin.stages.show', compact('stage'));


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $stage = $image->stages[0]->id;

        Storage::disk('public')->delete($image);

        $image->delete();

        return redirect()->route('admin.stages.show', compact('stage'));
    }
}
