<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\DetailInvoice;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['list'] = Invoice::query()->aktif()->get();
        return view('list',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = array();
        $data['type'] = "Created";
        $data['action'] = route('invoice.store');
        $data['client'] = Client::query()->aktif()->get();
        return view('form',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        try {
            DB::beginTransaction();
            $validateData = Validator::make($request->all(), [
                'subject' => ['required'],
                'client_id' => ['required'],
                'issue_date' => ['required'],
                'due_date' => ['required'],
                'tax' => ['required'],
                'subtotal' => ['required'],
                'total_order' => ['required'],
                'payment' => ['required'],
                // ---- Detail Order
                'product_id.*' => ['required'],
                'qty.*' => ['required'],
                'selling_price.*' => ['required'],
            ]);

            if ($validateData->fails()) {
                return response()->json($validateData->errors(), 400);
            }
            
            $data['client_id'] = $request->client_id;
            $data['subject'] = $request->subject;
            $data['issue_date'] = $request->issue_date;
            $data['due_date'] = $request->due_date;
            $data['subtotal'] = $request->subtotal;
            $data['tax'] = $request->tax;
            $data['total_order'] = $request->total_order;
            $data['payment'] = $request->payment;

            if ($data['payment'] - $data['total_order'] < 0) {
                $data['status'] = 'PAID';
            } else {
                $data['status'] = 'UNPAID';
            }

            $data['created_at'] = now();
            $invoice_id = Invoice::create($data)->id;
            // dd($createData);
            $data2['invoice_id'] = $invoice_id;
            foreach ($request->product_id as $key => $val) {
                $data2['product_id'] = $val;
                $data2['desc'] = $request->product_name[$key];
                $data2['qty'] = $request->qty[$key];
                $data2['selling_price'] = $request->selling_price[$key];
                $data2['created_at'] = now();
                // dump($data2);
                $createDetailData = DetailInvoice::create($data2);
            }

            if ($invoice_id && $createDetailData) {
                DB::commit();
                return response()->json([
                    'success' => true,
                    'message' => 'Sukses Menambahkan Data',
                ], 200);
            } else {
                DB::rollBack();
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal Menambahkan Data'
                ], 500);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'detail' => $th,
                'message' => 'Gagal Menambahkan Data (Catch)'
            ], 500);
        }
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();
            $data = Invoice::where('id', $id)->first()->delete();
            $dataDetail = DetailInvoice::where('invoice_id',$id)->delete();
            
            DB::commit();
            return redirect()->route('invoice.index');
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
