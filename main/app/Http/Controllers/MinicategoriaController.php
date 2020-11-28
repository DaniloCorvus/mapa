<?php

namespace App\Http\Controllers;

use App\Minicategoria;
use App\Proceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MinicategoriaController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permiss', 'auth']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function procesoStore(Request $request)
    {
        if (request()->expectsJson()) {
            try {
                $minicategoria =  Minicategoria::create(request()->all());
                return response()->json($minicategoria, 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Minicategoria  $minicategoria
     * @return \Illuminate\Http\Response
     */
    public function show($categoria)
    {
        // if (request()->expectsJson()) {
        //     try {
        //         return datatables()->of(Minicategoria::where('categoria_id', $categoria)->latest())
        //             ->editColumn('action', function ($data) {
        //                 $button = '
        //                     <div class="text-lg-right text-nowrap">
        //                     ';
        //                 $button  .= '<a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="editarCategoria(' . $data->id . ')"
        //                     data-toggle="tooltip" title="Editar">
        //                     <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
        //                     </a>';
        //                 $button .= '<a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="eliminarCategoria(' . $data->id . ')"
        //                     data-toggle="tooltip" title="Eliminar">
        //                     <i class="fa fa-fw fa-trash"></i>
        //                     </a>';
        //                 $button .= '
        //                     </div>';

        //                 return $button;
        //             })->rawColumns(['action'])
        //             ->addIndexColumn()
        //             ->toJson();
        //     } catch (\Throwable $th) {
        //         return response()->json($th->getMessage(), 500);
        //     }
        // }
        // return view('administrativo.detalles.index', compact('categoria'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Minicategoria  $minicategoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (request()->expectsJson()) {
            try {
                return response()->json(Minicategoria::findOrFail($id), 200);
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
     * @param  \App\Minicategoria  $minicategoria
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        if (request()->expectsJson()) {
            try {
                $categoria = Minicategoria::findOrFail(request()->id);
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
     * @param  \App\Minicategoria  $minicategoria
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                Minicategoria::findOrFail($id)->delete();
                return response()->json('Minicategoria eliminado correctamente.', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }
}
