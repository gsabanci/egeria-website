<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Theme;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }
    
    public function home()
    {
        $d['contact']=Contact::get();
        $d['theme'] = Theme::where('id', 1)->first();
        $d['data'] = array(
            'button' => array(

                'title' => null,
                'id' => null
            ),
            'pagetitle' => 'İletişim',
            'records' => null,
            'has_search' => null
        );
        return view('backend.pages.contact',$d);
    }
    public function delete(Request $r)
    {
        $delete=Contact::where('contact_guid',$r->contact_guid)->first();
        $delete->delete();
        return redirect()->back()->with('success','Talep başarıyla silindi.');
    }
}
