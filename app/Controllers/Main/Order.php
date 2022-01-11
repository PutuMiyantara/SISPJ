<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;

class Order extends BaseController
{
    public function index()
    {
        parent::MasterView('orders/orders', []);
    }
}