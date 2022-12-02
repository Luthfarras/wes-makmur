<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan halaman rekomendasi jamu
        return view('jamu');
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
        //mengambil data dari request dan menampilkannya lagi ke halaman rekomendasi jamu
        $keluhan = $request->keluhan;
        $dt = new Saran($request->keluhan, $request->tahunLahir);
        $data = [
            'nama' => $dt->namaJamu(),
            'khasiat' => $dt->khasiat(),
            'keluhan' => $keluhan,
            'umur' => $dt->umur(),
            'saran' => $dt->saran(),
        ];
        return view('jamu', compact('data'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

class Jamu {
    public function __construct($keluhan, $tahunLahir)
    {
        //mendeklarasikan parameter
        $this->keluhan = $keluhan;
        $this->tahunLahir = $tahunLahir;
    }

    public function namaJamu()
    {
        //menentukan nama jamu berdasarkan keluhan
        if ($this->keluhan == 'keseleo' || $this->keluhan == 'kurang nafsu makan') {
            return "Beras Kencur";
        }elseif ($this->keluhan == 'pegal-pegal') {
            return "Kunyit Asam";
        }elseif ($this->keluhan == 'darah tinggi' || $this->keluhan == 'gula darah') {
            return "Brotowali";
        }else {
            return "Temulawak";
        }
    }

    public function khasiat()
    {
        //menentukan khasiat berdasarkan keluhan
        if ($this->keluhan == 'keseleo') {
            return "Meredakan keseleo";
        }elseif ($this->keluhan == 'kurang nafsu makan') {
            return "Menambah nafsu makan";
        }elseif ($this->keluhan == 'pegal-pegal') {
            return "Meredakan pegal-pegal";
        }elseif ($this->keluhan == 'darah tinggi') {
            return "Mengatasi darah tinggi";
        }elseif ($this->keluhan == 'gula darah') {
            return "Menurunkan kadar gula darah";
        }elseif ($this->keluhan == 'masuk angin') {
            return "Mengatasi masuk angin";
        }else {
            return "Meredakan kram perut";
        }
    }

    public function umur()
    {
        return date('Y') - $this->tahunLahir;
    }
}

class Saran extends Jamu {
    public function saran()
    {
        //menentukan saran berdasarkan umur dan keluhan
        $saran = "";
        if ($this->umur() <= 10) {
            $saran = "Dikonsumsi 1x, ";
        }else {
            $saran = "Dikonsumsi 2x, ";
        }

        if ($this->namaJamu() == 'Beras Kencur' && $this->keluhan == 'keseleo') {
            return $saran .= "Dioleskan";
        }else {
            return $saran .= "Dikonsumsi";
        }
    }
}