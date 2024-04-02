@extends('layouts.app')
@prepend('page-css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endprepend
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Academic Year Management</h2>
                    </div>
                    <div class="pull-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i data-feather="home"></i></a>
                            </li>
                            <li class="breadcrumb-item">Academic Year Management</li>
                            <li class="breadcrumb-item active">Academic Year Lists</li>
                        </ol>
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
                            {{-- @can('academic-create') --}}
                            <a class="btn btn-sm btn-success" href="{{ route('academic.year.create') }}"> Add New Record</a>
                            {{-- @endcan --}}
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
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table-responsive">
                                <table class="table table-dashed" id="usersTable">
                                    <thead>
                                        <tr class="table-primary">
                                            <th class="text-center text-truncate">Academic Year</th>
                                            <th class="text-center">Semester</th>
                                            <th class="text-center">Default</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $year)
                                            <tr>
                                                <td class="text-center align-middle">{{ $year->academic_year }}</td>
                                                <td class="text-center align-middle">{{ $year->semester }}</td>
                                                <td class="text-center align-middle">
                                                    <form
                                                        action="{{ route('academic.year.updateDefaultStatus', ['id' => $year->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <label class="switch">
                                                            <input type="checkbox"
                                                                {{ $year->isDefault ? 'checked disabled' : '' }}
                                                                onchange="this.form.submit()">
                                                            <span class="switch-state"></span>
                                                        </label>
                                                    </form>
                                                </td>
                                                <td class="text-center text-truncate align-middle">
                                                    <a class="btn btn-xs btn-primary p-2"
                                                        href="{{ route('academic.year.edit', $year->id) }}">
                                                        Edit</a>
                                                    <a href="#" class="btn btn-xs btn-danger p-2 delete-record"
                                                        data-key="{{ $year->id }}">
                                                        Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('page-scripts')
        <script src="{{ asset('/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('/assets/libs/sweetalert2/sweetalert.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                var table = $("table").dataTable({
                    ordering: false,
                    "dom": 'rt'
                });

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
                                url: `/academic/year/${id}`,
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
            });
        </script>
    @endpush
@endsection
