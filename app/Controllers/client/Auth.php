<?php

namespace App\Controllers\client;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\ClientModel;

class Auth extends BaseController
{

    protected $clientModel;

    public function __construct(){
        helper(['form','uri']);

        $this->clientModel=new ClientModel();

    }

    public function index()
    {
        return view('client/login');
    }

    public function signup()
    {

        helper(['form', 'url']);

        if ($this->request->is('post')) {

            $rules = $this->validate([
                'username' => 'required|min_length[6]|max_length[15]|is_unique[client_users.email]',
                'email' => 'required|valid_email|is_unique[client_users.email]',
                'password' => 'required',
                'password_confirm' => 'required|matches[password]'

            ]);

            if ($rules) {

                $clientModel = new ClientModel();

                $data = [
                    'username' => $this->request->getVar('username'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                    'password_confirm' => $this->request->getVar('password_confirm')
                ];

                $clientModel->insert($data);
                $session = session();

                $session->setFlashdata('success', 'Successfull Registraion');
                return redirect()->to('client/login');
            } else {
                return view('client/signup', ['validation' => $this->validator]);
            }
        }

        return view('client/signup');
    }

    public function login(){
        
        helper(['form','uri']);

        if($this->request->is('post')){
            
            $rules=$this->validate([
                'username'=>'required|min_length[5]',
                'password'=>'required'

            ]);

            if($rules){

                $username=$this->request->getVar('username');
                $password=$this->request->getVar('password');
                $client=$this->clientModel->where('username',$username)->first();

                if($client){
                    $passwordVerify=password_verify($password,$client['password']);

                    if($passwordVerify){
                        $session=session();

                        $data=[
                            'username'=>$client['username'],
                            'id'=>$client['id'],
                            'isloggedIn'=>true,
                        ];
                        $session->set($data);
                        return redirect()->to('clientdashboard');



                    }else{
                       $data['error']='Password is incorrect';
                       return view('client/login',$data);
                    }

                }else{
                   $data['error']='Invalid username';
                   return view('client/login',$data);
                
                }

            }else{
                return view('client/login',['validation'=>$this->validator]);
    
            }
        }

        return view('client/login');

    
}

public function logout(){
    $session=session();
    $session->destroy();
    return redirect()->to('clientdashboard');

}

}