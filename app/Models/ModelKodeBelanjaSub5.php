<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKodeBelanjaSub5 extends Model
{
    public function getKodeBelanjaSub5($id){
        $db = db_connect();
        $builder = $db->table('tb_kode_belanja_sub5');

        $builder->select('tb_kode_belanja_sub5.id, kode_belanja_sub5, nama_rekening_belanja_sub5, jumlah_anggaran_belanja_sub5, 
            kode_belanja_sub4, nama_rekening_belanja_sub4, id_kode_belanja_sub4, 
            kode_belanja_sub3, nama_rekening_belanja_sub3, id_kode_belanja_sub3, 
            kode_belanja_sub2, nama_rekening_belanja_sub2, id_kode_belanja_sub2, 
            kode_belanja_sub1, nama_rekening_belanja_sub1, id_kode_belanja_sub1, 
            id_rekening_dasar ,nama_rekening_dasar, tahun_anggaran, 
            kode_rek_dinas, kode_rek_urusan, kode_rek_bidang, kode_rek_program, kode_rek_kegiatan, kode_rek_unit');
        $builder->join('tb_kode_belanja_sub4', 'tb_kode_belanja_sub4.id = tb_kode_belanja_sub5.id_kode_belanja_sub4', 'left');
        $builder->join('tb_kode_belanja_sub3', 'tb_kode_belanja_sub3.id = tb_kode_belanja_sub4.id_kode_belanja_sub3', 'left');
        $builder->join('tb_kode_belanja_sub2', 'tb_kode_belanja_sub2.id = tb_kode_belanja_sub3.id_kode_belanja_sub2', 'left');
        $builder->join('tb_kode_belanja_sub1', 'tb_kode_belanja_sub1.id = tb_kode_belanja_sub2.id_kode_belanja_sub1', 'left');
        $builder->join('tb_rekening_dasar', 'tb_rekening_dasar.id = tb_kode_belanja_sub1.id_rekening_dasar', 'left');
        $builder->join('tb_kode_dinas', 'tb_kode_dinas.id = tb_rekening_dasar.id_kode_dinas');
        $builder->join('tb_kode_urusan', 'tb_kode_urusan.id = tb_rekening_dasar.id_kode_urusan');
        $builder->join('tb_kode_bidang', 'tb_kode_bidang.id = tb_rekening_dasar.id_kode_bidang');
        $builder->join('tb_kode_program', 'tb_kode_program.id = tb_rekening_dasar.id_kode_program');
        $builder->join('tb_kode_kegiatan', 'tb_kode_kegiatan.id = tb_rekening_dasar.id_kode_kegiatan');
        $builder->join('tb_kode_unit', 'tb_kode_unit.id = tb_rekening_dasar.id_kode_unit');
        if ($id == null) {
            # code...
            $query = $builder->get();
        } else{
            
            $query = $builder->getWhere($id);
        }
        return $query->getResultArray();
    }

    public function insertData($data){
        $db = db_connect();
        $builder = $db->table('tb_kode_belanja_sub5');
        $builder->insert($data);
        return true;
    }

    public function updateData($where, $data){
        $db = db_connect();
        $builder = $db->table('tb_kode_belanja_sub5');
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    public function deleteData($where){
        $db = db_connect();
        $builder = $db->table('tb_kode_belanja_sub5');
        $builder->delete($where);
        return true;
    }
    
    public function getSearchRekReferensi($where){
        $db = db_connect();
        $builder = $db->table('tb_kode_belanja_sub5');
        $builder->select('tb_kode_belanja_sub4.id, kode_belanja_sub4, nama_rekening_belanja_sub4, tahun_anggaran');
        $builder->join('tb_kode_belanja_sub4', 'tb_kode_belanja_sub4.id = tb_kode_belanja_sub5.id_kode_belanja_sub4');
        $builder->join('tb_kode_belanja_sub3', 'tb_kode_belanja_sub3.id = tb_kode_belanja_sub4.id_kode_belanja_sub3');
        $builder->join('tb_kode_belanja_sub2', 'tb_kode_belanja_sub2.id = tb_kode_belanja_sub3.id_kode_belanja_sub2');
        $builder->join('tb_kode_belanja_sub1', 'tb_kode_belanja_sub1.id = tb_kode_belanja_sub2.id_kode_belanja_sub1');
        $builder->join('tb_rekening_dasar', 'tb_rekening_dasar.id = tb_kode_belanja_sub1.id_rekening_dasar');
        $query = $builder->getWhere($where);
        return $query->getResultArray();
    }
}