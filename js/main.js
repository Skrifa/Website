$_ready(function(){

	if(window.location.hash == "#Register"){
		$_("header").hide();
	    $_("form[data-form='register']").show();
	}

	$_("form[data-form='register']").submit(function(event){
		event.preventDefault();
		var self = this;
		var re = /^[a-z0-9\-_\.]+$/g;
		if(re.test($_("[data-form='register'] input[name='user']").value().trim())){
			if($_("[data-form='register'] input[name='password']").value() == $_("[data-form='register'] input[name='rpassword']").value()){

				var inputs = {
					"user": $_("[data-form='register'] input[name='user']").value().toLowerCase(),
					"password": $_("[data-form='register'] input[name='password']").value()
				};

				var str = [];
		        for(var value in inputs){
					str.push(encodeURIComponent(value) + "=" + encodeURIComponent(inputs[value]));
				}

				Request.post("register", str.join("&"), {
					onload: function(data){
						if(data.response.status){
							self.reset();
							$_("form[data-form='register'] [data-content='status']").text('');
							$_("form[data-form='register']").hide();
							$_("[data-view='download']").show();
						}else{
							$_("form[data-form='register'] [data-content='status']").text(data.response.error);
						}

					},

					error: function(data){

					}

				}, "json");

			}else{
				$_("form[data-form='register'] [data-content='status']").text("Passwords does not match");
			}
		}else{
			$_("form[data-form='register'] [data-content='status']").text("Invalid Username");
		}
	});

	$_('[data-action="download"]').click(function(){
		var value = $_("[data-select='skrifa']").value();
		if (value != 'Select your OS') {
			window.open(value, "_blank");
		}
	});

	$_('[data-action="download-lite"]').click(function(){
		var value = $_("[data-select='lite']").value();
		if (value != 'Select your OS') {
			window.open(value, "_blank");
		}
	});

	$_('[data-action="buy"]').click(function(){
		$_('#buy').get(0).submit();
	});

    $_("[data-action='register']").click(function(){
	    $_("header").hide();
	    $_("form[data-form='register']").show();
    });

    $_("[type='reset']").click(function(){
		$_("form[data-form='register']").hide();
		$_("header").show();
    });

});

