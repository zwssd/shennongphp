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

        show_error(array('error_title'=>'发生了错误','error_message'=>'函数已经取出！'));
        $result_array = $this->blog_default_model->getUser(1);
        echo mb_strlen('神农PHP框架');
        var_dump($result_array);


        $this->res->setExp($this->load->view('blog/default',array('aa'=>'bb')));
    }
}
