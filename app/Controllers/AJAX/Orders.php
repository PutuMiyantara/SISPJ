<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelKodeBelanjaSub5;
use App\Models\ModelOrders;
use App\Models\ModelRekanan;
use Mpdf\Mpdf;

class Orders extends BaseController{
    public function __construct()
    {
        $this->mOrders = new ModelOrders();
        $this->mRekanan = new ModelRekanan();
    }

    public function index()
    {
        echo json_encode($this->mOrders->getOrders(null));
    }

    public function insertData(){
        $cache = \Config\Services::cache();
        $dataJSON = $this->request->getJSON(true);
        $modelRekanan = new ModelRekanan();
        $errortext[] ='';
        $message = '';
        $dataOrders = array(
            'no_pesanan' => $dataJSON['no_pesanan'],
            'id_kode_belanja_sub5' => $dataJSON['id_kode_belanja_sub5'],
            'id_kpa_ppk' => $dataJSON['id_kpa_ppk'],
            'id_rekanan' => $dataJSON['id_rekanan'],
            'id_rekening_dasar' => $dataJSON['id_rekening_dasar'],
            'tgl_pesanan' => $dataJSON['tgl_pesanan'],
            'uraian_pesanan' => $dataJSON['uraian_pesanan']
        );

        // echo json_encode($dataOrders);
        // die;

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
        // insert data ke table orders
        if ($this->validator->run($dataOrders, 'orders')) {
            if (! $idOrderCache = cache('idOrderCache')) {
                // Save into the cache for 5 minutes
                $idOrderCache = $this->mOrders->insertData($dataOrders);
                cache()->save('idOrderCache', $idOrderCache, 200);
                $idOrder = $cache->get('idOrderCache');
                $this->insertBarang($dataJSON, $idOrder);
            }
            if ($idOrderCache != null) {
                # code...
                $message = 'Berhasil Menyimpan Data Orders';
            } else{
                $errortext[] = 'Gagal Memasukan Data Orders';
            }
        } else{
            $errortext[] = implode(', ', $this->validator->getErrors());
        }
        $cache->clean();
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
        $dataBarang = array();
        $id_barang = array();
        $dataInsertBarang = [];
        $message = '';
        $dataOrders = array(
            'no_pesanan' => $dataJSON['no_pesanan'],
            'id_kode_belanja_sub5' => $dataJSON['id_kode_belanja_sub5'],
            'id_kpa_ppk' => $dataJSON['id_kpa_ppk'],
            'id_rekanan' => $dataJSON['id_rekanan'],
            'id_rekening_dasar' => $dataJSON['id_rekening_dasar'],
            'tgl_pesanan' => $dataJSON['tgl_pesanan'],
            'uraian_pesanan' => $dataJSON['uraian_pesanan']
        );
        // (REKANAN) cek apahah rekanan sudah terdapat di dalam database atau belum
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
        if ($dataJSON['id_rekanan'] == 'undefined') {
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
        } else{
            // update data rekanan 
            $where = array('id' => $dataOrders['id_rekanan']);
            if ($this->validator->run($dataRekanan, 'rekanan')) {
                # code...
                if ($this->mRekanan->updateData($where, $dataRekanan)) {
                    # code...
                    $message = "Berhasil Menyimpan Data";
                } else{
                    $errortext[] ='Gagal Menyimpan Data';
                }
            } else{
                $errortext[] = implode(', ', $this->validator->getErrors());
            }
        }
        // (REKANAN) 

        // update data ke table orders
        if ($this->validator->run($dataOrders, 'orders')) {
            $id = array('id' => $id);
            if ($this->mOrders->updateData($id, $dataOrders)) {
                # code...
                // update data rekanan
                // update data ke table barang
                for ($i=0; $i < sizeof($dataJSON['jenis_barang']); $i++) { 
                    # code...
                    $id_barang = array('id_barang' => $dataJSON['id_barang'][$i]);
                    $dataBarang = array(
                        'id_orders' => $id,
                        'jenis_barang' => $dataJSON['jenis_barang'][$i],
                        'jumlah_barang' => $dataJSON['jumlah_barang'][$i],
                        'jenis_satuan_barang' => $dataJSON['jenis_satuan_barang'][$i]
                    );
                    if ($this->validator->run($dataBarang, 'barang')) {
                        # code...
                        if ($id_barang['id_barang'] == null) {
                            # code...
                            array_push($dataInsertBarang, $dataBarang);
                        } else {
                            # code...
                            $this->mOrders->updateBarang($id_barang, $dataBarang);
                        }
                    }
                    else {
                        # code...
                        $errortext[] = implode(', ', $this->validator->getErrors());
                    }
                }
                if (sizeof($dataInsertBarang) > 0) {
                    # code...
                    if ($this->mOrders->insertBarang($dataInsertBarang)) {
                        # code...
                        $message = 'Berhasil Mengubah Data Orders';
                    } else {
                        # code...
                        $errortext[] = 'Gagal Mengubah Data Orders';
                    }
                }
            } else{
                $errortext[] = 'Gagal Mengubah Data Orders';
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
        $whereBarang = array('id_orders' => $where['id']);
        $this->mOrders->deleteBarang($whereBarang);
        $this->mOrders->deleteData($where);
        return true;
    }

    public function cetakOrders($where){
        $whereOrder = array('tb_orders.id' => $where);
        $whereBarang = array('id_orders' => $where);
        $dataOrders = $this->mOrders->ordersPrint($whereOrder);
        $dataBarang = $this->mOrders->barangPrint($whereBarang);

        // echo json_encode($dataOrders); die;

        foreach ($dataOrders as $key) {
            # code...
            $no_pesanan = $key->no_pesanan;
        }

        $mpdf = new Mpdf();
        $viewHtml  = view('orders/printOrders', ['dOrders'=>$dataOrders, 'dBarang'=>$dataBarang, 2]);
        $mpdf->WriteHTML($viewHtml);
        $mpdf->shrink_tables_to_fit = 1;

        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('Pesanan('. $no_pesanan .').pdf','I');
    }
// cetak order sudah bener
    // public function cetakOrders($where){
    //     $where = array('tb_orders.id' => $where);
    //     $data = $this->mOrders->getOrders($where);
    //     $no_orders = '1';
    //     // $mpdf = new Mpdf([
    //     //     'default_font_size' => 8,
    //     //     // 'default_font' => 'Times New Roman'
    //     // ]);
    //     // $uang = ucfirst($this->cMataUang->terbilang($nominal));
    //     $mpdf = new Mpdf();
    //     $viewHtml  = view('orders/printOrders', ['dOrders'=>$data, 2]);
    //     $mpdf->WriteHTML($viewHtml);
    //     $mpdf->shrink_tables_to_fit = 1;

    //     $this->response->setHeader('Content-Type', 'application/pdf');
    //     $mpdf->Output('Orders('. $no_orders .').pdf','I');
    // }

    public function testDataOrders($where){
        $where = array('tb_orders.id' => $where);
        $data = $this->mOrders->getOrders($where);
        $no_orders = null;
        // foreach ($data as $key) {
        //     # code...
        //     $no_orders = $key->no_orders;
        // }
        echo json_encode($data);
    }


    public function searchReBelanja($id){
        $modelBelanja = new ModelKodeBelanjaSub5();
        if ($id == 0) {
            # code...
            die;
        }
        $where = array('id_rekening_dasar' => $id);
        $dataArray = $modelBelanja->getKodeBelanjaSub5($where);
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

    public function insertBarang($dataJSON, $idOrder){
        $dataBarang =  array();
        $tmpData =  array();
        $idOrder = $idOrder;

        for ($i=0; $i < sizeof($dataJSON['jenis_barang']); $i++) {
            # code...
            $tmpData['jenis_barang'] = $dataJSON['jenis_barang'][$i];
            $tmpData['jumlah_barang'] = $dataJSON['jumlah_barang'][$i];
            $tmpData['jenis_satuan_barang'] = $dataJSON['jenis_satuan_barang'][$i];
            $tmpData['id_orders'] = $idOrder;
            array_push($dataBarang, $tmpData);
            $tmpData = array();
        }
        $this->mOrders->insertBarang($dataBarang);
    }

    public function deleteBarang(){
        $where = $this->request->getJSON(true);
        $this->mOrders->deleteBarang($where);
        return true;
    }
}