<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobApply;
use App\Models\Theme;

class JobApplyController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }
    
    public function home()
    {
        $d['theme'] = Theme::where('id', 1)->first();
        $d['data'] = array(
            'button' => array(
                'route' => 'admin.jobapply.add',
                'title' => '#',
            ),
            'pagetitle' => 'İş Başvuruları',
            'records' => JobApply::with('job_detail.office')->count(),
            'has_search' => null
        );
        $d['jobapplies'] = JobApply::withTrashed()->with('job_detail.office')->paginate(10);
        return view('backend.pages.jobapply', $d);
    }
    public function delete($ja_guid)
    {
        $delete = JobApply::where('ja_guid', $ja_guid)->first();
        $delete->delete();
        return redirect()->back()->with('success', 'İş başvurusu başarıyla kaldırıldı.');
    }
    public function readed($ja_guid)
    {
        
        $read=JobApply::where('ja_guid',$ja_guid)->first();
        $read->readed='1';
        $read->update();
        return redirect()->back()->with('success','İş ilanı okundu olarak güncellendi.');

    }
}
