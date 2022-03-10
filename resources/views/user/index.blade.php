<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>USER LIST</title>
    <!-- Latest compiled and minified CSS & JS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- start script search​ --}}
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" class="init">
        function filterGlobal() {
            $('#user_list').DataTable().search(
                $('#global_filter').val(),
                $('#global_regex').prop('checked'),
                $('#global_smart').prop('checked')
            ).draw();
        }

        function filterColumn(i) {
            $('#user_list').DataTable().column(i).search(
                $('#col' + i + '_filter').val(),
                $('#col' + i + '_regex').prop('checked'),
                $('#col' + i + '_smart').prop('checked')
            ).draw();
        }

        $(document).ready(function() {
            $('#user_list').DataTable();

            $('input.global_filter').on('keyup click', function() {
                filterGlobal();
            });

            $('input.column_filter').on('keyup click', function() {
                filterColumn($(this).parents('tr').attr('data-column'));
            });
        });
    </script>
    {{-- end script search​ --}}
</head>

<body>
    <h1 style="text-align: center">USER LIST</h1>
    <div class="container">
        <div class="table-responsive">
            {{-- start table user search --}}
            <table cellpadding="3" cellspacing="0" border="0" style="width: 67%; margin: 0 auto 2em auto;">
                <thead>
                    <tr>
                        <th>Target</th>
                        <th>Search text</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="filter_global">
                        <td>Global search</td>
                        <td align="center"><input type="text" class="global_filter" id="global_filter"></td>
                    </tr>
                    <tr id="filter_col1" data-column="0">
                        <td>Column - Họ tên</td>
                        <td align="center"><input type="text" class="column_filter" id="col0_filter"></td>
                    </tr>
                    <tr id="filter_col2" data-column="1">
                        <td>Column - Giới tính</td>
                        <td align="center"><input type="text" class="column_filter" id="col1_filter"></td>
                    </tr>
                    <tr id="filter_col3" data-column="2">
                        <td>Column - Ngày sinh</td>
                        <td align="center"><input type="text" class="column_filter" id="col2_filter"></td>
                    </tr>
                    <tr id="filter_col4" data-column="3">
                        <td>Column - Số điện thoại</td>
                        <td align="center"><input type="text" class="column_filter" id="col3_filter"></td>
                    </tr>
                    <tr id="filter_col5" data-column="4">
                        <td>Column - Địa chỉ</td>
                        <td align="center"><input type="text" class="column_filter" id="col4_filter"></td>
                    </tr>
                </tbody>
            </table>
            {{-- end table user search --}}
            <a href="#" class="btn btn-success btn-add" data-target="#modal-add" data-toggle="modal">Add</a>
            <div>
                <br>
            </div>
            {{-- table user list --}}
            <table class="table table-hover" id="user_list">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Họ tên</th>
                        <th>Giới tính</th>
                        <th>Ngày sinh</th>
                        <th>Số điện thoại</th>
                        <th>Địa chỉ</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td id="{{ $user->id }}">{{ $user->id }}</td>
                            <td id="hoten-{{ $user->id }}">{{ $user->hoten }}</td>
                            <td id="gioitinh-{{ $user->id }}">{{ $user->gioitinh }}</td>
                            <td id="ngaysinh-{{ $user->id }}">{{ $user->ngaysinh }}</td>
                            <td id="sdt-{{ $user->id }}">{{ $user->sdt }}</td>
                            <td id="diachi-{{ $user->id }}">{{ $user->diachi }}</td>
                            <td>
                                <button data-url="{{ route('user.show', $user->id) }}" ​ type="button"
                                    data-target="#show" data-toggle="modal"
                                    class="btn btn-info btn-show">Detail</button>
                                <button data-url="{{ route('user.update', $user->id) }}" ​ type="button"
                                    data-target="#edit" data-toggle="modal"
                                    class="btn btn-warning btn-edit">Edit</button>
                                <button data-url="{{ route('user.destroy', $user->id) }}" ​ type="button"
                                    data-target="#delete" data-toggle="modal"
                                    class="btn btn-danger btn-delete">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- end table user list --}}
        </div>
    </div>


    @include('user.add')
    @include('user.detail')
    @include('user.edit')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" type="text/javascript"
        charset="utf-8" async defer></script>
    <script type="text/javascript" charset="utf-8">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {

            $('#form-add').submit(function(e) {

                e.preventDefault();

                var url = $(this).attr('data-url');

                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        hoten: $('#hoten-add').val(),
                        gioitinh: $('#gioitinh-add').val(),
                        ngaysinh: $('#ngaysinh-add').val(),
                        sdt: $('#sdt-add').val(),
                        diachi: $('#diachi-add').val(),
                    },
                    success: function(response) {
                        toastr.success(response.message)
                        $('#modal-add').modal('hide');
                        console.log(response.data)
                        $('tbody').prepend('<tr><td id="' + response.data.id + '">' + response
                            .data.id + '</td><td id="hoten-' + response.data.id + '">' +
                            response.data.hoten + '</td><td id="gioitinh-' + response.data
                            .id + '">' + response.data.gioitinh + '</td><td id="ngaysinh-' +
                            response.data.id + '">' + response.data.ngaysinh +
                            '</td><td id="sdt-' + response.data.id + '">' + response.data
                            .sdt + '</td><td id="diachi-' + response.data.id + '">' +
                            response.data.diachi +
                            '</td><td><button data-url="{{ asset('') }}user/' +
                            response.data.id +
                            '"​ type="button" data-target="#show" data-toggle="modal" class="btn btn-info btn-show">Detail</button><button style="margin-left: 5px;" data-url="{{ asset('') }}user/' +
                            response.data.id +
                            '"​ type="button" data-target="#edit" data-toggle="modal" class="btn btn-warning btn-edit">Edit</button><button style="margin-left: 5px;" data-url="{{ asset('') }}user/' +
                            response.data.id +
                            '"​ type="button" data-target="#delete" data-toggle="modal" class="btn btn-danger btn-delete">Delete</button></td></tr>'
                        );


                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //xử lý lỗi tại đây
                    }
                })
            })

            $('.btn-show').click(function() {
                var url = $(this).attr('data-url');
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function(response) {
                        console.log(response)

                        $('h1#id').text(response.data.id)
                        $('h1#hoten').text(response.data.hoten)
                        $('h1#gioitinh').text(response.data.gioitinh)
                        $('h1#ngaysinh').text(response.data.ngaysinh)
                        $('h1#sdt').text(response.data.sdt)
                        $('h1#diachi').text(response.data.diachi)
                        $('h1#created_at').text(response.data.created_at)
                        $('h1#update_at').text(response.data.update_at)
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //xử lý lỗi tại đây
                    }
                })
            })

            $('.btn-delete').click(function() {
                var url = $(this).attr('data-url');
                var _this = $(this);
                if (confirm('Do you want to delete??')) {
                    $.ajax({
                        type: 'delete',
                        url: url,
                        success: function(response) {
                            toastr.success('Delete user success!')
                            _this.parent().parent().remove();
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            //xử lý lỗi tại đây
                        }
                    })
                }
            })

            $('.btn-edit').click(function(e) {

                var url = $(this).attr('data-url');

                $('#modal-edit').modal('show');

                e.preventDefault();

                $.ajax({
                    //phương thức get
                    type: 'get',
                    url: url,
                    success: function(response) {
                        //đưa dữ liệu controller gửi về điền vào input trong form edit.
                        $('#hoten-edit').val(response.data.hoten);
                        $('#ngaysinh-edit').val(response.data.ngaysinh);
                        $('#gioitinh-edit').val(response.data.gioitinh);
                        $('#sdt-edit').val(response.data.sdt);
                        $('#diachi-edit').val(response.data.diachi);
                        //thêm data-url chứa route sửa todo đã được chỉ định vào form sửa.
                        $('#form-edit').attr('data-url', '{{ asset('user/') }}/' + response
                            .data.id)
                    },
                    error: function(error) {

                    }
                })
            })

            $('#form-edit').submit(function(e) {
                e.preventDefault();
                var url = $(this).attr('data-url');

                $.ajax({
                    type: 'put',
                    url: url,
                    data: {
                        hoten: $('#hoten-edit').val(),
                        gioitinh: $('#gioitinh-edit').val(),
                        ngaysinh: $('#ngaysinh-edit').val(),
                        sdt: $('#sdt-edit').val(),
                        diachi: $('#diachi-edit').val(),
                    },
                    success: function(response) {
                        // console.log(response.userid)
                        toastr.success(response.message)
                        $('#modal-edit').modal('hide');
                        $('#hoten-' + response.userid).text(response.user.hoten)
                        $('#gioitinh-' + response.userid).text(response.user.gioitinh)
                        $('#ngaysinh-' + response.userid).text(response.user.ngaysinh)
                        $('#sdt-' + response.userid).text(response.user.sdt)
                        $('#diachi-' + response.userid).text(response.user.diachi)
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        //xử lý lỗi tại đây
                    }
                })
            })
        })
    </script>
</body>

</html>​
