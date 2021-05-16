<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MyController extends Controller
{
    // Landing
    public function landing()
    {
        return view('landing');
    }



    // Login - Register - Logout
    public function login_view()
    {
        return view('login');
    }

    public function register_view()
    {
        return view('register');
    }

    public function logout(Request $request)
    {
        session()->regenerate();
        return redirect("login");
    }

    public function login(Request $request)
    {
        session()->regenerate();
        $result = DB::select('select id,password from akun where username = ?', [$request->input("username")]);
        if ($result == null) {
            return redirect("/login?message=Username tidak ditemukan");
        }
        if ($result[0]->password == $request->input("password")) {
            DB::update('update akun set csrf = ? where id = ?', [csrf_token(), $result[0]->id]);
        } else {
            return redirect("/login?message=Password Salah");
        }
        return redirect("/");
    }

    public function register(Request $request)
    {
        session()->regenerate();
        if ($request->input("password") != $request->input("re-password"))
            return redirect("register?message=Konfirmasi Password Salah!");
        DB::insert(
            'insert into akun (username,nama_lengkap,password,email,nohp,alamat,jenis_kelamin,tanggal_lahir,role,csrf) 
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [$request->input("username"), $request->input("nama"), $request->input("password"), $request->input("email"), $request->input("nohp"), $request->input("alamat"),$request->input("jenis_kelamin"), $request->input("date"), "user", ""]
        );
        $result = DB::select('select id,password from akun where username = ?', [$request->input("username")]);
        DB::update('update akun set csrf = ? where id = ?', [csrf_token(), $result[0]->id]);
        return redirect("/")->with('error', 'Register Berhasil!');
    }



    // About Us
    public function about_us()
    {
        return view('about_us');
    }


    // Profile
    public function profile()
    {
        return view('profile');
    }

    public function edit_profile(Request $request)
    {
        if ($request->input("password") != $request->input("passwordc")) {
            return redirect("/profile?message=Salah Password");
        }
        DB::update('update akun set nama_lengkap = ?, nohp = ? where csrf = ?', [$request->input("namadd"), $request->input("nohp"), csrf_token()]);

        return redirect("/profile");
    }



    // Product
    public function tambah_produk_view()
    {
        return view('tambah_produk');
    }

    public function hapusedit_produk()
    {
        return view('hapusedit_produk');
    }

    public function hapus(Request $request, $id_produk)
    {
        DB::delete("delete from parkiran where id = ?", [$id_produk]);

        return redirect("/hapusedit_produk");
    }

    public function edit(Request $request, $id_produk)
    {
        $prod = DB::select("select * from parkiran where id = ?", [$id_produk]);

        return view("edit_produk", ["produk" => $prod[0]]);
    }

    public function tambah_produk(Request $request)
    {
        $file = $request->file('gambar');
        $file->move(public_path() . "/foto/", $file->getClientOriginalName());
        DB::insert(
            "insert into parkiran (nama_parkiran,harga,kategori,gambar,detail_parkiran,lat,lang) values (?, ?, ?, ?, ?, ?, ?)",
            [$request->input("nama_parkiran"), $request->input("harga"), $request->input("kategori"), "foto/" . $file->getClientOriginalName(), $request->input("detail_parkiran"), $request->input("lat"), $request->input("lang")]
        );

        return redirect("/tambah_produk");
    }

    public function edit_produk(Request $request)
    {
        $file = $request->file('gambar');
        if ($file != null) {
            $file->move(public_path() . "/foto/", $file->getClientOriginalName());
            DB::update(
                'update parkiran set nama_parkiran = ?, harga = ?, kategori = ?, gambar = ?, detail_parkiran = ?, where id = ?, lat = ?, lang = ?',
                [$request->input("nama_parkiran"), $request->input("harga"), $request->input("kategori"), "foto/" . $file->getClientOriginalName(), $request->input("detail"), $request->input("produk_id"), $request->input("lat"), $request->input("lang")]
            );
            return redirect("/hapusedit_produk");
        }
        DB::update(
            'update parkiran set nama_parkiran = ?, harga = ?, kategori = ?, gambar = ?, detail_parkiran = ?, where id = ?, lat = ?, lang = ?',
            [$request->input("nama_parkiran"), $request->input("harga"), $request->input("kategori"), $request->input('gambar_old'), $request->input("detail_parkiran"), $request->input("produk_id"), $request->input("lat"), $request->input("lang")]
        );

        return redirect("/hapusedit_produk");
    }




    // Find - Cari
    public function cari(Request $request)
    {
        $kategori = $request->get("kategori");
        switch ($request->get("forma")) {
            case "barat":
                return view("barat", ["kategori" => $kategori]);
                break;
            case "utara":
                return view("utara", ["kategori" => $kategori]);
                break;
            case "selatan":
                return view("selatan", ["kategori" => $kategori]);
                break;
            case "":
                return redirect("/");
                break;
        }
    }

    public function search()
    {
        return view('search');
    }




    // Buy
    public function beli(Request $request)
    {
        if ($request->input("id_pembeli") == null) {
            return redirect("/login");
        }
        $exist = DB::select('select * from keranjang where id_produk = ?', [$request->input("id_produk")]);
        if ($exist != null) {
            DB::update('update keranjang set jumlah = jumlah+1 where id = ?', [$exist[0]->id]);
            return redirect("/keranjang");
        }
        DB::insert('insert into keranjang (id_produk, id_pembeli, jumlah) values (?, ?, 1)', [$request->input("id_produk"), $request->input("id_pembeli")]);

        return redirect("/keranjang");
    }




    // Cart
    public function keranjang()
    {
        return view('keranjang');
    }

    public function edit_keranjang_process(Request $request, $id_keranjang)
    {
        $keranj = DB::select('select * from keranjang where id = ?', [$id_keranjang]);
        $namaproduk = DB::select("select nama_parkiran from parkiran where id=?", [$keranj[0]->id_produk]);
        $jumlah = $keranj[0]->jumlah;

        return view('edit_keranjang', ["namaproduk" => $namaproduk[0]->nama_parkiran, "jumlah" => $jumlah, "id_keranjang" => $id_keranjang]);
    }

    public function hapus_keranjang_process(Request $request, $id_keranjang)
    {
        DB::delete("delete from keranjang where id = ?", [$id_keranjang]);

        return redirect("/keranjang");
    }

    public function edit_keranjang(Request $request)
    {
        DB::update('update keranjang set jumlah = ? where id = ?', [$request->input("jumlah"), $request->input("id_keranjang")]);

        return redirect("/keranjang");
    }




    // Category ( Barat - Utara - Selatan )
    public function barat()
    {
        return view('barat');
    }

    public function utara()
    {
        return view('utara');
    }

    public function selatan()
    {
        return view('selatan');
    }




    // Admin
    public function admin_reg()
    {
        return view('register_admin');
    }

    public function register_admin(Request $request)
    {
        session()->regenerate();
        if ($request->input("password") != $request->input("re-password"))
            return redirect("register?message=Konfirmasi Password Salah!");
        DB::insert(
            'insert into akun (username,nama_lengkap,password,email,nohp,alamat,jenis_kelamin,tanggal_lahir,role,csrf) 
            values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
            [$request->input("username"), $request->input("username"), $request->input("password"), $request->input("email"), $request->input("nohp"), $request->input("alamat"), "laki-laki", "2020-10-10 10:10:10", "admin", ""]
        );

        return redirect("register?message=Berhasil Register");
    }




    // Confirmation
    public function checkout(Request $request, $id_keranjang)
    {
        $keranj = DB::select('select * from keranjang where id = ?', [$id_keranjang]);
        $namaproduk = DB::select("select * from parkiran where id=?", [$keranj[0]->id_produk]);
        $jumlah = $keranj[0]->jumlah;
        DB::delete("delete from keranjang where id = ?", [$id_keranjang]);

        return view('checkout', ["produk" => $namaproduk[0], "jumlah" => $jumlah, "keranj" => $keranj[0]]);
    }

    public function teracc_process(Request $request, $id_keranjang)
    {
        $id_akun = $request->input("id_akun"); // SOLUSI SEMENTARA
        $id_produk = $request->input("id_produk"); // SOLUSI SEMENTARA
        DB::insert("insert into teracc (id_akun,id_produk) values (?,?)", [$id_akun, $id_produk]); // ANOMALI
        DB::delete("delete from bukti_pembayaran where id = ?", [$id_keranjang]);
        $bukti_pembayaran = DB::select("select * from bukti_pembayaran");


        return view("lihat_bukti_pembayaran", ["bukti_pembayaran" => $bukti_pembayaran]);
    }

    public function dteracc_process(Request $request, $id_keranjang)
    {
        DB::delete("delete from bukti_pembayaran where id = ?", [$id_keranjang]);
        $bukti_pembayaran = DB::select("select * from bukti_pembayaran");

        return view("lihat_bukti_pembayaran", ["bukti_pembayaran" => $bukti_pembayaran]);
    }

    public function teracc(Request $request)
    {

        $id_akun = $request->input("id_akun");
        $id_produk = $request->input("id_produk");

        DB::update(
            'update bukti_pembayaran set status = ?  where id = ?',
            [$request->input("status"), $request->input("id")]
        );
        DB::insert("insert into teracc (id_akun,id_produk) values 
        (?,?)", [$id_akun, $id_produk]);

        return redirect("/");
    }





    // Feedback
    public function lihat_feedback()
    {
        return view('lihat_feedback');
    }

    public function feedback()
    {
        return view('feedback');
    }

    public function feedback_process(Request $request)
    {

        DB::insert(
            "insert into feedback (nama_lengkap,feedback,rating) values (?, ?, ?)",
            [$request->input("namadd"), $request->input("feedback"), $request->input("rating")]
        );

        return redirect("/")->with('error', 'Transaksi Selesai !');
    }




    // Lainnya
    public function lihat_bukti_pembayaran(Request $request)
    {
        $bukti_pembayaran = DB::select("select * from bukti_pembayaran");

        return view("lihat_bukti_pembayaran", ["bukti_pembayaran" => $bukti_pembayaran]);
    }

    public function lihat_bukti_teracc(Request $request)
    {

        $user = DB::select("select * from akun where csrf = ?", [csrf_token()]);
        $bukti_pembayaran = DB::select("select * from teracc where id_akun = ?", [$user[0]->id]);

        return view("lihat_bukti_teracc", ["bukti_pembayaran" => $bukti_pembayaran]);
    }

    public function kirim_bukti_pembayaran(Request $request)
    {
        $file = $request->file('gambar');
        $gambar = "";
        if ($file != null) {
            $file->move(public_path() . "/foto/", $file->getClientOriginalName());
            $gambar = "/foto/" . $file->getClientOriginalName();
        }
        $id_akun = $request->input("id_akun");
        $id_produk = $request->input("id_produk");
        $metode = $request->input("metode");
        DB::insert("insert into bukti_pembayaran (metode,gambar,id_akun,id_produk) values 
        (?,?,?,?)", [$metode, $gambar, $id_akun, $id_produk]);

        return redirect("/feedback");
    }





    // 
}
