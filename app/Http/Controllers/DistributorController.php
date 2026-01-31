<?php

namespace App\Http\Controllers;

use App\Models\Distributor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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


protected $fillable = [
        'nama_distributor',
        'alamat_distributor',
        'notelpon_distributor',
    ];

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
        $distributor_lama = DB::table('distributors')->where('id', $id)->value('nama_distributor');
        $distributor = DB::table('distributors')->where('nama_distributor', $request->nama_distributor)->value('nama_distributor');
        $alamat = DB::table('distributors')->where('alamat_distributor', $request->alamat_distributor)->value('alamat_distributor');
        $notelpon = DB::table('distributors')->where('notelpon_distributor', $request->notelpon_distributor)->value('notelpon_distributor');

        if ($request->nama_distributor == $distributor && $request->alamat_distributor == $alamat && $request->notelpon_distributor == $notelpon) {
            return redirect()->route('distributor.edit')->with('duplikat', 'Distributor ' .
            $request->nama_distributor . ' data with address ' . $request->alamat_distributor . ' and telephone number ' . $request->notelpon_distributor . ' is already in the database!')->withInput();
        }else{
            $data = $request->only(['nama_distributor', 'alamat_distributor', 'notelpon_distributor']);
            $distributor = Distributor::findOrFail($id);
            $distributor->update($data);
            return redirect()->route('distributor.index')->with('ubah', 'The Distributor data, ' .
            $distributor_lama . ' Change To ' . $request->nama_distributor . ', has been successfuly updated! ');
        }
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