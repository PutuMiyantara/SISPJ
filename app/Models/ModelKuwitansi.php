<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKuwitansi extends Model
{
    public function getKuwitansi($id){
        $db = db_connect();
        $builder = $db->table('tb_kuwitansi');
        $builder->orderBy('no_kuwitansi', 'ASC');

        // isi orders
        // $builder->select('tb_kuwitansi.id, no_kuwitansi, nominal, uraian_belanja, dasar_spj_bukti, status_spj, tanggal_kuwitansi, keterangan,
        //     id_order, no_pesanan, jenis_barang, jumlah_barang, jenis_satuan_barang, uraian_pesanan, 
        //     id_rekanan, instansi_rekanan, alamat_rekanan, no_telp_rekanan, nama_rekanan, bank_rekanan, no_rekening_rekanan, npwp, jabatan, 
        //     kode_belanja_sub5, nama_rekening_belanja_sub5, id_kode_belanja_sub5, 
        //     kode_belanja_sub4, nama_rekening_belanja_sub4, 
        //     kode_belanja_sub3, nama_rekening_belanja_sub3, 
        //     kode_belanja_sub2, nama_rekening_belanja_sub2, 
        //     kode_belanja_sub1, nama_rekening_belanja_sub1, 
        //     tb_orders.id_rekening_dasar, nama_rekening_dasar, tahun_anggaran, 
        //     kode_rek_dinas, kode_rek_urusan, kode_rek_bidang, kode_rek_program, kode_rek_kegiatan, kode_rek_unit');
        
            // tidak isi order
        $builder->select('tb_kuwitansi.id, no_kuwitansi, nominal, uraian_belanja, dasar_spj_bukti, status_spj, tgl_kuwitansi, keterangan, keterangan_spj,
            id_rekanan, instansi_rekanan, alamat_rekanan, no_telp_rekanan, nama_rekanan, bank_rekanan, no_rekening_rekanan, npwp, jabatan, 
            kode_belanja_sub5, nama_rekening_belanja_sub5, id_kode_belanja_sub5, 
            kode_belanja_sub4, nama_rekening_belanja_sub4, 
            kode_belanja_sub3, nama_rekening_belanja_sub3, 
            kode_belanja_sub2, nama_rekening_belanja_sub2, 
            kode_belanja_sub1, nama_rekening_belanja_sub1, 
            tb_kuwitansi.id_rekening_dasar, nama_rekening_dasar, tahun_anggaran, 
            kode_rek_dinas, kode_rek_urusan, kode_rek_bidang, kode_rek_program, kode_rek_kegiatan, kode_rek_unit');
        // $builder->join('tb_orders', 'tb_orders.id = tb_kuwitansi.id_order', 'left');
        $builder->join('tb_rekening_dasar', 'tb_rekening_dasar.id = tb_kuwitansi.id_rekening_dasar', 'left');
        $builder->join('tb_rekanan', 'tb_rekanan.id = tb_kuwitansi.id_rekanan', 'left');
        $builder->join('tb_kode_belanja_sub5', 'tb_kode_belanja_sub5.id = tb_kuwitansi.id_kode_belanja_sub5', 'left');
        $builder->join('tb_kode_belanja_sub4', 'tb_kode_belanja_sub4.id = tb_kode_belanja_sub5.id_kode_belanja_sub4', 'left');
        $builder->join('tb_kode_belanja_sub3', 'tb_kode_belanja_sub3.id = tb_kode_belanja_sub4.id_kode_belanja_sub3', 'left');
        $builder->join('tb_kode_belanja_sub2', 'tb_kode_belanja_sub2.id = tb_kode_belanja_sub3.id_kode_belanja_sub2', 'left');
        $builder->join('tb_kode_belanja_sub1', 'tb_kode_belanja_sub1.id = tb_kode_belanja_sub2.id_kode_belanja_sub1', 'left');
        $builder->join('tb_kode_dinas', 'tb_kode_dinas.id = tb_rekening_dasar.id_kode_dinas', 'left');
        $builder->join('tb_kode_urusan', 'tb_kode_urusan.id = tb_rekening_dasar.id_kode_urusan', 'left');
        $builder->join('tb_kode_bidang', 'tb_kode_bidang.id = tb_rekening_dasar.id_kode_bidang', 'left');
        $builder->join('tb_kode_program', 'tb_kode_program.id = tb_rekening_dasar.id_kode_program', 'left');
        $builder->join('tb_kode_kegiatan', 'tb_kode_kegiatan.id = tb_rekening_dasar.id_kode_kegiatan', 'left');
        $builder->join('tb_kode_unit', 'tb_kode_unit.id = tb_rekening_dasar.id_kode_unit', 'left');
    
        if ($id == null) {
            # code...
            $query = $builder->get();
        } else{
            
            $query = $builder->getWhere($id);
        }
        return $query->getResult();
    }

    public function insertData($data){
        $db = db_connect();
        $builder = $db->table('tb_kuwitansi');
        $builder->insert($data);
        return true;
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
}