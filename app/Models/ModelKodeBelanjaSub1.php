<?php

namespace App\Models;
use CodeIgniter\Model;

class ModelKodeBelanjaSub1 extends Model {
    public function getKodeSub1(){
        $db = db_connect();
        $builder = $db->table('tb_kode_belanja_sub1');
        // $builder->select('*');
        $query = $builder->get();

        return $query->getResult();
    }
}