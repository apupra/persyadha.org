<?php
namespace App\Controllers;

class FrontendController extends BaseController
{
    public function index()
    {
        $this->render('index', [
            'title' => 'Beranda Persyadha',
        ]);
    }
}
