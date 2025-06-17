<?php

namespace App\Http\Controllers\Site;

use DB;
use Str;
use Mail;
use App\Models\News;
use App\Models\Staff;
use App\Models\JobFaq;
use App\Models\Office;
use App\Models\Category;
use App\Models\Reference;
use App\Models\AboutusCard;
use App\Mail\NewsletterMail;
use App\Models\Subscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(Request $r)
    {
        if ($r->has('office_guid')) {
            $d['o_guid']=$r->office_guid;
            $d['references'] = Reference::orderBy('queue', 'ASC')->where('is_active', '1')->get();
            if($r->office_guid != 'all') {
                $d['staff'] = Staff::where('office_guid',$r->office_guid)->where('is_active', '1')->orderBy('queue', 'ASC')->get();
            } else {
                $d['staff'] = Staff::where('is_active', '1')->orderBy('queue', 'ASC')->get();
            }
            $d['news'] = News::orderBy('queue','asc')->orderBy('created_at', 'DESC')->paginate(12);
            $d['offices'] = Office::with('city')->where('is_active', 1)->get();
            $d['aboutus_cards'] = AboutusCard::get();
            return view('frontend.page.dashboard', $d);
        } else {
            $d['o_guid']=null;
            $d['references'] = Reference::orderBy('queue', 'ASC')->where('is_active', '1')->get();
            $d['staff'] = Staff::where('is_active', '1')->orderBy('queue', 'ASC')->get();
            $d['news'] = News::orderBy('queue','asc')->orderBy('created_at', 'DESC')->paginate(12);
            $d['offices'] = Office::with('city')->where('is_active', 1)->get();
            $d['aboutus_cards'] = AboutusCard::get();
            return view('frontend.page.dashboard', $d);
        }
    }

    public function faqs()
    {
        $d['faq']=JobFaq::get();
        $d['page_title'] = 'Sık Sorulan Sorular';
        return view('frontend.page.faqs', $d);
    }

    public function subscription(Request $r)
    {
        $check = Subscription::where("email", $r->email)->first();
        if(!is_null($check)) {
            return redirect()->back()->with('error', 'Girmiş olduğunuz e-posta adresi e-bülten listesinde mevcuttur.');
        }

        $subscription=new Subscription();
        $subscription->subscription_guid=Str::uuid();
        $subscription->email = $r->email;
        $subscription->save();

        $array = [];

        try {
            Mail::to($r->email)->send(new NewsletterMail($array));
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect()->back()->with('success', 'Abonelik işleminiz başarıyla gerçekleşti.');
    }
}
