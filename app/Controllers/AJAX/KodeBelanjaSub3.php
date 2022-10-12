<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelKodeBelanjaSub3;

class KodeBelanjaSub3 extends BaseController{
    public function __construct()
    {
        $this->mKodeBelanjaSub3 = new ModelKodeBelanjaSub3();
    }

    public function index()
    {
        echo json_encode($this->mKodeBelanjaSub3->getKodeBelanjaSub3(null));
    }

    public function insertData(){
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';
        $message = '';
        $validatorsub3 = '';

        if ($dataJSON['keterangan_kode_belanja_sub3'] == 'Barang') {
            # code...
            $validatorsub3 = 'kodebelanjasub3barang';
        } else{
            $validatorsub3 = 'kodebelanjasub3jasa';
        }

        if($this->validator->run($dataJSON, $validatorsub3)){
            if ($this->mKodeBelanjaSub3->insertData($dataJSON)) {
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
        $where = array('tb_kode_belanja_sub3.id' => $id);
        echo json_encode($this->mKodeBelanjaSub3->getKodeBelanjaSub3($where));
    }
    
    public function updateData($id){
        $where = array('id' => $id);
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';
        $message = '';
        $validatorsub3 = '';

        if ($dataJSON['keterangan_kode_belanja_sub3'] == 'Barang') {
            # code...
            $validatorsub3 = 'kodebelanjasub3barang';
        } else{
            $validatorsub3 = 'kodebelanjasub3jasa';
        }
        if ($this->validator->run($dataJSON, $validatorsub3)) {
            # code...
            if ($this->mKodeBelanjaSub3->updateData($where, $dataJSON)) {
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
        $this->mKodeBelanjaSub3->deleteData($where);
        return true;
    }

    public function searchReBelanjaSub2($id){
        if ($id == 0) {
            # code...
            die;
        }
        $where = array('id_kode_belanja_sub1' => $id);
        $rek_referensi = $this->mKodeBelanjaSub3->getSearchRekReferensi($where);
        $dataArray = $rek_referensi;
        $data = [];
        foreach ($dataArray as $row) {
            array_push($data,
                [
                    'id' => $row['id'],
                    'kode_belanja_sub2' => (
                        $row['kode_belanja_sub2']. " - " .
                        $row['nama_rekening_belanja_sub2']. " (" .
                        $row['tahun_anggaran']. ")" )
                ]);
        }
        echo json_encode($data);
        
    }
}