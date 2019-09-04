<?php

class bbbController extends Controller
{
    public function index()
    {
        echo 'aaabbbController   index() ok!!!';
    }

    public function test()
    {
        echo 'aaabbbController   test() ok!!!';

        $this->res->setOut($this->load->view('aaa/bbb',array('aa'=>'bb')));

        $this->db->db('aaaa');

        $result_array = $this->db->result_array();
        var_dump($result_array);
    }
}
