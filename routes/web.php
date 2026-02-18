<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\NewsController;
use App\Http\Controllers\Site\PageController;
use App\Http\Controllers\Site\LaborController;
use App\Http\Controllers\Site\CareerController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\ServiceController;
use App\Http\Controllers\Site\IndustryController;
use App\Http\Controllers\Site\LibraryController;
use App\Http\Controllers\Site\ReferenceController;
use App\Http\Controllers\Site\CorporateController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('/', [HomeController::class, 'index'])->name('homepage');

Route::any('/kurumsal/{slug}',[CorporateController::class,'corporate_detail'])->name('corporate_detail');
Route::any('/cozumler/{slug}',[ServiceController::class,'service_detail'])->name('service_detail');
Route::any('/sektorler/{slug}',[IndustryController::class,'industry_detail'])->name('industry_detail');
Route::get('/hizmetler/{slug}', [LaborController::class, 'labor_detail'])->name('labor_detail');

Route::get('/sss', [HomeController::class, 'faqs'])->name('faqs');


//HABERLER
Route::get('/haberler',[NewsController::class,'home'])->name('news');
Route::get('/haberler/{slug}', [NewsController::class, 'category'])->name('news_category');
Route::any('/haber-detay/{slug}',[NewsController::class,'detail'])->name('news_detail');

//Kütüphane
Route::get('/kutuphane', [LibraryController::class, 'home'])->name('libraries');
Route::get('/kutuphane/{slug}', [LibraryController::class, 'category'])->name('lib_category');
Route::any('/kutuphane/dokuman/{slug}', [LibraryController::class, 'detail'])->name('lib_detail');

Route::get('/bize-ulasin',[ContactController::class,'home'])->name('contact');

Route::get('/referanslarimiz',[ReferenceController::class,'home'])->name('references');

Route::get('/kurumsal',[PageController::class,'aboutus'])->name('aboutus');

Route::get('/kariyer',[CareerController::class,'home'])->name('career');
Route::get('/kariyer-detay/{slug}',[CareerController::class,'filter'])->name('filter');

Route::get('/sozlesme/{slug}',[PageController::class,'policy_detail'])->name('policy_detail');

Route::get('/is-basvuru-formu/{slug}',[CareerController::class,'detail'])->name('job_detail');

Route::post('/is-basvuru-formu-gonder',[CareerController::class,'job_apply'])->name('job_apply');

//Talep Formu

Route::post('/talep-form-gonder',[ContactController::class,'send_form'])->name('send_form');

Route::Post('/demo-talep-form-gonder',[ContactController::class,'send_req'])->name('send_req');

Route::post('/homepage-filter',[HomeController::class,'index'])->name('homepage_filter');

//Subscription FOOTER

Route::post('/subscription',[HomeController::class,'subscription'])->name('subscription');

Route::get('{any}', function () {
    return redirect()->route('homepage');
});