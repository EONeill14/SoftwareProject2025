<?php
class HomeController {
    public function index() {
        // Data for the view would be prepared here

        // Tell the application which view file to use
        $view_file = 'app/views/home.php';

        // Load the main layout, which will in turn load the view file
        require_once 'app/views/layout.php';
    }
}
?>