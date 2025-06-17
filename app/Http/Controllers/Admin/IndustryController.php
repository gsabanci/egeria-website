<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\industry;
use App\Models\IndustryContent;
use App\Models\Theme;
Use Str;

class industryController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }
    
    public function home()
    {
        $d['theme'] = Theme::where('id',1)->first();
        $d['industries'] = industry::orderBy('queue','ASC')->paginate(10);
        $d['industries_count'] = industry::get()->count();
        $d['data'] = array(
            'button' => array(
                'title' => 'Sektör Ekle',
                'id'=>'endustriekle'
            ),
            'pagetitle' => 'Sektörler',
            'records' => $d['industries_count'],
            'has_search' => null
        );
        
        return view('backend.pages.industry',$d);
    }
    public function industry_add(Request $r)
    {
        $check=industry::where('name',$r->name)->first();
        if (!is_null($check)) {
        return redirect()->back()->with('error','Girdiğiniz isimde servisiniz bulunmaktadır.');
        }
        $industry=new industry();
        $industry->industry_guid=Str::uuid();
        $industry->name=$r->name;
        $industry->slug=Str::slug($r->name);
        $industry->queue=$r->queue;
        $industry->save();
        

        return redirect()->back()->with('success','Endüstri başarıyla eklendi.');
    }
    public function industry_edit(Request $r)
    {
        $industry=industry::where('industry_guid',$r->industry_guid)->first();
        $industry->name=$r->name;
        $industry->queue=$r->queue;
        $industry->slug=Str::slug($r->name);
        $industry->update();
        return redirect()->back()->with('success','Başarıyla Düzenlendi');
    }
    public function industry_delete($industry_guid)
    {
       
        $industry=industry::where('industry_guid',$industry_guid)->first();
        $industry->delete();
        return redirect()->back()->with('success','Endüstri başarıyla silindi.');
    }
    public function industry_detail($industry_guid)
    {
        $d['industry_contents']=IndustryContent::where('industry_guid',$industry_guid)->get();
        
        $d['industry']=industry::where('industry_guid',$industry_guid)->first();
        $d['theme'] = Theme::where('id',1)->first();
        $d['data'] = array(
            'button' => array(
                
                'title' => null,
                'id'=>null
            ),
            'pagetitle' => 'Endüstri',
            'records' => null,
            'has_search' => true
        );
       return view('backend.pages.industry_detail',$d);
    }
    public function industry_detail_update(Request $r)
    {
        $update=Industry::where('industry_guid',$r->industry_guid)->first();
        $update->first_title=$r->first_title;
        $update->first_title_subtitle=$r->first_title_subtitle;
        $update->second_title=$r->second_title;
        $update->second_title_subtitle=$r->second_title_subtitle;
        $update->content_area_title=$r->content_area_title;
        if (!is_null($r->image)) {
            $image_name=$r->file('image')->getClientOriginalName();
            $r->file('image')->move(storage_path('app/public/industry_photos/'),$image_name);
            $update->image=$image_name;
        }
        
        $update->update();
        return redirect()->back()->with('success','Endüstri detayı başarıyla güncellendi.');
    }
    public function industry_content_add(Request $r)
    {
        $new=new IndustryContent();
        $new->industry_guid=$r->industry_guid;
        $new->content_guid=Str::uuid();
        $new->content_title=$r->content_title;
        $new->content=$r->content;
        $new->queue=$r->queue;
        $new->is_active=$r->is_active;
        $new->save();
        return redirect()->back()->with('success','Endüstri içeriği başarıyla eklendi');
    }
    public function industry_content_update(Request $r)
    {
       $update=IndustryContent::where('content_guid',$r->content_guid)->first();
       $update->content_title=$r->content_title;
       $update->content=$r->content;
       $update->queue=$r->queue;
       $update->is_active=$r->is_active;
       $update->update();
       return redirect()->back()->with('success','Endüstri içeriği başarıyla güncellendi.');
    }
    public function industry_content_delete(Request $r)
    {
        $delete=IndustryContent::where('content_guid',$r->content_guid)->first();
        $delete->delete();

        return redirect()->back()->with('success','Endüstri içeriği başarıyla silindi.');
    }
}
