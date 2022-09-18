<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>List Data</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <main class="col-12">
                <h2>List Data Invoice</h2>
                <a href="{{route('invoice.create')}}"><button type="button" class="btn btn-primary">Create Invoice</button></a>
                <div class="table-responsive">
                    <table class="table table-striped table-md">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Invoice Number</th>
                                <th scope="col">Subject</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['list'] as $li)
                            <tr>
                                <td>
                                    <a href="{{route('invoice.update', $li->id)}}" class="btn btn-warning btn-sm btn-edit">Edit</a>
                                    <a href="{{route('invoice.destroy-get', $li->id)}}" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                                <td>{{$li->id}}</td>
                                <td>{{$li->subject}}</td>
                                <td>{{$li->due_date}}</td>
                                <td>{{$li->total_order}}</td>
                                <td>{{$li->status}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
</body>
</html>