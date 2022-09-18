<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$data['type']}} Invoice</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
</head>
<body>
    <div class="container">
        <main>
            <div class="row">
                <h2>{{$data['type']}} Invoice</h2>
                <a href="{{route('invoice.index')}}"><button class="btn btn-danger">Kembali</button></a>
                <div class="col-md-12">
                    <form action="{{$data['action']}}" method="post" class="row" id="formInvoice">
                        @csrf
                        <h4>Header Invoice</h4>
                        <hr>
                        <div class="col-sm-12">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" placeholder="" value="" required="">
                            <span class="subject_error_create alert-danger"></span>
                        </div>
                        <div class="col-sm-6">
                            <label for="issue_date" class="form-label">Issue Data</label>
                            <input type="date" class="form-control" id="issue_date" name="issue_date" placeholder="" value="" required="" min="{{date('Y-m-d',strtotime('-7 days'))}}">
                            <span class="issue_date_error_create alert-danger"></span>
                        </div>
                        <div class="col-sm-6">
                            <label for="due_date" class="form-label">Due Data</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" placeholder="" value="" required="" min="{{date('Y-m-d')}}" max="{{date('Y-m-d',strtotime('+30 days'))}}">
                            <span class="due_date_error_create alert-danger"></span>
                        </div>
                        <div class="col-sm-12">
                            <label for="client_id" class="form-label">Client</label>
                            <select class="form-select" id="client_id" name="client_id" required="">
                                @foreach ($data['client'] as $li)
                                    <option value="{{$li->id}}">{{$li->name}}</option>
                                @endforeach
                            </select>
                            <span class="client_id_error_create alert-danger"></span>
                        </div>
                        <div class="col-sm-12">
                            <label for="taxCal" class="form-label">Tax</label>
                            <input type="number" class="form-control" id="taxCal" name="taxCal" placeholder="0" value="" required="" min="0" value="0">
                            <span class="taxCal_error_create alert-danger"></span>
                        </div>
                        <div class="col-sm-12">
                            <label for="payment" class="form-label">Payment</label>
                            <input type="number" class="form-control" id="payment" name="payment" placeholder="0" value="" required="" min="0" value="0">
                            <span class="payment_error_create alert-danger"></span>
                        </div>
                        <h4 class="pt-5">Detail Product</h4>
                        <hr>
                        <span id="addrow" class="btn btn-primary">Add New Product</span>
                        <table id="myTable" class="table table-striped table-bordered order-list " style="width: 1500px;">
                            <thead>
                                <tr>
                                    <th>Aksi</th>
                                    <th>Product Id</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody id="myTableBody">
                                <tr>
                                    <td class="col-sm-2" style="width: 75px;"><a class="deleteRow btn btn-danger" onclick="clearValue()">Hapus</a></td>
                                    <td class="col-sm-3">
                                        <div class="input-group" style="width: 150px;">
                                            <input type="text" data-id="0" name="product_id[]" id="product_id0" class="form-control" readonly/>
                                            <span class="input-group-text btn" onclick="openPopUpWindow(popURL,['product_id0','product_name0','selling_price0']);">Cari</span>
                                        </div>
                                        <span class="product_id.0_error_create alert-danger"></span>
                                    </td>
                                    <td class="col-sm-3">
                                        <input type="text" data-id="0" name="product_name[]" id="product_name0" readonly class="form-control" style="width: 275px;"/>
                                        <span class="product_name.0_error_create alert-danger"></span>
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="number" data-id="0" name="qty[]" id="qty0" onChange="hitungTotal(0,this);" class="form-control" value="0" min="1" style="width: 125px;"/>
                                        <span class="qty.0_error_create alert-danger"></span>
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="number" data-id="0" name="selling_price[]" id="selling_price0" onChange="hitungTotal(0,this);" class="form-control" value="0" min="1" step="0.01" style="width: 175px;"/>
                                        <span class="selling_price.0_error_create alert-danger"></span>
                                    </td>
                                    <td class="col-sm-2">
                                        <input type="text" data-id="0" name="total[]" id="total0" class="form-control" readonly value="0" min="0" style="width: 175px;"/>
                                        {{-- <input type="text" name="text_total[]" id="text_total0" readonly class="form-control" value="0"/> --}}
                                        <span class="total.0_error_create alert-danger"></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Subtotal <small class="text-red">*</small></label>
                                <input type="text" name="subtotal" id="subtotal" required readonly class="form-control d-none">
                                <br>
                                <h4 id="text_subtotal">Rp. 0</h4>
                                <span class="subtotal_error_create alert-danger"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Tax <small class="text-red">*</small></label>
                                <input type="text" name="tax" id="tax" required readonly class="form-control d-none">
                                <br>
                                <h4 id="text_tax">Rp. 0</h4>
                                <span class="tax_error_create alert-danger"></span>
                            </div>
                            <div class="form-group col-md-4">
                                <label>Total Order <small class="text-red">*</small></label>
                                <input type="text" name="total_order" id="total_order" required readonly class="form-control d-none">
                                <br>
                                <h4 id="text_total_order">Rp. 0</h4>
                                <span class="total_order_error_create alert-danger"></span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-submit">Simpan</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        var counter = 1;
        var reject = false;
        var popURL = '{{route('pop-barang')}}';
        var tmpTable = `<tr>
                            <td class="col-sm-2" style="width: 75px;"><a class="deleteRow btn btn-danger" onclick="clearValue()">Hapus</a></td>
                            <td class="col-sm-3">
                                <div class="input-group" style="width: 150px;">
                                    <input type="text" data-id="0" name="product_id[]" id="product_id0" class="form-control" readonly/>
                                    <span class="input-group-text btn" onclick="openPopUpWindow(popURL,['product_id0','product_name0','selling_price0']);">Cari</span>
                                </div>
                                <span class="product_id.0_error_create alert-danger"></span>
                            </td>
                            <td class="col-sm-3">
                                <input type="text" data-id="0" name="product_name[]" id="product_name0" readonly class="form-control" style="width: 275px;"/>
                                <span class="product_name.0_error_create alert-danger"></span>
                            </td>
                            <td class="col-sm-2">
                                <input type="number" data-id="0" name="qty[]" id="qty0" onChange="hitungTotal(0,this);" class="form-control" value="0" min="1" style="width: 125px;"/>
                                <span class="qty.0_error_create alert-danger"></span>
                            </td>
                            <td class="col-sm-2">
                                <input type="number" data-id="0" name="selling_price[]" id="selling_price0" onChange="hitungTotal(0,this);" class="form-control" value="0" min="1" step="0.01" style="width: 175px;"/>
                                <span class="selling_price.0_error_create alert-danger"></span>
                            </td>
                            <td class="col-sm-2">
                                <input type="text" data-id="0" name="total[]" id="total0" class="form-control" readonly value="0" min="0" style="width: 175px;"/>
                                <span class="total.0_error_create alert-danger"></span>
                            </td>
                        </tr>`;

        $(document).ready(function() {
        });

        function clearValue() {
            $('#product_id0').val('');
            $('#product_name0').val('');
            $('#qty0').val('');
            $('#selling_price0').val('');
            $('#total0').val('');
        }

        $("#addrow").on("click", function () {
            var newRow = $("<tr>");
            var cols = "";
            cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger w-100" value="Hapus"></td>';
            cols += '<td><div class="input-group"><input type="text" readonly data-id="'+counter+'" name="product_id[]" id="product_id' + counter + '" class="form-control"/><div class="input-group-append"><span class="input-group-text btn" onclick="openPopUpWindow(popURL,[`product_id' + counter + '`,`product_name' + counter + '`,`selling_price' + counter + '`]);"><i class="fas fa-search"></i></span></div></div><span class="product_id.' + counter + '_error_create alert-danger"></span></td>';
            // cols += '<td><input type="text" class="form-control" data-id="'+counter+'" name="product_id[]"/></td>';
            cols += '<td><input type="text" class="form-control" readonly data-id="'+counter+'" name="product_name[]" id="product_name' + counter + '"/><span class="product_name.' + counter + '_error_create alert-danger"></span></td>';
            cols += '<td><input type="number" class="form-control" data-id="'+counter+'" name="qty[]" id="qty' + counter + '" onChange="hitungTotal(' + counter + ',this);" value="0" min="1"/><span class="qty.' + counter + '_error_create alert-danger"></span></td>';
            // cols += '<td><input type="text" class="form-control" readonly data-id="'+counter+'" name="satuan[]" id="satuan' + counter + '"/><span class="satuan.' + counter + '_error_create alert-danger"></span></td>';
            cols += '<td><input type="number" class="form-control" data-id="'+counter+'" name="selling_price[]" id="selling_price' + counter + '" onChange="hitungTotal(' + counter + ',this);" value="0" min="1" step="0.01"/><span class="selling_price.' + counter + '_error_create alert-danger"></span></td>';
            // cols += '<td><input type="number" class="form-control" data-id="'+counter+'" name="disc[]" id="disc' + counter + '" onChange="hitungTotal(' + counter + ',this);" value="0" min="0"/><span class="disc.' + counter + '_error_create alert-danger"></span></td>';
            // cols += '<td><input type="number" class="form-control" data-id="'+counter+'" name="ppn[]" id="ppn' + counter + '" onChange="hitungTotal(' + counter + ',this);" value="0" min="0"/><span class="ppn.' + counter + '_error_create alert-danger"></span></td>';
            cols += '<td><input type="number" class="form-control" readonly data-id="'+counter+'" name="total[]" id="total' + counter + '" value="0" min="0"/><span class="total.' + counter + '_error_create alert-danger"></span></td>';
            
            newRow.append(cols);
            $("table#myTable").append(newRow);
            counter++;
        });

        $("table#myTable").on("click", ".ibtnDel", function (event) {
            $(this).closest("tr").remove();       
            counter -= 1
        });

        // open a pop up window
        function openPopUpWindow(url,targetField){
            reject = false;
            var w = window.open(url,'_blank','width=400,height=400,scrollbars=1');
            // pass the targetField to the pop up window
            w.targetField = targetField;
            w.focus();
        }
    
        // this function is called by the pop up window
        function setSearchResult(targetField, returnValue){
            if (targetField.includes("product_id")) {
                let elKode = document.getElementsByName("product_id[]");
                for (let i = 0; i < elKode.length; i++) {
                    if(elKode[i].value == returnValue){
                        reject = true;
                    }
                }
            }

            if (reject) {
                alert('Data yang ada pilih sudah ada di list!');
            } else {
                $('#'+targetField).val(returnValue);
                window.focus();
            }
            
        }

        function hitungTotal(no,el) {
            if ($('#product_id'+no).val() == "") {
                alert('Pilih data barang terlebih dahulu!');
                el.value = 0;
                return;
            }
            let qty = parseInt($('#qty'+no).val());
            let harga = parseFloat($('#selling_price'+no).val());
            
            let hargaTotal = (qty*harga);
            $('#total'+no).val(hargaTotal);
            var tax = parseInt($('#taxCal').val());
            if (isNaN(tax)) {
                tax = 0;
            }
            let allTotal = document.getElementsByName('total[]');
            // console.log(allTotal);
            let finalHarga = 0;
            $.map(allTotal, function (el, idx) {
                finalHarga = finalHarga + parseFloat(el.value);
            });

            let finalTax = finalHarga*(tax/100);
            console.log(finalHarga,finalTax);
            $('#subtotal').val(finalHarga);
            $('#tax').val(finalTax);
            $('#total_order').val(finalHarga+finalTax);

            $('#text_subtotal').html(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(finalHarga));
            $('#text_tax').html(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(finalTax));
            $('#text_total_order').html(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(finalHarga+finalTax));
        }

        $('#formInvoice').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                url: $(this).attr('action'),
                beforeSend: function() {
                    $('#formInvoice > button.btn-submit').addClass("disabled").html("Processing...").attr('disabled', true);
                    // $(document).find('span.error-text').text('');
                },
                complete: function() {
                    $('#formInvoice > button.btn-submit').removeClass("disabled").html("Simpan").attr('disabled', false);
                },
                success: function(res) {
                    if (res.success == true) {
                        window.location.replace("{{route('invoice.index')}}");
                    }
                },
                error(err) {
                    $.each(err.responseJSON,function(prefix,val) {
                        // $('.'+prefix+'_error_create').text(val[0]);
                        document.getElementsByClassName(prefix+'_error_create')[0].innerHTML = val[0];
                    })
                    alert(err.responseJSON.message);
                    console.log(err);
                }
            })
        });
    </script>
</body>
</html>