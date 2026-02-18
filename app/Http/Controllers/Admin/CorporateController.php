<?php

namespace App\Http\Controllers\Admin;

use App\Models\Corporate;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class CorporateController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }

    public function home()
    {
        $d['corporates'] = Corporate::paginate(10);
        $d['theme'] = Theme::where('id', 1)->first();
        $d['data'] = array(
            'button' => array(
                'title' => 'Kurumsal İçerik Ekle',
                'id' => 'kurumsalekle',
            ),
            'pagetitle' => 'Kurumsal',
            'records' => null,
            'has_search' => null
        );

        return view('backend.pages.corporate', $d);
    }
    public function corporate_add(Request $r)
    {
        $corporate = new Corporate();
        $corporate->lang_code = $r->lang_code;
        $corporate->title = $r->title;
        $corporate->subtitle = $r->subtitle;
        $corporate->short_desc = $r->short_desc;
        $corporate->long_desc = $r->long_desc;
        $corporate->slug = $r->slug;
        $corporate->content = $r->content;
        $corporate->queue = $r->queue;
        $corporate->status = $r->status;

        if ($r->hasFile('image')) {
            $coverimg = $r->file('image')->getClientOriginalName();
            $r->file('image')->move(storage_path('app/public/corporate/cover/'), $coverimg);
            $corporate->image = $coverimg;
        }

        if ($r->hasFile('docname')) {
            $docfile = $r->file('docname')->getClientOriginalName();
            $r->file('docname')->move(storage_path('app/public/corporate/file/'), $docfile);
            $corporate->docname = $docfile;
        }


        $corporate->save();

        return redirect()->back()->with('success', 'Kurumsal içerik başarıyla eklendi.');
    }
    public function corporate_edit(Request $r)
    {
        $corporate = Corporate::where("id", $r->id)->first();
        $corporate->title = $r->title;
        $corporate->slug = $r->slug;
        $corporate->subtitle = $r->subtitle;
        $corporate->short_desc = $r->short_desc;
        $corporate->long_desc = $r->long_desc;
        $corporate->content = $r->content;
        $corporate->queue = $r->queue;
        $corporate->status = $r->status;

        if ($r->hasFile('image')) {
            $coverimg = $r->file('image')->getClientOriginalName();
            $r->file('image')->move(storage_path('app/public/corporate/cover/'), $coverimg);
            $corporate->image = $coverimg;
        }

        if ($r->hasFile('docname')) {
            $docfile = $r->file('docname')->getClientOriginalName();
            $r->file('docname')->move(storage_path('app/public/corporate/file/'), $docfile);
            $corporate->docname = $docfile;
        }

        $corporate->update();

        return redirect()->back()->with('success', 'Kurumsal içerik başarıyla güncellendi.');
    }
    public function corporate_delete(Request $r)
    {
        $corporate = Corporate::where("id", $r->id)->first();
        $corporate->delete();

        return redirect()->back()->with('success', 'Kurumsal içerik başarıyla silindi.');
    }
}
