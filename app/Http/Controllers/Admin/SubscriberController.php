<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subscription;
use App\Models\Theme;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }
    
    public function home()
    {
        $d['subscribers']=Subscription::paginate(10);
        $d['theme'] = Theme::where('id', 1)->first();
        $d['data'] = array(
            'button' => array(

                'title' => null,
                'id' => null
            ),
            'pagetitle' => 'E-bülten Aboneleri',
            'records' => null,
            'has_search' => null
        );
        return view('backend.pages.subscribers',$d);
    }
    public function delete(Request $r)
    {   
        $d=Subscription::where('subscription_guid',$r->subscription_guid)->first();
        $d->delete();
        return redirect()->back()->with('success','Abone başarıyla kaldırıldı.');
    }
}
