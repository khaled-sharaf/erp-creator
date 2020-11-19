<?php





use Illuminate\Http\Request;



Auth::routes(['register' => false]);



Route::redirect('/', url('/home'));

Route::get('/home', 'HomeController@index')->name('home');



// Route::get('/welcome', function (Request $request) {

    //  asd

//     return view('emails.send.welcome_user')

//     ->with([

//         'subject' => 'Welcome Khaled',

//         'data' => collect($request->user())->toArray(),

//         'settings' => getSettings()

//     ]);

// });



// here all routes control panel



// view pdf contract leads



Route::get('contract/pdf/{secret_id}/view', 'Admin\CRM\LeadContractController@viewContractPDF');

Route::get('invoice/pdf/{secret_id}/view', 'Admin\CRM\LeadContractController@viewInvoicePDF');

// view pdf quotation

Route::get('quotation/pdf/{secret_id}/view', 'Admin\CRM\QuotationController@viewQuotationPDF');



// documents

Route::get('documents/hr_letter', function () {

    $pdf = PDF::loadView('pdf.documents.hr_letter');

    return $pdf->stream('hr-letter.pdf');

});



/*********************************************************************************/



// Route::group(['prefix' => env('CP_PREFIX')], function () {

//   Route::get('test', 'HomeController@test');



Route::group(['middleware' => 'isAdmin'], function () {

    // handel pdf files

    Route::get('/contract/pdf/{id}', 'Admin\CRM\LeadContractController@saveContractPDF');



    Route::get('/receipt/pdf/{id}', 'Admin\CRM\LeadContractController@receiptPDF');



    Route::get(env('CP_PREFIX', 'app') . '/{path?}', 'Admin\HomeController@index')->where('path', '.*');



});



// });

/*********************************************************************************/









// use App\Models\HR\Acl;

// use Spatie\Permission\Models\Permission;

// use Spatie\Permission\Models\Role;





// Route::get('/test', function () {

//     // dd(json_encode(Project::select('lead_contract_id')->get()->pluck('lead_contract_id')->toArray()));

//     dd(str_random(30));

// });











// change language form this link -- method (get)

// Route::get('lang/{lang}', 'LangController@lang')->name('lang');

/**********************************************************************************/



// use App\User;







// Route::get('/', function () {

    // $travels = Travel::where('travel_category_id', 5)->get();

    // $travels = convert_column_to_array($travels, 'gallery');

    // dd($travels->count());

// });





Route::get('test',function(){

    \App\User::where('id',1)->update([

        'password'=>bcrypt(123456)

    ]);

});
