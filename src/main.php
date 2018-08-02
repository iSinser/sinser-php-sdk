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
		curl_setopt ($ch, CURLOPT_URL, 'https://sinser.applinzi.com/api/statistics.php');
		curl_setopt($ch, CURLOPT_POSTFIELDS, "sid=$sid&authorization=$Authorization");
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);
		return $file_contents;
	}
	
	
	public function getdata($sid,$sk,$type){
		if($sid !== null and $sk !== null){
			if($type=='json'){
				$ch = curl_init();
				$timeout = 5;
				curl_setopt ($ch, CURLOPT_URL, 'https://sinser.applinzi.com/api/api.php');
				curl_setopt($ch, CURLOPT_POSTFIELDS, "sid=$sid&secretkey=$sk&json=1");
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$file_contents = curl_exec($ch);
				curl_close($ch);
				return $file_contents;
			}elseif($type >= 1 and $type <= 13){
				$ch = curl_init();
				$timeout = 5;
				curl_setopt ($ch, CURLOPT_URL, 'https://sinser.applinzi.com/api/api.php');
				curl_setopt($ch, CURLOPT_POSTFIELDS, "sid=$sid&secretkey=$sk&type=$type");
				curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
				$file_contents = curl_exec($ch);
				curl_close($ch);
				return $file_contents;
			}
			
			
		}
		
		
		
		
	}

}



?>