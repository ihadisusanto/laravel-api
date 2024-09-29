<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * index
     * @return void
     */
    public function index(){
        //get all users
        $users = User::latest()->paginate(5); //5 users per page
        return new UserResource(true, 'List of all users', $users);
    }

    /**
     * store
     * @param Request $request
     * @return void
     */

    public function store(Request $request){
        //define the validators for user
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'username' => 'required|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required',
            'subscription' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        //create a new user
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' =>  password_hash($request->password, PASSWORD_BCRYPT),
            'role' => $request->role,
            'subscription' => $request->subscription
        ]);

        return new UserResource(true, 'User created successfully', $user);
    }

    //find user by username
    public function auth(Request $request){
        $user = User::where('username', $request->username)->first();
        if($user){
            if(password_verify($request->password, $user->password)){
                return new UserResource(true, 'User authenticated', $user);
            }
        }
        return new UserResource(false, 'Invalid username or password', null);
    }

    // public function update(Request $request, $id){
    //     //define validation rules
    //     $validator = Validator::make($request->all(),[
    //         'name' => 'required',
    //         'username' => 'required|unique:users',
    //         'email' => 'required|email|unique:users',
    //         'password' => 'required|confirmed',
    //         'role' => 'required',
    //         'subscription' => 'required',
    //     ]);
    // }
}
