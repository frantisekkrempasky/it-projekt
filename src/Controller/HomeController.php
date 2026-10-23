<?php

namespace App\Controller;

use App\Http\Response;

class HomeController extends BaseController
{
    public function index(): Response
    {
        return $this->render('home', ['title' => 'Úvod']);
    }

    public function about(): Response
    {
        return $this->render('about', ['title' => 'O aplikácii']);
    }
}
