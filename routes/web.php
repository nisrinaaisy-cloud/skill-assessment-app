<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\LeaderAssignmentController;
use App\Http\Controllers\PartController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OperatorAssessmentController;
use App\Http\Controllers\LeaderAssessmentController;
use App\Http\Controllers\ApprovalController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


/*
|--------------------------------------------------------------------------
| LANDING PAGE
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
	return view('landing');
})->name('landing');


/*
|--------------------------------------------------------------------------
| AUTH / LOGIN
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

	Route::get('/login', [AuthController::class, 'showLogin'])
		->name('login');

	Route::post('/login', [AuthController::class, 'login'])
		->name('login.process');

});


/*
|--------------------------------------------------------------------------
| OPERATOR ASSESSMENT
|--------------------------------------------------------------------------
| Operator tidak perlu login.
|--------------------------------------------------------------------------
*/

Route::prefix('operator-assessment')
	->name('operator.assessment.')
	->group(function () {

		Route::get('/', [OperatorAssessmentController::class, 'index'])
			->name('index');

		Route::post(
			'/pilih-operator',
			[OperatorAssessmentController::class, 'pilihOperator']
		)->name('pilihOperator');

		Route::get(
			'/pilih-part/{operator}',
			[OperatorAssessmentController::class, 'pilihPart']
		)->name('pilihPart');

		Route::get(
			'/history/{operator}',
			[OperatorAssessmentController::class, 'history']
		)->name('history');

		Route::get(
			'/get-sub-process/{part}',
			[OperatorAssessmentController::class, 'getSubProcess']
		)->name('getSubProcess');

		Route::post(
			'/mulai',
			[OperatorAssessmentController::class, 'mulai']
		)->name('mulai');

		Route::get(
			'/form/{assessment}',
			[OperatorAssessmentController::class, 'form']
		)->name('form');

		Route::post(
			'/submit/{assessment}',
			[OperatorAssessmentController::class, 'submit']
		)->name('submit');

	});


