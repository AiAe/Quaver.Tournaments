<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;

class UsersController extends Controller
{

    public function page()
    {
        $pageData[] = "";
        $pageData['seo']['title'] = "Users";

        $pageData['users'] = User::query()->paginate(50);

        return view('admin/users/users', $pageData);
    }

}
