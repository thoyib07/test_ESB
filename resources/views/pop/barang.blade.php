@extends('pop.app')

@section('title', 'Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card card-primary card-outline card-outline-tabs">
            <div class="card-title">
                <h1 class="text-center"> Product </h1>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade active show" id="custom-tabs-produk-aktif" role="tabpanel"
                        aria-labelledby="custom-tabs-produk-aktif-tab">
                        {{-- <div class="card-title">
                            <button style="float: right; font-weight: 900;" class="btn btn-info btn-sm mb-3 mx-1"
                                type="button" onclick="dtAktif.ajax.reload();">
                                <i class="fa fa-recycle"></i>
                                Segarkan Data
                            </button>
                            <button style="float: right; font-weight: 900;"
                                class="btn btn-success btn-create btn-sm mb-3 mx-1" type="button" data-toggle="modal"
                                data-backdrop="static" data-keyboard="false" data-target="#CreateDataModal"
                                onclick="//resetForm();">
                                <i class="fa fa-plus"></i>
                                Buat Produk
                            </button>
                        </div> --}}
                        <div class="table-responsive">
                            <table id="dtAktif" class="table table-bordered datatable w-100">
                                <thead>
                                    <tr>
                                        <th width="150" class="text-center">Action</th>
                                        <th>Id</th>
                                        <th>Product Name</th>
                                        <th>Suggest Price</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
{{-- <script src="{{ asset('assets/summernote/summernote-bs4.min.js') }}"></script> --}}

<script type="text/javascript">
    var dtAktif;
    // alert(JSON.stringify(targetField));
    $(document).ready(function () {
        // init datatable.
        dtAktif = $('#dtAktif').DataTable({
            dom: 'frtip',
            lengthMenu: [
                [ 10, 25, 50, -1 ],
                [ '10 rows', '25 rows', '50 rows', 'Show all' ]
            ],
            "responsive": true,
            "autoWidth" : true,
            "processing" : true,
            "serverSide" : true,
            // pageLength: 5,
            // scrollX: true,
            searchDelay: 1500,
            "order": [[ 1, "desc" ]],
            ajax: '{{ route('pop-barang') }}',
            columns: [
                // { data : 'DT_RowIndex' , orderable : false, searchable :false},
                // {data: 'id', name: 'id'},
                {data: 'Actions', name: 'Actions',orderable:false,serachable:false,sClass:'text-center'},
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name'},
                {data: 'suggest_price', name: 'suggest_price'},
            ]
        });
    });

    $(document).on('click', 'button.btn-select', function() {
        returnYourChoice(targetField[0],$(this).data('id'));
        returnYourChoice(targetField[1],$(this).data('nama'));
        returnYourChoice(targetField[2],$(this).data('price'));
        window.close();
    });

    function returnYourChoice(targetField,choice){
        opener.setSearchResult(targetField, choice);
        // window.close();
    }
</script>
@endsection
