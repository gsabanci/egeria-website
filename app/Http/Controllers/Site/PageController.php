<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function aboutus()
    {
        $d['page_title'] = 'Hakkımızda';
        $d['shortlink_title'] = 'Hakkımızda';
        return view('frontend.page.aboutus', $d);
    }
}
