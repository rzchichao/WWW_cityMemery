<?php


$imgs = array();
$imgs[0] = 'aaa.jpg';
$target = 'center.jpg';//背景图片
$target_img = Imagecreatefromjpeg($target);
$source= array();
foreach ($imgs as $k=>$v){
    $source[$k]['source'] = Imagecreatefromjpeg($v);
    $source[$k]['size'] = getimagesize($v);
}
$num1=0;
$num=1;
$tmp=4;
$tmpy=7;//图片之间的间距
for ($i=0; $i<1; $i++){
    imagecopy($target_img,$source[$i]['source'],$tmp,$tmpy,0,0,$source[$i]['size'][0],$source[$i]['size'][1]);
    $tmp = $tmp+$source[$i]['size'][0];
    $tmp = $tmp+5;
    if($i==$num){
        $tmpy = $tmpy+$source[$i]['size'][1];
        $tmpy = $tmpy+5;
        $tmp=2;
        $num=$num+3;
    }
}
Imagejpeg($target_img,'pin.jpg');

?>
<img src="pin.jpg">