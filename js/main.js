$_ready(function(){

	console.log(window.location.hash == "#Register");
	if(window.location.hash == "#Register"){
		$_("header").hide();
	    $_("form[data-form='register']").show();
	}else if(window.location.hash == "#Download"){
		$_("header").hide();
	    $_("[data-view='download']").show();
	}


	$_(".nav .menu-icon").click(function(){
		$_(this).parent().find("ul").toggleClass("active");
		$_(this).toggleClass('fa-bars fa-times');
	});

	$_(".nav li").click(function(){
		if($_(".menu-icon").isVisible()){
			$_(".menu-icon").toggleClass('fa-bars fa-times');
			$_(this).parent().parent().find("ul").toggleClass("active");
		}
	});

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

	$_('a[href="#Buy"]').click(function(){
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
