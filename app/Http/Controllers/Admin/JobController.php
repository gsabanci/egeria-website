<?php

namespace App\Http\Controllers\Admin;

use Str;
use App\Models\Job;
use App\Models\Theme;
use App\Models\Office;
use App\Models\JobOffice;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }

    public function home()
    {
        $lang = App::getLocale();

        $d['job_categories'] = JobCategory::where('lang_code', $lang)->get();
        $d['theme'] = Theme::where('id', 1)->first();
        $d['jobs'] = Job::with("offices.office")->paginate(10);
        $d['jobs_count'] = Job::get()->count();
        $d['offices'] = Office::get();
        $d['data'] = array(
            'button' => array(
                'id' => 'isekle',
                'title' => 'İş İlanı Ekle',
            ),
            'pagetitle' => 'İş İlanları',
            'records' => $d['jobs_count'],
            'has_search' => null
        );
        return view('backend.pages.job', $d);
    }
    public function job_add(Request $r)
    {
        $check = Job::where('title', $r->title)->first();
        if (!is_null($check)) {
            return redirect()->back()->with('error', 'Girdiğiniz başlıkta iş ilanınız bulunmaktadır.');
        }
        $job = new Job();
        $job->job_guid = Str::uuid();
        $job->title = $r->title;
        $job->slug = Str::slug($r->title);
        $job->desc = $r->desc;
        $job->jc_guid = $r->jc_guid;
        $job->short_desc = $r->short_desc;
        if ($r->office_guid[0] == 'all') {
            $offices = Office::get();
            foreach ($offices as $og) {
                $jo = new JobOffice();
                $jo->job_guid = $job->job_guid;
                $jo->office_guid = $og->office_guid;
                $jo->save();
            }
        } else {
            foreach ($r->office_guid as $og) {
                $jo = new JobOffice();
                $jo->job_guid = $job->job_guid;
                $jo->office_guid = $og;
                $jo->save();
            }
        }
        $job->kariyernet = $r->kariyernet;
        $job->linkedin = $r->linkedin;
        $job->is_active = $r->is_active;
        $job->lang_code = $r->lang_code;
        $job->save();

        return redirect()->back()->with('success', 'İş ilanı başarıyla kaydedildi.');
    }
    public function job_edit(Request $r)
    {
        $job = Job::where('job_guid', $r->job_guid)->first();
        $job->title = $r->title;
        $job->slug = Str::slug($r->title);
        $job->desc = $r->desc;
        $job->jc_guid = $r->jc_guid;
        $job->short_desc = $r->short_desc;
        if ($r->office_guid[0] == 'all') {
            JobOffice::where("job_guid", $r->job_guid)->delete();
            $offices = Office::get();
            foreach ($offices as $og) {
                $jo = new JobOffice();
                $jo->job_guid = $job->job_guid;
                $jo->office_guid = $og->office_guid;
                $jo->save();
            }
        } else {
            JobOffice::where("job_guid", $r->job_guid)->delete();
            foreach ($r->office_guid as $og) {
                $jo = new JobOffice();
                $jo->job_guid = $job->job_guid;
                $jo->office_guid = $og;
                $jo->save();
            }
        }
        $job->kariyernet = $r->kariyernet;
        $job->linkedin = $r->linkedin;
        $job->is_active = $r->is_active;
        $job->update();
        return redirect()->back()->with('success', 'Başarıyla Düzenlendi');
    }
    public function job_delete(Request $r)
    {
        $job = Job::where('job_guid', $r->job_guid)->first();
        $job->delete();
        JobOffice::where("job_guid", $r->job_guid)->delete();
        return redirect()->back()->with('success', 'İş ilanı başarıyla silindi.');
    }
}
