<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function ajax()
    {
        return view('admin.ajax');
    }

    public function send(Request $request)
    {
        return response()->json([
            'id' => $request->id,
            'status' => 'ok'
        ]);
    }
}
