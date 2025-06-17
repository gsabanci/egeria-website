<?php

namespace App\Providers;

use View;
use Validator;
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
        Validator::extend(
            'recaptcha',
            'App\\Validators\\ReCaptcha@validate'
        );

        $giris_banner=Setting::where('slug','giris-banner')->first();
        view()->share('giris_banner',$giris_banner);

        $giris_banner_subdesc = Setting::where('slug', 'giris-banner-subdesc')->first();
        view()->share('giris_banner_subdesc', $giris_banner_subdesc);

        $giris_banner_link = Setting::where('slug', 'giris-banner-link')->first();
        view()->share('giris_banner_link', $giris_banner_link);

        $aboutus=Setting::where('slug','hakkimizda')->first();
        view()->share('aboutus',$aboutus);

        $alt_baslik=Setting::where('slug','alt-baslik')->first();
        view()->share('alt_baslik',$alt_baslik);

        $ofis_baslik=Setting::where('slug','ofis-baslik')->first();
        view()->share('ofis_baslik',$ofis_baslik);

        $ofis_alt_baslik=Setting::where('slug','ofis-alt-baslik')->first();
        view()->share('ofis_alt_baslik',$ofis_alt_baslik);

        $haberler_baslik=Setting::where('slug','haberler-baslik')->first();
        view()->share('haberler_baslik',$haberler_baslik);

        $haberler_alt_baslik=Setting::where('slug','haberler-alt-baslik')->first();
        view()->share('haberler_alt_baslik',$haberler_alt_baslik);

        $haberler_detay_baslik=Setting::where('slug','haberler-detay-baslik')->first();
        view()->share('haberler_detay_baslik',$haberler_detay_baslik);

        $haberler_detay_alt_baslik=Setting::where('slug','haberler-detay-alt-baslik')->first();
        view()->share('haberler_detay_alt_baslik',$haberler_detay_alt_baslik);

        $kutuphane_detay_baslik = Setting::where('slug', 'kutuphane-detay-baslik')->first();
        view()->share('kutuphane_detay_baslik', $kutuphane_detay_baslik);

        $kutuphane_detay_alt_baslik = Setting::where('slug', 'kutuphane-detay-alt-baslik')->first();
        view()->share('kutuphane_detay_alt_baslik', $kutuphane_detay_alt_baslik);

        $musteriler_baslik=Setting::where('slug','musteriler-baslik')->first();
        view()->share('musteriler_baslik',$musteriler_baslik);

        $musteriler_alt_baslik=Setting::where('slug','musteriler-alt-baslik')->first();
        view()->share('musteriler_alt_baslik',$musteriler_alt_baslik);

        $kariyer_baslik=Setting::where('slug','kariyer-baslik')->first();
        view()->share('kariyer_baslik',$kariyer_baslik);

        $kariyer_alt_baslik=Setting::where('slug','kariyer-alt-baslik')->first();
        view()->share('kariyer_alt_baslik',$kariyer_alt_baslik);

        $services = Service::orderBy('queue')->get();
        view()->share('all_services', $services);

        $industries = Industry::orderBy('queue')->get();
        view()->share('all_industries', $industries);

        $socials=Social::orderBy('queue')->where('is_active','1')->get();
        view()->share('socials',$socials);

        $gizlilik_sozlesmesi=Setting::where('slug','gizlilik-sozlesmesi')->first();
        view()->share('gizlilik_sozlesmesi',$gizlilik_sozlesmesi);

        $kullanim_kosullari=Setting::where('slug','kullanim-kosullari')->first();
        view()->share('kullanim_kosullari',$kullanim_kosullari);

        $applies=JobApply::where('readed','0')->count();
        view()->share('applies',$applies);

        $labors = Labor::orderBy('queue')->get();
        view()->share('labors', $labors);

        $policies = Policy::get();
        view()->share('policies', $policies);

        $all_job_categories = JobCategory::get();
        view()->share('all_job_categories', $all_job_categories);

        $all_news_categories = NewsCategory::get();
        view()->share('all_news_categories', $all_news_categories);

        $all_lib_cats = LibraryCategory::get();
        view()->share('all_lib_cats', $all_lib_cats);

    }
}
