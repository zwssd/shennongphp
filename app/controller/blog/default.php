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

        $this->load->lang('blog/default');

        $data['username'] = $this->lang->get_key('username');

        //show_error(array('error_title'=>'发生了错误','error_message'=>'函数已经取出！'));
        $result_array = $this->blog_default_model->getUser(1);
        echo mb_strlen('神农PHP框架');
        var_dump($result_array);

        //测试分页类
        $pag_config['url'] = 'http://127.0.0.1/shennongphp/index.php?route=blog/default/showuser&page={page}';
        $pag_config['total'] = 200;
        $pag_config['page'] = 1;
        $pag_config['limit'] = 20;
        $pag = new Pag($this->lang,$pag_config);
        echo $pag->get_link();


        $this->res->setExp($this->load->view('blog/default',$data));
    }
}
