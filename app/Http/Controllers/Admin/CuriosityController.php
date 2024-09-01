<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\CuriosityRequest;

use App\Http\Controllers\Controller;

use App\Models\Curiosity;

use App\Models\Stage;

use Illuminate\Support\Facades\Auth;

class CuriosityController extends Controller
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
        $stage_id= $_GET['Stage'];

        $stage = Stage::find($stage_id);

        $user_id = Auth::id();

        if($stage != null){

            if($stage->user_id == $user_id){
                return view('admin.curiosities.create', compact('stage_id'));
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
    public function store(CuriosityRequest $request)
    {

        $stage_id= $_GET['Stage'];

        $form_data= $request->all();

        $new_curiosity = new Curiosity;

        $new_curiosity-> curiosity = $form_data['curiosity'];

        $new_curiosity->save();

        $curiosity = Curiosity::where('curiosity', $form_data['curiosity'])->get();

        $curiosity_id = $curiosity[0]->id;

        $stage = Stage::find($stage_id);

        $stage->curiosities()->attach($curiosity_id);


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
    public function update(CuriosityRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curiosity $curiosity)
    {
        $stage = $curiosity->stages[0]->id;

        $curiosity->delete();

        return redirect()->route('admin.stages.show', compact('stage'));
    }
}
