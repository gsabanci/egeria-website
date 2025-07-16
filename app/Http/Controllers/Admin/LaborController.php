<?php

namespace App\Http\Controllers\Admin;

use App\Models\Labor;
use App\Models\Theme;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Str;

class LaborController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }
    
    public function home()
    {
        $d['labors'] = Labor::paginate(10);
        $d['theme'] = Theme::where('id', 1)->first();
        $d['data'] = array(
            'button' => array(
                'title' => 'Hizmet Ekle',
                'id'=>'hizmetekle',
            ),
            'pagetitle' => 'Hizmetler',
            'records' => null,
            'has_search' => null
        );

        return view('backend.pages.labors',$d);
    }

    //Hizmet Ekle
    public function labor_add(Request $r)
    {
        $labor = new Labor();
        $labor->labor_guid = Str::uuid();
        $labor->lang_code = $r->lang_code;
        $labor->title = $r->title;
        $labor->slug = $r->slug;
        $labor->content = $r->content;
        $labor->queue = $r->queue;
        $labor->status = $r->status;
        $labor->save();

        return redirect()->back()->with('success','Hizmet başarıyla eklendi.');
    }

    //Hizmet Düzenle
    public function labor_edit(Request $r)
    {
        $labor = Labor::where("labor_guid",$r->labor_guid)->first();
        $labor->labor_guid = Str::uuid();
        $labor->title = $r->title;
        $labor->slug = $r->slug;
        $labor->content = $r->content;
        $labor->queue = $r->queue;
        $labor->status = $r->status;
        $labor->update();

        return redirect()->back()->with('success','Hizmet başarıyla güncellendi.');
    }

    //Hizmet Düzenle
    public function labor_delete(Request $r)
    {
        $labor = Labor::where("labor_guid",$r->labor_guid)->first();
        $labor->delete();

        return redirect()->back()->with('success','Hizmet başarıyla silindi.');
    }

    
}
