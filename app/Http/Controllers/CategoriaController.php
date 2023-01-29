<?php

namespace App\Http\Controllers;

use App\Models\Categoria;

use Ciri\services\impl\CategoriaServiceImpl;
use Ciri\services\ICategoriaService;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{

    private ICategoriaService $servicio;
    function __construct()
    {
        $this->servicio = new CategoriaServiceImpl();
    }

    public function index()
    {
        return response()->json($this->servicio->all(), 200);

        // $categorias = Categoria::all();
        // return response()->json($categorias, 200);
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
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
