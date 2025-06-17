<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;

class AdminController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }

    public function dashboard()
    {
        $d['theme'] = Theme::where('id',1)->first();
        $d['data'] = array(
            'button' => array(
                'route' => null,
                'title' => null,
            ),
            'pagetitle' => 'Dashboard',
            'records' => null,
            'has_search' => false
        );
        return view('backend.pages.dashboard',$d);
    }
}
