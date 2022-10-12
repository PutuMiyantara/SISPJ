<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelRekeningDasar;

class RekeningDasar extends BaseController{
    public function __construct()
    {
        $this->mRekeningDasar = new ModelRekeningDasar();
    }

    public function index($tahun)
    {
        if ($tahun == 1) {
            # code...
            echo json_encode($this->mRekeningDasar->getRekeningDasar(null));
        } else{
            $where = array('tahun_anggaran' => $tahun);
            echo json_encode($this->mRekeningDasar->getRekeningDasar($where));
        }
    }

    public function insertData(){
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';
        $message = '';

        if($this->validator->run($dataJSON, 'koderekeningdasar')){
            if ($this->mRekeningDasar->insertData($dataJSON)) {
                $message = 'Berhasil Menyimpan Data';
            }
            else{
                $errortext[] = 'Gagal Memasukan Data';
            }
        } else{
            $errortext[] = implode(', ', $this->validator->getErrors());
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function getDetail($id){
        $where = array('tb_rekening_dasar.id' => $id);
        echo json_encode($this->mRekeningDasar->getRekeningDasar($where));
    }
    
    public function getTahunAnggaran(){
        echo json_encode($this->mRekeningDasar->getTahunAnggaran());
    }

    public function updateData($id){
        $where = array('id' => $id);
        $wGetData = array('tb_rekening_dasar.id' => $id);
        $c_unique = true;
        $errortext[] ='';
        $message = '';
        $dataJSON = $this->request->getJSON(true);
        $dataRekDasarDetail = $this->mRekeningDasar->getRekeningDasar($wGetData);
        $dataRekDasar = $this->mRekeningDasar->getRekeningDasar(null);

        if ($this->validator->run($dataJSON, 'koderekeningdasaredit')) {
            # code...
            foreach ($dataRekDasarDetail as $key) {
                # code...
                if ($key->id == $id && $key->tahun_anggaran ==  $dataJSON['tahun_anggaran']) {
                    # code...
                    $c_unique = true;
                } else{
                    foreach ($dataRekDasar as $key) {
                        # code...
                        if ($key->tahun_anggaran == $dataJSON['tahun_anggaran']) {
                            # code...
                            $c_unique = false;
                        }
                    }
                }
            }
            if ($c_unique == true) {
                # code...
                if ($this->mRekeningDasar->updateData($where, $dataJSON)) {
                    # code...
                    $message = "Berhasil Menyimpan Data";
                } else{
                    $errortext[] ='Gagal Menyimpan Data';
                }
            } else{
                $errortext[] = implode(', ', ["Tahun Anggaran Sudah Terdapat Didalam Database"]);
            }
        } else{
            $errortext[] = implode(', ', $this->validator->getErrors());
        }

        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    // public function updateData($id){
    //     $where = array('id' => $id);
    //     $dataJSON = $this->request->getJSON(true);
    //     $errortext[] ='';
    //     $c_unique = true;
    //     $message = '';
    //     if ($this->validator->run($dataJSON, 'koderekeningdasaredit')) {
    //         # code...

            
    //         if ($this->mRekeningDasar->updateData($where, $dataJSON)) {
    //             # code...
    //             $message = "Berhasil Menyimpan Data";
    //         } else{
    //             $errortext[] ='Gagal Menyimpan Data';
    //         }
    //     } else{
    //         $errortext[] = implode(', ', $this->validator->getErrors());
    //     }

    //     $validationtext = implode('', $errortext);
    //     $output = array('errortext' => $validationtext, 'message' => $message);
    //     echo json_encode($output);
    // }

    public function deleteData(){
        $where = $this->request->getJSON(true);
        $this->mRekeningDasar->deleteData($where);
        return true;
    }


}