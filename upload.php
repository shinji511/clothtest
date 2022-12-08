<?php //图像识别请求函数    
function request_post($url = '', $param = '')
{if (empty($url) || empty($param))
     {return false;            
}            
$postUrl = $url;            
$curlPost = $param;// 初始化curl           
$curl = curl_init();            
 curl_setopt($curl, CURLOPT_URL, $postUrl);            
 curl_setopt($curl, CURLOPT_HEADER, 0);// 要求结果为字符串且输出到屏幕上            
 curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);            
 curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);// post提交方式            
 curl_setopt($curl, CURLOPT_POST, 1);            
 curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);// 运行curl            
 $data = curl_exec($curl);           
curl_close($curl);return $data;
}        
  $temp = explode(".", $_FILES["file"]["name"]);        
  $extension = end($temp);     // 获取图片文件后缀名        
  $_FILES["file"]["name"]=time().'.'.$extension;//图片重命名(以时间戳来命名)//将图片文件存在项目根目录下的upload文件夹下        
  move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);        
  $token = '24.b519a28a1cfc58a09c047deb1d177c42.2592000.1673013981.282335-28761767';//将获取的access_token值放进去       
   $url = 'https://aip.baidubce.com/rest/2.0/image-classify/v2/advanced_general?access_token=' . $token;        
   $img = file_get_contents("upload/" . $_FILES["file"]["name"]);//本地文件路径(存入后的图片文件路径)        
   $img = base64_encode($img);//文件进行base64编码加密//请求所需要的参数        
   $bodys = array('image' => $img,
   //Base64编码字符串
   'baike_num'=>5  //返回百科信息的结果数 5条        
);        
$res = request_post($url, $bodys);
//调用请求函数
echo $res;  //将识别的数据输出到前端
?>