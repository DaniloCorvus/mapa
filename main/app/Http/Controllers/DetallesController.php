<?php

namespace App\Http\Controllers;

use App\Minicategoria;
use Illuminate\Http\Request;

class DetallesController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permiss',  'auth']);
    }


    public function verCategoria($categoria)
    {
        if (request()->expectsJson()) {
            try {
                return datatables()->of(Minicategoria::with('categoria')->where('categoria_id', $categoria)->latest()->get())
                    ->editColumn('action', function ($data) {
                        $button = '
                            <div class="text-lg-right text-nowrap">
                            ';
                        $button  .= '<a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="editarDetalle(' . $data->id . ')"
                            data-toggle="tooltip" title="Editar">
                            <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                            </a>';
                        $button .= '<a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="eliminarDetalle(' . $data->id . ')"
                            data-toggle="tooltip" title="Eliminar">
                            <i class="fa fa-fw fa-trash"></i>
                            </a>';
                        $button .= '
                            </div>';

                        return $button;
                    })->rawColumns(['action'])
                    ->addIndexColumn()
                    ->toJson();
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return view('administrativo.detalles.categoria', compact('categoria'));
    }

    public function verProceso($proceso)
    {
        if (request()->expectsJson()) {
            try {
                return datatables()->of(Minicategoria::with('proceso')->where('proceso_id', $proceso)->latest()->get())
                    ->editColumn('action', function ($data) {
                        $button = '
                            <div class="text-lg-right text-nowrap">
                            ';
                        $button  .= '<a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="editarDetalleProceso(' . $data->id . ')"
                            data-toggle="tooltip" title="Editar">
                            <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                            </a>';
                        $button .= '<a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="eliminarDetalleProceso(' . $data->id . ')"
                            data-toggle="tooltip" title="Eliminar">
                            <i class="fa fa-fw fa-trash"></i>
                            </a>';
                        $button .= '
                            </div>';

                        return $button;
                    })->rawColumns(['action'])
                    ->addIndexColumn()
                    ->toJson();
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return view('administrativo.detalles.proceso', compact('proceso'));
    }

    public function verSubProceso($subproceso)
    {
        if (request()->expectsJson()) {
            try {
                return datatables()->of(Minicategoria::with('subproceso')->where('subproceso_id', $subproceso)->latest()->get())
                    ->editColumn('action', function ($data) {
                        $button = '
                            <div class="text-lg-right text-nowrap">
                            ';
                        $button  .= '<a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="editarDetallesubProceso(' . $data->id . ')"
                            data-toggle="tooltip" title="Editar">
                            <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                            </a>';
                        $button .= '<a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="eliminarDetallesubProceso(' . $data->id . ')"
                            data-toggle="tooltip" title="Eliminar">
                            <i class="fa fa-fw fa-trash"></i>
                            </a>';
                        $button .= '
                            </div>';

                        return $button;
                    })->rawColumns(['action'])
                    ->addIndexColumn()
                    ->toJson();
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return view('administrativo.detalles.subproceso', compact('subproceso'));
    }

    public function verMAcroproceso($macroproceso)
    {
        if (request()->expectsJson()) {
            try {
                return datatables()->of(Minicategoria::with('macroproceso')->where('macroproceso_id', $macroproceso)->latest()->get())
                    ->editColumn('action', function ($data) {
                        $button = '
                            <div class="text-lg-right text-nowrap">
                            ';
                        $button  .= '<a class="btn btn-sm btn-primary" href="javascript:void(0)" onclick="editarDetalleMacroProceso(' . $data->id . ')"
                            data-toggle="tooltip" title="Editar">
                            <i class="fa fa-edit fa-fw" aria-hidden="true"></i>
                            </a>';
                        $button .= '<a class="btn btn-sm btn-danger" href="javascript:void(0)" onclick="eliminarDetalleMacroProceso(' . $data->id . ')"
                            data-toggle="tooltip" title="Eliminar">
                            <i class="fa fa-fw fa-trash"></i>
                            </a>';
                        $button .= '
                            </div>';

                        return $button;
                    })->rawColumns(['action'])
                    ->addIndexColumn()
                    ->toJson();
            } catch (\Throwable $th) {
                return response()->json($th->getMessage(), 500);
            }
        }
        return view('administrativo.detalles.macroproceso', compact('macroproceso'));
    }
}
