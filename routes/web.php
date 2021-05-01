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

Route::get('/', function () {
    return view('landing');
});


Route::get('/about_us', function () {
    return view('about_us');
});
Route::get('/login', function () {
    return view('login');
});
Route::get('/logout', [MyController::class,"logout"]);
Route::get('/register', function () {
    return view('register');
});
Route::get('/keranjang', function () {
    return view('keranjang');
});
Route::get('/barat', function () {
    return view('barat');
});
Route::get('/utara', function () {
    return view('utara');
});
Route::get('/selatan', function () {
    return view('selatan');
});
Route::get('/about_us', function () {
    return view('about_us');
});
Route::get('/profile', function () {
    return view('profile');
});
Route::get('/admin_reg', function () {
    return view('register_admin');
});
Route::get('/tambah_produk', function () {
    return view('tambah_produk');
});
Route::get('/hapusedit_produk', function () {
    return view('hapusedit_produk');
});
Route::get('/edit_keranjang/{id_keranjang}', function ($id_keranjang) {
    $keranj = DB::select('select * from keranjang where id = ?', [$id_keranjang]);
    $namaproduk = DB::select("select nama_parkiran from parkiran where id=?", [$keranj[0]->id_produk]);
    $jumlah = $keranj[0]->jumlah;
    return view('edit_keranjang',["namaproduk"=>$namaproduk[0]->nama_parkiran,"jumlah"=>$jumlah,"id_keranjang"=>$id_keranjang]);
});
Route::get('/hapus_keranjang/{id_keranjang}', function ($id_keranjang) {
    DB::delete("delete from keranjang where id = ?", [$id_keranjang]);
    return redirect("/keranjang");
});
Route::get('/checkout/{id_keranjang}', function ($id_keranjang) {
    $keranj = DB::select('select * from keranjang where id = ?', [$id_keranjang]);
    $namaproduk = DB::select("select * from parkiran where id=?", [$keranj[0]->id_produk]);
    $jumlah = $keranj[0]->jumlah;  
	DB::delete("delete from keranjang where id = ?", [$id_keranjang]);	
    return view('checkout',["produk"=>$namaproduk[0],"jumlah"=>$jumlah,"keranj"=>$keranj[0]]);
});
Route::get('/teracc/{id_keranjang}', function ($id_keranjang) {
	
        
        DB::insert("insert into teracc (id_akun,id_produk) values 
        (?,?)",[$id_akun,$id_produk]);
	DB::delete("delete from bukti_pembayaran where id = ?", [$id_keranjang]);
	$bukti_pembayaran = DB::select("select * from bukti_pembayaran");
	
		
    return view("lihat_bukti_pembayaran",["bukti_pembayaran"=>$bukti_pembayaran]);
});
Route::get('/dteracc/{id_keranjang}', function ($id_keranjang) {
	DB::delete("delete from bukti_pembayaran where id = ?", [$id_keranjang]);
	$bukti_pembayaran = DB::select("select * from bukti_pembayaran");
    return view("lihat_bukti_pembayaran",["bukti_pembayaran"=>$bukti_pembayaran]);
});
Route::get('/produk/hapus/{id_produk}', function ($id_produk) {
    DB::delete("delete from parkiran where id = ?", [$id_produk]);
    return redirect("/hapusedit_produk");
});
Route::get('/produk/edit/{id_produk}', function ($id_produk) {
    $prod = DB::select("select * from parkiran where id = ?",[$id_produk]);
    return view("edit_produk",["produk"=>$prod[0]]);
});
Route::get('/lihat_bukti_pembayaran', function () {
    $bukti_pembayaran = DB::select("select * from bukti_pembayaran");
    return view("lihat_bukti_pembayaran",["bukti_pembayaran"=>$bukti_pembayaran]);
});
Route::get('/lihat_bukti_teracc', function () {
	$user = DB::select("select * from akun where csrf = ?", [csrf_token()]);
	$bukti_pembayaran = DB::select("select * from teracc where id_akun = ?", [$user[0]->id]);
    return view("lihat_bukti_teracc",["bukti_pembayaran"=>$bukti_pembayaran]);
});
Route::post('/edit_profile',[MyController::class, 'edit_profile']);
Route::post('/register_acc',[MyController::class, 'register']);
Route::post('/produk/tambah',[MyController::class, 'tambah_produk']);
Route::post('/produk/edit/confirm',[MyController::class, 'edit_produk']);
Route::post('/register_acc_admin',[MyController::class, 'register_admin']);
Route::post('/login_acc',[MyController::class, 'login']);
Route::post('/beli',[MyController::class, 'beli']);
Route::post('/edit/keranjang',[MyController::class, 'edit_keranjang']);
Route::post('/kirim_bukti_pembayaran',[MyController::class, 'kirim_bukti_pembayaran']);
Route::post('/teracc',[MyController::class, 'teracc']);
Route::get('/search', function () {
    return view('search');
});

Route::get("/cari",[MyController::class,'cari'])->name("cari");
