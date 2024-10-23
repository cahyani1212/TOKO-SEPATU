<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class kategoricontroller extends Controller
{
    public function index() : View
    {
        //get all products
        $kategori = Kategori::all();

        //render view with products
        return view('kategori.index', compact('kategori'));
    }

    /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('kategori.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $request->validate([
            'nama_kategori'         => 'required|max:255',
        ]);

        //create product
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }
    /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get product by ID
        $kategori = Kategori::findOrFail($id);

        //render view with product
        return view('kategori.edit', compact('kategori'));
    }
        
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $request->validate([
            'nama_kategori'         => 'required|max:255',
        ]);

        //get product by ID
        $kategori = Kategori::findOrFail($id);

            //update product without image
            $kategori->update([
                'nama_kategori'         => $request->nama_kategori
            ]);
        

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Diubah!']);
    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        //get product by ID
        $kategori = Kategori::findOrFail($id);
        
        $kategori->delete();

        //redirect to index
        return redirect()->route('kategori.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
