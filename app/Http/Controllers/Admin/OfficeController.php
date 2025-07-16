<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\Theme;
use Str;

class OfficeController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }
    
    public function home()
    {
        $d['theme'] = Theme::where('id',1)->first();
        $d['offices'] = Office::paginate(10);
        $d['offices_count']=Office::get()->count();
        $d['cities']=City::get();
        $d['data'] = array(
            'button' => array(
                'title' => 'Ofis Ekle',
                'id' => 'ofisekle',
            ),
            'pagetitle' => 'Ofisler',
            'records' => $d['offices_count'],
            'has_search' => null
        );
        
        return view('backend.pages.office',$d);
    }
    public function office_add(Request $r)
    {
        $check=office::where('title',$r->title)->first();
        if (!is_null($check)) {
        return redirect()->back()->with('error','Girdiğiniz isimde Ofisiniz bulunmaktadır.');
        }
        $office=new office();
        $office->office_guid=Str::uuid();
        $office->title=$r->title;
        $office->address=$r->address;
        $office->city_guid=$r->city_guid;
        $office->phone=$r->phone;
        $office->email=$r->email;
        $office->queue=$r->queue;
        $office->is_active=$r->is_active;
        $office->lang_code=$r->lang_code;
        $office->save();

        return redirect()->back();
    }
    public function office_edit(Request $r)
    {
        $office=Office::where('office_guid',$r->office_guid)->first();
        $office->title=$r->title;
        $office->address=$r->address;
        $office->city_guid=$r->city_guid;
        $office->phone=$r->phone;
        $office->email=$r->email;
        $office->queue=$r->queue;
        $office->is_active=$r->is_active;
        $office->update();
        return redirect()->back()->with('success','Başarıyla Düzenlendi');
    }
    public function office_delete($office_guid)
    {
       
        $office=Office::where('office_guid',$office_guid)->first();
        $office->delete();
        return redirect()->back()->with('success','Ofis başarıyla silindi.');
    }
}
