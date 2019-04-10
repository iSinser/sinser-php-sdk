<?php
class sinser{
	public $sign_algorithm = 'HMAC-SHA1';
	public $en = '1';
	

	
	public function getAuthorization($user,$ak,$sk,$sign_time,$salt){
		if($user !== null and $ak !== '' and $sk !== null){
			$ak=sha1($ak);//进行SHA1加密
			$sk=sha1($sk);//进行SHA1加密
			
			$sn_1="sign-algorithm=HMAC-SHA1&ak=$ak&sk=$sk";//拼接第一部分字符串
			$sn_2="user=$user&sign-time=$sign_time&salt=$salt&en=1";//拼接第二部分字符串
			
			$sn_1_sha1=hash_hmac("sha1",$sn_1,$salt);//第一部分加密
			$sn_2_base64=base64_encode($sn_2);//第二部分加密
			
			$Authorization=$sn_1_sha1.'==='.$sn_2_base64;//拼接
			return $Authorization;
		}
	}
	
	
	//请求采用Curl 需打开curl扩展
	public function statistics($sid,$Authorization){
		$ch = curl_init();
		$timeout = 5;
        $ip=$this->getIp();
        $os=$this->get_Os();
        
		
		curl_setopt ($ch, CURLOPT_URL, 'https://sinser.applinzi.com/api/statistics.php');
		curl_setopt($ch, CURLOPT_POSTFIELDS, "sid=$sid&authorization=$Authorization&sdk=1&ip=$ip&os=$os");
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);
		return $file_contents;
	}
	
	
	public function getdata($sid,$sk){
		if($sid !== null and $sk !== null){
				$ch = curl_init();
				$timeout = 5;
				curl_setopt ($ch, CURLOPT_URL, 'https://sinser.applinzi.com/api/api.php');
				curl_setopt($ch, CURLOPT_POSTFIELDS, "sid=$sid&secretkey=$sk&en=1");
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$file_contents = curl_exec($ch);
				curl_close($ch);
				return $file_contents;
			
		}

	}
	
	public function online($sid,$Authorization){
		if($sid !== null and $Authorization !== null){
				$ch = curl_init();
				$timeout = 5;
				$ip=$this->getIp();
				curl_setopt ($ch, CURLOPT_URL, 'https://sinser.applinzi.com/api/online.php');
				curl_setopt($ch, CURLOPT_POSTFIELDS, "sid=$sid&authorization=$Authorization&ip=$ip");
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$file_contents = curl_exec($ch);
				curl_close($ch);
				return $file_contents;
			
		}

	}
	
	function getIp()
	{
	    $ip=false;
	    if(!empty($_SERVER["HTTP_CLIENT_IP"])){
	        $ip = $_SERVER["HTTP_CLIENT_IP"];
	    }
	    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	        $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
	        if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
	        for ($i = 0; $i < count($ips); $i++) {
	            if (!preg_match ("^(10│172.16│192.168).", $ips[$i])) {
	                $ip = $ips[$i];
	                break;
	            }
	        }
	    }
	    return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
	}
	
	function get_Os(){
	    if(!empty($_SERVER['HTTP_USER_AGENT'])){
	        $OS = $_SERVER['HTTP_USER_AGENT'];
	        if (preg_match('/win/i',$OS)) {
	            $OS = 'Windows';
	        }
	        elseif (preg_match('/mac/i',$OS)) {
	            $OS = 'MAC';
	        }
	        elseif (preg_match('/linux/i',$OS)) {
	            $OS = 'Linux';
	        }
	        elseif (preg_match('/unix/i',$OS)) {
	            $OS = 'Unix';
	        }
	        elseif (preg_match('/bsd/i',$OS)) {
	            $OS = 'BSD';
	        }
	        else {
	            
	            $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	            $is_pc = (strpos($agent, 'windows nt')) ? true : false;
	            $is_iphone = (strpos($agent, 'iphone')) ? true : false;
	            $is_ipad = (strpos($agent, 'ipad')) ? true : false;
	            $is_android = (strpos($agent, 'android')) ? true : false;
	            if($is_pc){
	                $OS = 'Windows';
	            }
	            if($is_iphone){
	                $OS = 'iOS';
	            }
	            if($is_ipad){
	                $OS = 'iOS';
	            }
	            if($is_android){
	                $OS = 'Android';
	            }
	        }
	        return $OS;
	    }
	    else{
	        return "Unknown";
	    }
	}
	

}


?>