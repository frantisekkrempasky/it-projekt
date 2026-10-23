<?php

namespace App\Controller;

use App\Http\Response;

class AccessoryController extends BaseController
{
    public function index(): Response
    {
        return $this->render('accessories', ['title' => 'Doplnky']);
    }
}
