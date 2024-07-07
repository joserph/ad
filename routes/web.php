<?php

use App\Http\Controllers\MemberMunicipalController;
use App\Http\Controllers\MemberParroquialController;
use App\Http\Controllers\MemberSeccionalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OnextenController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;

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
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'members', 'as' => 'members.', 'controller' => App\Http\Controllers\MembersController::class], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/getScopeInfo', 'getScopeInfo')->name('getScopeInfo');
    Route::get('/create', 'create')->name('create');
    Route::get('/uploads', 'uploads')->name('uploads');
    Route::post('/save-members', 'saveMembers')->name('save-members');
    Route::get('/list', 'list')->name('list');
    Route::post('/store', 'store')->name('store');
    Route::post('/comiteStore', 'comiteStore')->name('comiteStore');
    Route::put('/update/{members}', 'update')->name('update');
    Route::get('/edit/{members}', 'edit')->name('edit');
    Route::get('/modal_delete/{members}', 'modal_delete')->name('modalDelete');
    Route::get('/modal_delete_masive', 'modal_delete_masive')->name('modalDeleteMasive');
    Route::delete('/delete/{members}', 'destroy')->name('delete');
    Route::post('/delete-masive', 'deleteMasive')->name('deleteMasive');
    Route::post('/ci', 'searchDoc')->name('searchDoc');
    Route::get('/export', 'export')->name('export');
});

Route::group(['middleware' => 'auth', 'prefix' => 'committe-local', 'as' => 'committe-local.', 'controller' => App\Http\Controllers\ComiteLocalController::class], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/list', 'list')->name('list');
    Route::get('/members/{comite}', 'members')->name('members');
    Route::get('/edit/{comite}', 'edit')->name('edit');
    Route::get('/create', 'create')->name('create');
    Route::get('/modal_delete/{comite}', 'modal_delete')->name('modalDelete');
    Route::delete('/delete/{comite}', 'destroy')->name('delete');
});

Route::group(['middleware' => 'auth', 'prefix' => 'notices', 'as' => 'notices.', 'controller' => App\Http\Controllers\NoticesController::class], function () {
    Route::get('/', 'index')->name('index');
    Route::get('/home', 'preview')->name('home');
    Route::post('/uploads', 'uploads')->name('uploads');
    Route::get('/create/{notices?}', 'create')->name('create');
    Route::get('/detail/{notices}', 'detail')->name('detail');
    Route::post('/store', 'store')->name('store');
    Route::post('/update/{notices}', 'update')->name('update');
    Route::get('/list', 'list')->name('list');
    Route::get('/modal_delete/{notices}', 'modal_delete')->name('modalDelete');
    Route::delete('/delete/{notices}', 'destroy')->name('delete');
    Route::post('/delete-masive', 'deleteMasive')->name('deleteMasive');
    Route::get('/modal_delete_masive', 'modal_delete_masive')->name('modalDeleteMasive');
    Route::post('/delete-attach/{noticesFile}', 'deleteAttachment')->name('deleteAttachment');
});

// Route::group(['middleware' => 'auth', 'prefix' => 'users', 'as' => 'users.', 'controller' => App\Http\Controllers\UsersController::class], function () {
//     Route::get('/', 'index')->name('index');
//     Route::get('/create', 'create')->name('create');
//     Route::get('/edit/{users}', 'edit')->name('edit');
//     Route::get('/modal_delete/{users}', 'modal_delete')->name('modalDelete');
//     Route::delete('/delete/{users}', 'destroy')->name('delete');
//     Route::get('/list', 'list')->name('list');
//     Route::post('/store', 'store')->name('store');
//     Route::post('/storeU', 'storeU')->name('storeU');
//     Route::get('/useremail', 'useremail')->name('useremail');
//     Route::put('/update/{users}', 'update')->name('update');
// });
Route::middleware(['auth'])->group(function () {
    Route::resource('/users', UserController::class)->names('users');
    Route::get('/users-list', [UserController::class, 'list'])->name('users.list');
    Route::get('/users-modal-delete/{users}', [UserController::class, 'modal_delete'])->name('users.modalDelete');
    Route::resource('/onexten', OnextenController::class)->names('onexten');
    Route::get('/onexten-list', [OnextenController::class, 'list'])->name('onexten.list');
    Route::get('/centro_votacion/{id}', [OnextenController::class, 'centro_votacion'])->name('centro_votacion');
    Route::resource('/roles', RoleController::class)->names('roles');
    Route::get('/roles-list', [RoleController::class, 'list'])->name('roles.list');
    Route::resource('/permissions', PermissionController::class)->names('permissions');
    Route::get('/permissions-list', [PermissionController::class, 'list'])->name('permissions.list');
    Route::resource('/members-seccional', MemberSeccionalController::class)->names('members-seccional');
    Route::get('/member-seccional-list', [MemberSeccionalController::class, 'list'])->name('member-seccional.list');
    Route::get('/member-seccional/export', [MemberSeccionalController::class, 'export'])->name('member-seccional.export');
    Route::resource('/members-municipal', MemberMunicipalController::class)->names('members-municipal');
    Route::get('/member-municipal-list', [MemberMunicipalController::class, 'list'])->name('member-municipal.list');
    Route::get('/member-municipal/export', [MemberMunicipalController::class, 'export'])->name('member-municipal.export');
    Route::resource('/members-parroquial', MemberParroquialController::class)->names('members-parroquial');
    Route::get('/member-parroquial-list', [MemberParroquialController::class, 'list'])->name('member-parroquial.list');
    Route::get('/member-parroquial/export', [MemberParroquialController::class, 'export'])->name('member-parroquial.export');
    Route::get('/cmd/{command}', function($command){
        Artisan::call($command);
        dd(Artisan::output());
    });
});



// Route::post('/ci', 'OnextenController@searchDoc')->name('searchDoc');
// Route::get('/list', 'OnextenController@list')->name('list');

// Route::group(['prefix' => 'seccional', 'as' => 'seccional.', 'controller' => App\Http\Controllers\SeccionalesController::class], function () {
//     Route::get('/', 'index')->name('index');
// });

// Route::group(['prefix' => 'municipios', 'as' => 'municipios.', 'controller' => App\Http\Controllers\MunicipiosController::class], function () {
//     Route::get('/', 'index')->name('index');
// });

// Route::group(['prefix' => 'parroquias', 'as' => 'parroquias.', 'controller' => App\Http\Controllers\ParroquiasController::class], function () {
//     Route::get('/', 'index')->name('index');
// });
