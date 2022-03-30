<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelKodeBelanjaSub5;
use App\Models\ModelKuwitansi;
use App\Models\ModelOrders;
use App\Models\ModelRekanan;
use Mpdf\Mpdf;

class Kuwitansi extends BaseController{
    public function __construct()
    {
        $this->mKuwitansi = new ModelKuwitansi();
    }

    public function index()
    {
        echo json_encode($this->mKuwitansi->getKuwitansi(null));
    }

    public function insertData(){
        $dataJSON = $this->request->getJSON(true);
        $modelRekanan = new ModelRekanan();
        $errortext[] ='';
        $message = '';
        
        $dataKuwitansi = array(
            'no_kuwitansi' => $dataJSON['no_kuwitansi'],
            'tgl_kuwitansi' => $dataJSON['tgl_kuwitansi'],
            'id_rekening_dasar' => $dataJSON['id_rekening_dasar'],
            'id_kode_belanja_sub5' => $dataJSON['id_kode_belanja_sub5'],
            'nominal' => $dataJSON['nominal'],
            'uraian_belanja' => $dataJSON['uraian_belanja'],
            'dasar_spj_bukti' => $dataJSON['dasar_spj_bukti'],
            'id_rekanan' => $dataJSON['id_rekanan'],
            'keterangan_spj' => $dataJSON['keterangan_spj'],
            'status_spj' => $dataJSON['status_spj'],
            'keterangan' => $dataJSON['keterangan'],
            'id_order' => $dataJSON['id_order']
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
                        $dataKuwitansi['id_rekanan'] = $key->id;
                    }
                } else{
                    $errortext[] = 'Gagal Memasukan Data Rekanan';
                }
            } else{
                $errortext[] = implode(', ', $this->validator->getErrors());
            }
            
        }
        
        if ($this->validator->run($dataKuwitansi, 'kuwitansi')) {
            if ($this->mKuwitansi->insertData($dataKuwitansi)) {
                # code...
                $message = 'Berhasil Menyimpan Data Kuwitansi';
            } else{
                $errortext[] = 'Gagal Memasukan Data Kuwitansi';
            }
        } else{
            // var_dump('galgal validasi data');
            $errortext[] = implode(', ', $this->validator->getErrors());
            // die;
        }
        $validationtext = implode('', $errortext);
        $output = array('errortext' => $validationtext, 'message' => $message);
        echo json_encode($output);
    }

    public function getDetail($id){
        $where = array('tb_kuwitansi.id' => $id);
        echo json_encode($this->mKuwitansi->getKuwitansi($where));
    }
    
    public function updateData($id){
        $dataJSON = $this->request->getJSON(true);
        $modelRekanan = new ModelRekanan();
        $errortext[] ='';
        $message = '';
        
        $dataKuwitansi = array(
            'no_kuwitansi' => $dataJSON['no_kuwitansi'],
            'tgl_kuwitansi' => $dataJSON['tgl_kuwitansi'],
            'id_rekening_dasar' => $dataJSON['id_rekening_dasar'],
            'id_kode_belanja_sub5' => $dataJSON['id_kode_belanja_sub5'],
            'nominal' => $dataJSON['nominal'],
            'uraian_belanja' => $dataJSON['uraian_belanja'],
            'dasar_spj_bukti' => $dataJSON['dasar_spj_bukti'],
            'id_rekanan' => $dataJSON['id_rekanan'],
            'keterangan_spj' => $dataJSON['keterangan_spj'],
            'status_spj' => $dataJSON['status_spj'],
        );

        // echo json_encode($dataKuwitansi);
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
            if ($this->validator->run($dataJSON, 'rekanan')) {
                if ($modelRekanan->insertData($dataRekanan)) {
                    $message = 'Berhasil Menyimpan Data Rekanan';
                    $where = array('instansi_rekanan' => $dataJSON['instansi_rekanan']);
                    $dataRekanan = $modelRekanan->getRekanan($where);
                    foreach ($dataRekanan as $key) {
                        $dataKuwitansi['id_rekanan'] = $key->id;
                    }
                } else{
                    $errortext[] = 'Gagal Memasukan Data Rekanan';
                }
            } else{
                $errortext[] = implode(', ', $this->validator->getErrors());
            }
            
        }
        
        if ($this->validator->run($dataKuwitansi, 'kuwitansi')) {
            $id = array('id' => $id);
            if ($this->mKuwitansi->updateData($id, $dataKuwitansi)) {
                # code...
                $message = 'Berhasil Mengubah Data Kuwitansi';
            } else{
                $errortext[] = 'Gagal Mengubah Data Kuwitansi';
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
        $this->mKuwitansi->deleteData($where);
        return true;
    }

    public function cetakKuwitansi($where){
        $where = array('tb_kuwitansi.id' => $where);
        $data = $this->mKuwitansi->getKuwitansi($where);

        $mpdf = new Mpdf([
            'default_font_size' => 8,
            // 'default_font' => 'Times New Roman'
        ]);
        $mpdf->WriteHTML('
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>

        <body>
            <div>
                <table style="margin:auto">
                    <tr>
                        <td style="width: 4cm">Tahun Anggaran</td>
                        <td>: 2022</td>
                        <td style="width: 2cm"></td>
                        <td>Rekening Bank</td>
                        <td>: 1234567890</td>
                    </tr>
                    <tr>
                        <td>Kode Rekening</td>
                        <td>: 2 . 17 . 3 .30 . 03 . 2 . 02 . 5 . 1 . 02 . 01 . 01 . 0027</td>
                        <td></td>
                        <td>NPWP</td>
                        <td>: 1234567890</td>
                    </tr>
                    <tr>
                        <td>Nomor</td>
                        <td>: 111</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
            <hr style="border-style: solid">
            <hr style="margin-top:-7px;">
            <h2></h2>
        </body>
        </html>'
        );
        $mpdf->shrink_tables_to_fit = 1;

        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('arjun.pdf','I');
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
        echo json_encode($this->mKuwitansi->getInstansiRekanan());
    }

    public function searchOrders($id){
        $modelOrders = new ModelOrders();
        if ($id == 0) {
            # code...
            die;
        }
        $where = array('id_kode_belanja_sub5' => $id);
        $orders = $modelOrders->getOrders($where);
        $dataArray = $orders;
        $data = [];
        foreach ($dataArray as $row) {
            array_push($data,
                [
                    'id' => $row['id'],
                    'orders' => (
                        $row['no_pesanan']. " - " .
                        $row['uraian_pesanan']. ", " .
                        $row['jumlah_barang']. " " .
                        $row['jenis_satuan_barang']. "( " .
                        $row['tgl_pesanan']. ")"
                    )
                ]);
        }
        echo json_encode($data);
    }
}