<?php

namespace App\Http\Controllers\Admin;

use App\Models\Theme;
use App\Models\StaticText;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class StaticTextController extends Controller
{
  public function __construct()
  {
    $this->middleware('adminauth:admin');
  }

  public function home()
  {
    $d['page_title'] = 'Statik Metinler';
    $d['theme'] = Theme::where('id', 1)->first();

    $d['static_texts'] = StaticText::orderBy('key')->orderBy('lang_code')->paginate(10);

    $d['data'] = array(
      'button' => array(
        'title' => 'Metin Ekle',
        'id' => 'metinekle'
      ),
      'pagetitle' => 'Statik Metinler',
      'records' => null,
      'has_search' => null
    );
    return view('backend.pages.static_texts', $d);
  }

  public function add(Request $r)
  {
    $check = StaticText::where('key', $r->key)->where('lang_code', $r->lang_code)->first();
    if (!is_null($check)) {
      return redirect()->back()->with('error', 'Girdiğiniz isimde metin bulunmaktadır.');
    }
    $text = new StaticText();
    $text->key = $r->key;
    $text->label = $r->label;
    $text->value = $r->value;
    $text->lang_code = $r->lang_code;
    $text->save();

    return redirect()->back();
  }

  public function update(Request $r)
  { {
      $update = StaticText::where('id', $r->id)->first();
      $update->label = $r->label;
      $update->value = $r->value;
      $update->update();
      return redirect()->back()->with('success', 'Metin başarıyla güncellendi.');
    }
  }

  public function delete($id)
  {
    StaticText::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Metin silindi.');
  }
}
