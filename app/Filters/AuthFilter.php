<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use Config\Services;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthFilter implements FilterInterface{
    public function before(RequestInterface $request, $arguments = null){
        $authHeader = $request->getHeaderLine('Authorization');

        if (!$authHeader){
            return Services::response()->setJSON(['message' => 'Token tidak ditemukan'])->setStatusCode(401);
        }

        $token = null;
        if (preg_match('/Bearer\s(\S+)/', $authHeader, $matches)){
            $token = $matches[1];
        }

        if (!$token){
            return Services::response()->setJSON(['message' => 'Token tidak valid'])->setStatusCode(401);
        }

        try {
            $decoded = JWT::decode($token, new Key(getenv('JWT_SECRET'), 'HS256'));
            $request->user = $decoded;
        } catch (\Exception $e){
            return Services::response()->setJSON(['message' => 'Token tidak valid']);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments=null){

    }
}
?>