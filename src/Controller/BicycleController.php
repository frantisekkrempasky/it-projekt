<?php

namespace App\Controller;

use App\Model\BicycleModel;

class BicycleController extends BaseController
{
    public function index($request)
    {
        $model = new BicycleModel();
        $bicycles = $model->getAll();

        // Názov bez .php, pretože systém si príponu doplní sám
        return $this->render('bicycles', [
            'title' => 'Zoznam Bicyklov',
            'bicycles' => $bicycles
        ]);
    }
}
