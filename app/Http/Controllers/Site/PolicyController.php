<?php

namespace App\Http\Controllers\Site;

use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class PolicyController extends Controller
{
    public function policy_detail($slug)
    {
        $lang = App::getLocale();

        $d['policy_detail'] = Policy::where('slug', $slug)->where('lang_code', $lang)->firstOrFail();
        $d['page_title'] = $d['policy_detail']->title;
        return view('frontend.page.policy_detail', $d);
    }
}
