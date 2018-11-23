<?php
Route::redirect('/','home');
// Ruta para el home
Route::get('/',[
	'as'=>'home',
	'uses'=>'HomeController@index'
]);

Route::resource('home','HomeController')->middleware('authCliente');

//Cliente-----------------------------------------------------------------------------------------------------

$this->post('users-act','UsersController@store')->name('profile.update')->middleware('authCliente');
$this->get('user-profile','UsersController@index')->name('profile')->middleware('authCliente');

//Rutas carro de compras-------------------------------------------------------------------------------
Route::group(['middleware' => ['authCliente']], function()
{
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

	//Historial de compras
	Route::get('hcompras',[
		'as'=>'h-compras',
		'uses'=>'TopController@showCompras'
	]);

});

//Fin Cliente-------------------------------------------------------------------------------------------------


//Administrador-----------------------------------------------------------------------------------------------
Route::group(['namespace' => 'Administrador', 'middleware' => ['authAdmin'], 'prefix'=>'administrador'], function()
{
	// Ruta home administrador
	Route::get('/home',function(){
		return view ('administrador.home');
	});

	//Generar PDF
 	Route::get('info_mes', 'DynamicPDFController@index_mes');

 	Route::get('info_mes/pdfmes','DynamicPDFController@pdf_mes');

	Route::get('dynamic_pdf', 'DynamicPDFController@index');

	Route::get('dynamic_pdf/pdf', 'DynamicPDFController@pdf');

	Route::get('info_reparto_mes', 'DynamicPDFController@index_reparto_mes');

	Route::get('info_reparto_mes/pdfmes', 'DynamicPDFController@pdf_reparto_mes');

	Route::get('info_conect_mes', 'DynamicPDFController@index_conect_mes');

	// Ruta para CRUD de productos
	Route::resource('productos','ProductosController');

	// Ruta para CRUD de usuarios
	Route::resource('usuarios','AdminUserController');

	//Ruta para CRUD repartidores
	Route::get('get-ip-details', function () {
			$ip = '66.102.0.0';
    	$data = \Location::get($ip);
    	dd($data);
	});

	Route::resource('repartidores','repartidorController');
	//Ruta para Pedidos en curso
	Route::resource('entrega','EntregaController');
	
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
Route::get('repartidores/login','RepartidorLoginController@showLoginForm');
Route::post('repartidores/login','RepartidorLoginController@login');
Route::get('repartidores/logout', 'RepartidorLoginController@logout');
Route::get('/repartidores/loginBloqueado',function(){
		return view ('repartidores.loginBloqueado');
	});
//--------------------------------------------------------



//	REPARTIDOR
Route::group(['namespace' => 'Repartidor', 'middleware' => ['authRepar']], function()
{
	Route::resource('repartidor','HomeRepartidorController');

	Route::get('/detalleEntrega/{id_pedido}',[
		'as' => 'detalleEntrega-show',
		'uses' => 'HomeRepartidorController@showPedido'
	]);

	Route::get('/updateEntrega/{id_pedido}',[
		'as' => 'updateEntrega',
		'uses' => 'HomeRepartidorController@updateEntrega'
	]);
});
//Fin Repartidor-----------------------------------------------------------------------------------------------

