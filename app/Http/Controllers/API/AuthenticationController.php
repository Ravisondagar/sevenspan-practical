<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

class AuthenticationController extends BaseController
{
    /**
     * user login method.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    'password' => 'required',
                ]);
        if($validator->fails()){
            return $this->handleError($validator->errors(), null, 400);
        }
         
        $user = User::where('email', $request->email)->first();
     
        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->handleError('The provided credentials are incorrect.', null, 400);
        }
        $success['token'] =  $user->createToken('LaravelSanctumAuth')->plainTextToken; 
        $success['user'] = $user;
        return $this->handleResponse($success, 'User logged-in!');
    }
}
