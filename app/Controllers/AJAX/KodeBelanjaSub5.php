<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelKodeBelanjaSub5;

class KodeBelanjaSub5 extends BaseController{
    public function __construct()
    {
        $this->mKodeBelanjaSub5 = new ModelKodeBelanjaSub5();
    }

    public function index()
    {
        echo json_encode($this->mKodeBelanjaSub5->getKodeBelanjaSub5(null));
    }

    public function insertData(){
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';
        $message = '';

        if($this->validator->run($dataJSON, 'kodebelanjasub5')){
            if ($this->mKodeBelanjaSub5->insertData($dataJSON)) {
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
        $where = array('tb_kode_belanja_sub5.id' => $id);
        echo json_encode($this->mKodeBelanjaSub5->getKodeBelanjaSub5($where));
    }
    
    public function updateData($id){
        $where = array('id' => $id);
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';

        $message = '';
        if ($this->validator->run($dataJSON, 'kodebelanjasub5')) {
            # code...
            if ($this->mKodeBelanjaSub5->updateData($where, $dataJSON)) {
                # code...
                $message = "Berhasil Menyimpan Data";
            } else{
                $errortext[] ='Gagal Menyimpan Data';
            }
        } else{
            $errortext[] = implode(', ', $this->validator->getErrors());
        }

        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function deleteData(){
        $where = $this->request->getJSON(true);
        $this->mKodeBelanjaSub5->deleteData($where);
        return true;
    }

    public function searchReBelanjaSub4($id){
        if ($id == 0) {
            # code...
            die;
        }
        $where = array('id_kode_belanja_sub3' => $id);
        $rek_referensi = $this->mKodeBelanjaSub5->getSearchRekReferensi($where);
        $dataArray = $rek_referensi;
        $data = [];
        foreach ($dataArray as $row) {
            array_push($data,
                [
                    'id' => $row['id'],
                    'kode_belanja_sub4' => (
                        $row['kode_belanja_sub4']. " - " .
                        $row['nama_rekening_belanja_sub4']. " (" .
                        $row['tahun_anggaran']. ")" )
                ]);
        }
        echo json_encode($data);
        
    }
}