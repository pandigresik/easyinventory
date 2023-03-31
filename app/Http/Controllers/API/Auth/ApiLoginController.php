<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\AppBaseController;
use App\Models\Base\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ApiLoginController extends AppBaseController
{    
    public function requestToken(Request $request): string
    {                
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        
        $user = User::where(['email' => $request->email])->first();

        if(! $user || ! Hash::check($request->password, $user->password)){
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect'],
            ]);
        }

        $token = $user->createToken($request->device_name)->plainTextToken;
        // return $this->sendSuccess([
        //     'message' => 'Login success',
        //     'token' => $token,
        //     'token_type' => 'Bearer'
        // ]);
        header('Content-Type: application/json');  // <-- header declaration
        echo json_encode([
                'message' => 'Login success',
                'token' => $token,
                'token_type' => 'Bearer'
            ], true);    // <--- encode
        exit();                        
    }    
}
