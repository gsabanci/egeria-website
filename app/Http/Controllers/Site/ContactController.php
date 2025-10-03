<?php

namespace App\Http\Controllers\Site;

use Str;
use Mail;
use Validator;
use App\Mail\DemoMail;
use App\Models\Office;
use App\Models\Contact;
use App\Models\DemoReq;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function home()
    {
        $lang = App::getLocale();

        $d['offices']=Office::with('city')->where('lang_code', $lang)->where('is_active',1)->get();
        $d['page_title'] = 'İletişim';
        $d['shortlink_title'] = 'İletişim';
        return view('frontend.page.contact', $d);
    }
    public function send_form(Request $r)
    {
        $valid = $r->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'company_name' => 'required',
            'g-recaptcha-response' => 'recaptcha',
        ]);

        $array=[
            'name'=>$r->name,
            'surname'=>$r->surname,
            'phone'=>$r->phone,
            'email'=>$r->email,
            'company_name'=>$r->company_name,
            'msg'=>$r->msg,
        ];

        $mailaddr = SystemSetting::where("s_key","contact-mail")->first()->s_value;

        try {
            Mail::to($mailaddr)->send(new ContactMail($array));
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect()->back()->with('success','İletişim talebiniz başarıyla alınmıştır.');
    }

    public function send_req(Request $r)
    {

        $validator = Validator::make($r->all(), [
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'msg' => 'required',
        ]);

        if ($validator->fails()) {
            $d['result'] = 400;
            $d['msg'] = "Lütfen tüm alanları eksiksiz doldurunuz ve geçerli bilgiler girdiğinizden emin olunuz.";
            return response()->json($d, 200);
        } else {
            $m=new DemoReq();
            $m->req_guid=Str::uuid();
            $m->name=$r->name;
            $m->surname=$r->surname;
            $m->phone=$r->phone;
            $m->email=$r->email;
            $m->message = $r->msg;
            $m->save();
    
            try {
                $array = [
                    'name' => $r->name,
                    'surname' => $r->surname,
                    'phone' => $r->phone,
                    'email' => $r->email,
                    'msg' => $r->msg,
                ];

                $mailaddr = SystemSetting::where("s_key", "demo-request-mail")->first()->s_value;
                
                Mail::to($mailaddr)->send(new DemoMail($array));
            } catch (\Throwable $th) {
                //throw $th;
            }

            // Webhook servisine POST isteği gönder
            try {
                $webhookUrl = env('WEBHOOK_URL');
                $webhookAuth = env('WEBHOOK_AUTH');
                $customerId = env('WEBHOOK_CUSTOMER_ID');
                $personId = env('WEBHOOK_PERSON_ID');

                if ($webhookUrl && $webhookAuth && $customerId && $personId) {
                    $notifyText = "
Egeria ERP Demo Talebi
Ad Soyad: {$r->name} {$r->surname}
E-posta: {$r->email}
Telefon: {$r->phone}
Notlar: {$r->msg}
                    ";

                    $response = Http::withHeaders([
                        'Authorization' => 'Basic ' . $webhookAuth,
                        'Content-Type' => 'application/json',
                    ])->post($webhookUrl, [
                        'CustomerId' => $customerId,
                        'PersonId' => $personId,
                        'NotifyText' => trim($notifyText),
                    ]);

                    // Log webhook response (opsiyonel)
                    if (!$response->successful()) {
                        Log::warning('Webhook request failed', [
                            'status' => $response->status(),
                            'body' => $response->body()
                        ]);
                    }
                }
            } catch (\Throwable $th) {
                // Webhook hatası uygulamayı durdurmaz
                Log::error('Webhook error: ' . $th->getMessage());
            }
    
            $d['result'] = 200;
            $d['msg'] = 'Demo talebiniz başarıyla alınmıştır.';
            return response()->json($d, 200);
        }
    }
}
