<?php 

   /** main app file **/

   class App
   {
        protected $controller = 'home';
        protected $method = 'index';
        protected $params = array();
        public function __construct()
        {
            // code ...
            $URL = $this->getURL();
            if(file_exists("../private/controllers/" . $URL[0] . ".php"))
            {
                $this->controller = $URL[0];
            }

            require "../private/controllers/" . $this->controller . ".php";
            $this->controller = new $this->controller();
        }
        private function getURL()
        {
           return explode("/", filter_var($_GET['url'], FILTER_SANITIZE_URL));
        }
   }

   