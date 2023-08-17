<?php

namespace App\Http\Controllers;

use App\Exceptions\NonAuthorizedException;
use App\Models\Habitation;
use App\MyStaff\ResponseHelper;
use Illuminate\Http\Request;
use App\Http\Requests\HabitationFiteredRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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

    public function index(HabitationFiteredRequest $request)
    {
        // if the flag filter is not set
        if(!$request->isFiltered())
            return ResponseHelper::json(Habitation::all());
        // if we want to filter the response

        if($request->has('min_price')) {
            
            // get the array without price and min_price
            $validated = array_diff_key(
                $request->validated(), 
                (['min_price'=> 0, 'price' => 0]));
            
            $habs = Habitation::where($validated)
                        ->where('price', '>=', $request['min_price'])
                        ->get();

        } else {
            $habs = Habitation::where($request->validated())->get();
        } 

        return ResponseHelper::json($habs);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request, int $id)
    {

        if(!self::exists($id))
        {
            return ResponseHelper::json([
                'error' => 'Could\'nt find an habitation with id ' . $id 
            ], 404);
        }

        //
        return ResponseHelper::json(Habitation::find($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(HabitationFiteredRequest $request, int $id)
    {

        $hab = Habitation::find($id);
        if(is_null($hab))
            return ResponseHelper::json([], 404);

        // check if user can update this habitation
        if(!Gate::allows('update-habit', $hab))
            throw new NonAuthorizedException();

        $inputs = array_diff_key( $request->validated(), ['min_price' => 0, 'area' => 0] );
        
        // if request does not contains datas
        if( empty($inputs) )
            return ResponseHelper::json(['error' => 'No data detected']);

        // update the table
        $hab = DB::table('habitations')
                    ->where(['id' => $id])
                    ->update($inputs);

        return ResponseHelper::json([ "message" => 'habitation with id ' . $id . ' has successfuly updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, int $id)
    {
        // if the $id is greater than  
        if(!self::exists($id))
            return ResponseHelper::json([
                'error' => 'Could\'nt find an habitation with id ' . $id 
            ], 404);

        Habitation::destroy($id);

        return ResponseHelper::json([ 'message' => 'Habitation with id ' . $id . ' is deleted' ]);
    }

    public function user(Request $request, int $id)
    {

        $hab = Habitation::find($id);
        if(is_null($hab))
            return ResponseHelper::json([
                'error' => 'Invalid Habitation id'
            ], 404);

        return ResponseHelper::json(['user' => $hab->user]);
    }
}
