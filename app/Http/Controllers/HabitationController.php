<?php

namespace App\Http\Controllers;

use App\Models\Habitation;
use Illuminate\Http\Request;

class HabitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Habitation::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

        $hab = Habitation::find(['id' => $id]);
        if(count($hab) === 0)
        {
            return response()->json([
                'error' => 'Could\'nt find an habitation with id ' . $id 
            ], 404);
        }

        return response()->json($hab);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Habitation $habitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id)
    {
        // if the $id is greater than  
        if($id >= count(Habitation::all()))
            return response()->json([
                'error' => 'Could\'nt find an habitation with id ' . $id 
            ], 404);

        Habitation::destroy($id);

        return response()->json([
            'message' => 'Habitation with id ' . $id . ' is deleted'
        ]);
    }
}
