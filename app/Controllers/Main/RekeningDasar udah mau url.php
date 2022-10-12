<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;
use App\Models\ModelUrl;

class RekeningDasar extends BaseController
{
    public function __construct()
    {
        $this->mUrl = new ModelUrl();
        
    }

    public function index()
    {
        $main_menu = $this->mUrl->getUrl(null, 'main');
        $dataUrl = [];

        foreach ($main_menu as $main) {
            # code...
            $data_sub_menu = [];
            $sub_menu = [];
            $data_sub_menu = $this->mUrl->getUrl(['tb_sub_menu.id_main_menu' => $main['id']], 'sub');
            foreach ($data_sub_menu as $sub) {
                # code...
                array_push($sub_menu,[
                    'id_sub_menu' => $sub['id'],
                    'name_sub_menu' => $sub['name_sub_menu'],
                    'sub_url' => $sub['sub_url'],
                    'no_urut_sub_menu' => $sub['no_urut_sub_menu'],
                    'subsub_menu' => $this->mUrl->getUrl(['id_sub_menu' => $sub['id']], 'subsub'),
                ]);
            }
            
            array_push($dataUrl, [
                'id_main_menu' => $main['id'],
                'name_main_menu' => $main['name_main_menu'],
                'no_urut_main_menu' => $main['no_urut_main_menu'],
                'sub_menu' => $sub_menu,
            ]);
        }
        // echo json_encode($dataUrl); die;
        parent::MasterView('rekening_dasar/rekening_dasar', ['data' => $dataUrl]);
    }

    public function testData (){
        $main_menu = $this->mUrl->getUrl(null, 'main');
        $dataUrl = [];

        foreach ($main_menu as $main) {
            # code...
            $data_sub_menu = [];
            $sub_menu = [];
            $data_sub_menu = $this->mUrl->getUrl(['tb_sub_menu.id_main_menu' => $main['id']], 'sub');
            foreach ($data_sub_menu as $sub) {
                # code...
                array_push($sub_menu,[
                    'id_sub_menu' => $sub['id'],
                    'name_sub_menu' => $sub['name_sub_menu'],
                    'sub_url' => $sub['sub_url'],
                    'no_urut_sub_menu' => $sub['no_urut_sub_menu'],
                    'subsub_menu' => $this->mUrl->getUrl(['id_sub_menu' => $sub['id']], 'subsub'),
                ]);
            }
            
            array_push($dataUrl, [
                'id_main_menu' => $main['id'],
                'name_main_menu' => $main['name_main_menu'],
                // 'main_url' => $main['main_url'],
                'no_urut_main_menu' => $main['no_urut_main_menu'],
                'sub_menu' => $sub_menu,
            ]);
        }

        echo json_encode($dataUrl); die;
        // $main_menu = $this->mUrl->getUrl(null, 'main');
        // $dataUrl = [];

        // foreach ($main_menu as $main) {
        //     # code...
        //     $data_sub_menu = [];
        //     $sub_menu = [];
        //     $data_sub_menu = $this->mUrl->getUrl(['tb_sub_menu.id_main_menu' => $main['id']], 'sub');
        //     foreach ($data_sub_menu as $sub) {
        //         # code...
        //         array_push($sub_menu,[
        //             'id_sub_menu' => $sub['id'],
        //             'name_sub_menu' => $sub['name_sub_menu'],
        //             'sub_url' => $sub['sub_url'],
        //             'no_urut_sub_menu' => $sub['no_urut_sub_menu'],
        //             'subsub_menu' => $this->mUrl->getUrl(['id_sub_menu' => $sub['id']], 'subsub'),
        //         ]);
        //     }
            
        //     array_push($dataUrl, [
        //         'id_main_menu' => $main['id'],
        //         'name_main_menu' => $main['name_main_menu'],
        //         // 'main_url' => $main['main_url'],
        //         'no_urut_main_menu' => $main['no_urut_main_menu'],
        //         'sub_menu' => $sub_menu,
        //     ]);
        // }
        // // echo json_encode($dataUrl);

        // foreach ($dataUrl as $main) {
        //     # code...
        //     foreach ($main['sub_menu'] as $sub) {
        //         # code...
        //         if (count($sub['subsub_menu']) != 0) {
        //             echo "!null : (".$sub['name_sub_menu'].")";
        //             echo "</br>";
        //             // foreach ($sub['subsub_menu'] as $subsub) :
        //                 //     # code...
        //                 // endforeach;
        //         } else {
        //             echo "null: (".$sub['name_sub_menu'].")";
        //             echo count($sub['subsub_menu']);
        //             echo "</br>";
        //         }
        //     }
        // }
    }

    public function kodeDinas()
    {
        parent::MasterView('rekening_dasar/kode_dinas/kode_dinas', []);
    }

    public function kodeUrusan()
    {
        parent::MasterView('rekening_dasar/kode_urusan/kode_urusan', []);
    }

    public function kodeBidang()
    {
        parent::MasterView('rekening_dasar/kode_bidang/kode_bidang', []);
    }

    public function kodeKegiatan()
    {
        parent::MasterView('rekening_dasar/kode_kegiatan/kode_kegiatan', []);
    }

    public function kodeProgram()
    {
        parent::MasterView('rekening_dasar/kode_program/kode_program', []);
    }

    public function kodeUnit()
    {
        parent::MasterView('rekening_dasar/kode_unit/kode_unit', []);
    }
}