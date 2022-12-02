<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan isi seluruh tabel produk
        $data = Produk::all();
        $kategori = Kategori::all();
        return view('produk', compact('data', 'kategori'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //menambah data dalam tabel produk
        $data = $request->all();
        $file = $request->file('foto')->store('img');
        $data['foto'] = $file;
        Produk::create($data);
        return redirect('produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        //mengubah salah satu data di tabel produk
        $data = $request->all();
        if ($request->file('foto')) {
            $file = $request->file('foto')->store('img');
            $data['foto'] = $file;
            Storage::delete($produk->foto);
            $produk->update($data);
        }else {
            $data['foto'] = $produk->foto;
            $produk->update($data);
        }
        return redirect('produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        //menghapus salah satu data dalam tabel produk
        $produk->delete();
        Storage::delete($produk->foto);
        return redirect('produk');
    }

    public function atur(Produk $produk)
    {
        //mengganti akses tampil salah satu data dalam tabel produk
        if ($produk->status == 'tampil') {
            $produk->update([
                'status' => 'tidak',
            ]);
        }else {
            $produk->update([
                'status' => 'tampil',
            ]);
        }
        return redirect('produk');
    }
}
