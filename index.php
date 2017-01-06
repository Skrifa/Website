<?php

	/**
	 * ==============================
	 * Aegis Framework | MIT License
	 * http://www.aegisframework.com/
	 * ==============================
	 */

	/**
	 * Include Aegis Library
	 *
	 * This includes the custom error handlers and the autoload function
	 * required to load classes dynamically.
	 */
	include("lib/Aegis.php");

	/**
	 * Debugging logs are shown on errors by default, to disable them,
	 * uncomment the following line.
	 */
	//Aegis::$debugging = false;

	/**
	 * Set domain name for Router
	 *
	 * This domain name is used for routing purposes and to load all resources
	 * correctly since it's used in the base tag for the pages. Set it to the
	 * path of your project.
	 */
	Router::$domain = Config::get("Domain");

	$db = new Database(Config::get("DB_User"), Config::get("DB_Password"), Config::get("DB"));

	$session = new Session();

	/**
	 * Register Routes
	 *
	 * Register all the custom routes for your site, the callback function
	 * will be executed when the route is accessed.
	 */
	Router::get("/", function(){
		global $session;
		return new main();

	});


	Router::get("/logout", function(){
		global $session;
		$session -> set("logged", false);
		$session -> end();
	});

	Router::post("/login", function(){
		global $db, $session;

		HTTP::type("json");

		if($data = Request::post(["user", "password"])){

			if($db -> exists("Citizen", "User", $data["user"])){
				$password = $db -> select("Citizen", ["Password"], "User", $data["user"])[0]["Password"];

				if(Password::compare($data["password"], $password)){
					$session -> set("logged", true);
					return new JSON($db -> select("Citizen", ["User", "Public", "Secret"], "User", $data["user"])[0]);
				}else{
					return new JSON(["error" => "Invalid Credentials"]);
				}
			}else{
				return new JSON(["error" => "User does not exist"]);
			}

		}else{
			return new JSON(["error" => "Invalid Request"]);
		}
	});


	Router::post("/register", function(){
		global $db;
		HTTP::type("json");
		if($data = Request::post(["user", "password"])){

			if(!$db -> exists("Citizen", "User", $data["user"])){
				$db -> insert("Citizen", [
					"User" => $data["user"],
					"Password" => Password::hash($data["password"])
				]);
				return new JSON(["status" => "Success"]);
			}else{
				return new JSON(["error" => "User already exists"]);
			}
		}else{
			return new JSON(["error" => "Invalid Request"]);
		}
	});

	Router::post("/key", function(){
		global $db;

		if($data = Request::post(["user", "password", "pub", "key"])){

			if($db -> exists("Citizen", "User", $data["user"])){
				$info = $db -> select("Citizen", ["Password", "Public"], "User", $data["user"])[0];
				$pass = $info["Password"];
				$public = $info["Public"];
				if(is_null($public)){
					if(Password::compare($data["password"], $pass)){
						$db -> update("Citizen", [
							"Public" => $data["pub"],
							"Secret" =>  $data["key"]
						], "User", $data["user"]);

						HTTP::type("json");
						return new JSON(["status" => "succcess"]);
					}
				}else{
					return new JSON(["error" => "A key had already been set for this user"]);
				}
			}else{
				return new JSON(["error" => "User does not exist"]);
			}
		}else{
			return new JSON(["error" => "Invalid Request"]);
		}
	});

	Router::get("/key/{user}", function($user){
		global $db;
		HTTP::type("json");

		if($db -> exists("Citizen", "User", $user)){
			$public = $db -> select("Citizen", ["Public"], "User", $user)[0]["Public"];

			return new JSON(["key" => $public]);
		}else{
			return new JSON(["error" => "User does not exist"]);
		}

	});

	/**
	 * Make the router listen to requests.
	 *
	 * The router will now match any request to the previously registered
	 * routes and run the callback function of the match.
	 */
	Router::listen();
?>
