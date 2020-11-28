<?php

namespace App\Http\Controllers;

use App\Archivo;
use App\Categoria;
use App\Http\Requests\ArchivoRequest;
use App\Http\Requests\UpdateArchivoRequest;
use App\Macroproceso;
use App\Minicategoria;
use App\Proceso;
use App\Repositories\ArchivoRepository;
use App\Services\DeleteService;
use App\Services\UploadService;
use App\Subproceso;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;

class ArchivoController extends Controller
{
    protected $archivoRepository;
    protected $uploadService;
    protected $deleteService;
    public function __construct(ArchivoRepository $archivoRepository, UploadService $uploadService, DeleteService $deleteService)
    {
        $this->archivoRepository = $archivoRepository;
        $this->uploadService = $uploadService;
        $this->deleteService = $deleteService;
        $this->middleware('permiss', ['except' => ['index']], 'auth', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($categoria, $subcategoria, $slug)
    {
        $archivos = $this->archivoRepository->allWithCatSubCatMiniCat($categoria, $subcategoria, $slug);
        return view('archivos.index', compact('archivos', 'categoria', 'subcategoria', 'slug'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $archivo = new Archivo();
        $archivo->nombre = 'archivo';
        $archivo->descripcion = 'descripcion';
        $archivo->pdf_path = 'hdhdhdhd.pdf';
        $archivo->slug = 'archivo';
        $archivo->categoria = 'procesos-estrategicos';
        $archivo->subcategoria = 'planeacion-del-desarrollo';
        $archivo->minicategoria = 'caracterizacion';
        $archivo->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArchivoRequest $request)
    {
        try {
            $this->archivoRepository->create($request);
            return response('cargado correcto', 200);
        } catch (\Throwable $th) {
            return response($th->getMessage());
        }
    }

    public function edit(Archivo $archivo)
    {
        try {
            return response(json_encode($archivo), 200);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArchivoRequest $request)
    {
        $respon =  $this->archivoRepository->update();
        return response($respon);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Archivo  $archivo
     * @return \Illuminate\Http\Response
     */
    public function destroy($archivo)
    {
        try {
            $delete = Archivo::findOrFail($archivo);
            $this->deleteService->handleDeleteedPdf($delete->pdf_path);
            $delete->delete();
            return response($content = $archivo, $status = 200);
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }
}
