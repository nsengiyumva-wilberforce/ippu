<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AccountTypesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\CpdsController;
use App\Http\Controllers\Admin\JobsController;
use App\Http\Controllers\EducationBackgroundController;
use App\Http\Controllers\WorkBackgroundController;
use App\Http\Controllers\EventsController as mEventsController;
use App\Http\Controllers\CpdsController as mCpdsController;
use App\Http\Controllers\JobsController as mJobsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\LeadsController;
use App\Http\Controllers\Admin\PipelinesController;
use App\Http\Controllers\Admin\StagesController;
use App\Http\Controllers\Admin\LeadStagesController;
use App\Http\Controllers\Admin\SourcesController;
use App\Http\Controllers\Admin\LabelsController;
use App\Http\Controllers\Admin\ContractTypesController;
use App\Http\Controllers\Admin\DealsController;
use App\Http\Controllers\Admin\FormBuildersController;
use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\Admin\CustomersController;
use App\Http\Controllers\Admin\VendorsController;
use App\Http\Controllers\Admin\ProposalsController;
use App\Http\Controllers\Admin\TaxesController;
use App\Http\Controllers\Admin\ProductServiceCategoriesController;
use App\Http\Controllers\Admin\ProductServiceUnitsController;
use App\Http\Controllers\Admin\CustomFieldsController;
use App\Http\Controllers\Admin\ProductServicesController;
use App\Http\Controllers\Admin\ProductStocksController;
use App\Http\Controllers\Admin\InvoicesController;
use App\Http\Controllers\Admin\CreditNotesController;
use App\Http\Controllers\Admin\BillsController;
use App\Http\Controllers\Admin\ReportsController;
use App\Http\Controllers\CommunicationsController;
use App\Http\Controllers\UsersController;

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
    return redirect('dashboard');
});

Route::get('/dashboard', [DashboardController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('update_profile', [ProfileController::class,'update_profile']);
});

Route::resource('communications', CommunicationsController::class)->middleware(['auth','verified']);


Route::middleware(['auth','verified'])->group(function(){
    Route::resource('education', EducationBackgroundController::class);
    Route::resource('experiences', WorkBackgroundController::class);
    Route::get('all_events', [mEventsController::class,'index']);
    Route::get('event_details/{id}', [mEventsController::class,'details']);
    Route::get('upcoming_events', [mEventsController::class,'upcoming']);
    Route::get('attend_event/{id}', [mEventsController::class,'attend']);
    Route::POST('attend_event', [mEventsController::class,'confirm_attendence']);
    Route::get('attended_events', [mEventsController::class,'attended']);
    Route::get('all_cpds', [mCpdsController::class,'index']);
    Route::get('upcoming_cpds', [mCpdsController::class,'upcoming']);
    Route::get('attend_cpd/{id}', [mCpdsController::class,'attend']);
    Route::POST('attend_cpd', [mCpdsController::class,'confirm_attendence']);
    Route::get('attended_cpds', [mCpdsController::class,'attended']);
    Route::get('subscribe',[DashboardController::class,'subscribe']);
    Route::get('cpd_details/{id}', [mCpdsController::class,'details']);
    Route::resource('jobs', mJobsController::class);
    Route::get('who-we-are', function() {
        return view('members.general.who_we_are');
    });
    Route::get('core-values', function() {
        return view('members.general.core_values');
    });
    
    Route::get('event_certificate/{event}',[mEventsController::class,'certificate']);
});

