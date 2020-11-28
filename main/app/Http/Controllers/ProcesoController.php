<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\Proceso;
use App\Categoria;
use App\Minicategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ProcesoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permiss', ['except' => ['index', 'details']], 'auth', ['except' => ['index', 'details']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($slugCategoria, $slugProceso)
    {
        try {

            $categoria = Categoria::where('slug', $slugCategoria)->first();
            $proceso = Proceso::where('slug', $slugProceso)->with('subprocesos', 'macroprocesos', 'minicategorias')->first();
            return view('procesos.index', compact('categoria', 'proceso'));
        } catch (\Throwable $th) {
            return json_encode($th->getMessage());
        }
    }


    public function get($categoria)
    {
        if (request()->expectsJson()) {
            return datatables()->of(Proceso::with('categoria')->where('categoria_id', $categoria)->get())
                ->editColumn('action', function ($data) {
                    $button = '
                <div class="text-lg-right text-nowrap">
                ';
                    $button  .= '<a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="editarProceso(' . $data->id . ')"
                data-toggle="tooltip" title="Editar">
                <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                </a>';
                    $button .= '<a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="eliminarProceso(' . $data->id . ')"
                data-toggle="tooltip" title="Eliminar">
                <i class="fa fa-fw fa-trash"></i>
                </a>';
                    $button .= '<a class="btn btn-sm btn-success" href="javascript:void(0)" onclick="verSubProceso(' . $data->id . ')"
                data-toggle="tooltip" title="ver sub procesos">
                <i class="fa fa-fw fa-eye"></i>
                </a>';
                    $button .= '<a class="btn btn-sm btn-warning" href="javascript:void(0)" onclick="verMacroProceso(' . $data->id . ')"
                data-toggle="tooltip" title="ver macroprocesos">
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
        // $categorias = Categoria::get(['id', 'nombre']);
        // return view('administrativo.procesos.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {

        try {

            $ps = Categoria::where('slug', 'PROCESOS-ESTRATEGICOS')->first();
            $pm = Categoria::where('slug', 'PROCESOS-MISIONALES')->first();
            $pa = Categoria::where('slug', 'PROCESOS-DE-APOYO')->first();
            $pe = Categoria::where('slug', 'PROCESO-DE-EVALUACION')->first();


            // PROCESOS (1)
            $categoria =  new Proceso();
            $categoria->nombre = 'DIRECCIONAMIENTO ESTRATEGICO';
            $categoria->descripcion = 'DIRECCIONAMIENTO  ESTRATEGICO';
            $categoria->categoria_id = $ps->id;
            $categoria->saveOrFail();

            // PROCESOS (2)
            $categoria =  new Proceso();
            $categoria->nombre = 'PLANEACION  E INVERSION  PUBLICA';
            $categoria->descripcion = 'PLANEACION  E INVERSION  PUBLICA';
            $categoria->categoria_id = $ps->id;
            $categoria->saveOrFail();

            // PROCESOS (3)
            $categoria =  new Proceso();
            $categoria->nombre = 'COMUNICACIONES Y RELACIONES PÚBLICAS ';
            $categoria->descripcion = 'COMUNICACIONES  Y RELACIONES  PÚBLICAS ';
            $categoria->categoria_id = $ps->id;
            $categoria->saveOrFail();

            // PROCESOS (4)
            $categoria =  new Proceso();
            $categoria->nombre = 'SERVICIOS A LA EDUCACION';
            $categoria->descripcion = 'SERVICIOS A LA EDUCACION';
            $categoria->categoria_id = $pm->id;
            $categoria->saveOrFail();

            // PROCESOS (5)
            $categoria =  new Proceso();
            $categoria->nombre = 'DESARROLLO Y SEGURIDAD SOCIAL EN SALUD';
            $categoria->descripcion = 'DESARROLLO  Y SEGURIDAD  SOCIAL  EN SALUD';
            $categoria->categoria_id = $pm->id;
            $categoria->saveOrFail();

            // PROCESOS (6)
            $categoria =  new Proceso();
            $categoria->nombre = 'DESARROLLO Y SOSTENIBILIDAD AMBIENTAL';
            $categoria->descripcion = 'DESARROLLO Y SOSTENIBILIDAD AMBIENTAL';
            $categoria->categoria_id = $pm->id;
            $categoria->saveOrFail();

            // PROCESOS (7)
            $categoria =  new Proceso();
            $categoria->nombre = 'INFRAESTRUCTURA';
            $categoria->descripcion = 'INFRAESTRUCTURA';
            $categoria->categoria_id = $pm->id;
            $categoria->saveOrFail();

            // PROCESOS (8)
            $categoria =  new Proceso();
            $categoria->nombre = 'DESARROLLO ECONOMICO Y SOCIAL';
            $categoria->descripcion = 'DESARROLLO ECONOMICO Y SOCIAL';
            $categoria->categoria_id = $pm->id;
            $categoria->saveOrFail();

            // PROCESOS (9)
            $categoria =  new Proceso();
            $categoria->nombre = 'GOBERNANCIA Y CONVIVENCIA';
            $categoria->descripcion = 'GOBERNANCIA Y CONVIVENCIA';
            $categoria->categoria_id = $pm->id;
            $categoria->saveOrFail();

            // PROCESOS (10)
            $categoria =  new Proceso();
            $categoria->nombre = 'GESTION TIC CIENCIA E INNOVACION';
            $categoria->descripcion = 'GESTION TIC CIENCIA E INNOVACION';
            $categoria->categoria_id = $pm->id;
            $categoria->saveOrFail();

            // PROCESOS (11)
            $categoria =  new Proceso();
            $categoria->nombre = 'PROCESO DESARROLLO TERRITORIAL ';
            $categoria->descripcion = 'PROCESO DESARROLLO TERRITORIAL ';
            $categoria->categoria_id = $pm->id;
            $categoria->saveOrFail();

            // PROCESOS (12)
            $categoria =  new Proceso();
            $categoria->nombre = 'RECURSOS FISICOS';
            $categoria->descripcion = 'RECURSOS FISICOS';
            $categoria->categoria_id = $pa->id;
            $categoria->saveOrFail();

            // PROCESOS (13)
            $categoria =  new Proceso();
            $categoria->nombre = 'GESTION DOCUMENTAL';
            $categoria->descripcion = 'GESTIÓN DOCUMENTAL';
            $categoria->categoria_id = $pa->id;
            $categoria->saveOrFail();

            // PROCESOS (14)
            $categoria =  new Proceso();
            $categoria->nombre = 'TALENTO HUMANO';
            $categoria->descripcion = 'TALENTO HUMANO';
            $categoria->categoria_id = $pa->id;
            $categoria->saveOrFail();

            // PROCESOS (15)
            $categoria =  new Proceso();
            $categoria->nombre = 'GESTION CONTRATACION';
            $categoria->descripcion = 'GESTIÒN CONTRATACIÓN';
            $categoria->categoria_id = $pa->id;
            $categoria->saveOrFail();

            // PROCESOS (16)
            $categoria =  new Proceso();
            $categoria->nombre = 'GESTION JURIDICA';
            $categoria->descripcion = 'GESTIÒN JURIDICA';
            $categoria->categoria_id = $pa->id;
            $categoria->saveOrFail();

            // PROCESOS (17)
            $categoria =  new Proceso();
            $categoria->nombre = 'GESTION FINANCIERA Y CONTABLE';
            $categoria->descripcion = 'GESTIÒN FINANCIERA Y CONTABLE';
            $categoria->categoria_id = $pa->id;
            $categoria->saveOrFail();

            // PROCESOS (19**)
            $categoria =  new Proceso();
            $categoria->nombre = 'GESTION ADMINISTRATIVA';
            $categoria->descripcion = 'GESTION ADMINISTRATIVA';
            $categoria->categoria_id = $pa->id;
            $categoria->saveOrFail();

            // PROCESOS (20)
            $categoria =  new Proceso();
            $categoria->nombre = 'CONTROL INTERNO Y GESTION PUBLICA';
            $categoria->descripcion = 'CONTROL INTERNO Y GESTIÓN PÚBLICA';
            $categoria->categoria_id = $pe->id;
            $categoria->saveOrFail();

            // PROCESOS (21)
            $categoria =  new Proceso();
            $categoria->nombre = 'CONTROL INTERNO DISCIPLINARIO';
            $categoria->descripcion = 'CONTROL INTERNO DISCIPLINARIO';
            $categoria->categoria_id = $pe->id;
            $categoria->saveOrFail();

            // PROCESOS (18)
            $categoria =  new Proceso();
            $categoria->nombre = 'PROCESO DICIPLINARIO INTERNO';
            $categoria->descripcion = 'PROCESO DICIPLINARIO INTERNO';
            $categoria->categoria_id = $pe->id;
            $categoria->saveOrFail();

            return 'Operacion exitosa';
        } catch (\Throwable $th) {
            return $th->getMessage();
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
                Proceso::create(request()->all());
                // return response()->json(request()->all(), 500);
                return response()->json('Proceso Agregado correctamente.', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proceso  $categoria
     * @return \Illuminate\Http\Response
     */
    public function show($proceso)
    {
        return view('administrativo.subprocesos.index', compact('proceso'));

        // $categorias = Proceso::with('procesos')->get();
        // $files = DB::table('otros')->get();
        // return view('administrativo.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Proceso  $categoria
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (request()->expectsJson()) {
            try {
                return response()->json(Proceso::findOrFail($id), 200);
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
     * @param  \App\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (request()->expectsJson()) {
            try {
                $proceso = Proceso::findOrFail($request->id);
                $proceso->update(request()->all());
                return response()->json('Proceso actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                Proceso::findOrFail($id)->delete();
                return response()->json('Proceso eliminado correctamente.', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    public function details(Categoria $categoria, Proceso $proceso, Minicategoria $minicategoria)
    {
        try {

            $archivos =  Archivo::where('categoria_id', $categoria->id)
                ->where('proceso_id', $proceso->id)
                ->where('minicategoria_id', $minicategoria->id)
                ->whereNull('macroproceso_id')
                ->whereNull('subproceso_id')
                ->get();

            return view('procesos.details', compact('categoria', 'proceso', 'minicategoria', 'archivos'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
