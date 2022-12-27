<?php

namespace App\Http\Controllers;

use App\Models\Tipo_usuario;
use Illuminate\Http\Request;


class Tipo_usuarioController extends Controller
{
    public function index()
    {
        $data = Tipo_usuario::orderBy('id','asc')->get();
        return view('tipo_usuario.index',compact('data'));
    }

    public function create()
    {
        

        return view('tipo_usuario.create');
    }

    public function store(Request $request)
    {
        try {
            if (Tipo_usuario::create($request->all())) {
                return redirect()->route('tipo_usuario.index')->with('success','Registro criado com sucesso!');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error',$e->getMessage());
        }
    }

    public function edit(Tipo_usuario $tipo_usuario)
    {
        return view('tipo_usuario.edit',compact('tipo_usuario'));
    }

    public function update(Request $request, Tipo_usuario $tipo_usuario)
    {
        try {
            $data = $request->all();
            if ($tipo_usuario->update($data)) {
                return redirect()->route('tipo_usuario.index')->with('success','Registro atualizado com sucesso!');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error',$e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $data = Tipo_usuario::find($request->tipo_usuario)->delete();
        return true;
    }
}
