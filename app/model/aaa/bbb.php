<?php
class bbbModel extends Model {
    public function getTest($id){
        $this->db->query('select * from test');
        return $this->db->result_array();
    }
}