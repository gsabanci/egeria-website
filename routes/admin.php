<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\JobController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DemoController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LaborController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\Admin\OfficeController;
use App\Http\Controllers\Admin\SocialController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\JobApplyController;
use App\Http\Controllers\Admin\ReferenceController;
use App\Http\Controllers\Admin\SubscriberController;
use App\Http\Controllers\Admin\JobCategoryController;
use App\Http\Controllers\Admin\LibraryController;
use App\Http\Controllers\Admin\LibraryCategoryController;
use App\Http\Controllers\Admin\NewsCategoryController;

//Auth işlemleri Tema Değiştir
Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
Route::post('/doLogin', [AuthController::class, 'do_login'])->name('admin.do_login');
Route::post('/themeColorChange', [ThemeController::class, 'themeColorChange'])->name('admin.themeColorChange');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

//Servisler
Route::get('/services', [ServiceController::class, 'home'])->name('admin.services');
//SERVİS EKLE
Route::post('/service-add', [ServiceController::class, 'service_add'])->name('admin.service_add');
Route::post('/service-edit/{service_guid}', [ServiceController::class, 'service_edit'])->name('admin.service_edit');
Route::post('/service-delete/{service_guid}', [ServiceController::class, 'service_delete'])->name('admin.service_delete');
//SERVİS DETAY
Route::get('/service-detail/{service_guid}', [ServiceController::class, 'service_detail'])->name('admin.service_detail');
Route::post('/service-detail-update', [ServiceController::class, 'service_detail_update'])->name('admin.service_detail_update');
Route::post('/service-content-add', [ServiceController::class, 'service_content_add'])->name('admin.service_content_add');
Route::post('/service-content-update', [ServiceController::class, 'service_content_update'])->name('admin.service_content_update');
Route::post('/service-content-delete', [ServiceController::class, 'service_content_delete'])->name('admin.service_content_delete');

//Endüstriler
Route::get('/industries', [IndustryController::class, 'home'])->name('admin.industries');
//ENDUSTRI EKLE
Route::post('/industry-add', [IndustryController::class, 'industry_add'])->name('admin.industry_add');
Route::post('/industry-edit/{industry_guid}', [IndustryController::class, 'industry_edit'])->name('admin.industry_edit');
Route::post('/industry-delete/{industry_guid}', [IndustryController::class, 'industry_delete'])->name('admin.industry_delete');
//ENDUSTRI DETAY
Route::get('/industry-detail/{industry_guid}', [IndustryController::class, 'industry_detail'])->name('admin.industry_detail');
Route::post('/industry-detail-update', [IndustryController::class, 'industry_detail_update'])->name('admin.industry_detail_update');
Route::post('/industry-content-add', [IndustryController::class, 'industry_content_add'])->name('admin.industry_content_add');
Route::post('/industry_content_update', [IndustryController::class, 'industry_content_update'])->name('admin.industry_content_update');
Route::post('/industry-content-delete', [IndustryController::class, 'industry_content_delete'])->name('admin.industry_content_delete');

//Hizmetler
Route::get('/labors', [LaborController::class, 'home'])->name('admin.labors');
Route::post('/labor-add', [LaborController::class, 'labor_add'])->name('admin.labor_add');
Route::post('/labor-update', [LaborController::class, 'labor_edit'])->name('admin.labor_edit');
Route::post('/labor-delete', [LaborController::class, 'labor_delete'])->name('admin.labor_delete');

//Ofisler
Route::get('/offices', [OfficeController::class, 'home'])->name('admin.offices');
//OFIS EKLE
Route::post('/office-add', [OfficeController::class, 'office_add'])->name('admin.office_add');
Route::post('/office-edit/{office_guid}', [OfficeController::class, 'office_edit'])->name('admin.office_edit');
Route::post('/office-delete/{office_guid}', [OfficeController::class, 'office_delete'])->name('admin.office_delete');
//Personeller
Route::get('/staffs', [StaffController::class, 'home'])->name('admin.staffs');
//PERSONEL EKLE
Route::post('/staff-add', [StaffController::class, 'staff_add'])->name('admin.staff_add');
Route::post('/staff-edit/{staff_guid}', [StaffController::class, 'staff_edit'])->name('admin.staff_edit');
Route::post('/staff-delete/{staff_guid}', [StaffController::class, 'staff_delete'])->name('admin.staff_delete');

//İş İlanları
Route::get('/jobs', [JobController::class, 'home'])->name('admin.jobs');
//İŞ EKLE
Route::post('/job-add', [JobController::class, 'job_add'])->name('admin.job_add');
Route::post('/job-edit', [JobController::class, 'job_edit'])->name('admin.job_edit');
Route::post('/job-delete', [JobController::class, 'job_delete'])->name('admin.job_delete');

//İŞ KATEGORİ
Route::get('/job-categories', [JobCategoryController::class, 'home'])->name('admin.job_category');
Route::post('/job-categories-add', [JobCategoryController::class, 'add'])->name('admin.job_category_add');
Route::post('/job-categories-update', [JobCategoryController::class, 'update'])->name('admin.job_category_update');
Route::post('/job-categories-delete', [JobCategoryController::class, 'delete'])->name('admin.job_category_delete');

