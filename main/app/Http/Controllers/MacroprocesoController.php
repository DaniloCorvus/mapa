<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\Categoria;
use App\Macroproceso;
use App\Minicategoria;
use App\Proceso;
use App\Subproceso;
use Illuminate\Http\Request;

class MacroprocesoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permiss', ['except' => ['show', 'details']], 'auth', ['except' => ['show', 'details']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cat)
    {
        // $this->categoria = $cat;
        // try {
        //     $categoria =  Categoria::Slug($this->categoria)->first();
        //     $macroprocesos =  Macroproceso::where('proceso', $categoria->id)->get();
        //     return view('Macroprocesos.index', compact('categoria', 'macroprocesos'));
        // } catch (\Throwable $th) {
        //     return json_encode($th->getMessage());
        // }
    }

    public function get($proceso)
    {
        try {
            if (request()->expectsJson()) {
                return datatables()->of(Macroproceso::with('proceso')->where('proceso_id', $proceso)->latest()->get())
                    ->editColumn('action', function ($data) {
                        $button = '
                    <div class="text-lg-right text-nowrap">
                    ';
                        $button  .= '<a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="editarMacroProceso(' . $data->id . ')"
                    data-toggle="tooltip" title="Editar">
                    <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                    </a>';
                        $button .= '<a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="eliminarMacroProceso(' . $data->id . ')"
                    data-toggle="tooltip" title="Eliminar">
                    <i class="fa fa-fw fa-trash"></i>
                    </a>';
                        $button .= '<a class="btn btn-sm btn-success" href="javascript:void(0)" onclick="verDetalles(' . $data->id . ')"
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
            return view('administrativo.macroprocesos.index', compact('proceso'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {

            $se = Proceso::where('slug', 'SERVICIOS-A-LA-EDUCACION')->first();

            $categoria =  new Macroproceso();
            $categoria->nombre = 'MACROPROCESO GESTION DE PROGRAMAS Y PROYECTOS';
            $categoria->descripcion = 'MACROPROCESO GESTION DE PROGRAMAS Y PROYECTOS';
            $categoria->proceso_id = $se->id;
            $categoria->saveOrFail();

            $categoria =  new Macroproceso();
            $categoria->nombre = 'MACROPROCESO GESTION DE LA COBERTURA DEL SERVICIO EDUCATIVO';
            $categoria->descripcion = 'MACROPROCESO GESTION DE LA COBERTURA DEL SERVICIO EDUCATIVO';
            $categoria->proceso_id = $se->id;
            $categoria->saveOrFail();

            $categoria =  new Macroproceso();
            $categoria->nombre = 'MACROPROCESO GESTION DE LA CALIDAD  DEL SERVICIO EDUCATIVO';
            $categoria->descripcion = 'MACROPROCESO GESTION DE LA CALIDAD  DEL SERVICIO EDUCATIVO';
            $categoria->proceso_id = $se->id;
            $categoria->saveOrFail();
            /*-----------------------------------------------------------------------------------------------------------------*/
            $categoria =  new Macroproceso();
            $categoria->nombre = 'MACROPROCESO ATENCION AL CIUDADANO';
            $categoria->descripcion = 'MACROPROCESO ATENCION AL CIUDADANO';
            $categoria->proceso_id = $se->id;
            $categoria->saveOrFail();

            /*-----------------------------------------------------------------------------------------------------------------*/
            $categoria =  new Macroproceso();
            $categoria->nombre = 'MACROPROCESO INSPECCION Y VIGILANCIA DE ESTABLECIMIENTOS EDUCATIVOS';
            $categoria->descripcion = 'MACROPROCESO INSPECCION Y VIGILANCIA DE ESTABLECIMIENTOS EDUCATIVOS';
            $categoria->proceso_id = $se->id;
            $categoria->saveOrFail();

            $categoria =  new Macroproceso();
            $categoria->nombre = 'MACROPROCESO GESTION DE LA INFORMACION';
            $categoria->descripcion = 'MACROPROCESO GESTION DE LA INFORMACION';
            $categoria->proceso_id = $se->id;
            $categoria->saveOrFail();

            $categoria =  new Macroproceso();
            $categoria->nombre = 'MACROPROCESO  GESTION DE RECURSOS HUMANOS';
            $categoria->descripcion = 'MACROPROCESO  GESTION DE RECURSOS HUMANOS';
            $categoria->proceso_id = $se->id;
            $categoria->saveOrFail();

            $categoria =  new Macroproceso();
            $categoria->nombre = 'MACROPROCESO GESTION ADMINISTRATIVA DE BIENES Y SERVICIOS';
            $categoria->descripcion = 'MACROPROCESO GESTION ADMINISTRATIVA DE BIENES Y SERVICIOS';
            $categoria->proceso_id = $se->id;
            $categoria->saveOrFail();

            $categoria =  new Macroproceso();
            $categoria->nombre = 'MACROPROCESO DE GESTION FINANCIERA';
            $categoria->descripcion = 'MACROPROCESO DE GESTION FINANCIERA';
            $categoria->proceso_id = $se->id;
            $categoria->saveOrFail();

            $categoria =  new Macroproceso();
            $categoria->nombre = 'MACROPROCESO DE CONTROL INTERNO';
            $categoria->descripcion = 'MACROPROCESO DE CONTROL INTERNO';
            $categoria->proceso_id = $se->id;
            $categoria->saveOrFail();

            $categoria =  new Macroproceso();
            $categoria->nombre = 'MACROPROCESO  GESTION  DE TECNOLOGIA INFORMATICA';
            $categoria->descripcion = 'MACROPROCESO  GESTION  DE TECNOLOGIA INFORMATICA';
            $categoria->proceso_id = $se->id;
            $categoria->saveOrFail();

            return 'Operacion exitosa';
        } catch (\Throwable $th) {
            return ($th->getMessage());
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
                Macroproceso::create(request()->all());
                // return response()->json(request()->all(), 500);
                return response()->json('Macroproceso eliminado correctamente.', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Macroproceso  $macroproceso
     * @return \Illuminate\Http\Response
     */

    // {{-- /macroprocesos/{categoria}/{proceso}/{macroproceso} --}}

    public function show(Categoria $categoria, Proceso $proceso, Macroproceso $macroproceso)
    {
        try {
            $macroproceso = Macroproceso::with('minicategorias')->findOrFail($macroproceso->id);
            return view('macroprocesos.index', compact('categoria', 'proceso', 'macroproceso'));
        } catch (\Throwable $th) {
            throw $th->getMessage();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Macroproceso  $macroproceso
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (request()->expectsJson()) {
            try {
                return response()->json(Macroproceso::findOrFail($id), 200);
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
     * @param  \App\Macroproceso  $macroproceso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (request()->expectsJson()) {
            try {
                $proceso = Macroproceso::findOrFail($request->id);
                $proceso->update(request()->all());
                return response()->json('Macroproceso actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Macroproceso  $macroproceso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                Macroproceso::findOrFail($id)->delete();
                return response()->json('Macroproceso eliminado correctamente.', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    // /macroprocesos/{categoria}/{proceso}/{macroproceso}/{minicategoria}
    public function details(Categoria $categoria, Proceso $proceso, Macroproceso $macroproceso, Minicategoria $minicategoria)
    {
        try {

            $archivos =  Archivo::where('categoria_id', $categoria->id)
                ->where('proceso_id', $proceso->id)
                ->where('minicategoria_id', $minicategoria->id)
                ->whereNull('subproceso_id')
                ->where('macroproceso_id', $macroproceso->id)
                ->get();

            return view('macroprocesos.details', compact('categoria', 'proceso', 'macroproceso', 'minicategoria', 'archivos'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
