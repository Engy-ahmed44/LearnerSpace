<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\ControllerHelpers;

use App\Auth\AuthManager;


class CourseController extends Controller
{

    public function index()
    {
        $this->view('course/index');
    }

    public function course_details()
    {
        $this->view('course/details');
    }
}
