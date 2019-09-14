<?php

class bbbController extends Controller
{
    public function index()
    {
        echo 'aaabbbController   index() ok!!!';
    }

    public function test()
    {
        $this->load->model('aaa/bbb');

        $result_array = $this->aaa_bbb_model->getTest(1);
        var_dump($result_array);

        echo 'aaabbbController   test() ok!!!';

        $this->res->setExp($this->load->view('aaa/bbb',array('aa'=>'bb')));
    }
}
