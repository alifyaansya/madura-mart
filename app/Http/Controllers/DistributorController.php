<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;

class DistributorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Menampilkan data Distributor
        return view('distributor.index',[
            'title' => 'Distributor',
            'datas' => Distributor::all()
        ]);
    } 

    /**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\View\View
 */
public function create()
{
    return view('distributor.create', [
        'title' => 'Distributor'
    ]);
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
     $data = $request->only(['nama_distributor', 'alamat_distributor', 'notelpon_distributor']);
     Distributor::create($data);
     return redirect()->route('distributor.index')->with('simpan', 'The new distributor data, ' .
     $request->nama_distributor . ', has been successfuly saved! ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
    
     */
    public function edit(string $id)
    {
        return view('distributor.edit', [
            'title' => 'Distributor',
            'data' => Distributor::findOrFail($id)
        ]);
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