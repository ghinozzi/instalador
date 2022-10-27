<?php

namespace App\Http\Controllers;

use App\Models\Cid_imuno;
use Illuminate\Http\Request;

class Cid_imunoController extends Controller
{
    public function index()
    {
        $data = Cid_imuno::orderBy('id asc')->get();
        return view('cid_imuno.index',compact('data'));
    }

    public function create()
    {
        return view('cid_imuno.create');
    }

    public function store(Request $request)
    {
        try {
            if (Cid_imuno::create($request->all())) {
                return redirect()->route('cid_imuno.index')->with('success','Registro criado com sucesso!');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error',$e->getMessage());
        }
    }

    public function edit(Cid_imuno $cid_imuno)
    {
        return view('cid_imuno.edit',compact('cid_imuno'));
    }

    public function update(Request $request, Cid_imuno $cid_imuno)
    {
        try {
            $data = $request->all();
            if ($cid_imuno->update($data)) {
                return redirect()->route('cid_imuno.index')->with('success','Registro atualizado com sucesso!');
            }
        } catch (Exception $e) {
            return redirect()->back()->withInput($request->all())->with('error',$e->getMessage());
        }
    }

    public function destroy(Cid_imuno $cid_imuno)
    {
        $cid_imuno->delete();
        return true;
    }
}
