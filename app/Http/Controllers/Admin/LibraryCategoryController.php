<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Models\LibraryCategory;
use App\Http\Controllers\Controller;
use App\Models\Library;

class LibraryCategoryController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }

    public function home()
    {
        $d['category'] = LibraryCategory::paginate(10);
        $d['theme'] = Theme::where('id', 1)->first();
        $d['data'] = array(
            'button' => array(
                'title' => 'Kütüphane Kategorisi Ekle',
                'id' => 'kutuphanekategorisiekle',
            ),
            'pagetitle' => 'Kütüphane Kategorisi',
            'records' => null,
            'has_search' => null
        );

        return view('backend.pages.library_categories', $d);
    }

    public function add(Request $r)
    {
        $allCatCount = LibraryCategory::count();
        $category = new LibraryCategory();
        $category->library_category_guid = Str::uuid();
        $category->title = $r->title;
        $category->lang_code = $r->lang_code;
        $category->slug = $r->slug;
        $category->order = !is_null($r->order) ? $r->order : $allCatCount + 1;
        $category->save();

        return redirect()->back()->with('success', 'Kütüphane kategorisi başarıyla eklendi.');
    }

    public function update(Request $r)
    {
        $allCatCount = LibraryCategory::count();
        $category = LibraryCategory::where("library_category_guid", $r->library_category_guid)->first();
        if(is_null($category)) {
            return redirect()->back()->with('error', 'Kütüphane kategorisi silinmiş veya mevcut değil.');
        }

        $category->title = $r->title;
        $category->slug = Str::slug($r->title);
        $category->order = !is_null($r->order) ? $r->order : $allCatCount + 1;
        $category->update();

        return redirect()->back()->with('success', 'Kütüphane kategorisi başarıyla düzenlendi.');
    }

    public function delete(Request $r)
    {
        $libs = Library::where("library_category_guid", $r->library_category_guid)->get();
        if (count($libs) > 0) {
            foreach($libs as $lib) {
                $lib->library_category_guid = null;
                $lib->update();
            }
        } 

        $delete = LibraryCategory::where('library_category_guid', $r->library_category_guid)->first();
        $delete->delete();

        return redirect()->back()->with('success', 'Kütüphane kategorisi başarıyla silindi.');
    }
}
