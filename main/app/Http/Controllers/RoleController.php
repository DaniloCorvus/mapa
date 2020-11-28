<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index']]);
        $this->middleware('permiss', ['except' => ['index']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            return datatables()->of(Role::latest())
                ->addColumn('action', 'admin.clientes.actions')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->toJson();
        }

        return view('admin.clientes.index');
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->expectsJson()) {
            try {
                Role::create(request()->all());
                return response('Role registrado correctamente', 200);
            } catch (\Throwable $th) {
                return  json_encode($th->getMessage(), 500);
            }
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Role  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->expectsJson()) {
            $cliente = Role::findOrFail($id);
            return response($cliente, 200);
        }
        return abort(404);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Transportes\Role  $cliente
     * @return \Illuminate\Http\Response
     */

    public function show(Request $request,  $key)
    {
        $cliente = Role::findOrfail($key);
        return view('admin.clientes.show', compact('cliente'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if ($request->expectsJson()) {
            try {
                $cliente = Role::findOrFail($request->id);
                $cliente->update(request()->all());
                return response('Role actualizado correctamente', 200);
            } catch (\Throwable $th) {
                return  response($th->getMessage(), 500);
            }
        }
        return abort(404);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \Transportes\Role  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->expectsJson()) {
            Role::findOrFail($id)->delete();
            return response('Role deleted successfully.');
        }
        return abort(404);
    }


    public function eliminarRol($rol, $user)
    {
        try {
            $rol = Role::findOrFail($rol);
            $user = User::findOrFail($user);
            $user->roles()->detach($rol->id);
            return json_encode('Eliminar correctamente');
        } catch (\Throwable $th) {
            return json_encode($th->getMessage());
        }
    }

    public function asignarRole(Request $request)
    {

        $user = User::findOrFail(request()->user_id);

        if ($request->tecnico == 'on') {

            $rol = Role::where('name', 'tecnico')->first();
            if (!$user->roles()->where('role_id', $rol->id)->first()) {
                $user->roles()->attach($rol);
            }
        }
        if ($request->user == 'on') {
            $rol = Role::where('name', 'user')->first();
            if (!$user->roles()->where('role_id', $rol->id)->first()) {
                $user->roles()->attach($rol);
            }
        }
        if ($request->admin == 'on') {
            $rol = Role::where('name', 'admin')->first();
            if (!$user->roles()->where('role_id', $rol->id)->first()) {
                $user->roles()->attach($rol);
            }
        }

        return back();
    }
}
