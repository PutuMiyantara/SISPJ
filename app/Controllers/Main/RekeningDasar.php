<?php

namespace App\Controllers\Main;
use App\Controllers\BaseController;
use App\Models\ModelUrl;

class RekeningDasar extends BaseController
{
    public function index()
    {
        parent::MasterView('rekening_dasar/rekening_dasar', [
            'dataUrl' => parent::manageUrl(), 
        ]);
    }

    public function testData (){
        $mUrl = new ModelUrl();
        $levelUrl = 'main';

        $url = $mUrl->getUrl(null, $levelUrl);
        $dataUrl = [];

        foreach ($url as $main) {
            # code...
            $sub_menu = [];
            $data_sub_menu = $mUrl->getUrl(['tb_sub_menu.id_main_menu' => $main['id']], 'sub');
            foreach ($data_sub_menu as $sub) {
                # code...
                $sub_sub_menu = [];
                $data_sub_sub_menu = $mUrl->getUrl(['id_sub_menu' => $sub['id']], 'subsub');
                foreach ($data_sub_sub_menu as $subsub) {
                    # code...
                    array_push($sub_sub_menu,[
                        'id_sub_sub_menu' => $subsub['id'],
                        'name_sub_sub_menu' => $subsub['name_sub_sub_menu'],
                        'sub_sub_url' => $subsub['sub_sub_url'],
                        'no_urut_sub_sub_menu' => $subsub['no_urut_sub_sub_menu'],
                        'kategori' => $mUrl->getUrl(['id_sub_sub_menu' => $subsub['id']], 'kategori'),
                    ]);
                }
                array_push($sub_menu,[
                    'id_sub_menu' => $sub['id'],
                    'name_sub_menu' => $sub['name_sub_menu'],
                    'sub_url' => $sub['sub_url'],
                    'no_urut_sub_menu' => $sub['no_urut_sub_menu'],
                    'subsub_menu' => $sub_sub_menu,
                ]);
            }
            
            array_push($dataUrl, [
                'id_main_menu' => $main['id'],
                'name_main_menu' => $main['name_main_menu'],
                'no_urut_main_menu' => $main['no_urut_main_menu'],
                'sub_menu' => $sub_menu,
            ]);
        }
		echo json_encode($dataUrl);
    }

    public function kodeDinas()
    {
        parent::MasterView('rekening_dasar/kode_dinas/kode_dinas', [
            'dataUrl' => parent::manageUrl(), 
        ]);
    }

    public function kodeUrusan()
    {
        parent::MasterView('rekening_dasar/kode_urusan/kode_urusan', ['dataUrl' => parent::manageUrl()]);
    }

    public function kodeBidang()
    {
        parent::MasterView('rekening_dasar/kode_bidang/kode_bidang', ['dataUrl' => parent::manageUrl(null)]);
    }

    public function kodeKegiatan()
    {
        parent::MasterView('rekening_dasar/kode_kegiatan/kode_kegiatan', ['dataUrl' => parent::manageUrl(null)]);
    }

    public function kodeProgram()
    {
        parent::MasterView('rekening_dasar/kode_program/kode_program', ['dataUrl' => parent::manageUrl(null)]);
    }

    public function kodeUnit()
    {
        parent::MasterView('rekening_dasar/kode_unit/kode_unit', ['dataUrl' => parent::manageUrl(null)]);
    }
}