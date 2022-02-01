<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPptk extends Model
{
    public function getPptk($id)
    {
        $db = db_connect();
        $builder = $db->table('tb_pptk');
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
        $builder = $db->table('tb_pptk');
        $builder->insert($data);
        return true;
    }

    public function updateData($where, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_pptk');
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    public function deleteData($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_pptk');
        $builder->delete($where);
        return true;
    }
}