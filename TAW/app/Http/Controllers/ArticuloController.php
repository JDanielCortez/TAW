<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Articulo;
use app\Categoria;

class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if($request->ajax()){
            return Articulo::
            join('categorias', 'articulos.idcategoria', '=', 'categorias.id')
            ->select('articulos.idarticulo', 'categorias.nombre as categoria', 'categorias.id as idcategoria', 'articulos.codigo', 'articulos.nombre', 'articulos.precio_venta', 'articulos.stock', 'articulos.descripcion', 'articulos.condicion')
            ->get();
        }else{
            return view('principal/contenido');
        }
    }


    public function getCategorias(Request $request)
    {
        
        if($request->ajax()){
            return Categoria::
            select('id','nombre')
            ->get();
        }else{
            return view('principal/contenido');
        }
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
        //
        $articulo = new Articulo();
        $articulo->idcategoria = $request->categoria;
        $articulo->codigo = $request->codigo;
        $articulo->nombre = $request->nombre;
        $articulo->precio_venta = $request->precio_venta;
        $articulo->stock = $request->stock;
        $articulo->descripcion = $request->descripcion;
        $articulo->condicion = $request->condicion;
        $articulo->save();
    
        return $articulo;
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
        $articulo = Articulo::find($id);
        $articulo->idcategoria = $request->categoria;
        $articulo->codigo = $request->codigo;
        $articulo->nombre = $request->nombre;
        $articulo->precio_venta = $request->precio_venta;
        $articulo->stock = $request->stock;
        $articulo->descripcion = $request->descripcion;
        $articulo->condicion = $request->condicion;
        $articulo->save();
    
        return $articulo;
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
        $articulo = Articulo::find($id);
        $articulo->delete();
    }
}
