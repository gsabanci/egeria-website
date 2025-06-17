<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Staff;

class ServiceController extends Controller
{
    public function service_detail($slug,Request $r)
    {   
    
        if ($r->has('office_guid')) {
            $d['o_guid']=$r->office_guid;
            if($r->office_guid != 'all') {
                $d['staff'] = Staff::where('office_guid',$r->office_guid)->where('is_active', '1')->orderBy('queue', 'ASC')->get();
            } else {
                $d['staff'] = Staff::where('is_active', '1')->orderBy('queue', 'ASC')->get();
            }
            $d['offices']=Office::where('is_active','1')->orderBy('queue','ASC')->get();
            $d['service_detail'] = Service::where('slug',$slug)->where('is_active','1')->with('content')->first();
            $d['page_title'] = $d['service_detail']->name;
            $d['shortlink_title'] = $d['service_detail']->first_title;
            $d['shortlink_subtitle'] = $d['service_detail']->fist_title_subtitle;
            $d['shortlink_image'] = asset('/storage/industry_photos/' . $d["service_detail"]->image);
            return view('frontend.page.service_detail', $d);
        }else {
            $d['offices']=Office::where('is_active','1')->orderBy('queue','ASC')->get();
            $d['staff'] = Staff::where('is_active', '1')->orderBy('queue', 'ASC')->get();
            $d['o_guid']=null;
            $d['service_detail'] = Service::where('slug',$slug)->where('is_active','1')->with('content')->first();
            $d['page_title'] = $d['service_detail']->name;
            $d['shortlink_title'] = $d['service_detail']->first_title;
            $d['shortlink_subtitle'] = $d['service_detail']->fist_title_subtitle;
            $d['shortlink_image'] = asset('/storage/industry_photos/' . $d["service_detail"]->image);
            return view('frontend.page.service_detail', $d);
        }
     
    }
}
