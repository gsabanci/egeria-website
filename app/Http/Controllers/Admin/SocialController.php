<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Social;
use Illuminate\Http\Request;
use App\Models\Theme;
use Str;

class SocialController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }
    
    public function home()
    {
        $d['theme'] = Theme::where('id', 1)->first();
        $d['socials'] = Social::paginate(10);
        $d['social_count'] = Social::get()->count();
        $d['data'] = array(
            'button' => array(
                'id' => 'sosyalmedyaekle',
                'title' => 'Sosyal Medya Ekle',
            ),
            'pagetitle' => 'Sosyal Medya Hesapları',
            'records' => $d['social_count'],
            'has_search' => null
        );
        return view('backend.pages.social', $d);
    }
    public function social_add(Request $r)
    {
        $check=social::where('title',$r->title)->first();
        if (!is_null($check)) {
        return redirect()->back()->with('error','Girdiğiniz başlıkta sosyal medyanız bulunmaktadır.');
        }
        $social=new social();
        $social->social_guid=Str::uuid();
        $social->title=$r->title;
        $social->link=$r->link;
        $social->queue=$r->queue;
        $social->is_active=$r->is_active;
        $social->save();

        return redirect()->back()->with('success','Sosyal medya başarıyla kaydedildi.');
    }
    public function social_edit(Request $r)
    {
        $social=social::where('social_guid',$r->social_guid)->first();
        $social->title=$r->title;
        $social->link=$r->link;
        $social->queue=$r->queue;
        $social->is_active=$r->is_active;
        $social->update();
        return redirect()->back()->with('success','Başarıyla Düzenlendi');
    }
    public function social_delete($social_guid)
    {
        $social=social::where('social_guid',$social_guid)->first();
        $social->delete();
        return redirect()->back()->with('success','Sosyal medya başarıyla silindi.');
    }
}
