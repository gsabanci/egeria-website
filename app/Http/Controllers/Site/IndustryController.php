<?php

namespace App\Http\Controllers\Site;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Industry;
use App\Models\Office;
use App\Models\Staff;

class IndustryController extends Controller
{
    public function industry_detail($slug, Request $r)
    {
        $lang = App::getLocale();

        if ($r->has('office_guid')) {
            $d['o_guid'] = $r->office_guid;
            if ($r->office_guid != 'all') {
                $d['staff'] = Staff::where('office_guid', $r->office_guid)->where('is_active', '1')->orderBy('queue', 'ASC')->get();
            } else {
                $d['staff'] = Staff::where('is_active', '1')->orderBy('queue', 'ASC')->get();
            }
            $d['offices'] = Office::where('is_active', '1')->orderBy('queue', 'ASC')->get();


            $d['industry_detail'] = Industry::where('slug', $slug)->where('lang_code', $lang)->with('content')->first();
            $d['page_title'] = $d['industry_detail']->name;
            $d['shortlink_title'] = $d['industry_detail']->first_title;
            $d['shortlink_subtitle'] = $d['industry_detail']->first_title_subtitle;
            $d['shortlink_image'] = asset('/storage/industry_photos/' . $d["industry_detail"]->image);
            return view('frontend.page.industry_detail', $d);
        } else {
            $d['offices'] = Office::where('is_active', '1')->orderBy('queue', 'ASC')->get();
            $d['staff'] = Staff::where('is_active', '1')->orderBy('queue', 'ASC')->get();
            $d['o_guid'] = null;
            $d['industry_detail'] = Industry::where('slug', $slug)->where('lang_code', $lang)->with('content')->first();
            $d['page_title'] = $d['industry_detail']->name;
            $d['shortlink_title'] = $d['industry_detail']->first_title;
            $d['shortlink_subtitle'] = $d['industry_detail']->first_title_subtitle;
            $d['shortlink_image'] = asset('/storage/industry_photos/' . $d["industry_detail"]->image);
            return view('frontend.page.industry_detail', $d);
        }

    }
}
