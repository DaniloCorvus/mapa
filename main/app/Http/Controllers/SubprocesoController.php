<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\Categoria;
use App\Minicategoria;
use App\Proceso;
use App\Subproceso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SubprocesoController extends Controller
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
    public function index($categoria, $proceso)
    {
        // try {
        //     $Proceso =  Proceso::Slug($proceso)->first();
        //     $Subprocesos =  Subproceso::where('Proceso_id', $Proceso->id)->get();
        //     return view('Subprocesos.index', compact('categoria', 'Proceso', 'Subprocesos'));
        // } catch (\Throwable $th) {
        //     return json_encode($th->getMessage());
        // }
    }

    public function get($proceso)
    {
        if (request()->expectsJson()) {
            return datatables()->of(Subproceso::with('proceso')->where('proceso_id', $proceso)->latest()->get())
                ->editColumn('action', function ($data) {
                    $button = '
                <div class="text-lg-right text-nowrap">
                ';
                    $button  .= '<a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="editarSubProceso(' . $data->id . ')"
                data-toggle="tooltip" title="Editar">
                <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                </a>';
                    $button .= '<a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="eliminarSubProceso(' . $data->id . ')"
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {



            $ds = Proceso::where('slug', 'DIRECCIONAMIENTO-ESTRATEGICO')->first();
            $cp = Proceso::where('slug', 'COMUNICACIONES-Y-RELACIONES-PUBLICAS')->first();
            $se = Proceso::where('slug', 'SERVICIOS-A-LA-EDUCACION')->first();
            $dss = Proceso::where('slug', 'DESARROLLO-Y-SEGURIDAD-SOCIAL-EN-SALUD')->first();
            $dsa = Proceso::where('slug', 'DESARROLLO-Y-SOSTENIBILIDAD-AMBIENTAL')->first();
            $in = Proceso::where('slug', 'INFRAESTRUCTURA')->first();
            $des = Proceso::where('slug', 'DESARROLLO-ECONOMICO-Y-SOCIAL')->first();
            $gc = Proceso::where('slug', 'GOBERNANCIA-Y-CONVIVENCIA')->first();
            $gti = Proceso::where('slug', 'GESTION-TIC-CIENCIA-E-INNOVACION')->first();
            $rf = Proceso::where('slug', 'RECURSOS-FISICOS')->first();
            $gd = Proceso::where('slug', 'GESTION-DOCUMENTAL')->first();
            $th = Proceso::where('slug', 'TALENTO-HUMANO')->first();
            $gec = Proceso::where('slug', 'GESTION-CONTRATACION')->first();
            $gj = Proceso::where('slug', 'GESTION-JURIDICA')->first();
            $gfc = Proceso::where('slug', 'GESTION-FINANCIERA-Y-CONTABLE')->first();
            $cig = Proceso::where('slug', 'CONTROL-INTERNO-Y-GESTION-PUBLICA')->first();
            $cid = Proceso::where('slug', 'CONTROL-INTERNO-DISCIPLINARIO')->first();


            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'SALUD  AMBIENTAL ';
            $subproceso->descripcion = 'SALUD  AMBIENTAL ';
            $subproceso->Proceso_id = $dss->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'VIDA SALUDABLE Y CONDICIONES NO TRANSMISIBLES ';
            $subproceso->descripcion = 'VIDA SALUDABLE Y CONDICIONES NO TRANSMISIBLES ';
            $subproceso->Proceso_id = $dss->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'CONVIVENCIA  SOCIAL Y SALUD  MENTAL ';
            $subproceso->descripcion = 'CONVIVENCIA  SOCIAL Y SALUD  MENTAL ';
            $subproceso->Proceso_id = $dss->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'SEGURIDAD ALIMENTARIA Y NUTRICIONAL ';
            $subproceso->descripcion = 'SEGURIDAD ALIMENTARIA Y NUTRICIONAL ';
            $subproceso->Proceso_id = $dss->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'SEXUALIDAD Y DERECHOS SEXUALES REPRODUCTIVOS ';
            $subproceso->descripcion = 'SEXUALIDAD Y DERECHOS SEXUALES REPRODUCTIVOS ';
            $subproceso->Proceso_id = $dss->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'VIDA SALUDABLE  Y ENFERMEDADES TRANSMISIBLES ';
            $subproceso->descripcion = 'VIDA SALUDABLE  Y ENFERMEDADES TRANSMISIBLES ';
            $subproceso->Proceso_id = $dss->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'SALUD PUBLICA EN EMERGENCIAS Y DESASTRES ';
            $subproceso->descripcion = 'SALUD PUBLICA EN EMERGENCIAS Y DESASTRES ';
            $subproceso->Proceso_id = $dss->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'SALUD Y AMBITO LABORAL ';
            $subproceso->descripcion = 'SALUD Y AMBITO LABORAL ';
            $subproceso->Proceso_id = $dss->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'GESTION DIFERENCIAL DE POBLACIONES VULNERABLES ';
            $subproceso->descripcion = 'GESTION DIFERENCIAL DE POBLACIONES VULNERABLES ';
            $subproceso->Proceso_id = $dss->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'FORTALECIMIENTO DE LA AUTORIDAD SANITARIA PARA LA GESTION EN SALUD, AREA DE ASEGURAMIENTO';
            $subproceso->descripcion = 'FORTALECIMIENTO DE LA AUTORIDAD SANITARIA PARA LA GESTION EN SALUD, AREA DE ASEGURAMIENTO';
            $subproceso->Proceso_id = $dss->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'DESARROLLO INDIVIDUAL DE SERVICIOS DE SALUD (SALUD HUMANA)';
            $subproceso->descripcion = 'DESARROLLO INDIVIDUAL DE SERVICIOS DE SALUD (SALUD HUMANA)';
            $subproceso->Proceso_id = $dss->id;
            $subproceso->saveOrFail();
            /*-------------------------------------------------------------------------------------------------------------*/
            /*-------------------------------------------------------------------------------------------------------------*/
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'EDUCACION AMBIENTAL';
            $subproceso->descripcion = 'EDUCACION AMBIENTAL';
            $subproceso->Proceso_id = $dsa->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'PLAN INTEGRAL DE RESIDUOS SOLIDOS. PGIRS';
            $subproceso->descripcion = 'PLAN INTEGRAL DE RESIDUOS SOLIDOS. PGIRS';
            $subproceso->Proceso_id = $dsa->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'MONITOREO DE RECURSOS NATURALES';
            $subproceso->descripcion = 'MONITOREO DE RECURSOS NATURALES';
            $subproceso->Proceso_id = $dsa->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'GESTION INTEGRAL DEL RIESGO';
            $subproceso->descripcion = 'GESTION INTEGRAL DEL RIESGO';
            $subproceso->Proceso_id = $dsa->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'VIVERO';
            $subproceso->descripcion = 'VIVERO';
            $subproceso->Proceso_id = $dsa->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'CEMENTERIO';
            $subproceso->descripcion = 'CEMENTERIO';
            $subproceso->Proceso_id = $dsa->id;
            $subproceso->saveOrFail();

            /*-------------------------------------------------------------------------------------------------------------*/
            /*-------------------------------------------------------------------------------------------------------------*/

            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'AUTOPAVIMENTACION';
            $subproceso->descripcion = 'AUTOPAVIMENTACION';
            $subproceso->Proceso_id = $in->id;
            $subproceso->saveOrFail();

            /*-------------------------------------------------------------------------------------------------------------*/
            /*-------------------------------------------------------------------------------------------------------------*/

            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'ATENCION A LA POBLACION ESPECIAL';
            $subproceso->descripcion = 'ATENCION A LA POBLACION ESPECIAL';
            $subproceso->Proceso_id = $des->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'GESTION CULTURAL';
            $subproceso->descripcion = 'GESTION CULTURAL';
            $subproceso->Proceso_id = $des->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'GESTION ECONOMICA';
            $subproceso->descripcion = 'GESTION ECONOMICA';
            $subproceso->Proceso_id = $des->id;
            $subproceso->saveOrFail();

            /*-------------------------------------------------------------------------------------------------------------*/
            /*-------------------------------------------------------------------------------------------------------------*/


            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'INSPECCION DE POLICIA';
            $subproceso->descripcion = 'INSPECCION DE POLICIA';
            $subproceso->Proceso_id = $gc->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'COMISARIAS DE FAMILIA';
            $subproceso->descripcion = 'COMISARIAS DE FAMILIA';
            $subproceso->Proceso_id = $gc->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'CRAIV';
            $subproceso->descripcion = 'CRAIV';
            $subproceso->Proceso_id = $gc->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'PAZ Y CONVIVENCIA';
            $subproceso->descripcion = 'PAZ Y CONVIVENCIA';
            $subproceso->Proceso_id = $gc->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'CENTRO DE CONVIVENCIA CIUDADANA';
            $subproceso->descripcion = 'CENTRO DE CONVIVENCIA CIUDADANA';
            $subproceso->Proceso_id = $gc->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'FAMILIAS EN ACCION';
            $subproceso->descripcion = 'FAMILIAS EN ACCION';
            $subproceso->Proceso_id = $gc->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'DESARROLLO COMUNITARIO';
            $subproceso->descripcion = 'DESARROLLO COMUNITARIO';
            $subproceso->Proceso_id = $gc->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'PROCESOS INTERNOS';
            $subproceso->descripcion = 'PROCESOS INTERNOS';
            $subproceso->Proceso_id = $gc->id;
            $subproceso->saveOrFail();

            /*-------------------------------------------------------------------------------------------------------------*/
            /*-------------------------------------------------------------------------------------------------------------*/

            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'OPERACIONES DE TI (SISTEMA DE INFORMACION INSFRAESTRUCTURA Y SOPORTE TECNOLOGICO)';
            $subproceso->descripcion = 'OPERACIONES DE TI (SISTEMA DE INFORMACION INSFRAESTRUCTURA Y SOPORTE TECNOLOGICO)';
            $subproceso->Proceso_id = $gti->id;
            $subproceso->saveOrFail();

            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'SERVICIOS DIGITALES';
            $subproceso->descripcion = 'SERVICIOS DIGITALES';
            $subproceso->Proceso_id = $gti->id;
            $subproceso->saveOrFail();

            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'PROYECTOS TIC';
            $subproceso->descripcion = 'PROYECTOS TIC';
            $subproceso->Proceso_id = $gti->id;
            $subproceso->saveOrFail();

            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'DESARROLLO DE  CIENCIA  TECNOLOGIA E INNOVACION';
            $subproceso->descripcion = 'DESARROLLO DE  CIENCIA  TECNOLOGIA E INNOVACION';
            $subproceso->Proceso_id = $gti->id;
            $subproceso->saveOrFail();

            /*-------------------------------------------------------------------------------------------------------------*/
            /*-------------------------------------------------------------------------------------------------------------*/

            // //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'SISTEMA INTERNO DE GESTION';
            $subproceso->descripcion = 'SISTEMA INTERNO DE GESTION';
            $subproceso->Proceso_id = $gd->id;
            $subproceso->saveOrFail();

            /*-------------------------------------------------------------------------------------------------------------*/
            /*-------------------------------------------------------------------------------------------------------------*/


            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'SGSST';
            $subproceso->descripcion = 'SGSST';
            $subproceso->Proceso_id = $th->id;
            $subproceso->saveOrFail();

            /*-------------------------------------------------------------------------------------------------------------*/
            /*-------------------------------------------------------------------------------------------------------------*/

            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'DEFENSA JUDICIAL Y AUTORIDADES ADMINISTRATIVAS';
            $subproceso->descripcion = 'DEFENSA JUDICIAL Y AUTORIDADES ADMINISTRATIVAS';
            $subproceso->Proceso_id = $gec->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'INMOBILIARIO';
            $subproceso->descripcion = 'INMOBILIARIO';
            $subproceso->Proceso_id = $gec->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'GESTION PUBLICA Y CONTROL';
            $subproceso->descripcion = 'GESTION PUBLICA Y CONTROL';
            $subproceso->Proceso_id = $gec->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'CONCILIACIONES';
            $subproceso->descripcion = 'CONCILIACIONES';
            $subproceso->Proceso_id = $gec->id;
            $subproceso->saveOrFail();

            /*-------------------------------------------------------------------------------------------------------------*/
            /*-------------------------------------------------------------------------------------------------------------*/


            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'GESTIÓN TRIBUTARIA';
            $subproceso->descripcion = 'GESTIÓN TRIBUTARIA';
            $subproceso->Proceso_id = $gfc->id;
            $subproceso->saveOrFail();

            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'GESTION DE RECAUDO';
            $subproceso->descripcion = 'GESTION DE RECAUDO';
            $subproceso->Proceso_id = $gfc->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'GESTION CONTABLE';
            $subproceso->descripcion = 'GESTION CONTABLE';
            $subproceso->Proceso_id = $gfc->id;
            $subproceso->saveOrFail();
            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'GESTION PRESUPUESTAL';
            $subproceso->descripcion = 'GESTION PRESUPUESTAL';
            $subproceso->Proceso_id = $gfc->id;
            $subproceso->saveOrFail();

            /*-------------------------------------------------------------------------------------------------------------*/
            /*-------------------------------------------------------------------------------------------------------------*/

            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'LIDERAZGO ESTRATEGICO';
            $subproceso->descripcion = 'LIDERAZGO ESTRATEGICO';
            $subproceso->Proceso_id = $cig->id;
            $subproceso->saveOrFail();

            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'ENFOQUE A LA PREVENCION';
            $subproceso->descripcion = 'ENFOQUE A LA PREVENCION';
            $subproceso->Proceso_id = $cig->id;
            $subproceso->saveOrFail();

            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'EVALUACION Y SEGUIMIENTO';
            $subproceso->descripcion = 'EVALUACION Y SEGUIMIENTO';
            $subproceso->Proceso_id = $cig->id;
            $subproceso->saveOrFail();

            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'GESTION DEL RIESGO';
            $subproceso->descripcion = 'GESTION DEL RIESGO';
            $subproceso->Proceso_id = $cig->id;
            $subproceso->saveOrFail();

            //Subprocesso(*)
            $subproceso =  new Subproceso();
            $subproceso->nombre = 'RELACION CON ENTES EXTERNOS DE CONTROL';
            $subproceso->descripcion = 'RELACION CON ENTES EXTERNOS DE CONTROL';
            $subproceso->Proceso_id = $cig->id;
            $subproceso->saveOrFail();

            return 'Operacion exitosa ';
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
                Subproceso::create(request()->all());
                // return response()->json(request()->all(), 500);
                return response()->json('Subproceso eliminado correctamente.', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subproceso  $Subproceso
     * @return \Illuminate\Http\Response
     */

    public function show(Categoria $categoria, Proceso $proceso, Subproceso $subproceso)
    {
        try {
            return view('subprocesos.index', compact('categoria', 'proceso', 'subproceso'));
        } catch (\Throwable $th) {
            throw $th->getMessage();
        }
    }

    public function subproceso($categoria, $subproceso)
    {
        // try {
        //     $categoria = Proceso::findOrFail($categoria);
        //     $subprocesos =  Subproceso::Slug($subproceso)->with('minicategorias')->get();
        //     return view('comodin.index', compact('categoria', 'subprocesos'));
        // } catch (\Throwable $th) {
        //     return json_encode($th->getMessage());
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subproceso  $Subproceso
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (request()->expectsJson()) {
            try {
                return response()->json(Subproceso::findOrFail($id), 200);
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
     * @param  \App\Subproceso  $Subproceso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if (request()->expectsJson()) {
            try {
                $proceso = Subproceso::findOrFail($request->id);
                $proceso->update(request()->all());
                return response()->json('Subproceso actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subproceso  $Subproceso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (request()->expectsJson()) {
            try {
                Subproceso::findOrFail($id)->delete();
                return response()->json('Subproceso eliminado correctamente.', 200);
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return abort(404);
    }


    // /subprocesos/{categoria}/{proceso}/{subproceso}/{minicategoria}
    public function details(Categoria $categoria, Proceso $proceso, Subproceso $subproceso, Minicategoria $minicategoria)
    {
        try {
            $archivos =  Archivo::where('categoria_id', $categoria->id)
                ->where('proceso_id', $proceso->id)
                ->where('minicategoria_id', $minicategoria->id)
                ->where('subproceso_id', $subproceso->id)
                ->whereNull('macroproceso_id')
                ->get();

            return view('subprocesos.details', compact('categoria', 'subproceso', 'proceso', 'minicategoria', 'archivos'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