/*
|--------------------------------------------------------------------------
| AUTHENTICATED SYSTEM
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {


	/*
	|--------------------------------------------------------------------------
	| DASHBOARD
	|--------------------------------------------------------------------------
	*/

	Route::get(
		'/dashboard',
		[DashboardController::class, 'index']
	)->name('dashboard');


	/*
	|--------------------------------------------------------------------------
	| USER MANAGEMENT
	|--------------------------------------------------------------------------
	| Digunakan untuk akun:
	| - Admin
	| - Leader
	| - Foreman
	| - Kabag
	|
	| Master Operator TIDAK digunakan untuk membuat akun.
	|--------------------------------------------------------------------------
	*/

	Route::resource(
		'user',
		UserController::class
	);

	Route::post(
		'user/{user}/reset-password',
		[UserController::class, 'resetPassword']
	)->name('user.reset-password');


	/*
	|--------------------------------------------------------------------------
	| MASTER OPERATOR
	|--------------------------------------------------------------------------
	| Master Operator hanya berisi data Operator.
	|--------------------------------------------------------------------------
	*/

	Route::resource(
		'operators',
		OperatorController::class
	);


	/*
	|--------------------------------------------------------------------------
	| LEADER ASSIGNMENT
	|--------------------------------------------------------------------------
	| Leader berasal dari tabel users dengan role = leader.
	|
	| Master Operator tetap khusus Operator.
	|
	| Leader Assignment hanya untuk:
	| 1. Menentukan Leader
	| 2. Menentukan divisi
	| 3. Mapping Leader dengan Operator
	|--------------------------------------------------------------------------
	*/

	Route::resource(
		'leader-assignments',
		LeaderAssignmentController::class
	);


	/*
	|--------------------------------------------------------------------------
	| AMBIL LEADER BERDASARKAN DIVISI
	|--------------------------------------------------------------------------
	| Sumber data:
	| users
	|
	| BUKAN:
	| operators
	|--------------------------------------------------------------------------
	*/

	Route::get(
		'/leader-assignments/leaders/{divisi}',
		[LeaderAssignmentController::class, 'getLeaders']
	)->name('leader-assignments.leaders');


	/*
	|--------------------------------------------------------------------------
	| AMBIL OPERATOR BERDASARKAN DIVISI
	|--------------------------------------------------------------------------
	| Sumber data:
	| operators
	|
	| Operator tetap Operator.
	|--------------------------------------------------------------------------
	*/

	Route::get(
		'/leader-assignments/operators/{divisi}',
		[LeaderAssignmentController::class, 'getOperators']
	)->name('leader-assignments.operators');


	/*
	|--------------------------------------------------------------------------
	| MAPPING LEADER → OPERATOR
	|--------------------------------------------------------------------------
	*/

	Route::post(
		'/leader-assignments/{leader}/mapping',
		[LeaderAssignmentController::class, 'mapping']
	)->name('leader-assignments.mapping');


	/*
	|--------------------------------------------------------------------------
	| MASTER DATA PART
	|--------------------------------------------------------------------------
	*/

	Route::get(
		'/parts/check-no-part',
		[PartController::class, 'checkNoPart']
	)->name('parts.checkNoPart');

	Route::resource(
		'parts',
		PartController::class
	);


	/*
	|--------------------------------------------------------------------------
	| REKAPITULASI
	|--------------------------------------------------------------------------
	*/

	Route::get(
		'/rekapitulasi',
		[RekapitulasiController::class, 'index']
	)->name('rekapitulasi.index');

	Route::get(
		'/rekapitulasi/export',
		[RekapitulasiController::class, 'export']
	)->name('rekapitulasi.export');

	Route::get(
		'/rekapitulasi/operator/{operator}',
		[RekapitulasiController::class, 'show']
	)->name('rekapitulasi.show');

	Route::get(
		'/rekapitulasi/operator/{operator}/periode/{periode}',
		[RekapitulasiController::class, 'showPeriod']
	)->name('rekapitulasi.period');

	Route::get(
		'/rekapitulasi/cetak/{assessment}',
		[RekapitulasiController::class, 'printForm']
	)->name('rekapitulasi.print');


	/*
	|--------------------------------------------------------------------------
	| LEADER ASSESSMENT
	|--------------------------------------------------------------------------
	*/

	Route::prefix('leader-assessments')
		->name('leader.assessments.')
		->group(function () {

			Route::get(
				'/',
				[LeaderAssessmentController::class, 'index']
			)->name('index');

			Route::get(
				'/{assessment}',
				[LeaderAssessmentController::class, 'show']
			)->name('show');

			Route::post(
				'/{assessment}/store',
				[LeaderAssessmentController::class, 'store']
			)->name('store');

		});


	/*
	|--------------------------------------------------------------------------
	| FOREMAN / KABAG APPROVAL
	|--------------------------------------------------------------------------
	*/

	Route::prefix('approvals')
		->name('approvals.')
		->group(function () {

			Route::get(
				'/',
				[ApprovalController::class, 'index']
			)->name('index');

			Route::get(
				'/{approval}',
				[ApprovalController::class, 'show']
			)->name('show');

			Route::post(
				'/{approval}/approve',
				[ApprovalController::class, 'approve']
			)->name('approve');

			Route::post(
				'/{approval}/reject',
				[ApprovalController::class, 'reject']
			)->name('reject');

		});


	/*
	|--------------------------------------------------------------------------
	| NOTIFICATIONS
	|--------------------------------------------------------------------------
	*/

	Route::get(
		'/notifications',
		[NotificationController::class, 'index']
	)->name('notifications.index');

	Route::post(
		'/notifications/{id}/read',
		[NotificationController::class, 'markAsRead']
	)->name('notifications.read');

	Route::post(
		'/notifications/read-all',
		[NotificationController::class, 'markAllAsRead']
	)->name('notifications.readAll');


	/*
	|--------------------------------------------------------------------------
	| LOGOUT
	|--------------------------------------------------------------------------
	*/

	Route::post(
		'/logout',
		[AuthController::class, 'logout']
	)->name('logout');

});


/*
|--------------------------------------------------------------------------
| TEST QR
|--------------------------------------------------------------------------
*/

Route::get('/test-qr', function () {

	return QrCode::size(250)
		->generate('TEST QR CODE PT MADA WIKRI TUNGGAL');

});