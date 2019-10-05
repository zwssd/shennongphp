<?php

class defaultController extends Controller
{
    public function index()
    {
        $this->res->setExp($this->load->view('blog/default', array('aa' => 'bb')));
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
        $pag = new Pag($this->lang, $pag_config);
        echo $pag->get_link();

        //测试图片类
        $pic = new Pic(UPLOAD_PATH.'shennongphplogo - 2019-10-02 - 17-39-01.png');
		$pic->resize(100, 100);
        $pic->save(PIC_PATH . 'shennongphplogo.png');
        
        //测试加密类
        //var_dump(openssl_get_cipher_methods());
        $encrypt = new Encryp();
        $encrypt_str = $encrypt->encrypt('abc','hello world!');
        echo 'encrypt_str>>>>>'.$encrypt_str.PHP_EOL;
        $decrypt_str = $encrypt->decrypt('abc',$encrypt_str);
        echo 'decrypt_str>>>>>'.$decrypt_str.PHP_EOL;

        //测试发邮件类
        $mail = new Email('smtp');
			$mail->parameter = '';
			$mail->smtp_hostname = 'smtp.qq.com';
			$mail->smtp_username = '@qq.com';
            $mail->smtp_password = html_entity_decode('', ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = 25;
			$mail->smtp_timeout = 5;
	
			$mail->setTo('@qq.com');
			$mail->setFrom('@qq.com');
			$mail->setSender('@qq.com');
			$mail->setSubject('测试邮件类!!!');
			$mail->setText('测试邮件类--正文!!!');
			$mail->send(); 


        $this->res->setExp($this->load->view('blog/default', $data));
    }

    public function uploadFile()
    {
        //获取到临时文件
        $file = $_FILES['fileField'];
        //获取文件名
        $fileName = $file['name'];
        echo $fileName;
        //移动文件到当前目录
        move_uploaded_file($file['tmp_name'], UPLOAD_PATH.$fileName);
    }
}
