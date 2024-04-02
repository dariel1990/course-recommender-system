<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: 'Montserrat';
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .text-start {
            text-align: left;
        }

        .font-weight-bold {
            font-weight: bold;
        }

        table,
        td,
        th {
            border-collapse: separate;
            border-spacing: 0px;
        }

        thead td,
        th {
            border: 1px solid black;
            border-spacing: 0px;
        }

        th {
            font-size: 12px;
        }

        tbody td {
            border: 1px solid black;
            border-spacing: 0px;
            font-size: 16px;
        }

        span {
            border: 1px solid black;
            padding: 1px 12px 1px 12px;
        }

        .fw-bold {
            font-weight: bold;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body>
    <table width="100%">
        <tr>
            <th class="text-end" style="border: none;" width="5%"></th>
            <th class="text-end" style="border: none;" width="15%"><img
                    src="file:///laragon/www/facultyEvaluation/public/assets/images/NEMSU.png" width="85%"></th>
            <th class="text-center" style="border: none;" width="60%">
                <h3 class="text-center" style="margin-top: 0; margin-bottom: 0; ">Republic of the Philippines</h3>
                <h2 class="text-center text-uppercase"
                    style="margin-top: 0; margin-bottom: 0; letter-spacing: 2px; color: #0d6efd;">
                    {{ $settings['SCHOOL_NAME']->Keyvalue }}</h1>
                    <h3 class="text-center" style="font-weight: bold; margin-top: 0; margin-bottom: 0;">
                        {{ $settings['CAMPUS_NAME']->Keyvalue }}</h3>
                    <h4 class="text-center" style="font-weight: normal; margin-top: 0; margin-bottom: 0;">
                        {{ $settings['CAMPUS_ADDRESS']->Keyvalue }}</h4>
                    <h4 class="text-center" style="font-weight: normal; margin-top: 0; margin-bottom: 0;">Website: <code
                            style="color:blue">www.nemsu.edu.ph</code></h4>
                    </td>
            <th class="text-start" style="border: none;" width="15%"><img
                    src="file:///laragon/www/facultyEvaluation/public/assets/images/iso.png" width="100%"></th>
            <th class="text-end" style="border: none;" width="5%"></th>
        </tr>
        <tr>
            <th style="border: none;" colspan="6">
                <hr>
            </th>
        </tr>
        <tr>
            <th class="text-center" style="border: none; padding-top: 15px;" colspan="6">
                <h2 class="text-center text-uppercase" style="margin-top: 10px; margin-bottom: 0; letter-spacing: 1px;">
                    UNIVERSITY ADMISSION TEST RESULT</h2>
                <h3 class="text-center" style="margin-top: 0; margin-bottom: 0; font-weight: normal;">
                    {{ $examination->academicYear->semester == '1' ? '1st' : '2nd' }} sem AY
                    {{ $examination->academicYear->academic_year }}
                </h3>
            </th>
        </tr>
    </table>
    <table width="100%" style="margin-top: 15px;">
        <tr>
            <td class="text-start text-truncate" style="border: none;" width="10%">STUDENT</td>
            <td class="text-start" style="border: none; font-weight: bold;" width="70%">:
                {{ $examination->student->fullname }}</td>
            <td class="text-start text-truncate" style="border: none;" width="10%">SEX</td>
            <td class="text-start" style="border: none; font-weight: bold;" width="20%">:
                {{ $examination->student->gender == 'M' ? 'Male' : 'Female' }}</td>
        </tr>
        <tr>
            <td class="text-start text-truncate" style="border: none;" width="10%">Contact No</td>
            <td class="text-start" style="border: none; font-weight: bold;" width="70%">:
                {{ $examination->student->contactNo }}</td>
            <td class="text-start text-truncate" style="border: none;" width="10%">Age</td>
            <td class="text-start" style="border: none; font-weight: bold;" width="20%">:
                {{ \Carbon\Carbon::parse($examination->student->birthDate)->age }}</td>
        </tr>
    </table>
    <table width="100%" style="margin-top: 15px;">
        <tr>
            <td class="text-start text-truncate" style="border: none; font-weight: bold" colspan="4">
                Preferred Courses</td>
        </tr>
        <tr>
            <td class="text-start text-truncate" style="border: none;" width="15%">COURSE 1</td>
            <td class="text-start" style="border: none; font-weight: bold;" width="85%">:
                {{ $course1 }}</td>
        </tr>
        <tr>
            <td class="text-start text-truncate" style="border: none;" width="15%">COURSE 2</td>
            <td class="text-start" style="border: none; font-weight: bold;" width="85%">:
                {{ $course2 }}</td>
        </tr>
    </table>

    <table width="100%" style="margin-top: 15px;">
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

    <table width="100%" style="margin-top: 50px;">
        <tr>
            <td width="40%" style="border: none;">Prepared by:</td>
            <td width="20%" style="border: none;"></td>
            <td width="40%" style="border: none;"></td>
        </tr>
        <tr>
            <td width="40%" class="text-center" style="border: none; padding-top:50px;">
                <strong>{{ $settings['GC']->Keyvalue }}</strong><br>
                {{ $settings['GC_POSITION']->Keyvalue }}
            </td>
            <td width="20%" style="border: none;"></td>
            <td width="40%" style="border: none;"></td>
        </tr>
    </table>
    </div>
</body>
