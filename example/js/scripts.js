$('#shortUrlForm').validate({
	rules: {
		shortUrl: {
			required: true,
			url: true
		}
	},
	messages: {
		shortUrl: {
			required: 'Informe a URL longa',
			url: 'Informe uma URL válida'
		}
	},
	submitHandler: function(form) {
		let date = $(form).serialize();
		$.ajax({
			type: 'POST',
			url: 'php/shortUrl.php',
			data: date,
			success: function(response) {
				$('.box-infosUrl,.box-error,.box-shortUrl').hide();
				let obj = JSON.parse(response);
				if(obj.erro) {
					$('.box-error.alert-danger').show();
					$('.box-error.alert-danger span').text(obj.code+' - '+obj.msg);
				} else {
					$('.box-shortUrl.alert-success').show();
					$('.box-shortUrl.alert-success span.short').html('<a href="http://www.localhost/shortUrl/s/'+obj.short+'" target="_blank">http://www.localhost/shortUrl/s/'+obj.short+'</a>');
					$('.box-shortUrl.alert-success span.origin').html('<a href="'+obj.origin+'" target="_blank">'+obj.origin);
				}
			},
			error: function(){
			}			
		});
	}
})

$('#infosUrlForm').validate({
	rules: {
		infosUrl: {
			required: true,
			url: true
		}
	},
	messages: {
		infosUrl: {
			required: 'Informe a URL encurtada',
			url: 'Informe uma URL válida'
		}
	},
	submitHandler: function(form) {
		let date = $(form).serialize();
		$.ajax({
			type: 'POST',
			url: 'php/infosUrl.php',
			data: date,
			success: function(response) {
				$('.box-infosUrl,.box-error,.box-shortUrl').hide();
				let obj = JSON.parse(response);
				if(obj.erro) {
					$('.box-error.alert-danger').show();
					$('.box-error.alert-danger span').text(obj.code+' - '+obj.msg);
				} else {
					let d = new Date(obj.date);
					$('.box-infosUrl.alert-success').show();
					$('.box-infosUrl.alert-success span.short').html('<a href="http://www.localhost/shortUrl/s/'+obj.short+'" target="_blank">http://www.localhost/shortUrl/s/'+obj.short+'</a>');
					$('.box-infosUrl.alert-success span.origin').html('<a href="'+obj.origin+'" target="_blank">'+obj.origin);
					$('.box-infosUrl.alert-success span.date').html(d.toLocaleString());
					$('.box-infosUrl.alert-success span.count').html(obj.count);
				}
			},
			error: function(){
			}			
		});
	}
})