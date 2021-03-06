<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelKodeBelanjaSub2;

class KodeBelanjaSub2 extends BaseController{
    public function __construct()
    {
        $this->mKodeBelanjaSub2 = new ModelKodeBelanjaSub2();
    }

    public function index()
    {
        echo json_encode($this->mKodeBelanjaSub2->getKodeBelanjaSub2(null));
    }

    public function insertData(){
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';
        $message = '';

        if($this->validator->run($dataJSON, 'kodebelanjasub2')){
            if ($this->mKodeBelanjaSub2->insertData($dataJSON)) {
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
        $where = array('tb_kode_belanja_sub2.id' => $id);
        echo json_encode($this->mKodeBelanjaSub2->getKodeBelanjaSub2($where));
    }
    
    public function updateData($id){
        $where = array('id' => $id);
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';

        $message = '';
        if ($this->validator->run($dataJSON, 'kodebelanjasub2')) {
            # code...
            if ($this->mKodeBelanjaSub2->updateData($where, $dataJSON)) {
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
        $this->mKodeBelanjaSub2->deleteData($where);
        return true;
    }

    public function searchReBelanjaSub1($id){
        if ($id == 0) {
            # code...
            die;
        }
        $where = array('id_rekening_dasar' => $id);
        $rek_referensi = $this->mKodeBelanjaSub2->getSearchRekReferensi($where);
        $dataArray = $rek_referensi;
        $data = [];
        foreach ($dataArray as $row) {
            array_push($data,
                [
                    'id' => $row['id'],
                    'nama_rekening_belanja_sub1' => $row['nama_rekening_belanja_sub1'],
                    'kode_belanja_sub1' => (
                        $row['kode_belanja_sub1']. " - " .
                        $row['nama_rekening_belanja_sub1']. " (" .
                        $row['tahun_anggaran']. ")" ),
                    'kode_rek_dasar' => (
                        $row['kode_rek_dinas']. "." .
                        $row['kode_rek_urusan']. "." .
                        $row['kode_rek_bidang']. "." .
                        $row['kode_rek_program']. "." .
                        $row['kode_rek_kegiatan']. "." .
                        $row['kode_rek_unit']. " - " .
                        $row['nama_rekening_dasar']),
                    'tahun_anggaran' => $row['tahun_anggaran']
                ]);
        }
        echo json_encode($data);
        
    }
}