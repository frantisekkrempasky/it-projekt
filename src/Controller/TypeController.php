<?php

namespace App\Controller;

use App\Http\Response;

class TypeController extends BaseController
{
    public function index(): Response
    {
        return $this->render('types', ['title' => 'Typy bicyklov']);
    }
}
