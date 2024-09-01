<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Http\Requests\DayRequest;

use App\Models\Day;

use App\Models\Stage;

use Illuminate\Support\Facades\DB;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $days = Day::where('user_id', Auth::id())->get();
        $stages = Stage::where('user_id', Auth::id())->get();
        return view('admin.days.index', compact('days', 'stages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $days = Day::where('user_id', Auth::id())->get();
        return view('admin.days.create', compact('days'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DayRequest $request)
    {
        $form_data= $request->all();

        $start = $form_data['start_date'];
        $end = $form_data['ending_date'];

        $days = Day::getDay($start, $end);

        $new_date = new Day;


        for($i = 0; $i <= $days; $i++){
            DB::table('days')->insert([
                'title' => 'Giorno '. $i,
                'date' => Day::getDate($start, $i),
                'user_id' => Auth::id(),
            ]);
        }

        return redirect()->route('admin.days.index');

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
    public function destroy(Day $day)
    {
        $day->delete();

        return redirect()->route('admin.days.index');
    }

}
