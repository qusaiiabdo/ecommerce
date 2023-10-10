<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use app\Models\CategoryModel;
use app\Models\ProductsModel;

class Admin extends BaseController
{
    public function index()
    {
        //

        return redirect()->to('productcontroller');


    }

    public function signup(){
        helper('form','uri');

        if($this->request->is('post')){

        $rules=[
            'username'=>'required',
            'email'=>'required|valid_email|is_enique[users.email]',
            'password'=>'required|min_length[5]'
        ];

     

        if($rules){
            $model=new AdminModel();

            $data=[
                'username'=>$this->request->getVar('username'),
                'email'=>$this->request->getVar('email'),
                'password'=>password_hash($this->request->getVar('password'),PASSWORD_BCRYPT),
            ];

            $model->save($data);
            return redirect()->to('admin/login');
        }
    }
return view('admin/signup');

    }


    public function login(){

        if($this->request->is('post')){

        $admin=new AdminModel();
        
        $email=$this->request->getVar('email');
        $password=$this->request->getVar('password');

        $validuser=$admin->where('email',$email)->first();

        if($validuser){
            $authpass=password_verify($password,$validuser['password']);
            
            if($authpass){
                $session=session();

                $ses_data=[
                    'id'=>$validuser['id'],
                    'username'=>$validuser['username'],
                    'isLoggedIn'=>true
                ];

                $session->set($ses_data);

                return redirect()->to("productcontroller");

            }else{
                session()->setFlashdata('msg','password is incorrect');
                return redirect()->to('admin/login');            }
        }else{
            session()->setFlashdata('msg','Email is incorrect');
            return redirect()->to('admin/login');
        }
    }
        return view('admin/login');


    }
}
