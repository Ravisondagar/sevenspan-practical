<?php

namespace App\Http\Controllers\API;

use App\Models\UserHobby;
use App\Http\Resources\UserResource;
use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;

class UserHobbyController extends BaseController
{
    // update user hobbies
    public function updateHobby(Request $request)
    {
        $user = $request->user();
        UserHobby::destroy($user->userHobbies->pluck('id'));
        foreach ($request->hobby as $value) {
            UserHobby::create(['user_id' => $user->id, 'hobby_id' => $value]);
        }
        $user->load('userHobbies.hobby');
        return $this->handleResponse(new UserResource($user), 'user hobby have been updated!');
    }
}
