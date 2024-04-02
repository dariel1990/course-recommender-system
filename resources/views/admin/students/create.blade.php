@extends('layouts.app')
@prepend('page-css')
@endprepend
@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>{{ $pageTitle }}</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i data-feather="home"></i></a>
                        </li>
                        <li class="breadcrumb-item">Student Records</li>
                        <li class="breadcrumb-item active">New Student</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        {!! Form::open(['route' => 'student.store', 'method' => 'POST', 'id' => 'student-form']) !!}
        <div class="row">
            <div class="col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header bg-primary py-3">
                        <h4 class="text-white">Student Registration Details <i class="far fa-hand-point-down"></i></h4>
                    </div>
                    <div class="card-body row">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="m-t-15 m-checkbox-inline custom-radio-ml">
                                        <span class="fw-bolder "> Status: </span>
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input" id="statusNew" type="radio" name="status"
                                                value="New" checked>
                                            <label class="form-check-label mb-0" for="statusNew">New</label>
                                        </div>
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input" id="transfereeNew" type="radio" name="status"
                                                value="Transferee">
                                            <label class="form-check-label mb-0" for="transfereeNew">Transferee</label>
                                        </div>
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input" id="statusReturnee" type="radio"
                                                name="status" value="Returnee">
                                            <label class="form-check-label mb-0" for="statusReturnee">Returnee</label>
                                        </div>
                                        <div class="form-check form-check-inline radio radio-primary">
                                            <input class="form-check-input" id="statusShiftee" type="radio" name="status"
                                                value="Shiftee">
                                            <label class="form-check-label mb-0" for="statusShiftee">Shiftee</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4 mb-3">
                                    <input type="hidden" name="academicId" value="{{ $defaultAY->id }}">
                                    <label for="con-mail">Last Name <strong
                                            class="text-danger">{{ $errors->has('lastName') ? '*' : '' }}</strong></label>
                                    {!! Form::text('lastName', old('lastName'), [
                                        'placeholder' => 'Enter Last Name',
                                        'class' => 'form-control' . ($errors->has('lastName') ? ' is-invalid' : ''),
                                    ]) !!}
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="con-mail">First Name <strong
                                            class="text-danger">{{ $errors->has('firstName') ? '*' : '' }}</strong></label>
                                    {!! Form::text('firstName', old('firstName'), [
                                        'placeholder' => 'Enter First Name',
                                        'class' => 'form-control' . ($errors->has('firstName') ? ' is-invalid' : ''),
                                    ]) !!}
                                </div>
                                <div class="col-3 mb-3">
                                    <label for="con-mail">Middle Name <strong
                                            class="text-danger">{{ $errors->has('middleName') ? '*' : '' }}</strong></label>
                                    {!! Form::text('middleName', old('middleName'), [
                                        'placeholder' => 'Enter Middle Name',
                                        'class' => 'form-control' . ($errors->has('middleName') ? ' is-invalid' : ''),
                                    ]) !!}
                                </div>
                                <div class="col-1 mb-3">
                                    <label for="con-mail">Suffix <strong
                                            class="text-danger">{{ $errors->has('suffix') ? '*' : '' }}</strong></label>
                                    {!! Form::text('suffix', old('suffix'), [
                                        'placeholder' => 'Ex: Jr',
                                        'class' => 'form-control' . ($errors->has('suffix') ? ' is-invalid' : ''),
                                    ]) !!}
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="con-mail">Gender <strong
                                            class="text-danger">{{ $errors->has('incident_location') ? '*' : '' }}</strong></label>
                                    <select class="form form-select gender" name="gender" id="gender">
                                        <option selected value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="con-mail">Date of Birth<strong
                                            class="text-danger">{{ $errors->has('birthDate') ? '*' : '' }}</strong></label>
                                    {!! Form::date('birthDate', old('birthDate'), [
                                        'id' => 'birthDate',
                                        'class' => 'form-control' . ($errors->has('birthDate') ? ' is-invalid' : ''),
                                    ]) !!}
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="con-mail">Citizenship <strong
                                            class="text-danger">{{ $errors->has('citizenship') ? '*' : '' }}</strong></label>
                                    {!! Form::text('citizenship', old('citizenship'), [
                                        'placeholder' => 'Enter Citizenship',
                                        'class' => 'form-control' . ($errors->has('citizenship') ? ' is-invalid' : ''),
                                    ]) !!}
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="con-mail">Ethnicity <strong
                                            class="text-danger">{{ $errors->has('ethnicity') ? '*' : '' }}</strong></label>
                                    {!! Form::text('ethnicity', old('ethnicity'), [
                                        'placeholder' => 'Enter Ethnicity',
                                        'class' => 'form-control' . ($errors->has('ethnicity') ? ' is-invalid' : ''),
                                    ]) !!}
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="con-mail">Contact No <strong
                                            class="text-danger">{{ $errors->has('contactNo') ? '*' : '' }}</strong></label>
                                    {!! Form::text('contactNo', old('contactNo'), [
                                        'placeholder' => 'Enter Contact No',
                                        'class' => 'form-control' . ($errors->has('contactNo') ? ' is-invalid' : ''),
                                    ]) !!}
                                </div>
                                <div class="col-4 mb-3">
                                    <label for="con-mail">Email Address <strong
                                            class="text-danger">{{ $errors->has('emailAddress') ? '*' : '' }}</strong></label>
                                    {!! Form::email('emailAddress', old('emailAddress'), [
                                        'placeholder' => 'Enter valid email address',
                                        'class' => 'form-control' . ($errors->has('emailAddress') ? ' is-invalid' : ''),
                                    ]) !!}
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="con-mail">Address <strong
                                            class="text-danger">{{ $errors->has('address') ? '*' : '' }}</strong></label>
                                    {!! Form::textarea('address', old('address'), [
                                        'placeholder' => 'Student Address',
                                        'rows' => '3',
                                        'class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''),
                                    ]) !!}
                                </div>
                                <div class="col-6 mb-3">
                                    <label for="con-mail">School last attended <strong
                                            class="text-danger">{{ $errors->has('lastSchoolAttended') ? '*' : '' }}</strong></label>
                                    {!! Form::textarea('lastSchoolAttended', old('lastSchoolAttended'), [
                                        'placeholder' => 'Student last school attended',
                                        'rows' => '3',
                                        'class' => 'form-control' . ($errors->has('lastSchoolAttended') ? ' is-invalid' : ''),
                                    ]) !!}
                                </div>
                                @foreach (range(1, 2) as $prefCourse)
                                    <div class="col-6 mb-3">
                                        <label for="con-mail">Preferred Course {{ $prefCourse }} <strong
                                                class="text-danger">{{ $errors->has('course' . $prefCourse) ? $errors->first('course2') : '' }}</strong></label>
                                        <select class="form form-select course{{ $prefCourse }}"
                                            name="course{{ $prefCourse }}" id="course{{ $prefCourse }}">
                                            <option selected value='' disabled>Choose Course</option>
                                            @foreach ($courses as $course)
                                                <option value="{{ $course->id }}">
                                                    {{ $course->courseDesc }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                                <div class="col-12 text-end mt-4">
                                    <button class="btn btn-primary text-uppercase" type="submit">Save Record</button>
                                    <a href="{{ route('student.index') }}" class="btn btn-danger text-uppercase"
                                        type="submit">Go back to List</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    @push('page-scripts')
        <script src="{{ asset('/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('/assets/js/datatable/datatables/datatable.custom.js') }}"></script>
        <script src="{{ asset('/assets/libs/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('/assets/libs/sweetalert2/sweetalert.min.js') }}"></script>
        {{-- <script src="https://cdn.ckeditor.com/4.17.2/standard/ckeditor.js"></script> --}}
        <script>
            $(document).ready(function() {
                CKEDITOR.replace('complain');
            });

            $('.person-input').select2({
                width: '100%',
                tags: true,
            });

            $(".person-input").on('change', function(e) {
                $('.select2-selection__choice__remove').addClass('ms-0');
                $('.select2-selection__choice__display').addClass('ms-3');
            })

            $(".select2-selection").on('keyup', function(e) {
                $('.select2-selection__choice__remove').addClass('ms-0');
                $('.select2-selection__choice__display').addClass('ms-3');
            })

            $(".select2-selection__choice__remove").on('click', function(e) {
                $('.select2-selection__choice__remove').addClass('ms-0');
                $('.select2-selection__choice__display').addClass('ms-3');
            })

            $('#student-form').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission

                if ($(".person-input").val().length === 0) {
                    swal({
                        title: 'Warning!',
                        text: `Please add persons involved first!`,
                        icon: 'warning',
                        buttons: false,
                    })
                } else {
                    this.submit();
                }
            });

            var oldValues = @json(old('person_name', []));
            $('#person_name').val(oldValues).trigger('change');
        </script>
    @endpush
@endsection
