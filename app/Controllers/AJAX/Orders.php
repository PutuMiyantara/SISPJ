<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelKodeBelanjaSub5;
use App\Models\ModelOrders;
use App\Models\ModelRekanan;

class Orders extends BaseController{
    public function __construct()
    {
        $this->mOrders = new ModelOrders();
    }

    public function index()
    {
        echo json_encode($this->mOrders->getOrders(null));
    }

    public function insertData(){
        $dataJSON = $this->request->getJSON(true);
        $modelRekanan = new ModelRekanan();
        $errortext[] ='';
        $message = '';
        $dataOrders = array(
            'no_pesanan	' => $dataJSON['no_pesanan'],
            'tgl_pesanan' => $dataJSON['tgl_pesanan'],
            'id_rekening_dasar' => $dataJSON['id_rekening_dasar'],
            'id_kode_belanja_sub5' => $dataJSON['id_kode_belanja_sub5'],
            'id_rekanan' => $dataJSON['id_rekanan'],
            'jenis_barang' => $dataJSON['jenis_barang'],
            'jumlah_barang' => $dataJSON['jumlah_barang'],
            'jenis_satuan_barang' => $dataJSON['jenis_satuan_barang'],
            'uraian_pesanan' => $dataJSON['uraian_pesanan']
        );

        // cek apahah rekanan sudah terdapat di dalam database atau belum
        if ($dataJSON['id_rekanan'] == 'undefined') {
            $dataRekanan = array(
                'instansi_rekanan' => $dataJSON['instansi_rekanan'],
                'alamat_rekanan' => $dataJSON['alamat_rekanan'],
                'no_telp_rekanan' => $dataJSON['no_telp_rekanan'],
                'nama_rekanan' => $dataJSON['nama_rekanan'],
                'bank_rekanan' => $dataJSON['bank_rekanan'],
                'no_rekening_rekanan' => $dataJSON['no_rekening_rekanan'],
                'npwp' => $dataJSON['npwp'],
                'jabatan' => $dataJSON['jabatan']
            );
            if ($this->validator->run($dataRekanan, 'rekanan')) {
                if ($modelRekanan->insertData($dataRekanan)) {
                    $message = 'Berhasil Menyimpan Data Rekanan';
                    $where = array('instansi_rekanan' => $dataJSON['instansi_rekanan']);
                    $dataRekanan = $modelRekanan->getRekanan($where);
                    foreach ($dataRekanan as $key) {
                        $dataOrders['id_rekanan'] = $key->id;
                    }
                } else{
                    $errortext[] = 'Gagal Memasukan Data Rekanan';
                }
            } else{
                $errortext[] = implode(', ', $this->validator->getErrors());
            }
            
        }
        
        if ($this->validator->run($dataOrders, 'orders')) {
            if ($this->mOrders->insertData($dataOrders)) {
                # code...
                $message = 'Berhasil Menyimpan Data Orders';
            } else{
                $errortext[] = 'Gagal Memasukan Data Orders';
            }
        } else{
            var_dump('galgal validasi data');
            die;
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function getDetail($id){
        $where = array('tb_orders.id' => $id);
        echo json_encode($this->mOrders->getOrders($where));
    }
    
    public function updateData($id){
        $dataJSON = $this->request->getJSON(true);
        $modelRekanan = new ModelRekanan();
        $errortext[] ='';
        $message = '';
        $dataOrders = array(
            'no_pesanan	' => $dataJSON['no_pesanan'],
            'tgl_pesanan' => $dataJSON['tgl_pesanan'],
            'id_rekening_dasar' => $dataJSON['id_rekening_dasar'],
            'id_kode_belanja_sub5' => $dataJSON['id_kode_belanja_sub5'],
            'id_rekanan' => $dataJSON['id_rekanan'],
            'jenis_barang' => $dataJSON['jenis_barang'],
            'jumlah_barang' => $dataJSON['jumlah_barang'],
            'jenis_satuan_barang' => $dataJSON['jenis_satuan_barang'],
            'uraian_pesanan' => $dataJSON['uraian_pesanan']
        );

        // cek apahah rekanan sudah terdapat di dalam database atau belum
        if ($dataJSON['id_rekanan'] == 'undefined') {
            $dataRekanan = array(
                'instansi_rekanan' => $dataJSON['instansi_rekanan'],
                'alamat_rekanan' => $dataJSON['alamat_rekanan'],
                'no_telp_rekanan' => $dataJSON['no_telp_rekanan'],
                'nama_rekanan' => $dataJSON['nama_rekanan'],
                'bank_rekanan' => $dataJSON['bank_rekanan'],
                'no_rekening_rekanan' => $dataJSON['no_rekening_rekanan'],
                'npwp' => $dataJSON['npwp'],
                'jabatan' => $dataJSON['jabatan']
            );
            if ($this->validator->run($dataRekanan, 'rekanan')) {
                if ($modelRekanan->insertData($dataRekanan)) {
                    $message = 'Berhasil Menyimpan Data Rekanan';
                    $where = array('instansi_rekanan' => $dataJSON['instansi_rekanan']);
                    $dataRekanan = $modelRekanan->getRekanan($where);
                    foreach ($dataRekanan as $key) {
                        $dataOrders['id_rekanan'] = $key->id;
                    }
                } else{
                    $errortext[] = 'Gagal Memasukan Data Rekanan';
                }
            } else{
                $errortext[] = implode(', ', $this->validator->getErrors());
            }
            
        }
        
        if ($this->validator->run($dataOrders, 'orders')) {
            $id = array('id' => $id);
            if ($this->mOrders->updateData($id, $dataOrders)) {
                # code...
                $message = 'Berhasil Mengubah Data Orders';
            } else{
                $errortext[] = 'Gagal Mengubah Data Orders';
            }
        } else{
            var_dump('galgal validasi data edit');
            die;
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function deleteData(){
        $where = $this->request->getJSON(true);
        $this->mOrders->deleteData($where);
        return true;
    }

    public function searchReBelanja($id){
        $modelBelanja = new ModelKodeBelanjaSub5();
        if ($id == 0) {
            # code...
            die;
        }
        $where = array('id_rekening_dasar' => $id);
        $rek_referensi = $modelBelanja->getKodeBelanjaSub5($where);
        $dataArray = $rek_referensi;
        $data = [];
        foreach ($dataArray as $row) {
            array_push($data,
                [
                    'id' => $row['id'],
                    'kode_belanja' => (
                        $row['kode_belanja_sub1']. "." .
                        $row['kode_belanja_sub2']. "." .
                        $row['kode_belanja_sub3']. "." .
                        $row['kode_belanja_sub4']. "." .
                        $row['kode_belanja_sub5']. " - " .
                        $row['nama_rekening_belanja_sub5']. " (" .
                        $row['tahun_anggaran']. ")" )
                ]);
        }
        echo json_encode($data);
    }

    public function getInstansiRekanan(){
        echo json_encode($this->mOrders->getInstansiRekanan());
    }
}