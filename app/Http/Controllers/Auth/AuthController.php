<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\MyStaff\ResponseHelper;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{

    private function sendErrorMessageForRegistration() 
    {
        return ResponseHelper::json([
            'error' => 'Invalid Credentials'
        ]);
    }

    public function login(Request $request)
    {

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            
            $user = Auth::user();
            $success = [
                'id' => $user->id,
                'account_status' => $user->account_verification_status(),
                'name' => $user->name,
                'email' => $user->email,
                'token' => $user->createToken('MyApp')->plainTextToken
            ];

            return ResponseHelper::json($success);
        }

        return $this->sendErrorMessageForRegistration();
    }

    public function register(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:4',
            'email' => 'required|email',
            'password' => 'required|string|min:8',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()) 
            return $this->sendErrorMessageForRegistration();
        // get validated datas
        $inputs = $validator->validate();
        $inputs['password'] = Hash::make($inputs['password']);
        // create the user
        try {
            $user = User::create($inputs);
            // create the tokens and success array
            $success = [
                // 'account_status' => $user->email_verification_status(),
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'token' => $user->createToken('MyApp')->plainTextToken
            ];

            return ResponseHelper::json($success);
        } catch (Exception $e) {

            return ResponseHelper::json([
                'error' => 'Account already exists'
            ]);
        }
    }

}
