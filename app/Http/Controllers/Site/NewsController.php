<?php

namespace App\Http\Controllers\Site;

use App\Models\News;
use App\Models\Staff;
use App\Models\Office;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function home()
    {
        $lang = App::getLocale();

        $d['news'] = News::where('lang_code', $lang)->orderBy('queue', 'asc')->orderBy("created_at", "DESC")->get();
        $d['news_categories'] = NewsCategory::get();
        $d['page_title'] = 'Haberler';
        $d["is_main"] = true;
        $d['nc_guid'] = null;
        return view('frontend.page.news', $d);
    }

    public function category($slug)
    {
        $lang = App::getLocale();

        $category = NewsCategory::where('slug', $slug)
            ->where('lang_code', $lang)
            ->first();
        if (is_null($category)) {
            return redirect()->back();
        }
        $d['page_title'] = $category->name . ' - Haberler';
        $d["is_main"] = false;
        $d['news_cat_title'] = $category->name;
        $d['news_categories'] = NewsCategory::get();
        $d['news'] = News::where('lang_code', $lang)
            ->whereIn(
                'nc_guid',
                NewsCategory::select('nc_guid')
                    ->where('slug', $slug)
                    ->where('lang_code', $lang)
            )
            ->orderBy('queue', 'asc')
            ->orderBy('created_at', 'DESC')->get();
        // $d['nc_guid'] = $category->nc_guid;
        // $d['news'] = News::where("nc_guid", $category->nc_guid)->orderBy('queue', 'asc')->orderBy("created_at", "DESC")->paginate(12);
        return view('frontend.page.news', $d);
    }

    public function detail($slug, Request $r)
    {
        $lang = App::getLocale();

        if ($r->has('office_guid')) {
            $d['o_guid'] = $r->office_guid;
            if ($r->office_guid != 'all') {
                $d['staff'] = Staff::where('office_guid', $r->office_guid)->where('is_active', '1')->orderBy('queue', 'ASC')->get();
            } else {
                $d['staff'] = Staff::where('is_active', '1')->orderBy('queue', 'ASC')->get();
            }

            $d['offices'] = Office::where('is_active', '1')->orderBy('queue', 'ASC')->get();

            $d['news_detail'] = News::where('lang_code', $lang)->where('slug', $slug)->first();
            $d['other_news'] = News::where('lang_code', $lang)->where('slug', '<>', $slug)->inRandomOrder()->limit(3)->get();
            $d['page_title'] = $d['news_detail']->title . ' ' . 'Detay';
            $d['shortlink_title'] = $d['news_detail']->title;
            $d['shortlink_subtitle'] = $d['news_detail']->short_desc;
            $d['shortlink_image'] = asset('/storage/news_photos/' . $d["news_detail"]->image);
            return view('frontend.page.news_detail', $d);
        } else {
            $d['offices'] = Office::where('is_active', '1')->orderBy('queue', 'ASC')->get();
            $d['staff'] = Staff::where('is_active', '1')->orderBy('queue', 'ASC')->get();
            $d['o_guid'] = null;

            $d['news_detail'] = News::where('lang_code', $lang)->where('slug', $slug)->first();
            $d['other_news'] = News::where('lang_code', $lang)->where('slug', '<>', $slug)->inRandomOrder()->limit(3)->get();
            $d['page_title'] = $d['news_detail']->title . ' ' . 'Detay';
            $d['shortlink_title'] = $d['news_detail']->title;
            $d['shortlink_subtitle'] = $d['news_detail']->short_desc;
            $d['shortlink_image'] = asset('/storage/news_photos/' . $d["news_detail"]->image);

            return view('frontend.page.news_detail', $d);
        }
    }
}
