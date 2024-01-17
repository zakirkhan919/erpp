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

Route::get('/', [App\Modules\Finance\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/', [App\Modules\Finance\Http\Controllers\IndexController::class, 'front'])->name('/');
Route::get('/excel-import', [App\Modules\Finance\Http\Controllers\MemberController::class, 'ExcelImport'])->name('ex.index');
Route::post('/excel-submit', [App\Modules\Finance\Http\Controllers\MemberController::class, 'SubmitExcelImport'])->name('import.submit');
// Admin Route
Route::group(['middleware' => 'auth'], function () {
    Route::get('/profile', [App\Modules\Finance\Http\Controllers\HomeController::class, 'profile'])->name('profile');
    Route::post('/update_profile', [App\Modules\Finance\Http\Controllers\HomeController::class, 'updateProfile'])->name('update_profile');
    Route::get('/change-password', [App\Modules\Finance\Http\Controllers\HomeController::class, 'changePassword'])->name('change-password');
    Route::post('/update_password', [App\Modules\Finance\Http\Controllers\HomeController::class, 'updatePassword'])->name('update_password');

    // member resource route
    // Route::resource('members', 'App\Modules\Finance\Http\Controllers\MemberController');
    Route::get('/members', [App\Modules\Finance\Http\Controllers\MemberController::class, 'index'])->name('members.index');
    Route::get('/member/add', [App\Modules\Finance\Http\Controllers\MemberController::class, 'create'])->name('member.create');
    Route::post('/member/get', [App\Modules\Finance\Http\Controllers\MemberController::class, 'MemberGet']); // ajax request
    Route::post('/member/search-get', [App\Modules\Finance\Http\Controllers\MemberController::class, 'SearchGet']); // ajax request
    Route::post('/member/delete', [App\Modules\Finance\Http\Controllers\MemberController::class, 'MemberDelete']); // ajax request
    Route::get('/member/edit/{id}', [App\Modules\Finance\Http\Controllers\MemberController::class, 'edit'])->name('edit.member');
    Route::post('/member/view', [App\Modules\Finance\Http\Controllers\MemberController::class, 'MemberView']);

    // search
    Route::get('/get-thana', [App\Modules\Finance\Http\Controllers\MemberController::class, 'getThana'])->name('getThana');
    Route::get('/get-postoffice', [App\Modules\Finance\Http\Controllers\MemberController::class, 'getpostoffice'])->name('getpostoffice');
    Route::get('/get-village', [App\Modules\Finance\Http\Controllers\MemberController::class, 'getvillage'])->name('getvillage');
    Route::post('/form-Submit', [App\Modules\Finance\Http\Controllers\MemberController::class, 'formSubmit'])->name('formSubmit');

    // nogod grohon of route
    Route::get('/amount/credit', [App\Modules\Finance\Http\Controllers\TransectionController::class, 'CreditTransection'])->name('credit.transection');
    Route::get('/amount/credit/add', [App\Modules\Finance\Http\Controllers\TransectionController::class, 'AddCreditTransection'])->name('add.credit.transection');
    Route::post('/amount/credit/get', [App\Modules\Finance\Http\Controllers\TransectionController::class, 'CreditAmountGet']); // ajax request
    Route::get('/amount/credit/edit/{id}', [App\Modules\Finance\Http\Controllers\TransectionController::class, 'EditCreditTransection'])->name('edit.credit.transection');
    Route::post('/amount/credit/delete', [App\Modules\Finance\Http\Controllers\TransectionController::class, 'CreditAmountDelete']); // ajax request

    // nogod spend of route
    Route::get('/amount/spend', [App\Modules\Finance\Http\Controllers\TransectionController::class, 'SpendTransection'])->name('spend.transection');
    Route::get('/amount/spend/add', [App\Modules\Finance\Http\Controllers\TransectionController::class, 'AddSpendTransection'])->name('add.spend.transection');
    Route::post('/amount/spend/get', [App\Modules\Finance\Http\Controllers\TransectionController::class, 'SpendAmountGet']); // ajax request
    Route::get('/amount/spend/edit/{id}', [App\Modules\Finance\Http\Controllers\TransectionController::class, 'EditSpendTransection'])->name('edit.spend.transection');
    Route::post('/amount/spend/delete', [App\Modules\Finance\Http\Controllers\TransectionController::class, 'SpendAmountDelete']); // ajax request

    // commite
    Route::get('/committe', [App\Modules\Finance\Http\Controllers\CommitteController::class, 'Committes'])->name('committe.index');
    Route::post('/committe_submit', [App\Modules\Finance\Http\Controllers\CommitteController::class, 'CommitteSubmit'])->name('committe_submit');
    Route::post('/committe/get', [App\Modules\Finance\Http\Controllers\CommitteController::class, 'CommitteGet']);

    // Kholipa
    Route::get('/kholipa', [App\Modules\Finance\Http\Controllers\KholipaController::class, 'Kholipas'])->name('kholipa.index');
    Route::post('/kholipa_submit', [App\Modules\Finance\Http\Controllers\KholipaController::class, 'KholipaSubmit'])->name('kholipa_submit');
    Route::post('/kholipa/get', [App\Modules\Finance\Http\Controllers\KholipaController::class, 'KholipaGet']);

    // invite member
    Route::get('/invite_member', [App\Modules\Finance\Http\Controllers\InviteMember::class, 'InviteMember'])->name('invite.member');
    Route::post('/invite_submit', [App\Modules\Finance\Http\Controllers\InviteMember::class, 'InviteSubmit'])->name('invite_submit');
    Route::post('/invite_member/get', [App\Modules\Finance\Http\Controllers\InviteMember::class, 'InviteMemberGet']);

    // complain route
    Route::get('/complains', [App\Modules\Finance\Http\Controllers\ComplainController::class, 'Complain'])->name('complain.index');
    Route::get('/complain/add', [App\Modules\Finance\Http\Controllers\ComplainController::class, 'AddComplain'])->name('add.complain');
    Route::post('/complain/get', [App\Modules\Finance\Http\Controllers\ComplainController::class, 'ComplainGet']); // ajax request
    Route::get('/complain/edit/{id}', [App\Modules\Finance\Http\Controllers\ComplainController::class, 'EditComplain'])->name('edit.complain');
    // Route::post('/complain/delete', [App\Modules\Finance\Http\Controllers\ComplainController::class, 'ComplainDelete']); // ajax request

    // report
    Route::get('/financial', [App\Modules\Finance\Http\Controllers\ReportController::class, 'Financial'])->name('financial');
    Route::post('/from-submit-financial', [App\Modules\Finance\Http\Controllers\ReportController::class, 'FromSubmit']);

    // member report
    Route::get('/member/report', [App\Modules\Finance\Http\Controllers\ReportController::class, 'MemberReport'])->name('member.report');
    Route::post('/from-submit-member-report', [App\Modules\Finance\Http\Controllers\ReportController::class, 'FromMemberSubmit']);

    // excel import
    Route::post('/search-submit', [App\Modules\Finance\Http\Controllers\MemberController::class, 'searchSubmit'])->name('submitSearch');
});
