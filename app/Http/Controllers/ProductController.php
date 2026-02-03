<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.index', [
            'title' => 'Products',
            'datas' => Product::all() 
        ]);
    }

    public function create()
    {
        return view('products.create', [
            'title' => 'Products'
        ]);
    }

   public function store(Request $request)
    {
    $kd = DB::table('products') ->where('kdbarang',$request->nama_distributor)->value('kdbarang');
    $nama = DB::table('products')->where('nama_barang', $request->alamat_distributor)->value('nama_barang');
   
    if ($request->kdbarang == $kd)
        { return redirect()->route('product.create')->with('duplikat','Product ' . 
        $request->kdbarang . 'data with code' . $request->kdbarang .' is already in the database!')->withInput();
    } else if ($request->nama_barang == $nama  ) {
        return redirect()->route('product.create')->with('duplikat','Product ' . 
        $request->nama_barang . ' data with name ' . $request->nama_barang .' is already in the database!')->withInput();
    } else {
        $data = $request->all();
        $data['foto_barang'] = $request->file('foto_barang')->store('product-images');
        Product::create($data);
        return redirect()->route('product.index')->with('simpan', 'The new product data, ' .
        $request->nama_barang . ', has been successfuly saved! ');
    }
    }
    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
