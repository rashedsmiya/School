<?php 

    class Controller{
        public static function view($view, $data = array())
        {
            return self::render($view, $data);
        }

        public static function render($view, $data = array())
        {
            extract($data); 
            // code ...
            if(file_exists("../private/views/" . $view . ".view.php"))
            {
                require("../private/views/" . $view . ".view.php");
            } else {
                require("../private/views/404.view.php");
            }
        }
    }
    
