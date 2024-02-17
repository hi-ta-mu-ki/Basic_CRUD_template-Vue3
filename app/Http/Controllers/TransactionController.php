<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\B_master;
use App\Models\O1_transaction;
use App\Models\O2_transaction;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    //
    public function list(Request $request)
    {
        $filter = $request->query('filter');

        if($filter){
            return O1_transaction::join('b_masters','o1_transactions.b_masters_id','=','b_masters.id')
                ->where('name','LIKE','%'.$filter.'%')->orwhere('tel','like','%'.$filter.'%')
                ->select('o1_transactions.id','b_masters.id','name','tel','o1_transactions.created_at')
                ->orderBy('o1_transactions.id')->paginate(10);
        }
        return O1_transaction::join('b_masters','o1_transactions.b_masters_id','=','b_masters.id')
        ->select('o1_transactions.id','b_masters_id','name','tel','o1_transactions.created_at')
        ->orderBy('o1_transactions.id')->paginate(10);
    }

    public function edit_order($o1_transaction)
    {
        return $items = O1_transaction::where('o1_transactions.id',$o1_transaction)
            ->join('b_masters','o1_transactions.b_masters_id','=','b_masters.id')
            ->join('o2_transactions','o1_transactions.id','=','o2_transactions.o1_transactions_id')
            ->join('a_masters','o2_transactions.a_masters_id','=','a_masters.id')
            ->select('o2_transactions.id as id2','o1_transactions.id as id1','b_masters.id as idb','o2_transactions.a_masters_id as ida','a_masters.name as namea','quantity')
            ->paginate(10);
    }

    public function add_order($o1_transaction)
    {
        return O1_transaction::where('o1_transactions.id',$o1_transaction)
            ->join('b_masters','o1_transactions.b_masters_id','=','b_masters.id')
            ->select('o1_transactions.id as id1','b_masters.id as idb','b_masters.name as nameb','tel')
            ->first();
    }

    public function update(Request $request,O2_transaction $o2_transaction)
    {
        $o2_transaction->update($request->all());

        return $o2_transaction;
    }

    public function create01(Request $request)
    {
        O1_transaction::create($request->all());
        return O1_transaction::latest('id')
            ->join('b_masters','o1_transactions.b_masters_id','=','b_masters.id')
            ->select('o1_transactions.id as id', 'name', 'tel')
            ->first();
    }

    public function delete01(O1_transaction $o1_transaction)
    {
        $o1_transaction->delete();
        return $o1_transaction;
    }

    public function create02(Request $request)
    {
        return O2_transaction::create($request->all());
    }

    public function delete02(O2_transaction $o2_transaction)
    {
        $o2_transaction->delete();
        return $o2_transaction;
    }
}