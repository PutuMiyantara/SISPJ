<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUrl extends Model
{
    public function getUrl($id, $url)
    {
        $db = db_connect();
        if ($url == 'main') {
            # code...
            $builder = $db->table('tb_main_menu');
            $builder->select('*');
            $builder->orderBy('no_urut_main_menu', 'ASC');
        } elseif ($url == 'sub') {
            # code...
            $builder = $db->table('tb_sub_menu');
            $builder->select('tb_sub_menu.id, name_sub_menu, sub_url, status_sub_menu, no_urut_sub_menu');
            // $builder->join('tb_main_menu', 'tb_main_menu.id = tb_sub_menu.id_main_menu', 'left');
            $builder->orderBy('no_urut_sub_menu', 'ASC');
        } elseif($url == 'subsub'){
            $builder = $db->table('tb_sub_sub_menu');
            $builder->select('tb_sub_sub_menu.id, name_sub_sub_menu, sub_sub_url, status_sub_sub_menu, no_urut_sub_sub_menu');
            // $builder->join('tb_sub_menu', 'tb_sub_menu.id = tb_sub_sub_menu.id_sub_menu', 'left');
            // $builder->join('tb_main_menu', 'tb_main_menu.id = tb_sub_menu.id_main_menu', 'left');
            $builder->orderBy('no_urut_sub_sub_menu', 'ASC');
        }

        if ($id == null) {
            # code...
            $query = $builder->get();
        } else{
            $query = $builder->getWhere($id);
        }
        return $query->getResultArray();
    }

    public function insertData($data)
    {
        $db = db_connect();
        $builder = $db->table('tb_sub_sub_menu');
        $builder->insert($data);
        return true;
    }

    public function updateData($where, $data)
    {
        $db = db_connect();
        $builder = $db->table('tb_sub_sub_menu');
        $builder->where($where);
        $builder->update($data);
        return true;
    }

    public function deleteData($where)
    {
        $db = db_connect();
        $builder = $db->table('tb_sub_sub_menu');
        $builder->delete($where);
        return true;
    }
}