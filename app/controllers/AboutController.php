<?php

namespace App\Controllers;

use App\Core\Controller as Controller;

class AboutController extends Controller
{
    public $pageTitle = 'About';

    public function get()
    {
        $this->view('about');
    }
}
