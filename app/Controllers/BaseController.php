<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

abstract class BaseController extends Controller
{
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }

    protected function requireLogin()
    {
        if (! session()->get('user_id')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter.');
        }

        return null;
    }

    protected function requireAdmin()
    {
        if ($redirect = $this->requireLogin()) {
            return $redirect;
        }

        if (session()->get('roles') !== 'admin') {
            return redirect()->to('/login')->with('error', 'Accès refusé');
        }

        return null;
    }
}
