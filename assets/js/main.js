$(function(){

	$('#pregunta a.tab').on('click', function(){
		$('a.tab.active').removeClass('active');
		$(this).addClass('active');
		var id = $(this).attr('id');
		$.get('/debate/inicio/preguntas?type=' + id, function(data) {
			$('#pregunta ul').slideUp(400,function() {
				$('#pregunta ul').html('').attr('id',id);
				if(data.length == 0) {
					$('#pregunta ul').append('<li class="error">No se han encontrado preguntas de esa categoria.</li>');
				}
				$.each(data, function() {
					$('#pregunta ul').append('<li><p>' + this.text + '</p><span>' + this.likes + '</span></li>');
				});
			});
			
			$('#pregunta ul').slideDown();
		});
	});

	$('#preguntaAdmin a.tab').on('click', function(){
		$('a.tab.active').removeClass('active');
		$(this).addClass('active');
		var id = $(this).attr('id');
		$.get('/debate/admin/preguntas?type=' + id, function(data) {
			$('#preguntaAdmin ul').slideUp(400,function() {
				$('#preguntaAdmin ul').html('').attr('data-type',id);
				if(data.length == 0) {
					$('#preguntaAdmin ul').append('<li class="error">No se han encontrado preguntas de esa categoria.</li>');
				}
				$.each(data, function() {
					$('#preguntaAdmin ul').append('<li class="pregunta"><form class="like" action="/debate/admin/" method="post"><div class="texto"><input type="hidden" name="pregunta_like" value="' + this.id +'"> ' + this.text + '<p>' + this.likes + '</p></div><button class="trash icon-trash" type="submit" name="delete" value=""></button></form></li>');
				});
			});
			
			$('#preguntaAdmin ul').slideDown();
		});
	});



});


//FRONTAL

function intervaloFrontal(){
	setInterval(function() {
		var type = $('#pregunta ul').attr('id');
		if (typeof type != 'undefined') {
			$.get('/debate/inicio/preguntas?type=' + type, function(data) {
				$('#pregunta ul').html('');
				if(data.length == 0) {
					$('#pregunta ul').append('<li class="error">No se han encontrado preguntas de esa categoria.</li>');
				}
				$.each(data, function() {
					$('#pregunta ul').append('<li><p>' + this.text + '</p><span>' + this.likes + '</span></li>');
				});
			});
		}
	}, 2000);
}

//ADMIN
	function intervaloAdmin(){
		setInterval(function() {
			var type = $('#pregunta ul').attr('data-type');
				$.get('/debate/admin/preguntas?type=' + type, function(data) {
					$('#pregunta ul').html('');
					if(data.length == 0) {
						$('#pregunta ul').append('<li class="error">No se han encontrado preguntas de esa categoria.</li>');
					}
					$.each(data, function() {
						$('#pregunta ul').append('<li class="pregunta"><form class="like" action="/debate/admin/" method="post"><div class="texto"><input type="hidden" name="pregunta_like" value="' + this.id +'"> ' + this.text + '<p>' + this.likes + '</p></div><button class="trash icon-trash" type="submit" name="delete" value=""></button></form></li>');
					});
				});
		}, 2000);
	}