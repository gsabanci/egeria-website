<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CareerPage;
use App\Models\JobFaq;
use App\Models\Theme;
use App\Models\Language;
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
        $d['sss']=JobFaq::orderBy('queue', 'ASC')->paginate(10);
        $d['faqs_count'] = JobFaq::get()->count();
        $d['languages'] = Language::where('is_active', 1)->get();
        $d['data'] = array(
            'button' => array(

                'title' => 'SSS Ekle',
                'id' => 'sssekle'
            ),
            'pagetitle' => 'SSS',
            'records' => $d['faqs_count'],
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
        $sss->lang_code=$r->lang_code;
        $sss->queue=$r->queue;
        $sss->save();
        return redirect()->back()->with('success','SSS başarıyla eklendi.');
    }

    public function faq_update(Request $r)
    {
        $faq = JobFaq::where('faq_guid',$r->faq_guid)->first();
        $faq->title = $r->title;
        $faq->description = $r->description;
        $faq->queue = $r->queue;
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