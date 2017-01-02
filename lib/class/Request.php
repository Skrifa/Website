<?php

	/**
	* ==============================
	* Request
	* ==============================
	*/

	class Request {

        /**
         * Get data received from a GET request
         *
         * @param mixed $keys | Expected data names
         * @param boolean $allowHTML | If the data should contain HTML code
         * @param boolean $allowEmpty | If the data can be empty
         *
         * @return mixed or null | Associative array with received data
         */
		public static function get($keys = null, $allowHTML = false, $allowEmpty = false){
		    if($keys != null){
		        $array = array();
    			foreach($keys as $value){
    				if(isset($_GET[$value])){

    					if(!$allowEmpty && empty($_GET[$value])){
    						return null;
    					}

                        if(!$allowHTML){
                            $array[$value] = strip_tags($_GET[$value]);
                        }else{
                            $array[$value] = $_GET[$value];
                        }

    				}else{
    					return null;
    				}
    			}
    			return $array;
		    }else{
		        return $_GET;
		    }
		}

		/**
         * Get data received from a POST request
         *
         * @param mixed $keys | Expected data names
         * @param boolean $allowHTML | If the data should contain HTML code
         * @param boolean $allowEmpty | If the data can be empty
         *
         * @return mixed or null | Associative array with received data
         */
		public static function post($keys = null, $allowHTML = false, $allowEmpty = false){
		    if($keys != null){
		        $array = array();
    			foreach($keys as $value){
    				if(isset($_POST[$value])){

    					if(!$allowEmpty && empty($_POST[$value])){
    						return null;
    					}

                        if(!$allowHTML){
                            $array[$value] = strip_tags($_POST[$value]);
                        }else{
                            $array[$value] = $_POST[$value];
                        }

    				}elseif(isset($_FILES[$value])){

    					if(!$allowEmpty && empty($_FILES[$value])){
    						return null;
    					}

    					$array[$value] = $_FILES[$value];

				    }else{
    					return null;
    				}
    			}
    			return $array;
		    }else{
		        return $_POST;
		    }
		}

		/**
         * Get data received from a OPTIONS request
         *
         * @param mixed $keys | Expected data names
         * @param boolean $allowHTML | If the data should contain HTML code
         * @param boolean $allowEmpty | If the data can be empty
         *
         * @return mixed or null | Associative array with received data
         */
		public static function options($keys = null, $allowHTML = false, $allowEmpty = false){

		    if($_SERVER['REQUEST_METHOD'] != "OPTIONS"){
		        return null;
		    }

		    parse_str(file_get_contents("php://input"), $_OPTIONS);

		    if($keys != null){
		        $array = array();
    			foreach($keys as $value){
    				if(isset($_OPTIONS[$value])){

    					if(!$allowEmpty && empty($_OPTIONS[$value])){
    						return null;
    					}

                        if(!$allowHTML){
                            $array[$value] = strip_tags($_OPTIONS[$value]);
                        }else{
                            $array[$value] = $_OPTIONS[$value];
                        }

    				}else{
    					return null;
    				}
    			}
    			return $array;
		    }else{
		        return $_OPTIONS;
		    }

		}

		/**
         * Get data received from a PUT request
         *
         * @param mixed $keys | Expected data names
         * @param boolean $allowHTML | If the data should contain HTML code
         * @param boolean $allowEmpty | If the data can be empty
         *
         * @return mixed or null | Associative array with received data
         */
		public static function put($keys = null, $allowHTML = false, $allowEmpty = false){

		    if($_SERVER['REQUEST_METHOD'] != "PUT"){
		        return null;
		    }

		    parse_str(file_get_contents("php://input"), $_PUT);

		    if($keys != null){
		        $array = array();
    			foreach($keys as $value){
    				if(isset($_PUT[$value])){

    					if(!$allowEmpty && empty($_PUT[$value])){
    						return null;
    					}

                        if(!$allowHTML){
                            $array[$value] = strip_tags($_PUT[$value]);
                        }else{
                            $array[$value] = $_PUT[$value];
                        }

    				}else{
    					return null;
    				}
    			}
    			return $array;
		    }else{
		        return $_PUT;
		    }

		}

		/**
         * Get data received from a PATCH request
         *
         * @param mixed $keys | Expected data names
         * @param boolean $allowHTML | If the data should contain HTML code
         * @param boolean $allowEmpty | If the data can be empty
         *
         * @return mixed or null | Associative array with received data
         */
		public static function patch($keys = null, $allowHTML = false, $allowEmpty = false){

		    if($_SERVER['REQUEST_METHOD'] != "PATCH"){
		        return null;
		    }

		    parse_str(file_get_contents("php://input"), $_PATCH);

		    if($keys != null){
		        $array = array();
    			foreach($keys as $value){
    				if(isset($_PATCH[$value])){

    					if(!$allowEmpty && empty($_PATCH[$value])){
    						return null;
    					}

                        if(!$allowHTML){
                            $array[$value] = strip_tags($_PATCH[$value]);
                        }else{
                            $array[$value] = $_PATCH[$value];
                        }

    				}else{
    					return null;
    				}
    			}
    			return $array;
		    }else{
		        return $_PATCH;
		    }

		}

		/**
         * Get data received from a DELETE request
         *
         * @param mixed $keys | Expected data names
         * @param boolean $allowHTML | If the data should contain HTML code
         * @param boolean $allowEmpty | If the data can be empty
         *
         * @return mixed or null | Associative array with received data
         */
		public static function delete($keys = null, $allowHTML = false, $allowEmpty = false){

		    if($_SERVER['REQUEST_METHOD'] != "DELETE"){
		        return null;
		    }

		    parse_str(file_get_contents("php://input"), $_DELETE);

		    if($keys != null){
		        $array = array();
    			foreach($keys as $value){
    				if(isset($_DELETE[$value])){

    					if(!$allowEmpty && empty($_DELETE[$value])){
    						return null;
    					}

                        if(!$allowHTML){
                            $array[$value] = strip_tags($_DELETE[$value]);
                        }else{
                            $array[$value] = $_DELETE[$value];
                        }

    				}else{
    					return null;
    				}
    			}
    			return $array;
		    }else{
		        return $_DELETE;
		    }

		}
	}
?>