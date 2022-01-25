<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKpaPpk extends Model
{
    public function getKpaPpk($id)
    {
        $db = db_connect();
        $builder = $db->table('tb_kpa_ppk');
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
        $builder = $db->table('tb_kpa_ppk');
        $builder->insert($data);
        return true;
    }

    public function updateData($where, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_kpa_ppk');
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    public function deleteData($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_kpa_ppk');
        $builder->delete($where);
        return true;
    }
}