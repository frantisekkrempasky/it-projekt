<?php

namespace App\Controller;

use App\Http\Response;

class LocationController extends BaseController
{
    public function index(): Response
    {
        return $this->render('locations', ['title' => 'Lokality']);
    }
}
