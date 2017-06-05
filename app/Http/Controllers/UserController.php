<?php

namespace App\Http\Controllers;

use App\Transformers\UserTransformer;
use Illuminate\Http\Request;

use App\User;

class UserController extends ApiBaseController
{
    //

    public function index()
    {
        $users = User::paginate(1);
        return $this->response->paginator($users, new UserTransformer());
    }
}
