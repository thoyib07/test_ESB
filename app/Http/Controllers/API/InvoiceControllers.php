<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $invoice = Invoice::orderBy('created_at','DESC')
            ->aktif()->paginate(100);

            $data = $invoice->map(function($value) {
                return $value;
            });
            return response()->json([
                'success' => true,
                'data' => $data,
                'lastPage' => $invoice->lastPage(),
                'currentPage' => $invoice->currentPage(),
                'perPage' => $invoice->perPage(),
                'total' => $invoice->total(),
                'message' => 'Data Invoice'
            ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error'
            ],500);
        }
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
        try {
            $invoice = Invoice::with(['DetailInvoice','DetailInvoice.Product'])->where('id', $id)->orderBy('created_at','DESC')
            ->aktif()->paginate(100);

            $data = $invoice->map(function($value) {
                return $value;
            });
            $respon = array();
            if ($data) {
                $respon = [
                    'success' => true,
                    'data' => $data,
                    'lastPage' => $invoice->lastPage(),
                    'currentPage' => $invoice->currentPage(),
                    'perPage' => $invoice->perPage(),
                    'total' => $invoice->total(),
                    'message' => 'Data Invoice',
                    'code' => 200
                ];
            } else {
                $respon = [
                    'success' => true,
                    'message' => 'Data Invoice Not Found',
                    'code' => 404
                ];
            }
            
            return response()->json($respon,$respon['code']);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error'
            ],500);
        }
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
        //
    }
}
