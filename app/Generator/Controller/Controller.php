<?php

namespace App\Http\Controllers;

use App\Models\__NomeModel__;
use Illuminate\Http\Request;

class __NomeModel__Controller extends Controller
{
    public function index()
    {
        $data = __NomeModel__::orderBy('id','asc')->get();
        return view('__NomePasta__.index',compact('data'));
    }

    public function create()
    {
        return view('__NomePasta__.create');
    }

    public function store(Request $request)
    {
        try {
            if (__NomeModel__::create($request->all())) {
                return redirect()->route('__NomePasta__.index')->with('success','Registro criado com sucesso!');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error',$e->getMessage());
        }
    }

    public function edit(__NomeModel__ $__NomeVariavel__)
    {
        return view('__NomePasta__.edit',compact('__NomeVariavel__'));
    }

    public function update(Request $request, __NomeModel__ $__NomeVariavel__)
    {
        try {
            $data = $request->all();
            if ($__NomeVariavel__->update($data)) {
                return redirect()->route('__NomePasta__.index')->with('success','Registro atualizado com sucesso!');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error',$e->getMessage());
        }
    }

    public function destroy(__NomeModel__ $__NomeVariavel__)
    {
        $__NomeVariavel__->delete();
        return true;
    }
}
