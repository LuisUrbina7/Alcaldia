<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Exception;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();

        return view('categorias.vista', compact('categorias'));
    }

    public function insertar(Request $request)
    {
        $objcategoriaA = new Categoria();
        $nombre = $request->input('nombre');
        try {
            $objcategoriaA->nombre = $nombre;
            $objcategoriaA->save();
            return redirect()->back()->with('mgs', 'Felidades...');
        } catch (Exception $e) {
            return redirect()->back()->with('mgs', 'Error...');
        }
    }
    public function actualizar(Request $request, $id)
    {
       
      

            try {
                $objcategoriaB = Categoria::find($id);
                $objcategoriaB->nombre = $request->input('nombre');
                $objcategoriaB->save();
                return response()->json('Actualizado Correctamente..');
            } catch (Exception $e) {
                return response()->json('Paso algo en la actualizacion');
            }
       
    }
    public function categoriaActualizar($id)
    {
        $categoriaId = Categoria::find($id);
        return response()->json($categoriaId);
    }
}
