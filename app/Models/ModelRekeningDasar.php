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
            $builder->select('*');
            $builder->join('tb_kode_dinas', 'tb_kode_dinas.id = tb_rekening_dasar.id_kode_dinas');
            $builder->join('tb_kode_urusan', 'tb_kode_urusan.id = tb_rekening_dasar.id_kode_urusan');
            $builder->join('tb_kode_bidang', 'tb_kode_bidang.id = tb_rekening_dasar.id_kode_bidang');
            $builder->join('tb_kode_program', 'tb_kode_program.id = tb_rekening_dasar.id_kode_program');
            $builder->join('tb_kode_kegiatan', 'tb_kode_kegiatan.id = tb_rekening_dasar.id_kode_kegiatan');
            $builder->join('tb_kode_unit', 'tb_kode_unit.id = tb_rekening_dasar.id_kode_unit');
            $query = $builder->get();
        } else{
            $builder->join('tb_kode_dinas', 'tb_kode_dinas.id = tb_rekening_dasar.id_kode_dinas');
            $builder->join('tb_kode_urusan', 'tb_kode_urusan.id = tb_rekening_dasar.id_kode_urusan');
            $builder->join('tb_kode_bidang', 'tb_kode_bidang.id = tb_rekening_dasar.id_kode_bidang');
            $builder->join('tb_kode_program', 'tb_kode_program.id = tb_rekening_dasar.id_kode_program');
            $builder->join('tb_kode_kegiatan', 'tb_kode_kegiatan.id = tb_rekening_dasar.id_kode_kegiatan');
            $builder->join('tb_kode_unit', 'tb_kode_unit.id = tb_rekening_dasar.id_kode_unit');
            $query = $builder->getWhere($id);
        }
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