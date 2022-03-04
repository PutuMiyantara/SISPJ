<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;

class Orders extends BaseController
{
    public function index()
    {
        parent::MasterView('orders/orders', []);
    }
}