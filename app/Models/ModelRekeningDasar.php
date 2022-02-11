<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelRekeningDasar extends Model
{
    public function getRekeningDasar($id)
    {
        $db = db_connect();
        $builder = $db->table('tb_rekening_dasar');
        if ($id == null) {
            # code...
            $builder->select('tb_rekening_dasar.id, nama_rekening_dasar, kode_rek_dinas, kode_rek_urusan, kode_rek_bidang, kode_rek_program, kode_rek_kegiatan, kode_rek_unit, keterangan_rekening_dasar, tahun_anggaran, jumlah_anggaran_rekening_dasar');
            $builder->join('tb_kode_dinas', 'tb_kode_dinas.id = tb_rekening_dasar.id_kode_dinas', 'left');
            $builder->join('tb_kode_urusan', 'tb_kode_urusan.id = tb_rekening_dasar.id_kode_urusan', 'left');
            $builder->join('tb_kode_bidang', 'tb_kode_bidang.id = tb_rekening_dasar.id_kode_bidang', 'left');
            $builder->join('tb_kode_program', 'tb_kode_program.id = tb_rekening_dasar.id_kode_program', 'left');
            $builder->join('tb_kode_kegiatan', 'tb_kode_kegiatan.id = tb_rekening_dasar.id_kode_kegiatan', 'left');
            $builder->join('tb_kode_unit', 'tb_kode_unit.id = tb_rekening_dasar.id_kode_unit', 'left');
            $query = $builder->get();
        } else{
            $builder->select('tb_rekening_dasar.id, id_kode_dinas, id_kode_urusan, id_kode_bidang, id_kode_program, id_kode_kegiatan, id_kode_unit, id_kpa_ppk, id_pptk, id_bendahara, nama_rekening_dasar, kode_rek_dinas, kode_rek_urusan, kode_rek_bidang, kode_rek_program, kode_rek_kegiatan, kode_rek_unit, keterangan_rekening_dasar, tahun_anggaran, jumlah_anggaran_rekening_dasar, nama_kpa_ppk, nip_kpa_ppk, nama_pptk, nip_pptk, nama_bendahara, nip_bendahara');
            $builder->join('tb_kode_dinas', 'tb_kode_dinas.id = tb_rekening_dasar.id_kode_dinas', 'left');
            $builder->join('tb_kode_urusan', 'tb_kode_urusan.id = tb_rekening_dasar.id_kode_urusan', 'left');
            $builder->join('tb_kode_bidang', 'tb_kode_bidang.id = tb_rekening_dasar.id_kode_bidang', 'left');
            $builder->join('tb_kode_program', 'tb_kode_program.id = tb_rekening_dasar.id_kode_program', 'left');
            $builder->join('tb_kode_kegiatan', 'tb_kode_kegiatan.id = tb_rekening_dasar.id_kode_kegiatan', 'left');
            $builder->join('tb_kode_unit', 'tb_kode_unit.id = tb_rekening_dasar.id_kode_unit', 'left');
            $builder->join('tb_kpa_ppk', 'tb_kpa_ppk.id = tb_rekening_dasar.id_kpa_ppk', 'left');
            $builder->join('tb_pptk', 'tb_pptk.id = tb_rekening_dasar.id_pptk', 'left');
            $builder->join('tb_bendahara', 'tb_bendahara.id = tb_rekening_dasar.id_bendahara', 'left');
            $query = $builder->getWhere($id);
        }
        return $query->getResult();
    }

    public function getTahunAnggaran(){
        $db = db_connect();
        $builder = $db->table('tb_rekening_dasar');
        $builder->select('tahun_anggaran');
        $builder->distinct();
        $builder->orderBy('tahun_anggaran', 'DESC');
        $query = $builder->get();
        return $query->getResult();
    }

    public function insertData($data)
    {
        $db = db_connect();
        $builder = $db->table('tb_rekening_dasar');
        $builder->insert($data);
        return true;
    }

    public function updateData($where, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_rekening_dasar');
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    public function deleteData($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_rekening_dasar');
        $builder->delete($where);
        return true;
    }
}