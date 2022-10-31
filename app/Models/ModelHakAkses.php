<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelHakAkses extends Model
{
    public function getRoleAkses($id)
    {
        $db = db_connect();
        $builder = $db->table('tb_hak_akses');
        if ($id == null) {
            # code...
            $builder->select('*');
            $query = $builder->get();
        } else{
            $builder = $db->table('tb_user_main_menu');
            $query = $builder->getWhere($id);
        }
        return $query->getResultArray();
    }

    public function getMenu (){
        $db = db_connect();
        $builder = $db->table('tb_sub_menu');
        $builder->select('*');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function insertData($data)
    {
        $db = db_connect();
        $builder = $db->table('tb_bendahara');
        $builder->insert($data);
        return true;
    }

    public function updateData($where, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_bendahara');
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    public function deleteData($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_bendahara');
        $builder->delete($where);
        return true;
    }
}