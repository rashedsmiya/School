<?php 
    //  home controller 
    class Home extends Controller
    {
           function index() 
           {
            // code ...
            echo $this->view('home');
        }
    }

    