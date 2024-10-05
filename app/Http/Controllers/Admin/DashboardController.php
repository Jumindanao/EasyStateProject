<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function users()
    {
        $users= User::all();
        return view('admin.users.index',compact('users'));
    }
  
    public function viewuser($id)
    {
        $users= User::find($id);
        return view('admin.users.view',compact('users'));
    }

}
