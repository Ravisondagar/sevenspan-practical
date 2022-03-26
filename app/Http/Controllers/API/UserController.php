<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('userHobbies.hobby')->where('role', 'user')->get();
        return $this->handleResponse(UserResource::collection($users), 'users have been retrieved!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $inputs = $request->all();
        $inputs['password'] = bcrypt($request->password);
        $user = User::create($inputs);
        return $this->handleResponse(new UserResource($user), 'users have been created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('userHobbies.hobby')->where('role', 'User')->where('id', $id)->get();
        return $this->handleResponse(UserResource::collection($user), 'user have been retrieved!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        return $this->handleResponse(new UserResource($user), 'users have been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->handleResponse([],'user have been deleted!');
    }

    // Super admin can filter user listing by hobby
    public function filterUserHobby(Request $request)
    {
        $users = User::whereHas('userHobbies', function($query) use($request) {
            $query->whereIn('hobby_id', $request->hobby);
        })->get();
        return $this->handleResponse(UserResource::collection($users), 'users have been retrieved!');
    }
}
