<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentsCtrl;

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

Route::get('/', [StudentsCtrl::class, 'students' ]);
Route::post('/add',[StudentsCtrl::class, 'insert_student'])->name('students.add');;
Route::delete('students/{id}', [StudentsCtrl::class, 'delete'])->name('students.delete');

