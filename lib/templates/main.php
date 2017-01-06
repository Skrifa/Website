<?php

    /**
     * Class for the main template
     *
     * Any information requested by the template will be provided by this class
     * as well as it's behaviour.
     */
    class main extends Template{

        // Set Meta Tags Information.
        public $_title = "Skrifa";
		public $_description = "A simple word processor built with web technologies.";
		public $_keywords = "editor, word, skrifa, processor, notes, notebook, scholl, office, encrypted, pgp";
		public $_shareimage = "share.png";
		public $_author = "Hyuchia";
		public $_twitter = "@HyuchiaDiego";
		public $_google = "+HyuchiaDiego";

		public $year;

        // Set what page and template should be used to render this template.
        function __construct(){
            $this -> setPage("home.html");
            $this -> setTemplate("main.html");
			$this -> year = date("Y");
        }
    }

?>
