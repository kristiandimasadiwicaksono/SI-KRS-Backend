<?php
namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use Firebase\JWT\JWT;

class Auth extends ResourceController{
    public function login(){
        $usermodel = new UserModel();
        
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $user = $usermodel->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])){
            return $this->failUnauthorized('Username atau Password salah');
        }

        $playload = [
            'iss' => 'localhost',
            'aud' => 'localhost',
            'iat' => time(),
            'exp' => time() + 3600,
            'data' => [
                'username'=> $user['username'],
                'password'=> $user['password']
            ]
        ];

        $token = JWT::encode($playload, getenv('JWT_SECRET'), 'HS256');

        return $this->respond(['token' => $token]);
    }
}
?>