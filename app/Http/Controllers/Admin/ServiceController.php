<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Theme;
use App\Models\Service;
use App\Models\ServiceContent;
use App\Models\Language;
use Str;

class ServiceController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }

    public function home()
    {
        $d['theme'] = Theme::where('id', 1)->first();
        $d['services'] = Service::orderBy('queue', 'ASC')->paginate(10);
        $d['services_count'] = Service::get()->count();

        $d['languages'] = Language::where('is_active', 1)->get();

        $d['data'] = array(
            'button' => array(
                'title' => 'Çözüm Ekle',
                'id' => 'cozumekle',
            ),
            'pagetitle' => 'Çözümler',
            'records' => $d['services_count'],
            'has_search' => null
        );
        return view('backend.pages.services', $d);
    }
    public function service_add(Request $r)
    {
        $check = Service::where('name', $r->name)->where('lang_code', $r->lang_code)->first();
        if (!is_null($check)) {
            return redirect()->back()->with('error', 'Girdiğiniz isimde servisiniz bulunmaktadır.');
        }
        $service = new Service();
        $service->services_guid = Str::uuid();
        $service->name = $r->name;
        $service->slug = $r->slug;
        $service->lang_code = $r->lang_code;
        $service->queue = $r->queue;
        $service->is_active = $r->is_active;
        $service->save();

        return redirect()->back();
    }
    public function service_edit(Request $r)
    {
        $service = Service::where('services_guid', $r->services_guid)->first();
        $service->name = $r->name;
        $service->slug = $r->slug;
        $service->queue = $r->queue;
        $service->is_active = $r->is_active;
        $service->update();
        return redirect()->back()->with('success', 'Başarıyla Düzenlendi');
    }
    public function service_delete($services_guid)
    {

        $service = Service::where('services_guid', $services_guid)->first();
        $service->delete();
        return redirect()->back()->with('success', 'Servis başarıyla silindi.');
    }
    public function service_detail($services_guid)
    {
        $d['data'] = array(
            'button' => array(
                'title' => null,
                'id' => null,
            ),
            'pagetitle' => 'Çözümler',
            'records' => null,
            'has_search' => false,
        );
        $d['theme'] = Theme::where('id', 1)->first();
        $d['service'] = Service::where('services_guid', $services_guid)->first();
        $d['services_content'] = ServiceContent::where('services_guid', $services_guid)->get();
        return view('backend.pages.service_detail', $d);
    }
    public function service_detail_update(Request $r)
    {
        $update = Service::where('services_guid', $r->services_guid)->first();
        $update->first_title = $r->first_title;
        $update->first_title_subtitle = $r->first_title_subtitle;
        $update->second_title = $r->second_title;
        $update->second_title_subtitle = $r->second_title_subtitle;
        $update->content_area_title = $r->content_area_title;
        if ($r->hasFile('image')) {
            $image_name = $r->file('image')->getClientOriginalName();
            $r->file('image')->move(storage_path('app/public/industry_photos/'), $image_name);
            $update->image = $image_name;
        }
        $update->update();
        return redirect()->back()->with('success', 'Servis başarıyla güncellendi.');
        ;
    }
    public function service_content_add(Request $r)
    {
        $new = new ServiceContent();
        $new->services_guid = $r->services_guid;
        $new->content_guid = Str::uuid();
        $new->content_title = $r->content_title;
        $new->content = $r->content;
        $new->queue = $r->queue;
        $new->is_active = $r->is_active;
        $new->save();
        return redirect()->back()->with('success', 'Servis içeriği başarıyla eklendi');
    }
    public function service_content_update(Request $r)
    {
        $update = ServiceContent::where('content_guid', $r->content_guid)->first();
        $update->content_title = $r->content_title;
        $update->content = $r->content;
        $update->queue = $r->queue;
        $update->is_active = $r->is_active;
        $update->update();
        return redirect()->back()->with('success', 'Servis içeriği başarıyla güncellendi.');

    }
    public function service_content_delete(Request $r)
    {
        $delete = ServiceContent::where('content_guid', $r->content_guid)->first();
        $delete->delete();

        return redirect()->back()->with('success', 'Servis içeriği başarıyla silindi.');
    }
}
