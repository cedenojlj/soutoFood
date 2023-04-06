<?php

use Illuminate\Http\Request;
use App\Http\Livewire\CheckOut;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;


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

 /* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', function () {
    return view('auth.login');
});
 


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/users', UserController::class);

Route::resource('/customers', CustomerController::class);

Route::resource('/products', ProductController::class);


Route::get('homenew',[ ProductController::class,'addProductItem'])->name('homenew');

Route::get('addtocart/{product}',[ ProductController::class,'addtoCart'])->name('addtocart');

Route::get('editcart/{id}',[ ProductController::class,'editCart'])->name('editcart');

Route::post('/addtocart',[ ProductController::class,'savetocart'])->name('savetocart');

Route::get('/cartlist',[ ProductController::class,'cartlist'])->name('cartlist');

Route::delete('cartdestroy',[ ProductController::class,'cartdestroy'])->name('cartdestroy');

Route::put('updatecart',[ ProductController::class,'updatecart'])->name('updatecart');

Route::get('cartedit/{product}',[ ProductController::class,'cartedit'])->name('cart.edit');

Route::get('/checkout', [ ProductController::class,'checkout'])->name('checkout');


//****************************************** */

//probando subida de archivos y descargas 

Route::view('/actualizando', 'actualizando');

Route::post('/actualizandoarchivo', function (Request $request) {

   //$filetests = $request->file('filetest')->store('public');

  $miarchivo = $request->file('filetest');

  $nombre = "000". $miarchivo->getClientOriginalName();

  $filetests= Storage::putFileAs('public', $request->file('filetest'), $nombre);  
   

    //return Storage::download('public/000SENIAT.jpg', $nombre);

    return Storage::download('public/'.$nombre, $nombre);
    
    //dd('todo listo');
    
})->name('actualizandoarchivo');

//******************************************* */



/**** exportando a excel ******** */

Route::get('/export-user', [UserController::class, 'export']);

/*********************************************** */


//********************/

Route::get('orders', [OrderController::class,'index'])->name('orders');

//***************** para exportar la orden en excel */

Route::get('export-order/{id}', [OrderController::class,'export']);

Route::get('export-rebate/{id}', [OrderController::class,'rebate']);



//******************************************** */
// Enviando correos con los archivos de excel


Route::get('sendmail/{id}', [MailController::class,'index'])->name('sendmail');

Route::get('rebatemail/{id}', [MailController::class,'rebate'])->name('rebatemail');




