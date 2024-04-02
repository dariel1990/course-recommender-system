@extends('layouts.app')
@prepend('page-css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .swal-text {
            text-align: center;
        }
    </style>
@endprepend
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Entrance Exam Schedules - <small>
                                {{ $defaultPeriod->semester == '1' ? '1st Semester of' : '2nd Semester of' }}
                                of
                                {{ $defaultPeriod->academic_year }}
                            </small>
                        </h2>
                    </div>
                    <div class="pull-right">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i data-feather="home"></i></a>
                            </li>
                            <li class="breadcrumb-item">Examination</li>
                            <li class="breadcrumb-item active">Lists</li>
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
                    <div class="card-body py-3">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="row">
                                <div class="col-4 mb-2">
                                    <button class="btn btn-primary" id="btnAddNewRecord">
                                        Create Exam Schedules
                                    </button>
                                </div>
                                <div class="col-4"></div>
                                <div class="col-4 mb-2">
                                    <div class="input-group mb-2">
                                        <div class="input-group-text">Search</div>
                                        <input class="form-control" id="keyword">
                                    </div>
                                </div>
                            </div>
                            <div class="table">
                                <table class="table table-dashed" id="examination-table">
                                    <thead>
                                        <tr class="table-primary">
                                            <th class="text-start">Student</th>
                                            <th class="text-center">Registration Status</th>
                                            <th class="text-start">Examination Status</th>
                                            <th class="text-start">Schedule</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade modal-bookmark" id="createSchedule" role="dialog"
                    aria-labelledby="createScheduleLabel" aria-hidden="true" data-bs-backdrop="static"
                    data-bs-keyboard="false">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createScheduleLabel">Create Exam Schedule
                                </h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="create-schedule">
                                    <div class="row g-2">
                                        <div class="mb-2 col-md-12 mt-0">
                                            <input type="hidden" id="academicId" name="academicId"
                                                value="{{ $defaultPeriod->id }}">
                                            <label for="con-name">Select Student</label>
                                            <select class="form form-select student-input" name="studentId" id="studentId">
                                                <option value="">Search name here</option>
                                                @foreach ($students as $student)
                                                    <option value="{{ $student->id }}">{{ $student->fullname }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class='text-danger' id="studentId-error-message"></div>
                                        </div>
                                        <div class="mb-2 col-md-12 mt-0">
                                            <label for="con-name">Choose the Date of Examination</label>
                                            <input class="form-control" type="date" name="scheduleDate"
                                                id="scheduleDate">
                                            <div class='text-danger' id="scheduleDate-error-message"></div>
                                        </div>
                                        <div class="mb-2 col-md-12 mt-0">
                                            <label for="con-name">Choose the Date of Examination</label>
                                            <input class="form-control" type="time" name="scheduleTime"
                                                id="scheduleTime">
                                            <div class='text-danger' id="scheduleTime-error-message"></div>
                                        </div>
                                    </div>
                                    <div class="pull-right mt-2">
                                        <button class="btn btn-primary" type="button" id="btnSaveRecord">Create this
                                            Schedule</button>
                                        <button class="btn btn-primary d-none" type="button"
                                            id="btnSaveRecordChanges">Save
                                            Changes</button>
                                        <button class="btn btn-danger" type="button"
                                            data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
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
        <script src="{{ asset('/assets/libs/select2/js/select2.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.student-input').select2({
                    width: '100%',
                });

                let dataTable = $('#examination-table').DataTable({
                    serverSide: true,
                    processing: false,
                    ordering: false,
                    bLengthChange: true,
                    paginate: true,
                    info: true,
                    dom: 'rtp',
                    language: {
                        "processing": '<div class="d-flex justify-content-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>'
                    },
                    ajax: `/examinations/dataTableList/`,
                    columns: [{
                            class: 'align-middle text-start',
                            data: 'studentFullname',
                            name: 'studentFullname',
                            searchable: true,
                            orderable: false,
                        },
                        {
                            class: 'align-middle text-center',
                            data: 'Status',
                            name: 'Status',
                            searchable: true,
                            orderable: false,
                        },
                        {
                            class: 'align-middle text-start ms-5 ps-5',
                            data: 'HasCompleted',
                            name: 'HasCompleted',
                            searchable: true,
                            orderable: false,
                            render: function(_, _, data) {
                                let status = data.HasCompleted ? 'Completed' : 'Not yet taken';

                                return `<span class="border-bottom">${status}</span>`;
                            },
                        },
                        {
                            class: 'align-middle text-start ms-5 ps-5',
                            data: 'ScheduleDate',
                            name: 'ScheduleDate',
                            searchable: true,
                            orderable: false,
                            render: function(row, _, data) {
                                return data.ScheduleDate;
                            },
                            render: function(_, _, data) {
                                return `<span class="border-bottom"><strong>${data.ScheduleDate}</strong></span>
                                <br><span><strong>${data.ScheduleTime}</strong></span>`;
                            },
                        },
                        {
                            class: 'align-middle text-center',
                            data: 'actions',
                            name: 'actions',
                            searchable: false,
                            orderable: false,
                            render: function(_, _, data, row) {
                                let buttons = '';
                                if (data.HasCompleted) {
                                    buttons = `
                                    <button class="btn btn-success btn-sm btn-block btn-square view-result" data-key="${data.id}" data-student="${data.studentFullname}">
                                        View Result
                                    </button>`;
                                } else {
                                    buttons = `<button class="btn btn-info btn-sm btn-square edit-record" data-key="${data.id}">
                                        Edit
                                    </button>
                                    <button class="btn btn-danger btn-sm btn-square delete-record" data-key="${data.id}">
                                        Delete
                                    </button>`;
                                }
                                return buttons;
                            },
                        },
                    ]
                });

                $(`#keyword`).keyup(function(e) {
                    $('#examination-table').DataTable().search(e.target.value).draw();
                });

                $('#btnAddNewRecord').click(function(e) {
                    $('#createSchedule').modal('toggle');
                    $("#create-schedule")[0].reset();
                    $("#btnAddRecord").removeClass('d-none');
                    $("#btnSaveChangesRecord").addClass('d-none');
                });

                $('#btnSaveRecord').on('click', function(e) {
                    e.preventDefault();
                    let student = $('#studentId').val();
                    let scheduleDate = $('#scheduleDate').val();
                    let scheduleTime = $('#scheduleTime').val();

                    if (student == '' || scheduleDate == '' || scheduleTime == '') {
                        swal({
                            text: 'Student and schedule are all required.',
                            icon: 'warning',
                            timer: 1500,
                            buttons: false,
                        });
                    } else {
                        let data = $("#create-schedule").serialize();
                        $.ajax({
                            url: "/examinations/store",
                            method: "POST",
                            data: data,
                            success: function(response) {
                                if (response.success) {
                                    location.reload();
                                    swal({
                                        text: 'Successfully scheduled.',
                                        icon: 'success',
                                        timer: 1500,
                                        buttons: false,
                                    });
                                    $('#createSchedule').modal('hide');
                                }
                            },
                        });
                    }
                });

                $(document).on('click', '.edit-record', function() {
                    const id = $(this).attr('data-key');
                    $("#btnSaveRecord").addClass('d-none');
                    $("#btnSaveRecordChanges").removeClass('d-none').attr('data-key', id);
                    $('#createSchedule').modal('toggle');

                    $.ajax({
                        url: `/examinations/${id}`,
                        success: function(record) {
                            const scheduleDate = record.schedule.split(' ')[0];
                            const scheduleTime = record.schedule.split(' ')[1];
                            const timeParts = scheduleTime.split(':');
                            const timeWithoutSeconds = timeParts.slice(0, 2).join(':');
                            $("#academicId").val(record.academicId);
                            $("#studentId").val(record.studentId).trigger('change');
                            $("#scheduleDate").val(scheduleDate);
                            $("#scheduleTime").val(timeWithoutSeconds);
                        },
                    });
                });

                $('#btnSaveRecordChanges').click(function(e) {
                    e.preventDefault();
                    const id = $(this).attr('data-key');
                    let data = $("#create-schedule").serialize();
                    $.ajax({
                        url: `/examinations/${id}`,
                        method: 'PUT',
                        data: data,
                        success: function(response) {
                            if (response.success == true) {
                                swal({
                                    text: 'Successfully updated!',
                                    icon: 'success',
                                    timer: 2500,
                                    buttons: false,
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 1500);
                            }
                        },
                    });
                });

                $(document).on('click', '.delete-record', function() {
                    const id = $(this).attr('data-key');

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
                                url: `/examinations/${id}`,
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    if (response.success == true) {
                                        swal({
                                            text: 'Successfully deleted!',
                                            icon: 'success',
                                            timer: 1500,
                                            buttons: false,
                                        });
                                        setTimeout(function() {
                                            location.reload();
                                        }, 1500);
                                    }
                                },
                            });
                        }
                    });
                });

                $(document).on('click', '.view-result', function() {
                    let examinationId = $(this).attr('data-key');
                    let student = $(this).attr('data-student');

                    box = new WinBox(`View Exam Result for ${student}`, {
                        root: document.querySelector('.page-content'),
                        class: ["no-min", "no-full"],
                        url: `/examinations/result/${examinationId}?winbox=1`,
                        index: 999999,
                        background: "#2a3042",
                        border: "0.3em",
                        width: "100%",
                        height: "100%",
                        top: 10,
                        left: 291,
                    }).movable();
                });
            });
        </script>
    @endpush
@endsection
