<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Reference;
use App\Models\ReferencePage;

class ReferenceController extends Controller
{
    public function home()
    {
        $lang = App::getLocale();

        $d['references'] = Reference::orderBy('queue')->where('is_active', '1')->get();
        $d['title'] = ReferencePage::where('lang_code', $lang)->first()->first_title;
        $d['subtitle'] = ReferencePage::where('lang_code', $lang)->first()->first_title_subtitle;
        $d['page_title'] = 'Referanslarımız';
        $d['shortlink_title'] = 'Referanslarımız';
        return view('frontend.page.references', $d);
    }
}
