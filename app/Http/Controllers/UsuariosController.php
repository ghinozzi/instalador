<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    public function index()
    {
        $data = Usuarios::orderBy('id','asc')->get();
        return view('usuarios.index',compact('data'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        try {
            if (Usuarios::create($request->all())) {
                return redirect()->route('usuarios.index')->with('success','Registro criado com sucesso!');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error',$e->getMessage());
        }
    }

    public function edit(Usuarios $usuarios)
    {
        return view('usuarios.edit',compact('usuarios'));
    }

    public function update(Request $request, Usuarios $usuarios)
    {
        try {
            $data = $request->all();
            if ($usuarios->update($data)) {
                return redirect()->route('usuarios.index')->with('success','Registro atualizado com sucesso!');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error',$e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $data = Usuarios::find($request->usuarios)->delete();
        return true;
    }
}
