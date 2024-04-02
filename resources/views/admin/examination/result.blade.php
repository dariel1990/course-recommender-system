@extends('layouts.winbox')
@prepend('page-css')
    <link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .sticky-container {
            position: sticky;
            top: 0;
            z-index: 1000;
        }
    </style>
@endprepend
@section('content')
    <div class="sticky-container bg-primary px-5 py-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2 text-end">
                    <img src="{{ asset('assets/images/NEMSU.png') }}" width="45%">
                </div>
                <div class="col-8 text-center">
                    <h5 class="m-0">Republic of the Philippines</h5>
                    <h4 class="m-0 text-dark">NORTH EASTERN MINDANAO STATE UNIVERSITY</h4>
                    <h5 class="m-0">Cantilan Campus</h5>
                    <h5 class="m-0 fw-light">Pag-antayan, Cantilan, Surigao del Sur</h5>
                    <h5 class="m-0 fw-light">Website: <code class="text-white">www.nemsu.edu.ph</code></h5>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="row mt-2">
                <div class="col-12 text-center">
                    <h4 class="m-0">UNIVERSITY ADMISSION TEST RESULT</h4>
                    <h5 class="fw-light">{{ $examination->academicYear->semester == '1' ? '1st' : '2nd' }} sem AY
                        {{ $examination->academicYear->academic_year }}</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid p-3">
        <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-12 box-col-12">
                <div class="row mt-2 h6 fw-light">
                    <div class="col-4 text-center mx-2">
                        <span class="fw-bold">{{ $examination->student->lastName }}</span>
                    </div>
                    <div class="col-3 text-center mx-2">
                        <span class="fw-bold">{{ $examination->student->firstName }}</span>
                    </div>
                    <div class="col-3 text-center mx-2">
                        <span class="fw-bold">{{ $examination->student->middleName }}</span>
                    </div>
                    <div class="col-1 text-center mx-2">
                        <span class="fw-bold">{{ $examination->student->suffix }}</span>
                    </div>
                </div>
                <div class="row mt-2 h6 fw-light">
                    <div class="col-4 text-center border-top mx-2">
                        <span class="fw-light">Last Name</span>
                    </div>
                    <div class="col-3 text-center border-top mx-2">
                        <span class="fw-light">First Name</span>
                    </div>
                    <div class="col-3 text-center border-top mx-2">
                        <span class="fw-light">Middle Name</span>
                    </div>
                    <div class="col-1 text-center border-top mx-2">
                        <span class="fw-light">Suffix</span>
                    </div>
                </div>
                <div class="row mt-2 h6 fw-light">
                    <div class="col-1 text-center">
                    </div>
                    <div class="col-3 text-center mx-2">
                        <span class="fw-bold">{{ $examination->student->gender == 'M' ? 'Male' : 'Female' }}</span>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-2 text-center mx-2">
                        <span class="fw-bold">
                            {{ \Carbon\Carbon::parse($examination->student->birthDate)->age }}
                        </span>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-3 text-center mx-2">
                        <span class="fw-bold">{{ $examination->student->contactNo }}</span>
                    </div>
                    <div class="col-1 text-center mx-2">
                        <span class="fw-bold"></span>
                    </div>
                </div>
                <div class="row mt-2 h6 fw-light">
                    <div class="col-1 text-center">
                    </div>
                    <div class="col-3 text-center border-top mx-2">
                        <span class="fw-light">Sex</span>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-2 text-center border-top mx-2">
                        <span class="fw-light">Age</span>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-3 text-center border-top mx-2">
                        <span class="fw-light">Contact #</span>
                    </div>
                    <div class="col-1 text-center">
                    </div>
                </div>
                <div class="row mt-2 h6 fw-light">
                    <div class="col-12 mb-3">
                        <span class="fw-bold">Preferred Courses</span>
                    </div>
                    <div class="col-2">
                        <span class="fw-bold">Course 1</span>
                    </div>
                    <div class="col-4">
                        <span class="fw-light">{{ $course1 }}</span>
                    </div>
                    <div class="col-2">
                        <span class="fw-bold">Course 2</span>
                    </div>
                    <div class="col-4">
                        <span class="fw-light">{{ $course2 }}</span>
                    </div>
                </div>
                <div class="row mt-2 h4 fw-light">
                    <div class="col-12 my-2 text-center">
                        <span class="fw-bold">ENTRANCE EXAM RATING</span>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body py-3">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="table">
                                <table class="table table-bordered" id="examination-table">
                                    <thead>
                                        <tr class="table-primary">
                                            <th class="text-center" colspan="{{ $catCount }}">Subject Area</th>
                                            <th class="text-center align-middle" rowspan="2">
                                                Total ({{ $questionCount }})
                                            </th>
                                        </tr>
                                        <tr class="table-primary">
                                            @foreach ($categories as $category)
                                                <th class="text-center">{{ $category->category }}
                                                    ({{ $category->question->count() }})
                                                </th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @foreach ($categories as $category)
                                                <td class="text-center">
                                                    {{ $categoryScores[$category->id] }}
                                                </td>
                                            @endforeach
                                            <td class="text-center fw-bold">{{ $totalScore }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-end">
                <a class="btn btn-primary" href="{{ route('examinations.print.result', $examination->id) }}">
                    <i class="fa fa-print"></i>
                    Print this exam result
                </a>
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
    @endpush
@endsection
