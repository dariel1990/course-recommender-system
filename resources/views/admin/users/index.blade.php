@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Users Management</h2>
                    </div>
                    <div class="pull-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('users.index') }}"><i data-feather="home"></i></a>
                            </li>
                            <li class="breadcrumb-item">User Management</li>
                            <li class="breadcrumb-item active">User Lists</li>
                        </ol>
                    </div>
                </div>
                <div class="col-lg-12 margin-tb mt-3">
                    <div class="pull-left">
                    </div>
                    <div class="pull-right">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 box-col-12">
                <div class="card">
                    <div class="col-lg-12 px-3 py-3">
                        <div class="pull-left">
                            <a class="btn btn-sm btn-success" href="{{ route('users.create') }}"> Create New User</a>
                        </div>
                        <div class="pull-right">

                        </div>
                    </div>
                    <div class="card-body p-2">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <span><i class="fa fa-check"></i></span>{{ $message }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <div class="card-block row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-dashed" id="usersTable">
                                    <thead>
                                        <tr class="table-primary">
                                            <th>Username</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $user)
                                            <tr>
                                                <td>{{ $user->username }}</td>
                                                <td class="text-center">
                                                    {{-- <a class="btn btn-xs btn-info p-2" type="button"
                                                    href="{{ route('users.show', $user->id) }}">View</a> --}}
                                                    <a class="btn btn-xs btn-primary p-2"
                                                        href="{{ route('users.edit', $user->id) }}"> Edit</a>
                                                    <a href="#" class="btn btn-xs btn-danger p-2 delete-record"
                                                        data-key="{{ $user->id }}"> Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {!! $data->render() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('page-scripts')
        <script src="{{ asset('/assets/libs/sweetalert2/sweetalert.min.js') }}"></script>
        <script>
            $('.delete-record').click(function(e) {

                let id = $(this).attr('data-key');
                swal({
                    text: "Are you sure you want to delete this?",
                    icon: "warning",
                    buttons: [
                        'No',
                        'Yes!'
                    ],
                    dangerMode: true,
                    closeOnClickOutside: false,
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: `/users/${id}`,
                            method: 'DELETE',
                            success: function(response) {
                                if (response.success == true) {
                                    swal({
                                        text: 'Successfully deleted!',
                                        icon: 'success',
                                        timer: 2500,
                                        buttons: false,
                                    });
                                    location.reload();
                                } else {
                                    swal({
                                        title: 'Warning!',
                                        text: `You're not allowed to do this!`,
                                        icon: 'warning',
                                        timer: 2500,
                                        buttons: false,
                                    });
                                }
                            },
                        });
                    }
                });
            });
        </script>
    @endpush
@endsection
