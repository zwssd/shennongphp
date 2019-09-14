<?php
class aaabbbModel extends Model {
    public function getTest($id){
        $results = $this->db->query('select * from test');
        return $results->query;
    }
}