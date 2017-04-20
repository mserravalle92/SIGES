var visible= false;

$(document).ready(function(){
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
})
