<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;


class Admindashboard extends BaseController{

    public function index(){


        return view('/admin/dashboard');
    }


}