<?php

class defaultController extends Controller
{
    public function index()
    {
        $this->res->setExp($this->load->view('blog/default',array('aa'=>'bb')));
    }

    public function showUser()
    {
        $this->load->model('blog/default');

        $result_array = $this->blog_default_model->getUser(1);
        var_dump($result_array);

        echo 'aaabbbController   test() ok!!!';

        $this->res->setExp($this->load->view('blog/default',array('aa'=>'bb')));
    }
}
