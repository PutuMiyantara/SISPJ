<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelBendahara;

class Bendahara extends BaseController{
    public function __construct()
    {
        $this->mBendahara = new ModelBendahara();
    }

    public function index($search)
    {
        $data = $this->mBendahara->getBendahara(null);
        $result = [];
        if ($search == 'search') {
            # code...
            foreach ($data as $key) {
                # code...
                array_push($result,
                [
                    'id' => $key['id'],
                    'bendahara' => (
                        $key['nip_bendahara']. " - " .
                        $key['nama_bendahara'])
                ]);
            }
        } else{
            $result = $data;
        }
        echo json_encode($result);
    }

    public function insertData(){
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';
        $message = '';

        if($this->validator->run($dataJSON, 'bendahara')){
            if ($this->mBendahara->insertData($dataJSON)) {
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
        echo json_encode($this->mBendahara->getBendahara($where));
    }
    
    public function updateData($id){
        $where = array('id' => $id);
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';

        $message = '';
        if ($this->validator->run($dataJSON, 'bendahara_edit')) {
            # code...
            if ($this->mBendahara->updateData($where, $dataJSON)) {
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
        $this->mBendahara->deleteData($where);
        return true;
    }


}