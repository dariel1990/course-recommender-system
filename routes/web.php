<?php

use App\Models\Faculties;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CriteriaController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\SupervisorController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SubjectStudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'index'])->name('landing.home');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/student-home', [HomeController::class, 'studentDashboard'])->name('studentDashboard');
Route::get('/peer-home', [HomeController::class, 'peerDashboard'])->name('peerDashboard');
Route::get('/supervisor-home', [HomeController::class, 'supervisorDashboard'])->name('supervisorDashboard');

Route::group(['middleware' => ['auth:web']], function () {
    Route::resource('users', UserController::class);
    Route::get('/edit/profile', [UserController::class, 'editProfile'])->name('edit.profile');
    Route::put('/edit/profile/{id}', [UserController::class, 'updateProfile'])->name('update.profile');

    //Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings/update/{keyName}', [SettingsController::class, 'update']);

    //Academic Year
    Route::get('/academic/year', [AcademicYearController::class, 'index'])->name('academic.year');
    Route::get('/academic/year/create', [AcademicYearController::class, 'create'])->name('academic.year.create');
    Route::post('/academic/year/store', [AcademicYearController::class, 'store'])->name('academic.year.store');
    Route::get('/academic/year/{id}', [AcademicYearController::class, 'edit'])->name('academic.year.edit');
    Route::put('/academic/year/{id}', [AcademicYearController::class, 'update'])->name('academic.year.update');
    Route::delete('/academic/year/{id}', [AcademicYearController::class, 'delete'])->name('academic.year.delete');
    Route::put('/academic/update-evaluation-status/{id}', [AcademicYearController::class, 'updateEvaluationStatus'])->name('academic.year.updateEvalStatus');
    Route::put('/academic/updateDefaultStatus/{id}', [AcademicYearController::class, 'updateDefaultStatus'])->name('academic.year.updateDefaultStatus');

    //Departments
    Route::post('/department/store', [DepartmentController::class, 'store'])->name('department.store');
    Route::get('/department/{id}', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::put('/department/{id}', [DepartmentController::class, 'update'])->name('department.update');
    Route::delete('/department/{id}', [DepartmentController::class, 'delete'])->name('department.delete');

    //Classes
    Route::get('/courses', [CourseController::class, 'index'])->name('course');
    Route::post('/course/store', [CourseController::class, 'store'])->name('course.store');
    Route::get('/course/{id}', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('/course/{id}', [CourseController::class, 'update'])->name('course.update');
    Route::delete('/course/{id}', [CourseController::class, 'delete'])->name('course.delete');

    //Students
    Route::get('/students', [StudentController::class, 'index'])->name('student.index');
    Route::get('/student/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/student/store', [StudentController::class, 'store'])->name('student.store');
    Route::get('/student/{id}', [StudentController::class, 'edit'])->name('student.edit');
    Route::put('/student/{id}', [StudentController::class, 'update'])->name('student.update');
    Route::delete('/student/{id}', [StudentController::class, 'delete'])->name('student.delete');

    //Criteria
    Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/category/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/category/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::patch('/update-category-order/{id}', [CategoryController::class, 'updateOrder']);

    //Questions
    Route::get('/question', [QuestionController::class, 'index'])->name('question');
    Route::post('/question/store', [QuestionController::class, 'store'])->name('question.store');
    Route::get('/question/{id}', [QuestionController::class, 'edit'])->name('question.edit');
    Route::put('/question/{id}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('/question/{id}', [QuestionController::class, 'delete'])->name('question.delete');

    //Examinations
    Route::get('/examinations', [ExaminationController::class, 'index'])->name('examinations');
    Route::get('/examinations/dataTableList', [ExaminationController::class, 'dataTableList'])->name('examinations.dataTableList');
    Route::post('/examinations/store', [ExaminationController::class, 'store'])->name('examinations.store');
    Route::get('/examinations/{id}', [ExaminationController::class, 'edit'])->name('examinations.edit');
    Route::put('/examinations/{id}', [ExaminationController::class, 'update'])->name('examinations.update');
    Route::delete('/examinations/{id}', [ExaminationController::class, 'delete'])->name('examinations.delete');
    Route::get('/examinations/result/{examinationId}', [ExaminationController::class, 'examinationResult'])->name('examinations.result');

    //Reports
    Route::get('/examination/print/result/{examinationId}', [ReportsController::class, 'printExamResult'])->name('examinations.print.result');
});

Route::get('/examination-login', [ExaminationController::class, 'examLogin'])->name('examination.login');
Route::post('/examination-auth', [ExaminationController::class, 'examAuth'])->name('examination.auth');
Route::get('/examination-page', [ExaminationController::class, 'examPage'])->name('examination.page');
Route::post('/examination/submit/{examinationId}', [ExaminationController::class, 'submitExamination'])->name('examination.submit');
Route::get('/examination/done', [ExaminationController::class, 'examDone'])->name('examination.done');
