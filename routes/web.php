<?php
Route::redirect('/','home');
// Ruta para el home
Route::get('/',[
	'as'=>'home',
	'uses'=>'HomeController@index'
]);

Route::resource('home','HomeController');

//Cliente-----------------------------------------------------------------------------------------------------

$this->post('users-act','UsersController@store')->name('profile.update')->middleware('auth');
$this->get('user-profile','UsersController@index')->name('profile')->middleware('auth');
//Fin Cliente-------------------------------------------------------------------------------------------------

//Administrador-----------------------------------------------------------------------------------------------
Route::group(['namespace' => 'Administrador', 'middleware' => ['auth'], 'prefix'=>'administrador'], function()
{
	// Ruta home administrador
	Route::get('/home',function(){
		return view ('administrador.home');
	});
	// Ruta para CRUD de productos
	Route::resource('productos','ProductosController');

	// Ruta para CRUD de usuarios
	Route::resource('usuarios','AdminUserController');

	//Ruta para CRUD repartidores

	Route::resource('repartidores','repartidorController');
	// Rutas para CRUD de canastas
	Route::get('canastas/search',[
		'as' => 'canastas-buscador',
		'uses' => 'CanastasController@buscador'
	]);
	Route::resource('canastas','CanastasController');

	Route::get('canastas/prodCanasta/show',[
		'as' => 'prodCanasta-show',
		'uses' => 'LlenadoCanastaController@show'
	]);

	Route::get('prodCanasta/add/{id}',[
		'as' => 'prodCanasta-add',
		'uses' => 'LlenadoCanastaController@add'
	]);

	Route::get('prodCanasta/delete/{id}',[
		'as' => 'prodCanasta-delete',
		'uses' => 'LlenadoCanastaController@delete'
	]);

	Route::get('prodCanasta/vaciar',[
		'as' => 'prodCanasta-vaciar',
		'uses' => 'LlenadoCanastaController@vaciar'
	]);

	Route::get('prodCanasta/update/{id}/{cantidad?}',[
		'as' => 'prodCanasta-update',
		'uses' => 'LlenadoCanastaController@update'
	]);

});
	
//Fin Administrador-----------------------------------------------------------------------------------------

//Rutas para el control de sesión-------------------------
Route::get('logout', 'Auth\LoginController@logout');
Auth::routes();
Route::get('/loginBloqueado',function(){
		return view ('auth.loginBloqueado');
	});
//--------------------------------------------------------

//Rutas carro de compras-------------------------------------------------------------------------------
Route::get('cart/show',[
	'as'=>'cart-show',
	'uses'=>'CartController@show'
]);

Route::bind('product',function($id){
	return App\Product::where('id',$id)->first();
});

Route::get('cart/add/{product}',[
	'as'=> 'cart-add',
	'uses' => 'CartController@add'
]);

Route::get('cart/delete/{product}',[
	'as'=>'cart-delete',
	'uses'=> 'CartController@delete'
]);
Route::get('cart/trash',[
	'as'=>'cart-trash',
	'uses'=>'CartController@trash'
]);

Route::get('cart/update/{product}/{cantidad?}',[
	'as'=>'cart-update',
	'uses'=>'CartController@update'
]);

Route::get('order-detail',[
	'middleware'=>'auth',
	'as'=>'order-detail',
	'uses'=>'CartController@orderDetail'
]);

//Paypal---------------------------------------------------------------------------------

//Enviar pedido a paypal
Route::get('payment',array(
	'as'=>'payment',
	'uses'=>'PaypalController@postPayment',
));

//Paypal redirecciona a esta ruta
Route::get('payment/status',array(
	'as'=>'payment.status',
	'uses'=>'PaypalController@getPaymentStatus',
));

//Top productos
Route::get('top',[
	'as'=>'top-product',
	'uses'=>'TopController@showTop'
]);