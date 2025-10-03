<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Language;
use App\Models\Theme;
use Str;

class LanguageController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }

    public function home()
    {
        $d['language'] = Language::orderBy('id', 'ASC')->paginate(10);
        $d['theme'] = Theme::where('id', 1)->first();
        $d['data'] = [
            'button' => [
                'title' => 'Dil Ekle',
                'id' => 'dilekle',
            ],
            'pagetitle' => 'Diller',
            'records' => null,
            'has_search' => null,
        ];
        return view('backend.pages.languages', $d);
    }

    public function add(Request $r)
    {
        $lang = new Language();
        $lang->language_guid = Str::uuid();
        $lang->code = $r->code;
        $lang->name = $r->name;
        $lang->is_active = $r->is_active ?? 1;
        if (!is_null($r->image)) {
            $image_name = $r->file('image')->getClientOriginalName();
            $r->file('image')->move(storage_path('app/public/flags/'), $image_name);
            $lang->image = $image_name;
        }
        $lang->save();

        return redirect()->back()->with('success', 'Dil başarıyla eklendi.');
    }

    public function update(Request $r)
    {
        $lang = Language::where('language_guid', $r->language_guid)->first();
        if (!$lang) {
            return redirect()->back()->with('error', 'Dil bulunamadı.');
        }

        $lang->code = $r->code;
        $lang->name = $r->name;
        $lang->is_active = $r->is_active ?? 1;
        if (!is_null($r->image)) {
            $image_name = $r->file('image')->getClientOriginalName();
            $r->file('image')->move(storage_path('app/public/flags/'), $image_name);
            $lang->image = $image_name;
        }
        $lang->update();

        return redirect()->back()->with('success', 'Dil başarıyla güncellendi.');
    }

    public function delete(Request $r)
    {
        $lang = Language::where('language_guid', $r->language_guid)->first();
        if ($lang) {
            $lang->delete();
        }

        return redirect()->back()->with('success', 'Dil başarıyla silindi.');
    }
}
