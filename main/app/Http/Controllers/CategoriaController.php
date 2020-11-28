<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\Categoria;
use App\Empresa;
use App\Macroproceso;
use App\Minicategoria;
use App\Proceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class CategoriaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permiss', ['except' => ['index']], 'auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Cache::flush();

        $categorias = Categoria::with('procesos')->get();
        $files = DB::table('otros')->get();
        $empresa = Empresa::first();
        if ($empresa) {
            $titulo = $empresa->title;
        } else {
            $titulo = 'MAPA DE PROCESOS MUNICIPIO DE BARRANCABERMEJA
            _ ALCALDIA MUNICIPAL';
        }
        return view(('/home'), compact('titulo', 'files', 'categorias'));
    }

    public function minis(Categoria $categoria)
    {
        try {
            $categoria = Categoria::find($categoria->id)->with('minicategorias')->first();
            return view('categorias.index', compact('categoria'));
        } catch (\Throwable $th) {
            throw $th->getMessage();
        }
    }

    public function get()
    {
        if (request()->expectsJson()) {
            return datatables()->of(Categoria::latest())
                ->editColumn('action', function ($data) {
                    $button = '
                <div class="text-lg-right text-nowrap">
                ';
                    $button  .= '<a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="editarCategoria(' . $data->id . ')"
                data-toggle="tooltip" title="Editar">
                <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                </a>';
                    $button .= '<a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="eliminarCategoria(' . $data->id . ')"
                data-toggle="tooltip" title="Eliminar">
                <i class="fa fa-fw fa-trash"></i>
                </a>';
                    $button .= '<a class="btn btn-sm btn-success" href="javascript:void(0)" onclick="verProcesos(' . $data->id . ')"
                data-toggle="tooltip" title="ver procesos">
                <i class="fa fa-fw fa-eye"></i>
                </a>';
                    $button .= '<a class="btn btn-sm btn-dark" href="javascript:void(0)" onclick="verDetalles(' . $data->id . ')"
                data-toggle="tooltip" title="ver detalles">
                <i class="fa fa-fw fa-eye"></i>
                </a>';
                    $button .= '
                </div>';

                    return $button;
                })->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }
        return view('administrativo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            // (1)
            $categoria =  new Categoria();
            $categoria->nombre = 'PROCESOS ESTRATEGICOS';
            $categoria->descripcion = 'Todos los procesos etrategicos de nuestra organizacion';
            $categoria->saveOrFail();
            // (2)
            $categoria =  new Categoria();
            $categoria->nombre = 'PROCESOS MISIONALES';
            $categoria->descripcion = 'Todos los procesos misionales de nuestra organizacion';
            $categoria->saveOrFail();
            // (3)
            $categoria =  new Categoria();
            $categoria->nombre = 'PROCESOS DE APOYO';
            $categoria->descripcion = 'Todos los procesos de apoyo de nuestra organizacion';
            $categoria->saveOrFail();
            // (4)
            $categoria =  new Categoria();
            $categoria->nombre = 'PROCESO DE EVALUACION';
            $categoria->descripcion = 'Todos los procesos de evaluacion de nuestra organizacion';
            $categoria->saveOrFail();
            return 'Operacion exitosa';
        } catch (\Throwable $th) {
            throw $th->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (request()->expectsJson()) {
            try {
                Categoria::create(request()->all());
                return response()->json('Categoria eliminado correctamente.', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show($categoria)
    {
        if (Categoria::find($categoria)) {
            $categorias = Categoria::all();
            return view('administrativo.procesos.index', compact('categorias', 'categoria'));
        }
        abort(404);
    }

    // public function detalles($categoria)
    // {
    //     return view('administrativo.detalles.index', compact('categoria'));
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (request()->expectsJson()) {
            try {
                return response()->json(Categoria::findOrFail($id), 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (request()->expectsJson()) {
            try {
                $categoria = Categoria::findOrFail($request->id);
                $categoria->update(request()->all());
                return response()->json('Categoria actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categoria  $categoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                Categoria::findOrFail($id)->delete();
                return response()->json('Categoria eliminado correctamente.', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }


    // /macroprocesos/{categoria}/{proceso}/{macroproceso}/{minicategoria}
    public function details(Categoria $categoria, Minicategoria $minicategoria)
    {
        try {

            $archivos =  Archivo::where('categoria_id', $categoria->id)
                ->where('minicategoria_id', $minicategoria->id)
                ->whereNull('proceso_id')
                ->whereNull('subproceso_id')
                ->whereNull('macroproceso_id')
                ->get();

            return view('categorias.details', compact('categoria', 'archivos', 'minicategoria'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
