<?php

namespace App\Providers;

use App\Models\StaticText;
use View;
use Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use App\Models\Labor;
use App\Models\Theme;
use App\Models\Policy;
use App\Models\Social;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Industry;
use App\Models\JobApply;
use App\Models\JobCategory;
use App\Models\NewsCategory;
use App\Models\Language;
use Illuminate\Support\ServiceProvider;
use App\Http\Controllers\Admin\JobApplyController;
use App\Models\LibraryCategory;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $lang = Request::get('lang') ?? Session::get('lang') ?? 'tr';
        App::setLocale($lang);
        Session::put('lang', $lang);

        URL::macro('withLang', function ($name, $parameters = [], $absolute = true) {
            $parameters['lang'] = session('lang', 'tr');
            return route($name, $parameters, $absolute);
        });

        Validator::extend(
            'recaptcha',
            'App\\Validators\\ReCaptcha@validate'
        );

        $categories = Category::where('lang_code', $lang)->orderBy('queue', 'ASC')->pluck('name', 'slug')->all();
        ;
        View::share('menuCategories', $categories);

        $giris_banner = Setting::where('slug', 'giris-banner')->where('lang_code', $lang)->first();
        view()->share('giris_banner', $giris_banner);

        $giris_banner_subdesc = Setting::where('slug', 'giris-banner-subdesc')->where('lang_code', $lang)->first();
        view()->share('giris_banner_subdesc', $giris_banner_subdesc);

        $giris_banner_link = Setting::where('slug', 'giris-banner-link')->where('lang_code', $lang)->first();
        view()->share('giris_banner_link', $giris_banner_link);

        $aboutus = Setting::where('slug', 'hakkimizda')->where('lang_code', $lang)->first();
        view()->share('aboutus', $aboutus);

        $alt_baslik = Setting::where('slug', 'alt-baslik')->where('lang_code', $lang)->first();
        view()->share('alt_baslik', $alt_baslik);

        $ofis_baslik = Setting::where('slug', 'ofis-baslik')->where('lang_code', $lang)->first();
        view()->share('ofis_baslik', $ofis_baslik);

        $ofis_alt_baslik = Setting::where('slug', 'ofis-alt-baslik')->where('lang_code', $lang)->first();
        view()->share('ofis_alt_baslik', $ofis_alt_baslik);

        $haberler_baslik = Setting::where('slug', 'haberler-baslik')->where('lang_code', $lang)->first();
        view()->share('haberler_baslik', $haberler_baslik);

        $haberler_alt_baslik = Setting::where('slug', 'haberler-alt-baslik')->where('lang_code', $lang)->first();
        view()->share('haberler_alt_baslik', $haberler_alt_baslik);

        $haberler_detay_baslik = Setting::where('slug', 'haberler-detay-baslik')->where('lang_code', $lang)->first();
        view()->share('haberler_detay_baslik', $haberler_detay_baslik);

        $haberler_detay_alt_baslik = Setting::where('slug', 'haberler-detay-alt-baslik')->where('lang_code', $lang)->first();
        view()->share('haberler_detay_alt_baslik', $haberler_detay_alt_baslik);

        $kutuphane_detay_baslik = Setting::where('slug', 'kutuphane-detay-baslik')->where('lang_code', $lang)->first();
        view()->share('kutuphane_detay_baslik', $kutuphane_detay_baslik);

        $kutuphane_detay_alt_baslik = Setting::where('slug', 'kutuphane-detay-alt-baslik')->where('lang_code', $lang)->first();
        view()->share('kutuphane_detay_alt_baslik', $kutuphane_detay_alt_baslik);

        $musteriler_baslik = Setting::where('slug', 'musteriler-baslik')->where('lang_code', $lang)->first();
        view()->share('musteriler_baslik', $musteriler_baslik);

        $musteriler_alt_baslik = Setting::where('slug', 'musteriler-alt-baslik')->where('lang_code', $lang)->first();
        view()->share('musteriler_alt_baslik', $musteriler_alt_baslik);

        $kariyer_baslik = Setting::where('slug', 'kariyer-baslik')->where('lang_code', $lang)->first();
        view()->share('kariyer_baslik', $kariyer_baslik);

        $kariyer_alt_baslik = Setting::where('slug', 'kariyer-alt-baslik')->where('lang_code', $lang)->first();
        view()->share('kariyer_alt_baslik', $kariyer_alt_baslik);

        $services = Service::where('lang_code', $lang)->orderBy('queue')->get();
        view()->share('all_services', $services);

        $industries = Industry::where('lang_code', $lang)->orderBy('queue')->get();
        view()->share('all_industries', $industries);

        $socials = Social::orderBy('queue')->where('is_active', '1')->get();
        view()->share('socials', $socials);

        $gizlilik_sozlesmesi = Setting::where('slug', 'gizlilik-sozlesmesi')->where('lang_code', $lang)->first();
        view()->share('gizlilik_sozlesmesi', $gizlilik_sozlesmesi);

        $kullanim_kosullari = Setting::where('slug', 'kullanim-kosullari')->where('lang_code', $lang)->first();
        view()->share('kullanim_kosullari', $kullanim_kosullari);

        $applies = JobApply::where('readed', '0')->count();
        view()->share('applies', $applies);

        $labors = Labor::where('lang_code', $lang)->orderBy('queue')->get();
        view()->share('labors', $labors);

        $policies = Policy::where('lang_code',$lang)->get()->keyBy('slug');
        view()->share('policies', $policies);

        $all_job_categories = JobCategory::where('lang_code', $lang)->get();
        view()->share('all_job_categories', $all_job_categories);

        $all_news_categories = NewsCategory::where('lang_code', $lang)->orderBy('queue')->get();
        view()->share('all_news_categories', $all_news_categories);

        $all_lib_cats = LibraryCategory::where('lang_code', $lang)->get();
        view()->share('all_lib_cats', $all_lib_cats);

        $languages = Language::where('is_active', '1')->orderBy('id')->get();
        view()->share('languages', $languages);

        $static_texts = StaticText::where('lang_code', $lang)->orderBy('id')->get()->keyBy('key');
        ;
        view()->share('static_texts', $static_texts);

        $gizlilik_onayi = Setting::where('slug', 'gizlilik-onayi')->where('lang_code', $lang)->first();
        view()->share('gizlilik_onayi', $gizlilik_onayi);
    }
}
