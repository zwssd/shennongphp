<?php
class blogdefaultModel extends Model {
    public function getTest($id){
        $test_data = $this->cache->get('aaa.bbb.test');
        if(!$test_data){
            $results = $this->db->query('select * from test');
            $test_data = $results->query;

            $this->cache->set('aaa.bbb.test',$test_data);
        }
        return $test_data;
    }
}