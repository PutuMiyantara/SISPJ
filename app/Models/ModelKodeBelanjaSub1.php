<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKodeBelanjaSub1 extends Model
{ 
    public function getKodeBelanjaSub1($id){
        $db = db_connect();
        $builder = $db->table('tb_kode_belanja_sub1');
        $builder->select('tb_kode_belanja_sub1.id, kode_belanja_sub1, nama_rekening_belanja_sub1, jumlah_anggaran_belanja_sub1, id_rekening_dasar, kode_rek_dinas, kode_rek_urusan, kode_rek_bidang, kode_rek_program, kode_rek_kegiatan, kode_rek_unit, tahun_anggaran, nama_rekening_dasar, id_rekening_dasar');
            $builder->join('tb_rekening_dasar', 'tb_rekening_dasar.id = tb_kode_belanja_sub1.id_rekening_dasar');
            $builder->join('tb_kode_dinas', 'tb_kode_dinas.id = tb_rekening_dasar.id_kode_dinas');
            $builder->join('tb_kode_urusan', 'tb_kode_urusan.id = tb_rekening_dasar.id_kode_urusan');
            $builder->join('tb_kode_bidang', 'tb_kode_bidang.id = tb_rekening_dasar.id_kode_bidang');
            $builder->join('tb_kode_program', 'tb_kode_program.id = tb_rekening_dasar.id_kode_program');
            $builder->join('tb_kode_kegiatan', 'tb_kode_kegiatan.id = tb_rekening_dasar.id_kode_kegiatan');
            $builder->join('tb_kode_unit', 'tb_kode_unit.id = tb_rekening_dasar.id_kode_unit');
            $builder->join('tb_kpa_ppk', 'tb_kpa_ppk.id = tb_rekening_dasar.id_kpa_ppk');
            $builder->join('tb_pptk', 'tb_pptk.id = tb_rekening_dasar.id_pptk');
            $builder->join('tb_bendahara', 'tb_bendahara.id = tb_rekening_dasar.id_bendahara');
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
        $builder = $db->table('tb_kode_belanja_sub1');
        $builder->insert($data);
        return true;
    }

    public function updateData($where, $data){
        $db = db_connect();
        $builder = $db->table('tb_kode_belanja_sub1');
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    public function deleteData($where){
        $db = db_connect();
        $builder = $db->table('tb_kode_belanja_sub1');
        $builder->delete($where);
        return true;
    }
    
    public function getSearchRekDasar(){
        $db = db_connect();
        $builder = $db->table('tb_rekening_dasar');
        $builder->select('tb_rekening_dasar.id, nama_rekening_dasar, tahun_anggaran, kode_rek_dinas, kode_rek_urusan, kode_rek_bidang, kode_rek_program, kode_rek_kegiatan, kode_rek_unit');
        $builder->join('tb_kode_dinas', 'tb_kode_dinas.id = tb_rekening_dasar.id_kode_dinas');
        $builder->join('tb_kode_urusan', 'tb_kode_urusan.id = tb_rekening_dasar.id_kode_urusan');
        $builder->join('tb_kode_bidang', 'tb_kode_bidang.id = tb_rekening_dasar.id_kode_bidang');
        $builder->join('tb_kode_program', 'tb_kode_program.id = tb_rekening_dasar.id_kode_program');
        $builder->join('tb_kode_kegiatan', 'tb_kode_kegiatan.id = tb_rekening_dasar.id_kode_kegiatan');
        $builder->join('tb_kode_unit', 'tb_kode_unit.id = tb_rekening_dasar.id_kode_unit');
        $query = $builder->get();
        return $query->getResultArray();
    }
}