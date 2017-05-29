
var visible= false;

$(document).ready(function(){

	/** VISTA INDEX CICLO**/
	$('#listaCiclosLectivos').hide();
	$('#opcionListarCiclos').click(function(){
		if(visible){
			$('#listaCiclosLectivos').hide();
			visible = false;
		}
		else{
			$('#listaCiclosLectivos').show();
			visible = true;

		}
		});

/** VISTA AGREGAR DE CURSO**/
	
	$('#listadoDeAlumnos').hide();
	$('#opcionAlumnos').click(function(){
			$('#listadoDeMaterias').hide();
			$('#listadoDeAlumnos').show();
		});
	$('#opcionMaterias').click(function(){
			$('#listadoDeAlumnos').hide();
			$('#listadoDeMaterias').show();
		});
})