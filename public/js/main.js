
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


$.getScript("https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js", function(){
    particlesJS('particles-js',
      {
        "particles": {
          "number": {
            "value": 80,
            "density": {
              "enable": true,
              "value_area": 800
            }
          },
          "color": {
            "value": "#ffffff"
          },
          "shape": {
            "type": "circle",
            "stroke": {
              "width": 0,
              "color": "#000000"
            },
            "polygon": {
              "nb_sides": 5
            },
            "image": {
              "width": 100,
              "height": 100
            }
          },
          "opacity": {
            "value": 0.5,
            "random": false,
            "anim": {
              "enable": false,
              "speed": 1,
              "opacity_min": 0.1,
              "sync": false
            }
          },
          "size": {
            "value": 5,
            "random": true,
            "anim": {
              "enable": false,
              "speed": 40,
              "size_min": 0.1,
              "sync": false
            }
          },
          "line_linked": {
            "enable": true,
            "distance": 150,
            "color": "#ffffff",
            "opacity": 0.4,
            "width": 1
          },
          "move": {
            "enable": true,
            "speed": 6,
            "direction": "none",
            "random": false,
            "straight": false,
            "out_mode": "out",
            "attract": {
              "enable": false,
              "rotateX": 600,
              "rotateY": 1200
            }
          }
        },
        "interactivity": {
          "detect_on": "canvas",
          "events": {
            "onhover": {
              "enable": true,
              "mode": "repulse"
            },
            "onclick": {
              "enable": true,
              "mode": "push"
            },
            "resize": true
          },
          "modes": {
            "grab": {
              "distance": 400,
              "line_linked": {
                "opacity": 1
              }
            },
            "bubble": {
              "distance": 400,
              "size": 40,
              "duration": 2,
              "opacity": 8,
              "speed": 3
            },
            "repulse": {
              "distance": 200
            },
            "push": {
              "particles_nb": 4
            },
            "remove": {
              "particles_nb": 2
            }
          }
        },
        "retina_detect": true,
        "config_demo": {
          "hide_card": false,
          "background_color": "#b61924",
          "background_image": "",
          "background_position": "50% 50%",
          "background_repeat": "no-repeat",
          "background_size": "cover"
        }
      }
    );

});