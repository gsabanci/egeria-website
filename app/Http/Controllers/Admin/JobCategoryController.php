<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobCategory;
use App\Models\Theme;
use Illuminate\Http\Request;
use Str;
class JobCategoryController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }

    public function home()
    {
        $d['category'] = JobCategory::paginate(10);
        $d['theme'] = Theme::where('id', 1)->first();
        $d['data'] = array(
            'button' => array(
                'title' => 'İş Kategorisi Ekle',
                'id' => 'iskategorisiekle',
            ),
            'pagetitle' => 'İş Kategori',
            'records' => null,
            'has_search' => null
        );

        return view('backend.pages.job_category', $d);
    }
    public function add(Request $r)
    {

        $category = new JobCategory();
        $check = JobCategory::where('slug', $r->slug)->first();
        if (!is_null($check)) {
            $category->jc_guid = $check->jc_guid;
        } else {
            $category->jc_guid = Str::uuid();
        }
        $category->name = $r->name;
        $category->slug = $r->slug;
        $category->lang_code = $r->lang_code;
        $category->save();
        return redirect()->back()->with('success', 'Kategori başarıyla eklendi.');
    }
    public function update(Request $r)
    {
        $update = JobCategory::where('jc_guid', $r->jc_guid)->first();
        $update->name = $r->name;
        $update->slug = Str::slug($r->name);
        $update->update();
        return redirect()->back()->with('success', 'Kategori başarıyla güncellendi.');
    }
    public function delete(Request $r)
    {
        $delete = JobCategory::where('jc_guid', $r->jc_guid)->first();
        $delete->delete();
        return redirect()->back()->with('success', 'Kategori başarıyla silindi.');
    }
}
