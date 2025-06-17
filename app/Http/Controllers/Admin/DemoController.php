<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DemoReq;
use App\Models\Theme;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }
    
    public function home()
    {
        $d['theme'] = Theme::where('id', 1)->first();
        $d['data'] = array(
            'button' => array(

                'title' => null,
                'id' => null
            ),
            'pagetitle' => 'Demo Talepleri',
            'records' => null,
            'has_search' => null
        );
        $d['demo']=DemoReq::paginate(10);

        return view('backend.pages.demo',$d);
    }

    public function delete(Request $r)
    {
        $delete=DemoReq::where('req_guid',$r->req_guid)->first();
        $delete->delete();
        return redirect()->back()->with('success','Demo Talebi başarıyla silindi.');
    }
}
