<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MyController extends Controller
{
    public function register(Request $request)
    {
        session()->regenerate();
        if ($request->input("password") != $request->input("re-password"))
            return redirect("register?message=Konfirmasi Password Salah!");
        DB::insert('insert into akun (username,nama_lengkap,password,email,nohp,alamat,jenis_kelamin,tanggal_lahir,role,csrf) 
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        [$request->input("username"),$request->input("username"),$request->input("password"),$request->input("email"),$request->input("nohp"),$request->input("alamat"),"laki-laki","2020-10-10 10:10:10","user",""]);
        return redirect("register?message=Berhasil Register");
    }

    public function logout(Request $request)
    {
        session()->regenerate();
        return redirect("login");
    }

    public function register_admin(Request $request)
    {
        session()->regenerate();
        if ($request->input("password") != $request->input("re-password"))
            return redirect("register?message=Konfirmasi Password Salah!");
        DB::insert('insert into akun (username,nama_lengkap,password,email,nohp,alamat,jenis_kelamin,tanggal_lahir,role,csrf) 
        values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
        [$request->input("username"),$request->input("username"),$request->input("password"),$request->input("email"),$request->input("nohp"),$request->input("alamat"),"laki-laki","2020-10-10 10:10:10","admin",""]);
        return redirect("register?message=Berhasil Register");
    }

    public function login(Request $request)
    {
        session()->regenerate();
        $result = DB::select('select id,password from akun where username = ?', [$request->input("username")]);
        if ($result == null){
            return redirect("/login?message=Username tidak ditemukan");
        }
        if ($result[0]->password == $request->input("password"))
        {
            DB::update('update akun set csrf = ? where id = ?', [csrf_token(),$result[0]->id]);
        }else
        {
            return redirect("/login?message=Password Salah");
        }
        return redirect("/");
    }
    
    public function edit_profile(Request $request)
    {
        if ($request->input("password") != $request->input("passwordc"))
        {
            return redirect("/profile?message=Salah Password");
        }
		
		

        DB::update('update akun set nama_lengkap = ?, nohp = ? where csrf = ?', [$request->input("namadd"),$request->input("nohp"),csrf_token()]);
        return redirect("/profile");
    }

    public function beli(Request $request)
    {
        if ($request->input("id_pembeli") == null) {
            return redirect("/login");
        }
        $exist = DB::select('select * from keranjang where id_produk = ?', [$request->input("id_produk")]);
        if ($exist!=null)
        {
            DB::update('update keranjang set jumlah = jumlah+1 where id = ?', [$exist[0]->id]);
            return redirect("/keranjang");
        }
        DB::insert('insert into keranjang (id_produk, id_pembeli, jumlah) values (?, ?, 1)', [$request->input("id_produk"),$request->input("id_pembeli")]);
        
        return redirect("/keranjang");
    }

    public function edit_keranjang(Request $request)
    {
        DB::update('update keranjang set jumlah = ? where id = ?', [$request->input("jumlah"),$request->input("id_keranjang")]);
        return redirect("/keranjang");
    }

    public function tambah_produk(Request $request)
    {
        $file = $request->file('gambar');
        $file->move(public_path()."/foto/", $file->getClientOriginalName());
        DB::insert("insert into parkiran (nama_parkiran,harga,kategori,gambar,detail_parkiran) values (?, ?, ?, ?, ?)", 
        [$request->input("nama_parkiran"),$request->input("harga"),$request->input("kategori"),"foto/".$file->getClientOriginalName(),$request->input("detail_parkiran")]);
        return redirect("/tambah_produk");
    }

    public function edit_produk(Request $request)
    {
        $file = $request->file('gambar');
        if ($file != null) {
            $file->move(public_path()."/foto/", $file->getClientOriginalName());
            DB::update('update parkiran set nama_parkiran = ?, harga = ?, kategori = ?, gambar = ?, detail_parkiran = ? where id = ?', 
            [$request->input("nama_parkiran"),$request->input("harga"),$request->input("kategori"),"foto/".$file->getClientOriginalName(),$request->input("detail"),$request->input("produk_id")]);
            return redirect("/hapusedit_produk");
        }
        DB::update('update parkiran set nama_parkiran = ?, harga = ?, kategori = ?, gambar = ?, detail_parkiran = ? where id = ?', 
        [$request->input("nama_parkiran"),$request->input("harga"),$request->input("kategori"),$request->input('gambar_old'),$request->input("detail_parkiran"),$request->input("produk_id")]);
        return redirect("/hapusedit_produk");
    }

    public function kirim_bukti_pembayaran(Request $request)
    {
        $file = $request->file('gambar');
        $gambar = "";
        if ($file != null) {
            $file->move(public_path()."/foto/", $file->getClientOriginalName());
            $gambar = "/foto/".$file->getClientOriginalName();
        }
        $id_akun = $request->input("id_akun");
        $id_produk = $request->input("id_produk");
        $metode = $request->input("metode");
        DB::insert("insert into bukti_pembayaran (metode,gambar,id_akun,id_produk) values 
        (?,?,?,?)",[$metode,$gambar,$id_akun,$id_produk]);
		
        return redirect("/");
    }
	
	public function teracc(Request $request)
    {
       
        $id_akun = $request->input("id_akun");
        $id_produk = $request->input("id_produk");
        
		 DB::update('update bukti_pembayaran set status = ?  where id = ?', 
        [$request->input("status"),$request->input("id")]);
        DB::insert("insert into teracc (id_akun,id_produk) values 
        (?,?)",[$id_akun,$id_produk]);
		
		
        return redirect("/");
    }

    public function cari(Request $request)
    {
        $kategori = $request->get("kategori");
        switch ($request->get("forma"))
        {
            case "barat":
                return view("barat",["kategori"=>$kategori]);
                break;
            case "utara":
                return view("utara",["kategori"=>$kategori]);
                break;
            case "selatan":
                return view("selatan",["kategori"=>$kategori]);
                break;
        }
    }
}
