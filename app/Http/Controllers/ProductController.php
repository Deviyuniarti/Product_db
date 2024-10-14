<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\DataTables;

class ProductController extends Controller
{
    public function index()
    {
        $productData = Product::get();
        return view('pages.product.index', ['productData' => $productData]);
    }

    public function create()
    {
        return view('pages.product.create');
    }

    public function store(Request $request)
    {
        $productData = new Product;
        $productData->name = $request->name;
        $productData->price = $request->price;
        $productData->stock = $request->stock;
        $productData->save();

        return redirect()->to('/product')->with('success', 'Data berhasil disimpan');
    }

    public function view($id)
    {
        // Ambil data product berdasarkan ID yang diberikan
        $productData = Product::findOrFail($id);
    
        // Kirim productData ke view
        return view('pages.product.view', ['productData' => $productData]);
    }

    public function formEdit($id)
    {
        $productData = Product::find($id);
        return view('pages.product.form_edit', ['productData' => $productData]);
    }

    public function update($id, Request $request)
    {
        $productData = Product::find($id);

        if (!$productData) {
            return redirect()->to('/product')->with('error', 'Data tidak ditemukan');
        }

        $productData->name = $request->name;
        $productData->price = $request->price;
        $productData->stock = $request->stock;
        $productData->save();

        return redirect()->to('/product')->with('success', 'Data berhasil diubah');
    }

    public function delete($id)
    {
        $productData = Product::find($id);

        if (!$productData) {
            return redirect()->to('/product')->with('error', 'Data tidak ditemukan');
        }

        $productData->delete();

        return redirect()->to('/product')->with('success', 'Data berhasil dihapus');
    }

    // Menambahkan metode getData untuk DataTables
    public function getData(Request $request)
    {
        // Ambil data produk dari model Product
        $products = Product::query();
        
        return DataTables::of($products)
            ->addColumn('action', function ($product) {
                // Menambahkan tombol untuk edit dan delete
                return '<a href="/product/edit/' . $product->id . '" class="btn btn-primary btn-sm">Edit</a>
                        <form action="/product/delete/' . $product->id . '" method="POST" style="display:inline;">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>';
            })
            ->make(true); // Mengembalikan response dalam format JSON
    }
}
