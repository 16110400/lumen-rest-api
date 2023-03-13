<?php

namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Kontak::all();
        return $data;
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
        $this->validate($request,[
            "nomor_hp"=>"required|numeric",
            "nama"=>"required"
        ]);

        $kontak = new Kontak();
        $kontak->nomor_hp = $request->nomor_hp;
        $kontak->nama = $request->nama;
        $kontak->save();

        return $kontak;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function show(Kontak $kontak, $nomor)
    {
        $kontak = Kontak::find($nomor);

        return $kontak;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function edit(Kontak $kontak)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kontak $kontak, $nomor)
    {
        $this->validate($request,[
            "nomor_hp"=>"required|numeric",
            "nama"=>"required"
        ]);

        $kontak = Kontak::find($nomor);
        $kontak->nomor_hp = $request->nomor_hp;
        $kontak->nama = $request->nama;
        $kontak->save();

        return $kontak;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kontak  $kontak
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kontak $kontak, $nomor)
    {
        $kontak = Kontak::find($nomor);
        $kontak->delete();

        return $kontak;
    }
}