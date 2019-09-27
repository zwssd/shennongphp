<?php

class blogController extends Controller
{
    public function index()
    {
        $json = array(
            'code'=>1,
            'message'=>'测试json返回。',
            'data'=>'返回成功！'
        );
        $this->res->addHeader('Content-Type: application/json');
		$this->res->setExp(json_encode($json));
    }
}