<?php

namespace App\Http\Controllers\Site;

use App\Models\Corporate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class CorporateController extends Controller
{
    public function corporate_detail($slug)
    {
        $lang = App::getLocale();

        $d['corporate_detail'] = Corporate::where('slug', $slug)->where('lang_code', $lang)->where('status', '1')->first();
        $d['page_title'] = $d['corporate_detail']->title;
        return view('frontend.page.corporate_detail', $d);
    }
}
