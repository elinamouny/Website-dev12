<?php

namespace App\Http\Controllers;

use App\Models\Habitation;
use App\MyStaff\ResponseHelper;
use Illuminate\Http\Request;

class HabitationController extends Controller
{

    public function __construct() { }

    /**
     * Check if an Habitation exists or not
     */
    public static function exists(int $id) : bool 
    {
        return count(Habitation::find(['id' => $id])) !== 0;
    }

    public function index()
    {
        return response(ResponseHelper::json(Habitation::all()));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, int $id)
    {
        if(!self::exists($id))
        {
            return response(ResponseHelper::json([
                'error' => 'Could\'nt find an habitation with id ' . $id 
            ]), 404);
        }

        //
        $hab = Habitation::find(['id' => $id]);
        return response(ResponseHelper::json($hab));
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
        if(!self::exists($id))
            return response(ResponseHelper::json([
                'error' => 'Could\'nt find an habitation with id ' . $id 
            ]), 404);

        Habitation::destroy($id);

        return response(ResponseHelper::json([
            'message' => 'Habitation with id ' . $id . ' is deleted'
        ]));
    }
}
