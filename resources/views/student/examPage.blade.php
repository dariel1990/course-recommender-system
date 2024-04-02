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
                <div class="col-3 text-end">
                    <img src="{{ asset('assets/images/NEMSU.png') }}" width="30%">
                </div>
                <div class="col-6 text-center">
                    <h5 class="m-0">Republic of the Philippines</h5>
                    <h4 class="m-0 text-dark">NORTH EASTERN MINDANAO STATE UNIVERSITY</h4>
                    <h5 class="m-0">Cantilan Campus</h5>
                    <h5 class="m-0 fw-light">Pag-antayan, Cantilan, Surigao del Sur</h5>
                    <h5 class="m-0 fw-light">Website: <code class="text-white">www.nemsu.edu.ph</code></h5>
                </div>
                <div class="col-3"></div>
            </div>
            <div class="row mt-2">
                <div class="col-12 text-center">
                    <h4 class="m-0">ENTRANCE EXAMINATION FORM</h4>
                    <h5 class="fw-light">{{ $examination->academicYear->semester == '1' ? '1st' : '2nd' }} sem of
                        {{ $examination->academicYear->academic_year }}</h5>
                </div>
            </div>
            <div class="row mt-2 h5 fw-light">
                <div class="col-2">
                    Name of Student
                </div>
                <div class="col-10">
                    :&nbsp;<span class="fw-bold">{{ $examination->student->fullname }}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row mt-3 h5 fw-light">
                    <div class="col-12">
                        <strong>Instruction: </strong> Select the correct answer for the following questions.
                    </div>
                </div>
                @if (count($errors) > 0)
                    <div class="alert alert-danger mt-2">
                        <strong>Whoops!</strong> You did not finished the evaluation. Check your work, you might
                        have missed an item!
                    </div>
                @endif
                <form method="POST" action="/examination/submit/{{ $examination->id }}">
                    @csrf
                    @foreach ($categories as $index => $category)
                        <h4>{{ chr(65 + $index) }}. {{ $category->category }}</h4>
                        @foreach ($category->question as $question)
                            <div class="card mt-2">
                                <div class="card-body">
                                    <p class="mb-3">{{ $loop->index + 1 }}. {{ $question->question }}</p>
                                    @foreach ($question->option as $options)
                                        <label class="ms-3">
                                            <input type="radio" name="question{{ $question->id }}"
                                                value="{{ $options->id }}">
                                            {{ $options->option }}
                                        </label><br>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    @endforeach

                    <div class="row mt-3 h6 fw-light">
                        <div class="col-12 text-end">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-lg btn-primary">SUBMIT EXAMINATION</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @push('page-scripts')
        <script src="{{ asset('/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('/assets/libs/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset('/assets/libs/sweetalert2/sweetalert.min.js') }}"></script>
    @endpush
@endsection