Route::prefix('admin')->middleware(['auth','verified'])->group(function(){
    Route::resource('account_types', AccountTypesController::class);
    Route::resource('events', EventsController::class);
    Route::resource('cpds', CpdsController::class);
    Route::resource('jobs', JobsController::class);
    Route::resource('leads', LeadsController::class);
    Route::POST('leads_order',[LeadsController::class,'order']);
    Route::get('leads_list', [LeadsController::class,'lead_list']);
    Route::get('leads/{id}/labels', [LeadsController::class,'labels']);
    Route::post('leads_labels_store/{id}', [LeadsController::class, 'labelStore']);
    Route::resource('deals', DealsController::class);
    Route::get('deals_list', [DealsController::class,'deal_list']);
    Route::POST('deals_order', [DealsController::class,'order']);
    Route::post('deals_change_pipeline', [DealsController::class,'changePipeline']);
    Route::resource('pipelines', PipelinesController::class);
    Route::resource('stages', StagesController::class);
    Route::POST('stages_order',[StagesController::class,'order']);
    Route::resource('lead_stages', LeadStagesController::class);
    Route::POST('lead_stages_order',[LeadStagesController::class,'order']);
    Route::get('leads/{id}/sources', [LeadsController::class, 'sourceEdit']);
    Route::put('leads/{id}/sources', [LeadsController::class, 'sourceUpdate']);
    Route::resource('sources', SourcesController::class);
    Route::resource('labels', LabelsController::class);
    Route::resource('contract_types', ContractTypesController::class);
    Route::post('leads_json', [LeadsController::class, 'json']);
    Route::resource('form_builders', FormBuildersController::class);
    Route::get('form_field/{id}', [FormBuildersController::class, 'formFieldBind']);
    Route::get('form_response/{id}', [FormBuildersController::class, 'viewResponse']);
    Route::get('form_builder/{id}/field', [FormBuildersController::class, 'fieldCreate']);
    Route::post('form_builder/{id}/field', [FormBuildersController::class, 'fieldStore']);
    Route::get('members', [MembersController::class,'index']);
    Route::get('members/{id}', [MembersController::class,'show']);
    Route::get('change_member_status/{member}', [MembersController::class,'change_member_status']);
    Route::POST('change_member_status', [MembersController::class,'update_member_status']);
    Route::resource('customers', CustomersController::class);
    Route::resource('vendors', VendorsController::class);
    Route::resource('proposals', ProposalsController::class);
    Route::get('proposals/create/{id}', [ProposalsController::class,'create']);
    Route::resource('taxes', TaxesController::class);
    Route::resource('product-category', ProductServiceCategoriesController::class);
    Route::resource('product-unit', ProductServiceUnitsController::class);
    Route::resource('custom-fields', CustomFieldsController::class);
    Route::resource('productservice', ProductServicesController::class);
    Route::get('productservice/{id}/detail', [ProductServicesController::class, 'warehouseDetail']);
    Route::resource('productstock', ProductStocksController::class);
    Route::post('proposals/product', [ProposalsController::class, 'product']);
    Route::post('proposals/customer', [ProposalsController::class, 'customer']);
    Route::get('customer/proposal/{id}/', [ProposalsController::class, 'invoiceLink']);
    Route::resource('invoices', InvoicesController::class);
    Route::get('invoices/create/{id}', [InvoicesController::class,'create']);
    Route::post('invoices/product', [InvoicesController::class, 'product']);
    Route::post('invoices/customer', [InvoicesController::class, 'customer']);
    Route::get('invoice/index', [InvoicesController::class, 'index'])->name('invoice.index');
    Route::resource('credit_notes', CreditNotesController::class);
    Route::get('credit_note/invoice', [CreditNotesController::class, 'getinvoice']);
    Route::get('custom-credit-note', [CreditNotesController::class, 'customCreate']);
    Route::post('custom-credit-note', [CreditNotesController::class, 'customStore']);
    Route::resource('bills', BillsController::class);
    Route::get('events/attendence/{attendence_id}/{status}', [EventsController::class,'attendence']);
    Route::get('cpds/attendence/{attendence_id}/{status}', [CpdsController::class,'attendence']);
    Route::get('invoice/pdf/{id}', [InvoicesController::class, 'invoice'])->name('invoice.pdf');

    Route::get('approve_membership/{id}', [DashboardController::class,'approve']);

    Route::get('deny_membership/{id}', [DashboardController::class,'deny']);
    Route::get('review_membership/{id}',[DashboardController::class,'review']);
    Route::post('review_membership', [DashboardController::class,'post_review']);

    Route::get('invoice/{id}/sent', [InvoicesController::class, 'sent']);
    Route::get('invoice/{id}/payment', [InvoicesController::class, 'payment']);
    Route::post('invoice/{id}/payment', [InvoicesController::class, 'createPayment']);
    Route::get('invoice/{id}/credit-note', [CreditNotesController::class, 'create']);
    Route::post('invoice/{id}/credit-note', [CreditNotesController::class, 'store']);
    Route::post('invoice/product/destroy', [InvoicesController::class, 'productDestroy'])->name('invoice.product.destroy');

    Route::get('invoices/items', [InvoicesController::class, 'items']);
    Route::get('leads/{id}/show_convert', [LeadsController::class, 'showConvertToDeal']);

    Route::get('audit-trail', function() {
        $activityLogs = \Spatie\Activitylog\Models\Activity::all();

        return view('admin.audit.index', compact('activityLogs'));
    });

    Route::get('members_report',[ReportsController::class,'members']);
    Route::get('points_report',[ReportsController::class,'points']);
    Route::get('cpds_report',[ReportsController::class,'cpds']);
    Route::get('events_report',[ReportsController::class,'events']);
    Route::get('payments_report',[ReportsController::class,'payments']);

    Route::get('create_reminder/{type}', [DashboardController::class,'create_reminder']);
    Route::post('send_reminder', [DashboardController::class,'send_reminder']);
    Route::get('users',[UsersController::class,'users']);
    Route::get('edit_user/{user}',[UsersController::class,'edit']);
    Route::POST('assign_permission',[UsersController::class,'assign_permission']);
});
require __DIR__.'/auth.php';
