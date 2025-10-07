<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\Theme;
use App\Models\Library;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LibraryCategory;

class LibraryController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }

    /**
     * Kütüphane Listesi
     */
    public function home()
    {
        $d['library_categories'] = LibraryCategory::where('lang_code', 'tr')->get();
        $d['libraries'] = Library::with("category")->paginate(10);
        $d['theme'] = Theme::where('id', 1)->first();
        $d['library_count'] = Library::count();
        $d['data'] = array(
            'button' => array(
                'id' => 'addDoc',
                'title' => 'Döküman Ekle',
            ),
            'pagetitle' => 'Kütüphane',
            'records' => $d['library_count'],
            'has_search' => null
        );

        return view('backend.pages.libraries', $d);
    }

    /**
     * Döküman Ekle
     */
    public function add(Request $r)
    {
        $lib = new Library();
        $lib->library_guid = Str::uuid();
        $lib->title = $r->title;
        $lib->slug = $r->slug;
        $lib->library_category_slug = $r->library_category_slug;
        $lib->short_desc = $r->short_desc;
        $lib->long_desc = $r->long_desc;
        $lib->is_active = $r->is_active;
        $lib->lang_code = $r->lang_code;
        $lib->order = $r->order;

        $coverimg = $r->file('image')->getClientOriginalName();
        $r->file('image')->move(storage_path('app/public/library/cover/'), $coverimg);
        $lib->image = $coverimg;

        $docfile = $r->file('docname')->getClientOriginalName();
        $r->file('docname')->move(storage_path('app/public/library/file/'), $docfile);
        $lib->docname = $docfile;

        $lib->save();

        return redirect()->back()->with('success', 'Döküman başarıyla eklendi.');;
    }

    /**
     * Döküman Düzenle
     */
    public function update(Request $r)
    {
        $lib = Library::where("library_guid", $r->library_guid)->first();
        if (is_null($lib)) {
            return redirect()->back()->with('error', 'Döküman daha önce silinmiş veya mevcut değil.');
        }

        $lib->title = $r->title;
        $lib->slug = $r->slug;
        $lib->library_category_guid = $r->library_category_guid;
        $lib->short_desc = $r->short_desc;
        $lib->long_desc = $r->long_desc;
        $lib->is_active = $r->is_active;
        $lib->order = $r->order;

        if ($r->hasFile('image')) {
            $coverimg = $r->file('image')->getClientOriginalName();
            $r->file('image')->move(storage_path('app/public/library/cover/'), $coverimg);
            $lib->image = $coverimg;
        }

        if ($r->hasFile('docname')) {
            $docfile = $r->file('docname')->getClientOriginalName();
            $r->file('docname')->move(storage_path('app/public/library/file/'), $docfile);
            $lib->docname = $docfile;
        }

        $lib->update();

        return redirect()->back()->with('success', 'Döküman başarıyla güncellendi.');;
    }

    /**
     * Döküman Sil
     */
    public function delete(Request $r)
    {
        $lib = Library::where("library_guid", $r->library_guid)->first();
        $lib->delete();

        return redirect()->back()->with('success', 'Döküman başarıyla silindi.');
    }
}
