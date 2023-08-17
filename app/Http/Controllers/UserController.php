<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\MyStaff\ResponseHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    
    public function index(Request $request)
    {
        return ResponseHelper::json(User::all());
    }

    public function show(Request $request, int | string $id) 
    {

        if(is_numeric($id))
            $user = User::find($id);
        else
            $user = User::where('email', $id)->first();

        return ResponseHelper::json($user);
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, int $id) 
    {

    }

    public function destroy(Request $request, int $id)
    {
        
    }

    public function habitations(Request $request, $id) {

        $user = User::find($id);
        if(is_null($user))
            return ResponseHelper::json([
                'error' => 'Invalid User Id'
            ]);
        
        $habs = $user->habitations;
        return ResponseHelper::json([
            'user' => $user,
            'habitations' => $habs
        ]);
    }

}
