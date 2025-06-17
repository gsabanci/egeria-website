<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerPage;
use App\Models\JobFaq;
use App\Models\Theme;
use Illuminate\Http\Request;
use Str;

class FaqController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }
    
    public function faqs()
    {
        $d['career_content']=CareerPage::first();
        $d['theme'] = Theme::where('id', 1)->first();
        $d['sss']=JobFaq::get();
        $d['data'] = array(
            'button' => array(

                'title' => 'SSS Ekle',
                'id' => 'sssekle'
            ),
            'pagetitle' => 'SSS',
            'records' => null,
            'has_search' => null
        );
        return view('backend.pages.faqs', $d);
    }
    
    public function faq_add(Request $r)
    {
        $sss=New JobFaq();
        $sss->faq_guid=Str::uuid();
        $sss->title=$r->title;
        $sss->description=$r->description;
        $sss->save();
        return redirect()->back()->with('success','SSS başarıyla eklendi.');
    }

    public function faq_update(Request $r)
    {
        $faq = JobFaq::where('faq_guid',$r->faq_guid)->first();
        $faq->title = $r->title;
        $faq->description = $r->description;
        $faq->update();

        return redirect()->back()->with('success','SSS başarıyla güncellendi.');
    }

    public function faq_delete(Request $r)
    {
        $delete=JobFaq::where('faq_guid',$r->faq_guid)->first();
        $delete->delete();
        return redirect()->back()->with('success','SSS başarıyla silindi.');
    }
}