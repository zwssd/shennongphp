<?php

class defaultController extends Controller
{
    public function index()
    {
        $this->res->setExp($this->load->view('blog/default',array(''=>'')));
    }

}
