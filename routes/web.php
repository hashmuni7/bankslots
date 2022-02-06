<?php


use Illuminate\Support\Facades\Route;


use App\Http\Controllers\Logic\USSDPayments;
use App\Http\Livewire\Pages\DistrictsPage;
use App\Http\Livewire\Pages\Markets;
use App\Http\Livewire\Pages\NewHolder;
use App\Http\Livewire\Pages\UpdateVendor;
use App\Http\Livewire\Pages\VendorsPage;

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

Route::get('/views/{pageNumber}', function ($pageNumber) {
    switch ($pageNumber){
        case 1: 
            return view('common.login');

        case 201: 
            return view('admin.landlords');

        case 202: 
            return view('admin.properties');

        case 203: 
            return view('admin.tenants');

        case 204: 
            return view('admin.spaces');

        case 207: 
            return view('admin.singlelandlord');

        case 208: 
            return view('admin.editlandlord');

        case 209: 
            return view('admin.editproperty');

        case 210: 
            return view('admin.singleproperty');

        case 211: 
            return view('admin.addspace');

        case 212: 
            return view('admin.addtenant');

        case 213: 
            return view('admin.singlespace');

        case 214: 
            return view('admin.payments');

        case 301: 
            return view('landlord.properties');

        case 302: 
            return view('landlord.singleproperty');

        case 303: 
            return view('landlord.editproperty');

        case 304: 
            return view('landlord.addspace');

        case 305: 
            return view('landlord.addtenant');

        case 306: 
            return view('landlord.singlespace');

        case 307: 
            return view('landlord.spacehistory');

        case 400: 
            return view('tenants.dash');
        
        case 401: 
            return view('tenants.myspaces');

        case 402: 
            return view('tenants.singlespace');

        case 403: 
            return view('tenants.profile');

        case 404: 
            return view('tenants.oldspaces'); 

        default: 
            return 'Page Not Found';    
    }
    
    
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //Alert::success('Success Title', 'Success Message');
    return view('dashboard');
})->name('dashboard');

Route::post('/paymentussd', [USSDPayments::class, 'handleRequest']);
Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('/newholders', NewHolder::class)->name('newholders');
    Route::get('/markets', Markets::class)->name('markets');
    Route::get('/vendors', VendorsPage::class)->name('vendors');
    Route::get('/updatevendor/{vendorID}', UpdateVendor::class)->name('updatevendor');
    Route::get('/districts', DistrictsPage::class)->name('districts');
});

