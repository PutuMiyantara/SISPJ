<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelOrders extends Model
{
    public function getOrders($id){
        $db = db_connect();
        $builder = $db->table('tb_orders');
        // $builder->orderBy('no_pesanan', 'ASC');
        $builder->select('tb_orders.id, no_pesanan, tgl_pesanan, 
            tb_orders.id_rekening_dasar, nama_rekening_dasar, kode_rek_dinas, kode_rek_urusan, kode_rek_bidang, kode_rek_program, kode_rek_kegiatan, kode_rek_unit, tahun_anggaran, 
            kode_belanja_sub1, kode_belanja_sub2, kode_belanja_sub3, kode_belanja_sub4, id_kode_belanja_sub5, kode_belanja_sub5, nama_rekening_belanja_sub5, 
            id_rekanan, instansi_rekanan, nama_rekanan, no_telp_rekanan, npwp, bank_rekanan, no_rekening_rekanan, jabatan, alamat_rekanan,
            tb_orders.id_kpa_ppk, nip_kpa_ppk, nama_kpa_ppk
            ');
        $builder->join('tb_rekening_dasar', 'tb_rekening_dasar.id = tb_orders.id_rekening_dasar', 'left');
        $builder->join('tb_kpa_ppk', 'tb_kpa_ppk.id = tb_orders.id_kpa_ppk', 'left');
        $builder->join('tb_kode_dinas', 'tb_kode_dinas.id = tb_rekening_dasar.id_kode_dinas', 'left');
        $builder->join('tb_kode_urusan', 'tb_kode_urusan.id = tb_rekening_dasar.id_kode_urusan', 'left');
        $builder->join('tb_kode_bidang', 'tb_kode_bidang.id = tb_rekening_dasar.id_kode_bidang', 'left');
        $builder->join('tb_kode_program', 'tb_kode_program.id = tb_rekening_dasar.id_kode_program', 'left');
        $builder->join('tb_kode_kegiatan', 'tb_kode_kegiatan.id = tb_rekening_dasar.id_kode_kegiatan', 'left');
        $builder->join('tb_kode_unit', 'tb_kode_unit.id = tb_rekening_dasar.id_kode_unit', 'left');
        $builder->join('tb_kode_belanja_sub5', 'tb_kode_belanja_sub5.id = tb_orders.id_kode_belanja_sub5', 'left');
        $builder->join('tb_kode_belanja_sub4', 'tb_kode_belanja_sub4.id = tb_kode_belanja_sub5.id_kode_belanja_sub4', 'left');
        $builder->join('tb_kode_belanja_sub3', 'tb_kode_belanja_sub3.id = tb_kode_belanja_sub4.id_kode_belanja_sub3', 'left');
        $builder->join('tb_kode_belanja_sub2', 'tb_kode_belanja_sub2.id = tb_kode_belanja_sub3.id_kode_belanja_sub2', 'left');
        $builder->join('tb_kode_belanja_sub1', 'tb_kode_belanja_sub1.id = tb_kode_belanja_sub2.id_kode_belanja_sub1', 'left');
        $builder->join('tb_rekanan', 'tb_rekanan.id = tb_orders.id_rekanan', 'left');

        if ($id == null) {
            # code...
            $query = $builder->get();
        } else{
            $builder = $db->table('tb_barang');
            // $builder->orderBy('no_pesanan', 'ASC');
            $builder->select('tb_orders.id, id_barang, jenis_barang, jumlah_barang, jenis_satuan_barang, uraian_pesanan, 
                no_pesanan, tgl_pesanan,
                tb_orders.id_rekening_dasar, nama_rekening_dasar, kode_rek_dinas, kode_rek_urusan, kode_rek_bidang, kode_rek_program, kode_rek_kegiatan, kode_rek_unit, tahun_anggaran, 
                kode_belanja_sub1, kode_belanja_sub2, kode_belanja_sub3, kode_belanja_sub4, id_kode_belanja_sub5, kode_belanja_sub5, nama_rekening_belanja_sub5, 
                id_rekanan, instansi_rekanan, nama_rekanan, no_telp_rekanan, npwp, bank_rekanan, no_rekening_rekanan, jabatan, alamat_rekanan,
                tb_orders.id_kpa_ppk, nip_kpa_ppk, nama_kpa_ppk
                ');
            $builder->join('tb_orders', 'tb_orders.id = tb_barang.id_orders', 'right');
            $builder->join('tb_rekening_dasar', 'tb_rekening_dasar.id = tb_orders.id_rekening_dasar', 'right');
            $builder->join('tb_kpa_ppk', 'tb_kpa_ppk.id = tb_orders.id_kpa_ppk', 'right');
            $builder->join('tb_kode_dinas', 'tb_kode_dinas.id = tb_rekening_dasar.id_kode_dinas', 'right');
            $builder->join('tb_kode_urusan', 'tb_kode_urusan.id = tb_rekening_dasar.id_kode_urusan', 'right');
            $builder->join('tb_kode_bidang', 'tb_kode_bidang.id = tb_rekening_dasar.id_kode_bidang', 'right');
            $builder->join('tb_kode_program', 'tb_kode_program.id = tb_rekening_dasar.id_kode_program', 'right');
            $builder->join('tb_kode_kegiatan', 'tb_kode_kegiatan.id = tb_rekening_dasar.id_kode_kegiatan', 'right');
            $builder->join('tb_kode_unit', 'tb_kode_unit.id = tb_rekening_dasar.id_kode_unit', 'right');
            $builder->join('tb_kode_belanja_sub5', 'tb_kode_belanja_sub5.id = tb_orders.id_kode_belanja_sub5', 'right');
            $builder->join('tb_kode_belanja_sub4', 'tb_kode_belanja_sub4.id = tb_kode_belanja_sub5.id_kode_belanja_sub4', 'right');
            $builder->join('tb_kode_belanja_sub3', 'tb_kode_belanja_sub3.id = tb_kode_belanja_sub4.id_kode_belanja_sub3', 'right');
            $builder->join('tb_kode_belanja_sub2', 'tb_kode_belanja_sub2.id = tb_kode_belanja_sub3.id_kode_belanja_sub2', 'right');
            $builder->join('tb_kode_belanja_sub1', 'tb_kode_belanja_sub1.id = tb_kode_belanja_sub2.id_kode_belanja_sub1', 'right');
            $builder->join('tb_rekanan', 'tb_rekanan.id = tb_orders.id_rekanan', 'right');

            $query = $builder->getWhere($id);

        }
        return $query->getResult();
    }

    public function barangPrint($id){
        $db = db_connect();
        $builder = $db->table('tb_barang');
        $builder->select('id_barang, jenis_barang, jumlah_barang, jenis_satuan_barang');
        $query = $builder->getWhere($id);
        return $query->getResult();
    }

    public function ordersPrint($id) {
        $db = db_connect();
        $builder = $db->table('tb_orders');
        // $builder->orderBy('no_pesanan', 'ASC');
        $builder->select('tb_orders.id, no_pesanan, tgl_pesanan, 
            tb_orders.id_rekening_dasar, nama_rekening_dasar, kode_rek_dinas, kode_rek_urusan, kode_rek_bidang, kode_rek_program, kode_rek_kegiatan, kode_rek_unit, tahun_anggaran, 
            kode_belanja_sub1, kode_belanja_sub2, kode_belanja_sub3, kode_belanja_sub4, id_kode_belanja_sub5, kode_belanja_sub5, nama_rekening_belanja_sub5, 
            id_rekanan, instansi_rekanan, nama_rekanan, no_telp_rekanan, npwp, bank_rekanan, no_rekening_rekanan, jabatan, alamat_rekanan,
            tb_orders.id_kpa_ppk, nip_kpa_ppk, nama_kpa_ppk, uraian_pesanan
            ');
        $builder->join('tb_rekening_dasar', 'tb_rekening_dasar.id = tb_orders.id_rekening_dasar', 'left');
        $builder->join('tb_kpa_ppk', 'tb_kpa_ppk.id = tb_orders.id_kpa_ppk', 'left');
        $builder->join('tb_kode_dinas', 'tb_kode_dinas.id = tb_rekening_dasar.id_kode_dinas', 'left');
        $builder->join('tb_kode_urusan', 'tb_kode_urusan.id = tb_rekening_dasar.id_kode_urusan', 'left');
        $builder->join('tb_kode_bidang', 'tb_kode_bidang.id = tb_rekening_dasar.id_kode_bidang', 'left');
        $builder->join('tb_kode_program', 'tb_kode_program.id = tb_rekening_dasar.id_kode_program', 'left');
        $builder->join('tb_kode_kegiatan', 'tb_kode_kegiatan.id = tb_rekening_dasar.id_kode_kegiatan', 'left');
        $builder->join('tb_kode_unit', 'tb_kode_unit.id = tb_rekening_dasar.id_kode_unit', 'left');
        $builder->join('tb_kode_belanja_sub5', 'tb_kode_belanja_sub5.id = tb_orders.id_kode_belanja_sub5', 'left');
        $builder->join('tb_kode_belanja_sub4', 'tb_kode_belanja_sub4.id = tb_kode_belanja_sub5.id_kode_belanja_sub4', 'left');
        $builder->join('tb_kode_belanja_sub3', 'tb_kode_belanja_sub3.id = tb_kode_belanja_sub4.id_kode_belanja_sub3', 'left');
        $builder->join('tb_kode_belanja_sub2', 'tb_kode_belanja_sub2.id = tb_kode_belanja_sub3.id_kode_belanja_sub2', 'left');
        $builder->join('tb_kode_belanja_sub1', 'tb_kode_belanja_sub1.id = tb_kode_belanja_sub2.id_kode_belanja_sub1', 'left');
        $builder->join('tb_rekanan', 'tb_rekanan.id = tb_orders.id_rekanan', 'left');

        $query = $builder->getWhere($id);

        return $query->getResult();
    }

    // public function getOrders($id){
    //     $db = db_connect();
    //     $builder = $db->table('tb_barang');
    //     // $builder->orderBy('no_pesanan', 'ASC');
    //     $builder->select('tb_orders.id, no_pesanan, tgl_pesanan, jenis_barang, jumlah_barang, jenis_satuan_barang, uraian_pesanan, 
    //         tb_orders.id_rekening_dasar, nama_rekening_dasar, kode_rek_dinas, kode_rek_urusan, kode_rek_bidang, kode_rek_program, kode_rek_kegiatan, kode_rek_unit,
    //         kode_belanja_sub1, kode_belanja_sub2, kode_belanja_sub3, kode_belanja_sub4, id_kode_belanja_sub5, kode_belanja_sub5,
    //         id_rekanan, instansi_rekanan, nama_rekanan, no_telp_rekanan, npwp, bank_rekanan, no_rekening_rekanan, jabatan
    //         ');
    //     $builder->join('tb_orders', 'tb_orders.id = tb_barang.id_orders', 'left');
    //     $builder->join('tb_rekening_dasar', 'tb_rekening_dasar.id = tb_orders.id_rekening_dasar', 'left');
    //     $builder->join('tb_kode_dinas', 'tb_kode_dinas.id = tb_rekening_dasar.id_kode_dinas', 'left');
    //     $builder->join('tb_kode_urusan', 'tb_kode_urusan.id = tb_rekening_dasar.id_kode_urusan', 'left');
    //     $builder->join('tb_kode_bidang', 'tb_kode_bidang.id = tb_rekening_dasar.id_kode_bidang', 'left');
    //     $builder->join('tb_kode_program', 'tb_kode_program.id = tb_rekening_dasar.id_kode_program', 'left');
    //     $builder->join('tb_kode_kegiatan', 'tb_kode_kegiatan.id = tb_rekening_dasar.id_kode_kegiatan', 'left');
    //     $builder->join('tb_kode_unit', 'tb_kode_unit.id = tb_rekening_dasar.id_kode_unit', 'left');
    //     $builder->join('tb_kode_belanja_sub5', 'tb_kode_belanja_sub5.id = tb_orders.id_kode_belanja_sub5', 'left');
    //     $builder->join('tb_kode_belanja_sub4', 'tb_kode_belanja_sub4.id = tb_kode_belanja_sub5.id_kode_belanja_sub4', 'left');
    //     $builder->join('tb_kode_belanja_sub3', 'tb_kode_belanja_sub3.id = tb_kode_belanja_sub4.id_kode_belanja_sub3', 'left');
    //     $builder->join('tb_kode_belanja_sub2', 'tb_kode_belanja_sub2.id = tb_kode_belanja_sub3.id_kode_belanja_sub2', 'left');
    //     $builder->join('tb_kode_belanja_sub1', 'tb_kode_belanja_sub1.id = tb_kode_belanja_sub2.id_kode_belanja_sub1', 'left');
    //     $builder->join('tb_rekanan', 'tb_rekanan.id = tb_orders.id_rekanan', 'left');

    //     if ($id == null) {
    //         # code...
    //         $query = $builder->get();
    //     } else{
    //         $query = $builder->getWhere($id);

    //     }
    //     return $query->getResult();
    // }

    public function insertData($data){
        $idOrder = [];
        $db = db_connect();
        $builder = $db->table('tb_orders');
        $builder->insert($data);
        $idOrder = $db->insertID();
        return $idOrder;
    }

    public function updateData($where, $data){
        $db = db_connect();
        $builder = $db->table('tb_orders');
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    public function deleteData($where){
        $db = db_connect();
        $builder = $db->table('tb_orders');
        $builder->delete($where);
        return true;
    }
    
    public function getSearchRekReferensi($where){
        $db = db_connect();
        $builder = $db->table('tb_kode_belanja_sub4');
        $builder->select('tb_kode_belanja_sub4.id, kode_belanja_sub4, nama_rekening_belanja_sub4, tahun_anggaran');
        $builder->join('tb_kode_belanja_sub3', 'tb_kode_belanja_sub3.id = tb_kode_belanja_sub4.id_kode_belanja_sub3');
        $builder->join('tb_kode_belanja_sub2', 'tb_kode_belanja_sub2.id = tb_kode_belanja_sub3.id_kode_belanja_sub2');
        $builder->join('tb_kode_belanja_sub1', 'tb_kode_belanja_sub1.id = tb_kode_belanja_sub2.id_kode_belanja_sub1');
        $builder->join('tb_rekening_dasar', 'tb_rekening_dasar.id = tb_kode_belanja_sub1.id_rekening_dasar');
        $query = $builder->getWhere($where);
        return $query->getResultArray();
    }

    public function getInstansiRekanan(){
        $db = db_connect();
        $builder = $db->table('tb_rekanan');
        $builder->select('*');
        $query = $builder->get();
        return $query->getResult();
    }

    public function insertBarang($data){
        $db = db_connect();
        $builder = $db->table('tb_barang');
        $builder->insertBatch($data);
        return true;
    }

    // public function singleInsertBarang($data){
    //     $db = db_connect();
    //     $builder = $db->table('tb_barang');
    //     $builder->insert($data);
    //     return true;
    // }

    public function updateBarang($where ,$data){
        $db = db_connect();
        $builder = $db->table('tb_barang');
        $builder->where($where);
        $builder->update($data);
    }

    public function deleteBarang($where){
        $db = db_connect();
        $builder = $db->table('tb_barang');
        $builder->delete($where);
        return true;
    }
}