<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reference;
use App\Models\ReferencePage;
use App\Models\Theme;
use Illuminate\Http\Request;
use Str;

class ReferenceController extends Controller
{
  public function __construct()
  {
    return $this->middleware('adminauth:admin');
  }
  
  public function home()
  {
    $d['references']=Reference::get();
    $d['reference_page']=ReferencePage::first();
    $d['theme'] = Theme::where('id',1)->first();
    $d['data'] = array(
        'button' => array(
            'title' => 'Referans Ekle',
            'id' => 'referansekle',
        ),
        'pagetitle' => 'Referanslar',
        'records' => null,
        'has_search' => null
    );
    return view('backend.pages.references',$d);
  }
  public function reference_page_text_update(Request $r)
  {
    $update=ReferencePage::where('reference_page_guid',$r->reference_page_guid)->first();
    $update->first_title=$r->first_title;
    $update->first_title_subtitle=$r->first_title_subtitle;
    $update->second_subtitle=$r->second_subtitle;
    $update->update();
    return redirect()->back()->with('success','Referanslar sayfası içeriği başarıyla güncellendi.');
  }
  public function reference_add(Request $r)
  {
     $reference=New Reference();
     $reference->reference_guid=Str::uuid();
     $reference->name=$r->name;
     $reference->link=$r->link;
     $reference->queue=$r->queue;
     $reference->is_active=$r->is_active;
     if($r->has('bad_logo')) {
       $reference->bad_logo = '1';
     }
     $image_name=$r->file('logo')->getClientOriginalName();
     $r->file('logo')->move(storage_path('app/public/reference_images/'),$image_name);
     $reference->logo=$image_name;
     $reference->save();
     return redirect()->back()->with('success','Referans başarıyla eklendi.');
  }
  public function reference_delete(Request $r)
  {
    $delete=Reference::where('reference_guid',$r->reference_guid)->first();
    $delete->delete();
    return redirect()->back()->with('success','Referans başarıyla kaldırıldı.');
  }
}
