<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//Fichier CSV pour l'affectation des groupes pour chaque étudiant
use App\Http\Controllers\GroupsCSVController;
Route::get('/import_groups_for_students', [GroupsCSVController::class, 'interface']);
Route::post('/import_groups_for_students', [GroupsCSVController::class, 'importCsv']);

//Téléchargement des statistiques de présence
use App\Http\Controllers\StatsExportController;
Route::get('/export_stats_presences', [StatsExportController::class, 'interface']);
Route::post('/export_stats_presences', [StatsExportController::class, 'export']);

//Consultation des étudiants pour une séance
use App\Http\Controllers\StudentsCtrl;
Route::get('/seance-details/{seance_id}', [StudentsCtrl::class, 'students']);
Route::post('/seance-details/{seance_id}', [StudentsCtrl::class, 'addException']);
Route::get('/seance-details/{seance_id}/delete/{student_id}', [StudentsCtrl::class, 'deleteException'])->name('seanceDeleteStudent');
Route::post('/seance-details/{seance_id}/delete/{student_id}', [StudentsCtrl::class, 'deleteException'])->name('seanceDeleteStudent');
Route::post('/seance-details/{seance_id}/validation', [StudentsCtrl::class, 'save_presences']);

use App\Http\Controllers\ImportController;
//Consultation des étudiants
Route::get('/import_schedule', [ImportController::class, 'importIndex' ]);
Route::post('/import_schedule', [ImportController::class, 'import' ]);

// Display calendar
use App\Http\Controllers\CalendarCtrl;
Route::get('/calendar', [CalendarCtrl::class, 'calendarData']);

// Route for the students management
Route::get('/students_management', [StudentsCtrl::class, 'getAll']);
Route::post('/students_management/add', [StudentsCtrl::class, 'add']);
Route::post('/students_management/delete/{id}', [StudentsCtrl::class, 'delete'])->name('deleteStudent');