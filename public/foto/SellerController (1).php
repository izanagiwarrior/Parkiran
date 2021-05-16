<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Seller;

class SellerController extends Controller
{
    public function index()
    {
        return Seller::all();
    }

    public function create(Request $request)
    {
        $seller = new Seller;
        $seller->nama_penjual = $request->nama_penjual;
        $seller->alamat_penjual = $request->alamat_penjual;
        $seller->telfon_penjual = $request->telfon_penjual;
        $seller->transaksi_terakhir = $request->transaksi_terakhir;
        $seller->status_penjual = $request->status_penjual;
        $seller->save();
        return "Seller Data Has Been Created";
    }

    public function update(Request $request, $id)
    {

        $nama_penjual = $request->nama_penjual;
        $alamat_penjual = $request->alamat_penjual;
        $telfon_penjual = $request->telfon_penjual;
        $transaksi_terakhir = $request->transaksi_terakhir;
        $status_penjual = $request->status_penjual;

        $sales = Seller::find($id);

        $seller->nama_penjual = $nama_penjual;
        $seller->alamat_penjual = $alamat_penjual;
        $seller->telfon_penjual = $telfon_penjual;
        $seller->transaksi_terakhir = $transaksi_terakhir;
        $seller->status_penjual = $status_penjual;
        $seller->save();

        return "Seller Data Has Been Updated";
    }

    public function delete($id)
    {
        $seller = Seller::find($id);
        $seller->delete();

        return "Seller Data Has Been Deleted";
    }
}
