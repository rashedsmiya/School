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
                $this->controller = ucfirst($URL[0]);
                require "../private/controllers/" . $URL[0] . ".php";
                $this->controller = new $this->controller();
                unset($URL[0]);
            }else{
                require "../private/controllers/" . $this->controller . ".php";
                $this->controller = new $this->controller();
            }
            

            if(isset($URL[0])){
                if(method_exists($this->controller, $URL[0])){
                    $this->method = $URL[0];
                    unset($URL[0]);
                }
            }
            
            $this->params = array_values($URL);
            $this->params = $URL;
            call_user_func_array([$this->controller, $this->method], $this->params);
        }

        private function getURL() 
        {
            $url = isset($_GET['url']) ? $_GET['url'] : 'home';
            return explode("/", filter_var(trim($url, '/'), FILTER_SANITIZE_URL));
        }
    }