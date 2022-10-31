<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelHakAkses;
use App\Models\ModelUser;

class HakAkses extends BaseController{
    public function __construct()
    {
        $this->mRole = new ModelHakAkses();
    }

    public function index () {
        echo json_encode($this->mRole->getRoleAkses(null));
    }

    public function getMenu (){
        echo json_encode($this->mRole->getMenu());
    }

// untuk mengatur menu apa saja yang bisa diakses oleh user
    // public function test(){
    //     $dataHakAkses = $this->mRole->getRoleAkses(['id_user' => 6]);
    //     // echo json_encode($dataHakAkses);
    //     // die;
    //     foreach ($this->testData() as $main) {
    //         # code...
    //         foreach ($dataHakAkses as $hak_akses) {
    //             # code...
    //             # code...
    //             foreach ($main['sub_menu'] as $sub) {
    //                 # code...
    //                 if ($hak_akses['id_sub_menu'] == $sub['id_sub_menu']) {
    //                     echo $sub['name_sub_menu'] . "</br>";
    //                 }
    //             }
    //         }
    //     }
    // }

    // private function testData(){
    //     $data = [];

    //     $mUrl = new ModelUrl();
    //     $levelUrl = 'main';

    //     $url = $mUrl->getUrl(null, $levelUrl);
    //     $dataUrl = [];

    //     foreach ($url as $main) {
    //         # code...
    //         $sub_menu = [];
    //         $data_sub_menu = $mUrl->getUrl(['tb_sub_menu.id_main_menu' => $main['id']], 'sub');
    //         foreach ($data_sub_menu as $sub) {
    //             # code...
    //             $sub_sub_menu = [];
    //             $data_sub_sub_menu = $mUrl->getUrl(['id_sub_menu' => $sub['id']], 'subsub');
    //             foreach ($data_sub_sub_menu as $subsub) {
    //                 # code...
    //                 array_push($sub_sub_menu,[
    //                     'id_sub_sub_menu' => $subsub['id'],
    //                     'name_sub_sub_menu' => $subsub['name_sub_sub_menu'],
    //                     'sub_sub_url' => $subsub['sub_sub_url'],
    //                     'no_urut_sub_sub_menu' => $subsub['no_urut_sub_sub_menu'],
    //                     'kategori' => $mUrl->getUrl(['id_sub_sub_menu' => $subsub['id']], 'kategori'),
    //                 ]);
    //             }
    //             array_push($sub_menu,[
    //                 'id_sub_menu' => $sub['id'],
    //                 'name_sub_menu' => $sub['name_sub_menu'],
    //                 'sub_url' => $sub['sub_url'],
    //                 'no_urut_sub_menu' => $sub['no_urut_sub_menu'],
    //                 'subsub_menu' => $sub_sub_menu,
    //             ]);
    //         }
            
    //         array_push($dataUrl, [
    //             'id_main_menu' => $main['id'],
    //             'name_main_menu' => $main['name_main_menu'],
    //             'no_urut_main_menu' => $main['no_urut_main_menu'],
    //             'sub_menu' => $sub_menu,
    //         ]);
    //     }
	// 	return $dataUrl;
    // }
// untuk mengatur menu apa saja yang bisa diakses oleh user
}