<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\B_master;

class B_masterController extends Controller
{
    //
    public function list(Request $request)
    {
        $filter = $request->query('filter');

        if($filter){
            return B_master::where('name','LIKE','%'.$filter.'%')->orderBy('id')->paginate(10);
        }
        return B_master::orderBy('id')->paginate(10);
    }

    public function update(Request $request,B_master $b_master)
    {
        $b_master->update($request->all());

        return $b_master;
    }

    public function create(Request $request)
    {
        return B_master::create($request->all());
    }

    public function delete(B_master $b_master)
    {
        $b_master->delete();
        return $b_master;
    }

}