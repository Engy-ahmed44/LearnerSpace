<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\ControllerHelpers;

use App\Auth\AuthManager;


class BlogController extends Controller
{

    public function index()
    {
        $this->view('blog/index');
    }

    public function blog_details()
    {
        $this->view('blog/details');
    }
}
