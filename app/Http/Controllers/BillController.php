<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bills= Bill::all();
        // dd($bills);
        return view('admin.bill', ['bills' => $bills]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.bill_edit', [
            'bill' => Bill::firstWhere('id', $id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'id_customer'=>'required',
            'date_order'=>'required',
            'total'=>'required',
            'payment'=>'required',
            'note'=>'required',
            'created_at'=>'required',
            'updated_at'=>'required',
            'trangthai'=>'required'
        ],[
            'id_customer.required'=>'Bạn chưa nhập id',
            'date_order.required'=>'Bạn chưa nhập date',
            'total.required'=>'Bạn chưa nhập số total',
            'payment.required' => 'Bạn chưa nhập  payment',
            'note.required' => 'Bạn chưa nhập  note',
            'created_at.required' => 'Bạn chưa nhập  created_at',
            'updated_at.required' => 'Bạn chưa nhập  updated_at',
            'trangthai.required' => 'Bạn chưa nhập  trang thai'
        ]);
        $bill=bill::find($id);
        $bill->id_customer=$request->id_cutomer;
        $bill->date_order=$request->date_order;
        $bill->total=$request->total;
        $bill->payment=$request->payment;
        $bill->note=$request->note;
        $bill->created_at=$request->create_at;
        $bill->updated_at=$request->updated_at;
        $bill->trangthai=$request->trangthai;
        $bill->save();

        return redirect()->route('bills.index')->with('success','Bạn đã cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bill=bill::find($id);
        $bill->delete();
        return redirect()->route('bills.index')->with('success','Bạn đã xóa thành công');
    }
}
