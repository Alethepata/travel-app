<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests\NoteRequest;

use App\Http\Controllers\Controller;

use App\Models\Note;

use App\Models\Stage;

use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
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

                return view('admin.notes.create', compact('stage_id'));
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
    public function store(NoteRequest $request)
    {

        $stage_id= $_GET['Stage'];

        $form_data= $request->all();

        $new_note = new Note;

        $new_note-> note = $form_data['note'];

        $new_note->save();

        $note = Note::where('note', $form_data['note'])->get();

        $note_id = $note[0]->id;

        $stage = Stage::find($stage_id);

        $stage->notes()->attach($note_id);


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
    public function update(NoteRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {

        $stage = $note->stages[0]->id;

        $note->delete();

        return redirect()->route('admin.stages.show', compact('stage'));
    }
}
