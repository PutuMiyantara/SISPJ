<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengurusBarang extends Model
{
    public function getPengurusBarang($id)
    {
        $db = db_connect();
        $builder = $db->table('tb_pengurus_barang');
        if ($id == null) {
            # code...
            $builder->select('*');
            $query = $builder->get();
        } else{
            $query = $builder->getWhere($id);
        }
        return $query->getResultArray();
    }

    public function insertData($data)
    {
        $db = db_connect();
        $builder = $db->table('tb_pengurus_barang');
        $builder->insert($data);
        return true;
    }

    public function updateData($where, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_pengurus_barang');
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    public function deleteData($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_pengurus_barang');
        $builder->delete($where);
        return true;
    }
}