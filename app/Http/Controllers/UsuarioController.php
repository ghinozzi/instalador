<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;


class UsuarioController extends Controller
{
    public function index()
    {
        $data = Usuario::orderBy('id','asc')->get();
        return view('usuario.index',compact('data'));
    }

    public function create()
    {
        

        return view('usuario.create',compact());
    }

    public function store(Request $request)
    {
        try {
            if (Usuario::create($request->all())) {
                return redirect()->route('usuario.index')->with('success','Registro criado com sucesso!');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error',$e->getMessage());
        }
    }

    public function edit(Usuario $usuario)
    {
        return view('usuario.edit',compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        try {
            $data = $request->all();
            if ($usuario->update($data)) {
                return redirect()->route('usuario.index')->with('success','Registro atualizado com sucesso!');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error',$e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $data = Usuario::find($request->usuario)->delete();
        return true;
    }
}