//İş Başvuruları
Route::get('/job-applies', [JobApplyController::class, 'home'])->name('admin.jobapplies');
Route::get('/job-apply-delete/{ja_guid}', [JobApplyController::class, 'delete'])->name('admin.jobapply_delete');
Route::get('/job-apply-read/{ja_guid}', [JobApplyController::class, 'readed'])->name('admin.jobapply_read');

//SOSYAL MEDYA
Route::get('/social-media', [SocialController::class, 'home'])->name('admin.socialmedia');
Route::post('/social-add', [SocialController::class, 'social_add'])->name('admin.social_add');
Route::post('/social-edit/{social_guid}', [SocialController::class, 'social_edit'])->name('admin.social_edit');
Route::post('/social-delete/{social_guid}', [SocialController::class, 'social_delete'])->name('admin.social_delete');

//Site Ayarları
Route::get('/settings', [SettingController::class, 'index'])->name('admin.settings.list');
Route::post('/settings/update', [SettingController::class, 'update'])->name('admin.settings.update');

//HABERLER
Route::get('/news', [NewsController::class, 'home'])->name('admin.news');
Route::get('/news-edit/{news_guid}', [NewsController::class, 'news_detail'])->name('admin.news_detail');
//HABER EKLE
Route::post('/news-add', [NewsController::class, 'news_add'])->name('admin.news_add');
Route::post('/news-update', [NewsController::class, 'news_update'])->name('admin.news_update');
Route::post('/news-delete', [NewsController::class, 'news_delete'])->name('admin.news_delete');

//HABER KATEGORİLERİ
Route::get('/news-categories', [NewsCategoryController::class, 'home'])->name('admin.news_category');
Route::post('/news-categories-add', [NewsCategoryController::class, 'add'])->name('admin.news_category_add');
Route::post('/news-categories-update', [NewsCategoryController::class, 'update'])->name('admin.news_category_update');
Route::post('/news-categories-delete', [NewsCategoryController::class, 'delete'])->name('admin.news_category_delete');

//REFERANSLAR
Route::get('/references', [ReferenceController::class, 'home'])->name('admin.references');
//REFERANS EKLE
Route::post('/reference_page_text_update', [ReferenceController::class, 'reference_page_text_update'])->name('admin.reference_page_text_update');
Route::post('/reference-add', [ReferenceController::class, 'reference_add'])->name('admin.reference_add');
Route::post('/reference-delete', [ReferenceController::class, 'reference_delete'])->name('admin.reference_delete');


//KARIYER
Route::get('/career', [CareerController::class, 'home'])->name('admin.career');
Route::post('/career-content-update', [CareerController::class, 'career_content_update'])->name('admin.career_content_update');

//FAQS
Route::get('/faqs', [FaqController::class, 'faqs'])->name('admin.faqs');
Route::post('/faq-add', [FaqController::class, 'faq_add'])->name('admin.faq_add');
Route::post('/faq-edit', [FaqController::class, 'faq_update'])->name('admin.faq_update');
Route::post('/faq-delete', [FaqController::class, 'faq_delete'])->name('admin.faq_delete');

//ILETISIM

Route::get('/contact', [ContactController::class, 'home'])->name('admin.contact');
Route::post('/contact-delete', [ContactController::class, 'delete'])->name('admin.delete');


//AYARLAR

Route::get('/setting', [SettingController::class, 'home'])->name('admin.setting');
Route::post('/setting-update', [SettingController::class, 'update'])->name('admin.setting_update');

Route::get('/form-settings', [SettingController::class, 'form_settings'])->name('admin.form_settings');
Route::post('/form-settings', [SettingController::class, 'form_setting_update'])->name('admin.form_setting_update');

//DEMO TALEPLERİ
Route::get('/demo-req', [DemoController::class, 'home'])->name('admin.demo_req');
Route::post('/demo-req-delete', [DemoController::class, 'delete'])->name('admin.demo_req_delete');

//SOZLESMELER

Route::get('/contracts', [SettingController::class, 'contract'])->name('admin.contract');
Route::post('/contracts', [SettingController::class, 'policy_update'])->name('admin.policy_update');

//SUBSCRİPTİON

Route::get('/subscribers', [SubscriberController::class, 'home'])->name('admin.subscribers');
Route::post('/subscriber-delete', [SubscriberController::class, 'delete'])->name('admin.subscriber_delete');

//KÜTÜPHANE
Route::get('/libraries', [LibraryController::class, 'home'])->name('admin.libraries');
Route::post('/libraries-add', [LibraryController::class, 'add'])->name('admin.library_add');
Route::post('/libraries-update', [LibraryController::class, 'update'])->name('admin.library_update');
Route::post('/libraries-delete', [LibraryController::class, 'delete'])->name('admin.library_delete');

//KÜTÜPHANE KATEGORİSİ
Route::get('/library-categories', [LibraryCategoryController::class, 'home'])->name('admin.library_categories');
Route::post('/library-category-add', [LibraryCategoryController::class, 'add'])->name('admin.library_category_add');
Route::post('/library-category-update', [LibraryCategoryController::class, 'update'])->name('admin.library_category_update');
Route::post('/library-category-delete', [LibraryCategoryController::class, 'delete'])->name('admin.library_category_delete');