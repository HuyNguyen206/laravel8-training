<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
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

Route::get('/', function () {
    $brands = \App\Models\Brand::latest()->get();
    $sliders = \App\Models\Slider::all();
    $countAbout  = \App\Models\HomeAbout::count();
    $countAbout = $countAbout == 0 ? 1 : $countAbout;
    $about = \App\Models\HomeAbout::find(random_int(1,$countAbout));
    return view('home', compact('brands', 'sliders', 'about'));
});
Route::get('portfolio', function (){
   $images = \App\Models\Multipic::all();
   return view('portfolio', compact('images'));
})->name('portfolio');
Route::get('categories',[CategoryController::class, 'index'])->name('category.index');
Route::post('categories',[CategoryController::class, 'store'])->name('category.store');
Route::get('categories/{category}',[CategoryController::class, 'edit'])->name('category.edit');
Route::patch('categories/{category}',[CategoryController::class, 'update'])->name('category.update');
Route::get('categories/delete/{category}',[CategoryController::class, 'destroy'])->name('category.delete');
Route::get('categories/restore/{category}',[CategoryController::class, 'restore'])->name('category.restore');
Route::get('categories/force-delete/{category}',[CategoryController::class, 'forceDelete'])->name('category.forceDelete');
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $users = User::all();
    return view('admin.index', compact('users'));
})->name('dashboard');
Route::get('brands/destroy/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
Route::get('sliders/destroy/{id}', [HomeController::class, 'destroy'])->name('sliders.destroy');
//Route::get('abouts/destroy/{id}', [AboutController::class, 'destroy'])->name('abouts.destroy');
Route::resource('brands',BrandController::class)->except(['destroy']);
Route::resource('sliders',HomeController::class)->except(['destroy']);
Route::resource('abouts',AboutController::class)->except('destroy');
//Route::resources([
//    'brands' => BrandController::class,
//    'sliders' => HomeController::class
//]);


Route::get('multipics', [BrandController::class, 'getAllImages'])->name('multipic.index');
Route::post('multipics', [BrandController::class, 'storeImages'])->name('multipic.store');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
Route::get('edit-password', [\App\Http\Controllers\PasswordController::class, 'edit'])->name('password.edit');
Route::put('update-password', [\App\Http\Controllers\PasswordController::class, 'update'])->name('password.update');
Route::get('user/profile', [\App\Http\Controllers\PasswordController::class, 'getProfile'])->name('profile.show');
Route::put('user/profile', [\App\Http\Controllers\PasswordController::class, 'updateP'])->name('profile.update');

