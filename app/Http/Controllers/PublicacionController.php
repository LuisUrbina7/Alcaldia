<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Publicacion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Stmt\TryCatch;

class PublicacionController extends Controller
{
    public function index()
    {
        $publicaciones = Publicacion::select('id', 'img', 'titulo')->orderby('id', 'desc')->get();
       
        return view('publicaciones.vista', compact('publicaciones'));
    }
    public function insertarVista()
    { 
        $categorias=Categoria::select('nombre','id')->get();  
        return view('publicaciones.insertar',compact('categorias'));
    }
    public function insertar(Request $request)
    {
        /* dd($request->all()); */
        $validado = Validator::make($request->all(), [
            'idUsuario' =>  'required',
            'titulo' =>  'required|max:1',
            'categoria' =>  'required',
            'sinopsis' =>  'required',
            'detalles' =>  'required',
        ]);

        if ($validado->fails()) {
            echo $validado->errors();
        } else {

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $destino = 'img/';
                $fotoNombre = time() . '-' . $foto->getClientOriginalName();
                $mover = $request->file('foto')->move($destino, $fotoNombre);
            }
            try{
                Publicacion::create([
                    'titulo' => $request->input('titulo'),
                    'sinopsis' => $request->input('sinopsis'),
                    'detalles' => $request->input('detalles'),
                    'img' => $destino . $fotoNombre,
                    'fecha' => date('y-m-d'),
                    'categoria' => $request->input('categoria'),
                    'idUsuario' => $request->input('idUsuario'),
                ]);
    
                return redirect()->back()->with('success', 'Publicado correctamente');
            }catch(Exception $e){
                return redirect()->back()->with('danger', 'mal');
            }
           
        }
    }
    public function actualizarVista($id)
    {
        $busqueda = Publicacion::find($id);
        $categorias=Categoria::select('nombre','id')->get();  
        return view('publicaciones.actualizar',compact('busqueda','categorias'));
    }
    public function borrar($id)
    {
        
        $busqueda = Publicacion::find($id);
        try{

            $busqueda->delete();
            return redirect()->route('publicaciones')->with('borrado', 'Bien');
        }
        catch(Exception $e){   return redirect()->route('publicaciones')->with('borrado', 'Bien');
        }
    
    }
}
