<?php

namespace App\Http\Controllers\Site;

use App\Models\News;
use App\Models\Library;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\LibraryCategory;
use App\Http\Controllers\Controller;

class LibraryController extends Controller
{
    public function home()
    {
        $lang = App::getLocale();

        $d['libs'] = Library::where("is_active", "1")->where('lang_code', $lang)->orderBy('order', 'asc')->orderBy("created_at", "DESC")->paginate(12);
        $d['lib_categories'] = LibraryCategory::where('lang_code', $lang)->get();
        $d['page_title'] = 'Kütüphane';
        $d['library_category_guid'] = null;
        return view('frontend.page.library', $d);
    }

    public function category($slug)
    {
        $lang = App::getLocale();

        $category = LibraryCategory::where('lang_code', $lang)
                               ->where('slug', $slug)
                               ->firstOrFail();
        if (is_null($category)) {
            return redirect()->back();
        }
        $d['page_title'] = $category->title . ' - Kütüphane';
        $d['libs_cat_title'] = $category->title;
        $d['lib_categories'] = LibraryCategory::where('lang_code', $lang)->get();
        $d['library_category_guid'] = $category->library_category_guid;
        $d['libs'] = Library::with('category')
        ->where('lang_code', $lang)->where('is_active', 1)->where('library_category_slug', $slug)
        ->orderBy('order', 'asc')
        ->orderBy('created_at', 'desc')->get();
        
        return view('frontend.page.library', $d);
    }

    public function detail($slug)
    {
        $lang = App::getLocale();

        $lib_detail = Library::where('slug', $slug)->where('lang_code', $lang)->where("is_active", "1")->first();
        if (is_null($lib_detail)) {
            return redirect()->back();
        }
        $d['lib_detail'] = $lib_detail;
        $d['other_libs'] = Library::where('slug', '<>', $slug)->inRandomOrder()->limit(3)->get();
        $d['page_title'] = $d['lib_detail']->title;
        $d['shortlink_title'] = $d['lib_detail']->title;
        $d['shortlink_subtitle'] = $d['lib_detail']->short_desc;
        $d['shortlink_image'] = asset('/storage/library/cover/' . $d["lib_detail"]->image);

        return view('frontend.page.library_detail', $d);
    }
}
