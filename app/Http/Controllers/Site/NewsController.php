<?php

namespace App\Http\Controllers\Site;

use App\Models\News;
use App\Models\Staff;
use App\Models\Office;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function home()
    {
        $d['news'] = News::orderBy('queue', 'asc')->orderBy("created_at", "DESC")->paginate(12);
        $d['news_categories'] = NewsCategory::get();
        $d['page_title'] = 'Haberler';
        $d["is_main"] = true;
        $d['nc_guid'] = null;
        return view('frontend.page.news', $d);
    }

    public function category($slug)
    {
        $category = NewsCategory::whereSlug($slug)->first();
        if (is_null($category)) {
            return redirect()->back();
        }
        $d['page_title'] = $category->name.' - Haberler';
        $d["is_main"] = false;
        $d['news_cat_title'] = $category->name;
        $d['news_categories'] = NewsCategory::get();
        $d['nc_guid'] = $category->nc_guid;
        $d['news'] = News::where("nc_guid",$category->nc_guid)->orderBy('queue', 'asc')->orderBy("created_at", "DESC")->paginate(12);
        return view('frontend.page.news', $d);
    }

    public function detail($slug,Request $r)
    {
        if ($r->has('office_guid')) {
            $d['o_guid'] = $r->office_guid;
            if($r->office_guid != 'all') {
                $d['staff'] = Staff::where('office_guid', $r->office_guid)->where('is_active', '1')->orderBy('queue', 'ASC')->get();
            } else {
                $d['staff'] = Staff::where('is_active', '1')->orderBy('queue', 'ASC')->get();
            }

            $d['offices'] = Office::where('is_active', '1')->orderBy('queue','ASC')->get();

            $d['news_detail'] = News::where('slug', $slug)->first();
            $d['other_news'] = News::where('slug', '<>', $slug)->inRandomOrder()->limit(3)->get();
            $d['page_title'] = $d['news_detail']->title . ' ' . 'Detay';
            $d['shortlink_title'] = $d['news_detail']->title;
            $d['shortlink_subtitle'] = $d['news_detail']->short_desc;
            $d['shortlink_image'] = asset('/storage/news_photos/' . $d["news_detail"]->image);
            return view('frontend.page.news_detail',$d);
        } else {
            $d['offices'] = Office::where('is_active', '1')->orderBy('queue','ASC')->get();
            $d['staff'] = Staff::where('is_active', '1')->orderBy('queue', 'ASC')->get();
            $d['o_guid'] = null;

            $d['news_detail'] = News::where('slug', $slug)->first();
            $d['other_news'] = News::where('slug', '<>', $slug)->inRandomOrder()->limit(3)->get();
            $d['page_title'] = $d['news_detail']->title . ' ' . 'Detay';
            $d['shortlink_title'] = $d['news_detail']->title;
            $d['shortlink_subtitle'] = $d['news_detail']->short_desc;
            $d['shortlink_image'] = asset('/storage/news_photos/' . $d["news_detail"]->image);

            return view('frontend.page.news_detail',$d);
        }
    }
}
