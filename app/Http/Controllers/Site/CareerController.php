<?php

namespace App\Http\Controllers\Site;

use Str;
use Mail;
use App\Models\Job;
use App\Models\JobFaq;
use App\Models\Office;
use App\Mail\CareerMail;
use App\Models\JobApply;
use App\Models\CareerPage;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;

class CareerController extends Controller
{
    public function home()
    {   
        $d['jc_guid']=null;
        $d['job_categories']=JobCategory::get();
        $d['jobs']=Job::with('offices.office')->get();
        $d['office_count'] = Office::count();
        $d['faq']=JobFaq::get();
        $d['page_title'] = 'Kariyer';
        $d['shortlink_title'] = 'Kariyer';
        $d['title'] = CareerPage::first()->title;
        $d['subtitle'] = CareerPage::first()->subtitle;
        return view('frontend.page.career', $d);
    }
   
    public function filter($slug)
    {   $guid=JobCategory::where('slug',$slug)->first();
        $d['job_categories']=JobCategory::get();
        $d['jobs']=Job::where('jc_guid',$guid->jc_guid)->with('office')->get();
        $d['faq']=JobFaq::get();
        $d['jc_guid']=$guid->jc_guid;
        $d['office_count'] = Office::count();
        $d['page_title'] = 'Kariyer';
        $d['shortlink_title'] = 'Kariyer';
        $d['title'] = CareerPage::first()->title;
        $d['subtitle'] = CareerPage::first()->subtitle;
        return view('frontend.page.career', $d);
    }
    
    public function detail($slug)
    {
        $d['job_detail']=Job::Where('slug',$slug)->first();
        $d['page_title'] = $d['job_detail']->title.' Başvuru Formu';
        $d['shortlink_title'] = $d['job_detail']->title . ' Başvuru Formu';

        return view('frontend.page.job_apply',$d);
    }

    public function job_apply(Request $r)
    {
        $valid = $r->validate([
            'name' => 'required',
            'surname' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'cv' => 'required',
            'g-recaptcha-response' => 'recaptcha',
        ]);

        $apply=new JobApply();
        $apply->ja_guid=Str::uuid();
        $apply->job_guid = $r->job_guid;
        $apply->name=$r->name;
        $apply->surname=$r->surname;
        $apply->fullname=$r->name.' '.$r->surname;
        $apply->phone=$r->phone;
        $apply->email=$r->email;
        $apply->readed='0';
       
        $file=$r->file('cv');
        $filename=$file->getClientOriginalName();
        $file->move(storage_path('app/public/cv/'),$filename);
        $apply->cv=$filename;
        
        $apply->save();

        try {
            $job = Job::where("job_guid", $r->job_guid)->first();

            $array = [
                'name' => $r->name,
                'surname' => $r->surname,
                'phone' => $r->phone,
                'email' => $r->email,
                'job_title' => $job->title,
                'attach' => $filename
            ];

            $mailaddr = SystemSetting::where("s_key", "career-mail")->first()->s_value;

            Mail::to($mailaddr)->send(new CareerMail($array));
        } catch (\Throwable $th) {
            //throw $th;
        }

        return redirect()->back()->with('success','İş başvurunuz başarıyla alınmıştır.');
    }
}
