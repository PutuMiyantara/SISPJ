<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelKpaPpk;

class KpaPpk extends BaseController{
    public function __construct()
    {
        $this->mKpaPpk = new ModelKpaPpk();
    }

    public function index($search)
    {
        $data = $this->mKpaPpk->getKpaPpk(null);
        $result = [];
        if ($search == 'search') {
            # code...
            foreach ($data as $key) {
                # code...
                array_push($result,
                [
                    'id' => $key['id'],
                    'kpa_ppk' => (
                        $key['nip_kpa_ppk']. " - " .
                        $key['nama_kpa_ppk']. "( " .
                        $key['bidang_kpa_ppk']. " )")
                ]);
            }
        } elseif ($search == 'getAll') {
            # code...
            $result = $data;

        }
        echo json_encode($result);
    }

    public function insertData(){
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';
        $message = '';

        if($this->validator->run($dataJSON, 'kpappk')){
            if ($this->mKpaPpk->insertData($dataJSON)) {
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
        $where = array('id' => $id);
        echo json_encode($this->mKpaPpk->getKpaPpk($where));
    }
    
    public function updateData($id){
        $where = array('id' => $id);
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';

        $message = '';
        if ($this->validator->run($dataJSON, 'kpappk_edit')) {
            # code...
            if ($this->mKpaPpk->updateData($where, $dataJSON)) {
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
        $this->mKpaPpk->deleteData($where);
        return true;
    }


}