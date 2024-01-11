<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicationController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auxiliar-create-data', [App\Http\Controllers\GlobalController::class, 'auxiliardata']);



// Route::group(['middleware'=>['auth','admin']], function(){
    Route::group(['middleware'=>['auth']], function(){

    //Admins Route
    //rotas para CRUD Administradores
    Route::get('/admins/dashboard/getdashboarddata', [App\Http\Controllers\Admin\DashboardController::class, 'dashboarddata']);

    Route::resource('users', 'App\Http\Controllers\Admin\UsersController');
    Route::resource('fees', 'App\Http\Controllers\Admin\FeesController');
    Route::resource('payments', 'App\Http\Controllers\Admin\PaymentsController');









    Route::resource('areas', 'App\Http\Controllers\Admin\AreasController');
    Route::resource('departments', 'App\Http\Controllers\Admin\DepartmentsController');
    Route::resource('technicians', 'App\Http\Controllers\Admin\TechnicianController');
    Route::resource('tasks', 'App\Http\Controllers\Admin\TaskController');
    Route::resource('taskplans', 'App\Http\Controllers\Admin\TaskPlanController');
    Route::resource('taskplanequipments', 'App\Http\Controllers\Admin\TaskPlanEquipmentController');
    Route::resource('taskplantasks', 'App\Http\Controllers\Admin\TaskPlanTaskController');
    Route::resource('subtasks', 'App\Http\Controllers\Admin\SubTaskController');
    Route::resource('taskmaterials', 'App\Http\Controllers\Admin\TaskMaterialsController');
    Route::resource('taskdepartments', 'App\Http\Controllers\Admin\TaskDepartmentsController');
    Route::resource('malfunctions', 'App\Http\Controllers\Admin\MalfunctionsController');
    Route::resource('destinations', 'App\Http\Controllers\Admin\DestinationsController');
    Route::resource('centercost', 'App\Http\Controllers\Admin\CenterCostController');
    Route::resource('centercostaccount', 'App\Http\Controllers\Admin\CenterCostAccountController');
    Route::resource('equipments', 'App\Http\Controllers\Admin\EquipmentsController');
    Route::resource('type_equipments', 'App\Http\Controllers\Admin\TypeEquipmentsController');
    Route::resource('fleets', 'App\Http\Controllers\Admin\FleetController');
    Route::resource('suppliers', 'App\Http\Controllers\Admin\SuppliersController');
    Route::resource('equipmentcomponent', 'App\Http\Controllers\Admin\EquipmentComponentsController');
    Route::resource('equipmentsubcomponent','App\Http\Controllers\Admin\EquipmentSubComponentController');
    Route::resource('typeequipmentcomponent', 'App\Http\Controllers\Admin\TypeEquipmentComponentsController');
    Route::resource('typeequipmentsubcomponent','App\Http\Controllers\Admin\TypeEquipmentSubComponentController');
    Route::resource('reasons', 'App\Http\Controllers\Admin\ReasonsController');
    Route::resource('causes', 'App\Http\Controllers\Admin\CausesController');
    Route::resource('solutions', 'App\Http\Controllers\Admin\SolutionsController');
    Route::resource('consequences', 'App\Http\Controllers\Admin\ConsequencesController');
    Route::resource('recommendations', 'App\Http\Controllers\Admin\RecommendationsController');
    Route::resource('mcscr', 'App\Http\Controllers\Admin\MCSCRController');
    Route::resource('brands', 'App\Http\Controllers\Admin\ProductBrandController');
    Route::resource('categories', 'App\Http\Controllers\Admin\ProductCategoryController');
    Route::resource('products', 'App\Http\Controllers\Admin\ProductController');
    Route::resource('taskmcscr', 'App\Http\Controllers\Admin\TaskMcscrController');
    Route::resource('stockcenters', 'App\Http\Controllers\Admin\StockCentersController');
    Route::resource('inventories', 'App\Http\Controllers\Admin\InventoryController');
    Route::resource('exitnotes', 'App\Http\Controllers\Admin\ExitNoteController');
    Route::resource('shifts', 'App\Http\Controllers\Admin\ShiftController');
    Route::resource('entrynotes', 'App\Http\Controllers\Admin\EntryNoteController');
    Route::resource('stocksuppliers', 'App\Http\Controllers\Admin\StockSupplierController');
    Route::resource('stocktransfers', 'App\Http\Controllers\Admin\StockTransferController');
    Route::resource('stockrequests', 'App\Http\Controllers\Admin\RequestStockController');
    Route::resource('technicianrequests', 'App\Http\Controllers\Admin\RequestTechnicianController');
    Route::resource('toolrequests', 'App\Http\Controllers\Admin\RequestToolController');
    Route::resource('toolshops', 'App\Http\Controllers\Admin\ToolShopController');
    Route::resource('notifications', 'App\Http\Controllers\Admin\NotificationController');
    Route::resource('hourdistances', 'App\Http\Controllers\Admin\HoursDistanceEquipmentController');
    Route::resource('fuel', 'App\Http\Controllers\Admin\FuelController');
    Route::resource('groupshift', 'App\Http\Controllers\Admin\GroupShiftController');
    Route::resource('groupshiftoperator', 'App\Http\Controllers\Admin\GroupShiftOperatorController');
    Route::resource('shiftequipmentrequest', 'App\Http\Controllers\Admin\ShiftEquipmentRequestController');
    Route::resource('shiftequipmentrequestitem', 'App\Http\Controllers\Admin\ShiftEquipmentRequestItemController');

    

  
    

});




//Ultima rota

Route::get('{view}', ApplicationController::class)->where('view','(.*)')->middleware('auth');

