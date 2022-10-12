<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;
use App\Models\ModelKuwitansi;
use CodeIgniter\Model;

class Kuwitansi extends BaseController
{
    public function index()
    {
        parent::MasterView('kuwitansi/kuwitansi', []);
    }

    public function test()
    {
        
        // $data = array(
            //     'todo_list' => 'list1',
            //     'title'     => 'My Real Title',
        //     'heading'   => 'My Real Heading',
        // );
        return view('orders/test', []);
    }
}