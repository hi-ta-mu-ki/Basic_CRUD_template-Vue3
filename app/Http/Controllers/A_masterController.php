<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\A_master;

class A_masterController extends Controller
{
    //
    public function list(Request $request)
    {
        $filter = $request->query('filter');

        if($filter){
            return A_master::where('name','LIKE','%'.$filter.'%')->orderBy('id')->paginate(10);
        }
        return A_master::orderBy('id')->paginate(10);
    }

    public function update(Request $request,A_master $a_master)
    {
        $a_master->update($request->all());

        return $a_master;
    }

    public function create(Request $request)
    {
        return A_master::create($request->all());
    }

    public function delete(A_master $a_master)
    {
        $a_master->delete();
        return $a_master;
    }

}