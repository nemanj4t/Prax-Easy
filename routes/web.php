<?php
use App\Faculty;
use App\Company;
use App\User;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $users = User::where('type', 'company')->get();
    return view('index', compact('users'));
});

Auth::routes();

Route::get('/register', function () {
    $faculties = Faculty::all();
    return view('register', compact('faculties'));
})->name('register');

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function(){
    Route::get('/student', 'StudentController@index')->name('student.home');
    Route::get('/faculty', 'FacultyController@index')->name('faculty.home');
    Route::get('/company', 'CompanyController@index')->name('company.home');
    Route::get('/student/profile', 'StudentController@showProfile')->name('student.profile');
    Route::get('/company/profile', 'CompanyController@showProfile')->name('company.profile');
    Route::get('/faculty/profile', 'FacultyController@showProfile')->name('faculty.profile');
    Route::post('/student/application', 'StudentController@application')->name('student.application');
    Route::get('/company/application', 'CompanyController@allApplications')->name('company.applications');
    Route::post('/company/application/accept', 'CompanyController@acceptApplication')->name('company.acceptApplication');
    Route::post('/company/application/decline', 'CompanyController@declineApplication')->name('company.declineApplication');
    Route::post('/student/assign', 'StudentController@assignInternship')->name('student.assignInternship');
    Route::get('/internship', 'InternshipController@create')->name('internship.create');
    Route::post('/internship', 'InternshipController@store')->name('internship.store');
    Route::get('/student/edit', 'StudentController@edit')->name('student.edit');
    Route::post('/student/update', 'StudentController@update')->name('student.update');
    Route::get('/company/edit', 'CompanyController@edit')->name('company.edit');
    Route::post('/company/update', 'CompanyController@update')->name('company.update');
    Route::get('/faculty/edit', 'FacultyController@edit')->name('faculty.edit');
    Route::post('/faculty/update', 'FacultyController@update')->name('faculty.update');
    Route::get('/internship/{id}/edit', 'InternshipController@edit')->name('internship.edit');
    Route::post('/internship/update', 'InternshipController@update')->name('internship.update');
    Route::get('/internship/{id}/re', 'CompanyController@obnovi')->name('internship.re');

});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function(){
    Route::get('/', 'LoginController@showLoginForm')->name('admin.showLoginForm');
    Route::post('/', 'LoginController@login')->name('admin.login');

    Route::group(['middleware' => 'auth:admin'], function(){
        Route::get('/home', 'AdminController@index')->name('admin.home');
        Route::post('/logout', 'LoginController@logout')->name('admin.logout');
        Route::get('/create', 'AdminController@createFaculty')->name('admin.create-faculty');
        Route::post('/store', 'AdminController@storeFaculty')->name('admin.store-faculty');
        Route::delete('/delete', 'AdminController@destroy')->name('admin.destroy');
        Route::get('/student/{id}', 'AdminController@showStudent')->name('admin.show-student');
        Route::get('/company/{id}', 'AdminController@showCompany')->name('admin.show-company');
        Route::get('/faculty/{id}', 'AdminController@showFaculty')->name('admin.show-faculty');
    });
});

Route::group(['middleware' => 'guest'], function(){
    Route::get('/company/register', 'RegisterCompanyController@create')->name('company.registration-form');
    Route::post('/company/register', 'RegisterCompanyController@store')->name('company.registration');
    Route::get('/student/register', 'RegisterStudentController@create')->name('student.registration-form');
    Route::post('/student/register', 'RegisterStudentController@store')->name('student.registration');
});


Route::get('/internship/{id}', 'InternshipController@show')->name('internship.show');


Route::get('/student/profile/{id}', 'StudentController@show')->name('student.show');
Route::get('/company/profile/{id}', 'CompanyController@show')->name('company.show');
Route::get('/faculty/profile/{id}', 'FacultyController@show')->name('faculty.show');


Route::get('/internship/tags/{tag}', 'TagsController@index')->name('home.blade.php');

Route::get('/search', 'SearchController@index');

Route::get('/verify/{token}', 'VerifyController@verify')->name('verify');

Route::post('/comment/store', 'CommentController@store')->name('comment.store');

Route::post('recommendation/store', 'RecommendationController@store')->name('recommendation.store');
