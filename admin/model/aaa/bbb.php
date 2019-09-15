<?php
class aaabbbModel extends Model {
    public function getTest($id){
        $results = $this->db->query('select * from test1');
        return $results->query;
    }
}