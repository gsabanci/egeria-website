<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\News;
use App\Models\Theme;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsCategoryController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }
    
    public function home()
    {
        $d['category'] = NewsCategory::paginate(10);
        $d['theme'] = Theme::where('id', 1)->first();
        $d['data'] = array(
            'button' => array(
                'title' => 'Haber Kategorisi Ekle',
                'id' => 'haberkategorisiekle',
            ),
            'pagetitle' => 'Haber Kategorisi',
            'records' => null,
            'has_search' => null
        );

        return view('backend.pages.news_categories', $d);
    }
    public function add(Request $r)
    {
        $category = new NewsCategory();
        $category->nc_guid = Str::uuid();
        $category->name = $r->name;
        $category->slug = $r->slug;
        $category->lang_code = $r->lang_code;
        $category->save();
        return redirect()->back()->with('success', 'Kategori başarıyla eklendi.');
    }
    public function update(Request $r)
    {
        $update = NewsCategory::where('nc_guid', $r->nc_guid)->first();
        $update->name = $r->name;
        $update->slug = $r->slug;
        $update->update();
        return redirect()->back()->with('success', 'Kategori başarıyla güncellendi.');
    }
    public function delete(Request $r)
    {
        $news = News::where("nc_guid", $r->nc_guid)->get();
        if (count($news) > 0) {
            foreach($news as $n) {
                $n->nc_guid = null;
                $n->update();
            }
        }
        
        $delete = NewsCategory::where('nc_guid', $r->nc_guid)->first();
        $delete->delete();
        return redirect()->back()->with('success', 'Kategori başarıyla silindi.');
    }
}
