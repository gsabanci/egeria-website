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
        $d['career_contents'] = CareerPage::get();
        $d['theme'] = Theme::where('id', 1)->first();
        $d['sss'] = JobFaq::get();
        $d['data'] = array(
            'button' => array(
                'title' => 'Kariyer içerik Ekle',
                'id' => 'kariyerekle'
            ),
            'pagetitle' => 'Kariyer İçerik',
            'records' => null,
            'has_search' => null
        );
        return view('backend.pages.career', $d);
    }

    public function career_add(Request $r)
    {
        $career = new CareerPage();
        $career->content_guid = Str::uuid();
        $career->lang_code = $r->lang_code;
        $career->title = $r->title;
        $career->subtitle = $r->subtitle;
        $career->save();

        return redirect()->back()->with('success', 'Kariyer sayfası içeriği başarıyla eklendi.');
    }

    public function career_content_update(Request $r)
    {
        $update = CareerPage::where('content_guid', $r->content_guid)->first();
        $update->title = $r->title;
        $update->subtitle = $r->subtitle;
        $update->update();
        return redirect()->back()->with('sucess', 'Kariyer sayfası içeriği başarıyla güncellendi.');
    }

    public function career_delete(Request $r)
    {
        $delete = CareerPage::where("content_guid", $r->content_guid)->first();
        $delete->delete();
        return redirect()->back()->with('success', 'Kariyer sayfası içeriği başarıyla silindi.');
    }
}
