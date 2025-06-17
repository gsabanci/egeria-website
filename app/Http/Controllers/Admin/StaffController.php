<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Office;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\Staff;
use Str;

class StaffController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }
    
    public function home()
    {
        $d['theme'] = Theme::where('id',1)->first();
        $d['offices']=Office::get();
        $d['data'] = array(
            'button' => array(
                'id'=>'personelekle',
                'title' => 'Personel Ekle',
            ),
            'pagetitle' => 'Personeller',
            'records' => 12,
            'has_search' => null
        );
        $d['staffs'] = Staff::paginate(10);
        return view('backend.pages.staff',$d);
    }
    public function staff_add(Request $r)
    {
        $check=Staff::where('fullname',$r->fullname)->first();
        if (!is_null($check)) {
        return redirect()->back()->with('error','Girdiğiniz isimde servisiniz bulunmaktadır.');
        }
        $staff=new Staff();
        $staff->staff_guid=Str::uuid();
        $staff->fullname=$r->fullname;
        $staff->title=$r->title;
        $staff->queue=$r->queue;
        if($r->hasFile('image')) {
            $image_name=$r->file('image')->getClientOriginalName();
            $r->file('image')->move(storage_path('app/public/staff_photos/'),$image_name);
            $staff->image=$image_name;
        }
        $staff->office_guid=$r->office_guid;
        $staff->email=$r->email;
        $staff->linkedin=$r->linkedin;
        $staff->is_active=$r->is_active;
        $staff->save();

        return redirect()->back()->with('success','Personel başarıyla kaydedildi.');
    }
    public function staff_edit(Request $r)
    {
        $staff=Staff::where('staff_guid',$r->staff_guid)->first();
        $staff->fullname=$r->fullname;
        $staff->title=$r->title;
        $staff->queue=$r->queue;
      
        if (!is_null($r->image)) {
            $image_name=$r->file('image')->getClientOriginalName();
            $r->file('image')->move(storage_path('app/public/staff_photos/'),$image_name);
            $staff->image=$image_name;
        }
       
        $staff->office_guid=$r->office_guid;
        $staff->email=$r->email;
        $staff->linkedin=$r->linkedin;
        $staff->is_active=$r->is_active;
        $staff->update();
        return redirect()->back()->with('success','Başarıyla Düzenlendi');
    }
    public function staff_delete($staff_guid)
    {
       
        $staff=Staff::where('staff_guid',$staff_guid)->first();
        $staff->delete();
        return redirect()->back()->with('success','Personel başarıyla silindi.');
    }
}
