<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\App;
use App\Models\Theme;
use App\Models\Policy;
use App\Models\Setting;
use App\Models\AboutusCard;
use Illuminate\Http\Request;
use App\Models\SystemSetting;
use App\Http\Controllers\Controller;
use Str;

class SettingController extends Controller
{
    public function __construct()
    {
        return $this->middleware('adminauth:admin');
    }

    public function home()
    {
        $d['page_title'] = 'Site İçerikleri';
        $d['theme'] = Theme::where('id', 1)->first();
        $d['settings'] = Setting::orderBy('slug', 'ASC')->paginate(10);
        $d['aboutus_cards'] = AboutusCard::get();
        $d['data'] = array(
            'button' => array(
                'title' => 'İçerik Ekle',
                'id' => 'icerikekle'
            ),
            'pagetitle' => 'Site İçerikleri',
            'records' => null,
            'has_search' => null
        );
        return view('backend.pages.setting', $d);
    }
    public function setting_add(Request $r)
    {
        $check = Setting::where('title', $r->title)->where('lang_code', $r->lang_code)->first();
        if (!is_null($check)) {
            return redirect()->back()->with('error', 'Girdiğiniz isimde ayar bulunmaktadır.');
        }
        $setting = new Setting();
        $setting->setting_guid = Str::uuid();
        $setting->title = $r->title;
        $setting->slug = $r->slug ?: Str::slug($r->title);
        $setting->lang_code = $r->lang_code;
        $setting->save();

        return redirect()->back();
    }
    public function update(Request $r)
    {
        $update = Setting::where('setting_guid', $r->setting_guid)->first();
        $update->title = $r->title;
        $update->text = $r->text;
        if ($r->has('image')) {
            $image_name = $r->file('image')->getClientOriginalName();
            $r->file('image')->move(storage_path('app/public/setting_images/'), $image_name);
            $update->image = $image_name;
        }
        $update->update();

        if ($r->has('ac_guid')) {
            $ac_titles = $r->ac_title;
            $ac_links = $r->ac_link;
            $ac_contents = $r->ac_content;
            foreach ($r->ac_guid as $k => $ac_guid) {
                $ac = AboutusCard::where("ac_guid", $ac_guid)->first();
                $ac->title = $ac_titles[$k];
                $ac->link = $ac_links[$k];
                $ac->content = $ac_contents[$k];
                $ac->update();
            }
        }

        return redirect()->back()->with('success', 'Ayar başarıyla güncellendi.');
    }

    public function form_settings()
    {
        $d['page_title'] = 'Form Ayarları';
        $d['settings'] = SystemSetting::get();
        $d['theme'] = Theme::where('id', 1)->first();
        $d['data'] = array(
            'button' => array(

                'title' => null,
                'id' => null,
            ),
            'pagetitle' => 'Form Ayarları',
            'records' => null,
            'has_search' => null
        );
        return view('backend.pages.form_setting', $d);
    }

    public function form_setting_update(Request $r)
    {
        $st = SystemSetting::where("ss_guid", $r->ss_guid)->first();
        if (is_null($st)) {
            return redirect()->back()->with('error', 'Form ayarı bulunamadı.');
            ;
        }

        $st->s_value = $r->s_value;
        $st->update();

        return redirect()->back()->with('success', 'Form ayarı başarıyla güncellendi.');
    }

    public function contract()
    {
        $d['page_title'] = 'Sözleşmeler';
        $d['theme'] = Theme::where('id', 1)->first();

        $d['policies'] = Policy::get();

        $d['data'] = array(
            'button' => array(

                'title' => 'Sözleşme Ekle',
                'id' => 'sozlesmeekle',
            ),
            'pagetitle' => 'Sözleşmeler',
            'records' => null,
            'has_search' => null
        );
        return view('backend.pages.contract', $d);

    }

    public function policy_add(Request $r)
    {
        $policy = new Policy();
        $policy->policy_guid = Str::uuid();
        $policy->title = $r->title;
        $policy->slug = $r->slug;
        $policy->lang_code = $r->lang_code;
        $policy->content = $r->content;
        $policy->save();

        return redirect()->back();
    }

    public function policy_update(Request $r)
    {
        $p = Policy::where("policy_guid", $r->policy_guid)->first();
        $p->slug = $r->slug;
        $p->title = $r->title;
        $p->content = $r->content;
        $p->update();

        return redirect()->back()->with('success', 'Sözleşme içeriği başarıyla güncellendi.');
    }

}
