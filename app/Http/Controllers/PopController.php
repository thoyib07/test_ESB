<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon as Carbon;
// use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PopController extends Controller
{
    public function __construct()
    {
        setlocale(LC_TIME, 'id_ID');
        Carbon::setLocale('id');
    }

    public function barang(Request $request)
    {
        if ($request->ajax()) {
            $dataTable = Product::query();
            // ->when($request->order[0]['column'] == 0, function ($q) {
            //     $q->orderBy('created_at', 'desc');
            // });
            if (!isset($request->dataType)) {
                $dataTable->aktif();
            } else {
                $dataTable->tidakAktif();
            }

            // dd($dataTable->get());
            return DataTables::of($dataTable)
                ->addIndexColumn()
                ->addColumn('Actions', function ($data) use ($request) {
                    $btnHTML = '';
                    $btnHTML .= '<button type="button" 
                                    data-id="' . $data->id . '" 
                                    data-nama="' . $data->name . '"
                                    data-price="' . $data->suggest_price . '"
                                    class="btn btn-success btn-sm btn-select"><i class="fa fa-circle"></i> Pilih</button>';

                    return $btnHTML;
                })
                ->rawColumns([
                    'Actions'
                ])
                ->make(true);
        }
        return view('pop/barang');
    }
}
