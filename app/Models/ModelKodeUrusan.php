<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKodeUrusan extends Model
{
    public function getKodeurusan($id)
    {
        $db = db_connect();
        $builder = $db->table('tb_kode_urusan');
        if ($id == null) {
            # code...
            $builder->select('*');
            $query = $builder->get();
        } else{
            $query = $builder->getWhere($id);
        }
        return $query->getResult();
    }

    public function insertData($data)
    {
        $db = db_connect();
        $builder = $db->table('tb_kode_urusan');
        $builder->insert($data);
        return true;
    }

    public function updateData($where, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_kode_urusan');
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    public function deleteData($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_kode_urusan');
        $builder->delete($where);
        return true;
    }
}