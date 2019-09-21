<?php
class blogdefaultModel extends Model {
    public function getUser($id){
        //$user_data = $this->cache->get('blog.default.user');
        if(!$user_data){
            $results = $this->db->query('select * from sn_user','object');
            $user_data = $results->query;

            //$this->cache->set('blog.default.user',$user_data);
        }
        return $user_data;
    }
}