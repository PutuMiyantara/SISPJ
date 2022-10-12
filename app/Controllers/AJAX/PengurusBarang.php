<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelPengurusBarang;

class PengurusBarang extends BaseController{
    public function __construct()
    {
        $this->mPengurusBarang = new ModelPengurusBarang();
    }

    public function index($search)
    {
        $data = $this->mPengurusBarang->getPengurusBarang(null);
        $result = [];
        if ($search == 'search') {
            # code...
            foreach ($data as $key) {
                # code...
                array_push($result,
                [
                    'id' => $key['id'],
                    'pengurus_barang' => (
                        $key['nip_pengurus_barang']. " - " .
                        $key['nama_pengurus_barang'])
                ]);
            }
        } else{
            $result = $data;
        }
        echo json_encode($result);
    }

    public function test(){
        var_dump('test');
    }

    public function insertData(){
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';
        $message = '';

        if($this->validator->run($dataJSON, 'pengurus_barang')){
            if ($this->mPengurusBarang->insertData($dataJSON)) {
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
        echo json_encode($this->mPengurusBarang->getPengurusBarang($where));
    }
    
    public function updateData($id){
        $where = array('id' => $id);
        $dataJSON = $this->request->getJSON(true);
        $errortext[] ='';

        $message = '';
        if ($this->validator->run($dataJSON, 'pengurus_barang_edit')) {
            # code...
            if ($this->mPengurusBarang->updateData($where, $dataJSON)) {
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
        $this->mPengurusBarang->deleteData($where);
        return true;
    }


}