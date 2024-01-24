<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        // $user = User::all();
        // $upload = Upload::find($id);
        return view('user.contuctus');
    }
}
