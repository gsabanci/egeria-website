<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Theme;
use App\Models\Language;
use Illuminate\Http\Request;
use Str;

class NewsController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }
    
    public function home()
    {   
        $d['news'] = News::with("category")->paginate(10);
        $d['news_count'] = News::get()->count();
        $d['theme'] = Theme::where('id', 1)->first();
        $d['data'] = array(
            'button' => array(
                'title' => 'Haber Ekle',
                'id' => 'haberekle',
            ),
            'pagetitle' => 'Haberler',
            'records' => $d['news_count'],
            'has_search' => null
        );
        $d['categories'] = NewsCategory::where('lang_code', 'tr')->get();
        $d['languages'] = Language::where('is_active', 1)->get();

        return view('backend.pages.news',$d);
    }

    public function news_detail($news_guid)
    {
        $d['news'] = News::where("news_guid", $news_guid)->with("category")->first();
        $d['theme'] = Theme::where('id', 1)->first();
        $d['data'] = array(
            'pagetitle' => $d['news']->title . ' - Haber Detay',
            'records' => 0,
            'has_search' => null
        );
        $d['categories'] = NewsCategory::get();
        return view('backend.pages.news_detail', $d);
    }

    public function news_add(Request $r)
    {
        $news=new News();
        $news->news_guid=Str::uuid();
        $news->title=$r->title;
        $news->slug=Str::slug($r->title);
        $news->lang_code = $r->lang_code;
        $news->short_desc=$r->short_desc;
        $news->detail=$r->detail;
        $news->nc_guid = $r->nc_guid;
        if (!is_null($r->image)) {
            $image_name=$r->file('image')->getClientOriginalName();
            $r->file('image')->move(storage_path('app/public/news_photos/'),$image_name);
            $news->image=$image_name;
        }
        if  ($r->hasFile('coverimage')) {
            $coverimage_name=$r->file('coverimage')->getClientOriginalName();
            $r->file('coverimage')->move(storage_path('app/public/news_photos/'),$coverimage_name);
            $news->coverimage=$coverimage_name;
        }
        $last = News::orderBy("queue")->first();
        if(!is_null($last)) {
            $news->queue = $last->queue - 1;
        }
        $news->is_active=$r->is_active;
        $news->save();

        return redirect()->back()->with('success','Haber başarıyla eklendi.');
    }
    public function news_update(Request $r)
    {
        $update=News::where('news_guid',$r->news_guid)->first();
        $update->title=$r->title;
        $update->slug=Str::slug($r->title);
        $update->short_desc=$r->short_desc;
        $update->nc_guid = $r->nc_guid;
        $update->detail=$r->detail;
        if (!is_null($r->image)) {
            $image_name=$r->file('image')->getClientOriginalName();
            $r->file('image')->move(storage_path('app/public/news_photos/'),$image_name);
            $update->image=$image_name;
        }
        if (!is_null($r->coverimage)) {
            $coverimage_name=$r->file('coverimage')->getClientOriginalName();
            $r->file('coverimage')->move(storage_path('app/public/news_photos/'),$coverimage_name);
            $update->coverimage=$coverimage_name;
        }
        $update->queue = $r->queue;
        $update->is_active=$r->is_active;
        $update->update();
        return redirect()->back()->with('success','Haber başarıyla güncellendi.');
    }
    public function news_delete(Request $r)
    {
        $delete=News::where('news_guid',$r->news_guid)->first();
        $delete->delete();
        return redirect()->back()->with('success','Haber başarıyla kaldırıldı.');

    }
}
