<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\Modelpptk;

class Pptk extends BaseController{
    public function __construct()
    {
        $this->mPptk = new Modelpptk();
    }

    public function index($search)
    {
        $data = $this->mPptk->getPptk(null);
        $result = [];
        if ($search == 'search') {
            # code...
            foreach ($data as $key) {
                # code...
                array_push($result,
                [
                    'id' => $key['id'],
                    'pptk' => (
                        $key['nip_pptk']. " - " .
                        $key['nama_pptk'])
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

        if($this->validator->run($dataJSON, 'pptk')){
            if ($this->mPptk->insertData($dataJSON)) {
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
        echo json_encode($this->mPptk->getPptk($where));
    }
    
    public function updateData($id){
        $where = array('id' => $id);
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';

        $message = '';
        if ($this->validator->run($dataJSON, 'pptk_edit')) {
            # code...
            if ($this->mPptk->updateData($where, $dataJSON)) {
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
        $this->mPptk->deleteData($where);
        return true;
    }


}