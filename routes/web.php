<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\DB;

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

// Landing
Route::get('/',[MyController::class, 'landing'])->name('home');


// Login - Register - Logout
Route::get('/login',[MyController::class, 'login_view']);
Route::get('/register', [MyController::class,"register_view"]);
Route::get('/logout', [MyController::class,"logout"]);

Route::post('/login_acc',[MyController::class, 'login']);
Route::post('/register_acc',[MyController::class, 'register']);


// About Us
Route::get('/about_us',[MyController::class, 'about_us']);


// Profile
Route::get('/profile', [MyController::class,"profile"]);

Route::post('/edit_profile',[MyController::class, 'edit_profile']);


// Product
Route::get('/tambah_produk', [MyController::class,"tambah_produk_view"]);
Route::get('/hapusedit_produk', [MyController::class,"hapusedit_produk"]);
Route::get('/produk/hapus/{id_produk}', [MyController::class,"hapus"]);
Route::get('/produk/edit/{id_produk}', [MyController::class,"edit"]);

Route::post('/produk/tambah',[MyController::class, 'tambah_produk']);
Route::post('/produk/edit/confirm',[MyController::class, 'edit_produk']);


// Find - Cari
Route::get("/cari",[MyController::class,'cari'])->name("cari");
Route::get('/search', [MyController::class,"search"]);


// Buy
Route::post('/beli',[MyController::class, 'beli']);


// Cart
Route::get('/keranjang', [MyController::class,"keranjang"]);
Route::get('/edit_keranjang/{id_keranjang}', [MyController::class,"edit_keranjang_process"]);
Route::get('/hapus_keranjang/{id_keranjang}', [MyController::class,"hapus_keranjang_process"]);

Route::post('/edit/keranjang',[MyController::class, 'edit_keranjang']);


// Category ( Barat - Utara - Selatan )
Route::get('/barat', [MyController::class,"barat"]);
Route::get('/utara', [MyController::class,"utara"]);
Route::get('/selatan', [MyController::class,"selatan"]);


// Admin
Route::get('/admin_reg', [MyController::class,"admin_reg"]);

Route::post('/register_acc_admin',[MyController::class, 'register_admin']);


// Confirmation
Route::get('/checkout/{id_keranjang}', [MyController::class,"checkout"]);
Route::get('/teracc/{id_keranjang}', [MyController::class,"teracc_process"]);
Route::get('/dteracc/{id_keranjang}', [MyController::class,"dteracc_process"]);
Route::get('/teracc/{id_keranjang}', [MyController::class,"teracc_process"]);

Route::post('/teracc',[MyController::class, 'teracc']);


//Feedback
Route::get('/lihat_feedback', [MyController::class,"lihat_feedback"]);
Route::get('/feedback', [MyController::class,"feedback"]);

Route::post('/feedback',[MyController::class, 'feedback_process']);


// Lainnya
Route::get('/lihat_bukti_pembayaran', [MyController::class,"lihat_bukti_pembayaran"]);
Route::get('/lihat_bukti_teracc', [MyController::class,"lihat_bukti_teracc"])->name('lihat_bukti_teracc');
Route::get('/lihat_transaksi', [MyController::class,"lihat_transaksi"])->name('lihat_transaksi');
Route::get('/lihat_valley', [MyController::class,"lihat_valley"])->name('lihat_valley');
Route::get('/detailTransaksi_user/{id}', [MyController::class,"detailTransaksi_user"])->name('detailTransaksi_user');



Route::post('/lihat_bukti_teracc', [MyController::class,"delete_teracc"])->name('delete_teracc');
Route::post('/trackingTeracc', [MyController::class,"trackingTeracc"])->name('trackingTeracc');
Route::post('/kirim_bukti_pembayaran',[MyController::class, 'kirim_bukti_pembayaran']);