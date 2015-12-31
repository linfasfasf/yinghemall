<?php

    /*
     * 发送邮件
     * qq邮箱的账号必须经过认证，账号需要获取授权码
     * php.ini需要开启 php_openssl
     */
    function send_mail($to,$title,$content){
        require_cache(VENDOR_PATH."PHPmail/PHPMailerAutoload.php");

        $mail = new PHPMailer;

    //    $mail->SMTPDebug =3;
        $mail->isSMTP();

        $mail->Host         = 'smtp.qq.com';
        $mail->SMTPAuth     =  true;
        $mail->SMTPSecure   = 'ssl';
        $mail->Port         = 465;
        $mail->Hostname     = 'lero.com';
        $mail->CharSet      = 'utf-8';
        $mail->FromName     = 'lero_lin';//昵称
        $mail->Username     = '254430304';
        $mail->Password     = 'hlqhklajvcpkbhbg';//此处必须填写邮箱服务器的授权码
        $mail->From         = '254430304@qq.com';
        $mail->isHTML(true);
        $mail->addAddress($to);
        $mail->Subject      = $title;
        $mail->Body         = $content;
        $status = $mail->send();
        if($status){
            return $result  = '测试成功';
        }else{
            return $result  = '发送失败'.$mail->ErrorInfo;
        }
    }

    /*
     * 检查是否是使用手机浏览网站
     * 使用投票策略进行检测，当检查多项参数为手机时，确认为手机
     * return bool
     */
    function is_mobile() {
        $_SERVER['ALL_HTTP'] = isset($_SERVER['ALL_HTTP']) ? $_SERVER['ALL_HTTP'] : '';
        $mobile_browser = '0';
        if(preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|ipad|ipod|android|xoom)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
            $mobile_browser++;
        if((isset($_SERVER['HTTP_ACCEPT'])) and (strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') !== false))
            $mobile_browser++;
        if(isset($_SERVER['HTTP_X_WAP_PROFILE']))
            $mobile_browser++;
        if(isset($_SERVER['HTTP_PROFILE']))
            $mobile_browser++;
        $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'],0,4));
        $mobile_agents = array(
            'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
            'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
            'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
            'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
            'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
            'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
            'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
            'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
            'wapr','webc','winw','winw','xda','xda-'
        );
        if(in_array($mobile_ua, $mobile_agents))$mobile_browser++;
        if(strpos(strtolower($_SERVER['ALL_HTTP']), 'operamini') !== false)$mobile_browser++;
        if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows') !== false)$mobile_browser=0;
        if(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'windows phone') !== false)$mobile_browser++;
        if($mobile_browser>0){
            return true;
        }else{
            return false;
        }
    }


    /*
     * 生成指定长度随机字符
     * $type : alpha 不包含数字的字符
     *         alnum 包含数字以及字符
     *         numeric 包含10个数字
     *         nozero 不包含0 的9个数字
     */
    function creat_rand_str($len=8,$type='alnum'){
        switch($type){
            case 'alpha':
                $pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'alnum':
                $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                break;
            case 'numeric':
                $pool = '0123456789';
                break;
            case 'nozero':
                $pool = '123456789';
                break;
            default :
                return 'type no exist';
        }
        $str = '';
        for($i=0;$i<$len;$i++){
            $str .=substr($pool,mt_rand(0,strlen($pool)-1),1);
        }
        return $str;
    }