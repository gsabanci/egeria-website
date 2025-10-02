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
use App\Models\StaticText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\SystemSetting;
use App\Models\Language;
use App\Http\Controllers\Controller;

class CareerController extends Controller
{
    public function home()
    {
        $lang = App::getLocale();

        $d['jc_guid'] = null;
        $d['job_categories'] = JobCategory::where('lang_code', $lang)->get();
        $d['jobs'] = Job::where('lang_code', $lang)->where('is_active',1)->with('offices.office')->get();
        $d['office_count'] = Office::count();
        $d['languages'] = Language::where('is_active', 1)->get();
        $d['faq'] = JobFaq::where('lang_code', $lang)->get();
        $d['page_title'] = StaticText::where('key', 'kariyer')->where('lang_code', $lang)->first()->value;
        $d['shortlink_title'] = StaticText::where('key', 'kariyer')->where('lang_code', $lang)->first()->value;
        $d['title'] = CareerPage::where('lang_code', $lang)->first()->title;
        $d['subtitle'] = CareerPage::where('lang_code', $lang)->first()->subtitle;
        return view('frontend.page.career', $d);
    }

    public function filter($slug)
    {
        $lang = App::getLocale();

        $guid = JobCategory::where('slug', $slug)->where('lang_code', $lang)->first();
        $d['job_categories'] = JobCategory::where('lang_code', $lang)->get();
        $d['jobs'] = Job::where('lang_code', $lang)
            ->where('jc_guid', $guid->jc_guid)->where('is_active', 1)->with('office')->get();
        $d['faq'] = JobFaq::where('lang_code', $lang)->get();
        $d['jc_guid'] = $guid->jc_guid;
        $d['office_count'] = Office::count();
        $d['page_title'] = StaticText::where('key', 'kariyer')->where('lang_code', $lang)->first()->value;
        $d['shortlink_title'] = StaticText::where('key', 'kariyer')->where('lang_code', $lang)->first()->value;
        $d['title'] = CareerPage::where('lang_code', $lang)->first()->title;
        $d['subtitle'] = CareerPage::where('lang_code', $lang)->first()->subtitle;
        return view('frontend.page.career', $d);
    }

    public function detail($slug)
    {
        $lang = App::getLocale();

        $d['job_detail'] = Job::Where('slug', $slug)->where('lang_code', $lang)->first();
        $d['page_title'] = $d['job_detail']->title . ' Başvuru Formu';
        $d['shortlink_title'] = $d['job_detail']->title . ' Başvuru Formu';

        return view('frontend.page.job_apply', $d);
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

        $apply = new JobApply();
        $apply->ja_guid = Str::uuid();
        $apply->job_guid = $r->job_guid;
        $apply->name = $r->name;
        $apply->surname = $r->surname;
        $apply->fullname = $r->name . ' ' . $r->surname;
        $apply->phone = $r->phone;
        $apply->email = $r->email;
        $apply->readed = '0';

        $file = $r->file('cv');
        $filename = $file->getClientOriginalName();
        $file->move(storage_path('app/public/cv/'), $filename);
        $apply->cv = $filename;

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

        return redirect()->back()->with('success', 'İş başvurunuz başarıyla alınmıştır.');
    }
}
