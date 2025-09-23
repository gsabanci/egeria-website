<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\News;
use App\Models\Theme;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }

    public function home()
    {
        $d['category'] = Category::orderBy('queue', 'ASC')->paginate(10);
        $d['theme'] = Theme::where('id', 1)->first();
        $d['data'] = array(
            'button' => array(
                'title' => 'Kategori Ekle',
                'id' => 'kategoriekle',
            ),
            'pagetitle' => 'Kategori',
            'records' => null,
            'has_search' => null
        );

        $d['languages'] = Language::where('is_active', 1)->get();

        return view('backend.pages.categories', $d);
    }
    public function category_add(Request $r)
    {
        $category = new Category();
        $category->c_guid = Str::uuid();
        $category->name = $r->name;
        $category->lang_code = $r->lang_code;
        $category->slug = $r->slug;
        $category->queue = $r->queue;
        $category->save();
        return redirect()->back()->with('success', 'Kategori başarıyla eklendi.');
    }
    public function category_update(Request $r)
    {
        $update = Category::where('c_guid', $r->c_guid)->first();
        $update->name = $r->name;
        $update->slug = $r->slug;
        $update->update();
        return redirect()->back()->with('success', 'Kategori başarıyla güncellendi.');
    }
    public function category_delete(Request $r)
    {
        $delete = Category::where('c_guid', $r->c_guid)->first();
        $delete->delete();
        return redirect()->back()->with('success', 'Kategori başarıyla silindi.');
    }
}
