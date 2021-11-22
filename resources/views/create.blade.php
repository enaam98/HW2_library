<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assetss/css/bootstrap.min.css">
    <title>Document</title>
</head>

<body><br> <br>

    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">

            @csrf
            <div class="form-group">
                <label> Name </label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="form-group">
                <label name="type" for="type"> type </label>
                <select class="form-control" id="type" name="type" class="form-group">
                    <option value="0"> _____ </option>
                    <option value="1"> file </option>
                    <option value="2"> folder </option>
                </select>
            </div>

            <div class="form-group">

                <label> file_path </label>
                <input type="file" class="form-control" name="file_path" multiple>
            </div>

            <div class="form-group">
                <label> parent_id </label>
                <input type="hidden" id="parent_id_name" name="parent_id_name">
                <select class="form-control" name="parent_id" id="parent_id">
                    <option value="0"></option>
                    @foreach ($f as $fs)
                    @if ($fs->type == 2)
                    <option value="{{$fs->id}}">{{$fs->name}}</option>
                    @endif

                    @endforeach
                </select>
            </div>


<div style="text-align:center">
            <button type="submit" name="btn" class="btn btn-primary btn-lg"> Add </button>
        </div>
<br> <br>

            <div id="tableDiv">
                <table id="example1" class="table table-bordered table-striped mx-auto  col-md-8 ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>type</th>
                            <th>parent_id</th>
                            <th>file_path</th>
                            <th>file_size</th>
                            <th>extention</th>
                            <th>options</th>
                        </tr>
                    </thead>
                    <tbody id="empTableBody">
                        @foreach ($f as $fs)
                        <tr>
                            <td>   <a href="{{asset('upload/'.$fs->file_path)}}"><?= $fs->name ?></a> </td>

                            <td> {{ $fs->type }} </td>
                            <td> {{ $fs->parent_id }} </td>
                            <td> {{ $fs->file_path }} </td>
                            <td> {{ $fs->file_size }} </td>
                            <td> {{ $fs->extention }} </td>

                            <td>
                                <a class="btn btn-danger delete" data-id="">
                                    Delete
                                </a>
                                <a class="btn btn-primary edit" data-id="">
                                    Edit
                                </a>

                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <script src="assetss/js/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {

            //---------------------
            $("#parent_id").on("change", function() {
                var thistext = $("#parent_id option:selected").text();
                $("#parent_id_name").val(thistext);
            });


        });
    </script>
</body>

</html>
{{-- <div class="form-group">
                <label name="type" for="type">type </label>
              <select id="type" name="type" class="form-group">
                  <option value="0"> _____ </option>
                  @foreach ($f as $fs)
                  <option value="{{$fs->id}}" > {{$fs->type}} </option>

@endforeach

</select>
</div> --}}
