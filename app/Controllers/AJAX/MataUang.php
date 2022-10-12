<?php

namespace App\Controllers\AJAX;

use App\Controllers\BaseController;
use App\Models\ModelKodeBelanjaSub5;
use App\Models\ModelKuwitansi;
use App\Models\ModelOrders;
use App\Models\ModelRekanan;
use Mpdf\Mpdf;

class MataUang extends BaseController{
    public function penyebut($nilai){
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $tmp = "";

        if ($nilai < 12) {
            # code...
            $tmp = " " . $huruf[$nilai];
        } elseif ($nilai < 20){
            $tmp = $this->penyebut($nilai - 10). " belas";
        } elseif ($nilai < 100){
            $tmp = $this->penyebut($nilai/10) . " puluh" . $this->penyebut($nilai%10);
        } elseif ($nilai < 200){
            $tmp = " seratus" . $this->penyebut($nilai-100);
        } elseif ($nilai < 1000){
            $tmp = $this->penyebut($nilai/100) . " ratus" . $this->penyebut($nilai%100);
        } elseif ($nilai < 2000){
            $tmp = " seribu" . $this->penyebut($nilai-1000);
        } elseif ($nilai < 1000000) {
            $tmp = $this->penyebut($nilai/1000) . " ribu" . $this->penyebut($nilai%1000);
        } elseif ($nilai < 1000000000) {
            $tmp = $this->penyebut($nilai/1000000) . " juta" . $this->penyebut($nilai%1000000);
        } elseif ($nilai < 1000000000000) {
            $tmp = $this->penyebut($nilai/1000000000) . " miliar" . $this->penyebut(fmod($nilai, 1000000000));
        } elseif ($nilai < 1000000000000000) {
            $tmp = $this->penyebut($nilai/1000000000000) . " triliun" . $this->penyebut(fmod($nilai, 1000000000000));
        }
        return $tmp;
    }

    public function terbilang($nilai){
        // var_dump("tesst:" . $this->penyebut($nilai));
        $hasil = null;
        if ($nilai < 0) {
            # code...
            $hasil = "minus" . $this->penyebut($nilai);
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }
}