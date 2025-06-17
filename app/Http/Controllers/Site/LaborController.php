<?php

namespace App\Http\Controllers\Site;

use App\Models\Labor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaborController extends Controller
{
    public function labor_detail($slug)
    {   
        $d['labor_detail'] = Labor::where('slug',$slug)->where('status','1')->first();
        $d['page_title'] = $d['labor_detail']->title;
        return view('frontend.page.labor_detail', $d);
    }
}
