<?php

namespace App\Http\Controllers;

use App\Models\detailtransaksi;
use App\Models\produk;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class homecontroller extends Controller
{
    public function home()
    {
        $data = produk::with('kategori')->get();

        return view('customer.home', compact('data'));
    }
    public function list(Request $request)
    {
        $data = produk::with('kategori')->when($request->search, function($query) use ($request) {
            $query->where('name','rlike',$request->search);
        })->get();

        return view('customer.list', compact('data'));
    }
    public function detail(Request $request, produk $produk)
    {
        return view('customer.detail', compact('produk'));
    }
    public function keranjang(Request $request)
    {
        $produk=detailtransaksi::where('status','keranjang')->with('produk')->get();

        return view('customer.keranjang',compact('produk'));
    }
    public function postkeranjang(Request $request,produk $produk)
    {
        $request->validate([
            'qty'=>'required',
        ]);
        
        detailtransaksi::create([
            'qty' => $request->qty,
            'user_id' => Auth::id(),
            'produk_id' => $produk->id,
            'status' =>'keranjang',
            'totalharga' => $produk->harga * $request->qty,
        ]);


         return redirect()->route('customer.keranjang')->with('status','dimasukan kedalam keranjang');
    }
    public function deletekeranjang(detailtransaksi $detailtransaksi)
    {
            $detailtransaksi->delete();

        return back()->with('status','berhasil di hapus');
    }

    public function cekout(Request $request)
    {
        $keranjang = detailtransaksi::where('user_id',Auth::id())->where('status','keranjang')->with('produk')->get();

        $transaksi=transaksi::create([
            'user_id'=>Auth::id(),
            'totalharga'=>$keranjang->sum('totalharga'),
            'kode'=>'INV/' . now()->format('Y-m-d') . transaksi::whereDate('created_at', now())->count()
        ]);

        detailtransaksi::where('user_id',Auth::id())->where('status','keranjang')->update([
            'status'=>'cekout',
            'transaksi_id'=>$transaksi->id,
        ]);

        return redirect()->route('customer.invoice', $transaksi->id);
    }

    public function invoice(transaksi $transaksi)
    {
        $transaksi->detailtransaksi;
        
        return view('customer.invoice', compact('transaksi'));
    }
}
