
$(document).ready(function() {
	// Orden de productos
	$('#products').pinterest_grid({
		no_columns: 5,
		padding_x: 10,
		padding_y: 10,
		margin_bottom: 50,
		single_column_breakpoint: 700
	});


	// Update canasta
	$(".btn-update-item").on('click', function(e){
		e.preventDefault();
		
		var id = $(this).data('id');
		var href = $(this).data('href');
		
		if(($("#prod_" + id).val() > 0) ){
			var cantidad = $("#prod_" + id).val();
		}
		else{
			var cantidad = 1;
		}
		window.location.href = href + "/" + cantidad;
	});

	//  Evitar que productos se muestren a diferente nivel

	// Obtener el div de producto más grande
	var altura_arr = [];
	$('.product').each(function(){
		//	Recorriendo cada div de producto obteniendo y guardando la altura.
		var altura = $(this).height();	
		altura_arr.push(altura);
	});
	//	Ordenar y asignar el div más grande a todos los div
	altura_arr.sort(function(a, b){return b-a}); //Array en orden descendente
	$('.product').each(function(){
		// Asignando a todos los productos la altura más grande
		$(this).css('height',altura_arr[0]);
	});

	// Obtener el div más grande de titulo
	var altura_arr = [];
	$('.producto-titulo').each(function(){
		//	Recorriendo cada div de producto obteniendo y guardando la altura.
		var altura = $(this).height();	
		altura_arr.push(altura);
	});

	//	Ordenar y asignar el div más grande de titulo a todos los div
	altura_arr.sort(function(a, b){return b-a}); //Array en orden descendente
	$('.producto-titulo').each(function(){
		// Asignando a todos los productos la altura más grande
		$(this).css('height',altura_arr[0]);
	});

});