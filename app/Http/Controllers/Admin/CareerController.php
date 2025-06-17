<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerPage;
use App\Models\JobFaq;
use App\Models\Theme;
use Illuminate\Http\Request;
use Str;

class CareerController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }
    
    public function home()
    {
        $d['career_content']=CareerPage::first();
        $d['theme'] = Theme::where('id', 1)->first();
        $d['sss']=JobFaq::get();
        $d['data'] = array(
            'button' => array(
                'title' => null,
                'id' => null
            ),
            'pagetitle' => 'Kariyer İçerik',
            'records' => null,
            'has_search' => null
        );
        return view('backend.pages.career', $d);
    }

    public function career_content_update(Request $r)
    {
        $update=CareerPage::where('content_guid',$r->content_guid)->first();
        $update->title=$r->title;
        $update->subtitle=$r->subtitle;
        $update->update();
        return redirect()->back()->with('sucess','Kariyer sayfası içeriği başarıyla güncellendi.');
    }
}
