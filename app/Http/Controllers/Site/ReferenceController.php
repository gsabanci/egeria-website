<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reference;
use App\Models\ReferencePage;

class ReferenceController extends Controller
{
    public function home()
    {
        $d['references'] = Reference::orderBy('queue')->where('is_active','1')->get();
        $d['title'] = ReferencePage::first()->first_title;
        $d['subtitle'] = ReferencePage::first()->first_title_subtitle;
        $d['page_title'] = 'Referanslarımız';
        $d['shortlink_title'] = 'Referanslarımız';
        return view('frontend.page.references', $d);
    }
}
