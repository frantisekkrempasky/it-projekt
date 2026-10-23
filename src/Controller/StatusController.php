<?php

namespace App\Controller;

use App\Http\Response;

class StatusController extends BaseController
{
    public function index(): Response
    {
        return $this->render('statuses', ['title' => 'Stavy bicyklov']);
    }
}
