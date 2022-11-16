<?php

namespace App\Http\Controllers;

use App\Models\Joao;
use Illuminate\Http\Request;


class JoaoController extends Controller
{
    public function index()
    {
        $data = Joao::orderBy('id','asc')->get();
        return view('joao.index',compact('data'));
    }

    public function create()
    {
        

        return view('joao.create');
    }

    public function store(Request $request)
    {
        try {
            if (Joao::create($request->all())) {
                return redirect()->route('joao.index')->with('success','Registro criado com sucesso!');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error',$e->getMessage());
        }
    }

    public function edit(Joao $joao)
    {
        return view('joao.edit',compact('joao'));
    }

    public function update(Request $request, Joao $joao)
    {
        try {
            $data = $request->all();
            if ($joao->update($data)) {
                return redirect()->route('joao.index')->with('success','Registro atualizado com sucesso!');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error',$e->getMessage());
        }
    }

    public function destroy(Request $request)
    {
        $data = Joao::find($request->joao)->delete();
        return true;
    }
}
