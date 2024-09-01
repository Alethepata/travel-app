<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Http\Requests\StageRequest;

use Illuminate\Support\Facades\Auth;

use App\Models\Stage;

use App\Models\Image;

use App\Models\Day;

class StageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $stage = null;
        $route = route('admin.stages.store');
        $method = 'POST';
        $days = Day::where('user_id', Auth::id())->get();
        $title = 'Crea tappa';
        return view('admin.stages.create-edit', compact('stage','title', 'route', 'method','days'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StageRequest $request)
    {
        $day = Day::find($request->day_id);

        $form_data= $request->all();

        $new_stage = new Stage();

        $new_stage->fill($form_data);

        $new_stage->user_id = Auth::id();

        $new_stage->slug = Stage::generateSlug($request->title);

        $lat_long_place = Stage::getLatLong($request->place);

        $new_stage->latitude = $lat_long_place['latitude'];

        $new_stage->longitude = $lat_long_place['longitude'];

        $new_stage->place = $lat_long_place['place'];

        $new_stage->date = $day['date'] .' ' . $request->time . ':00';

        $new_stage->rating = 0;

        if(empty($request->is_visited)){
            $new_stage->is_visited = false;
        }else{
            $new_stage->is_visited = true;
        }

        $new_stage->save();

        return redirect()->route('admin.days.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stage = Stage::find($id);

        $user_id = Auth::id();

        if($stage != null){

            if($stage->user_id == $user_id){
                $rating = intval($stage->rating);
                $rating_different = 5 - $rating;
                return view('admin.stages.show', compact('stage', 'rating', 'rating_different'));
            }else{
                return redirect()->route('admin.days.index');
            }

        }else{
            return redirect()->route('admin.days.index');
        }


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Stage $stage)
    {
        $user_id = Auth::id();

        if($stage->user_id == $user_id){

            $route = route('admin.stages.update', $stage);
            $method = 'PUT';
            $days = Day::where('user_id', Auth::id())->get();
            $title = 'Modifica tappa';
            return view('admin.stages.create-edit', compact('stage','title', 'route', 'method','days'));

        }else{
            return redirect()->route('admin.days.index');
        }


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StageRequest $request, Stage $stage)
    {
        $form_data = $request->all();

        $stage->slug = Stage::generateSlug($request->title);

        $form_data['is_visited'] = $request->is_visited == 'on' ? true : false;

        $lat_long_place = Stage::getLatLong($request->place);

        $stage->latitude = $lat_long_place['latitude'];

        $stage->longitude = $lat_long_place['longitude'];

        $form_data['place'] = $lat_long_place['place'];

        $stage->update($form_data);

        return redirect()->route('admin.stages.show', $stage);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stage $stage)
    {
        $stage->delete();

        return redirect()->route('admin.days.index');
    }


}
