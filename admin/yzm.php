<?php
/*

PHP 手册：php.net   函数   分别找到对应的系统函数    函数

验证码实现过程：(GD库：PHP提供的一个绘图的函数库)

1、创建一个画布(100px * 50px)     imagecreate — 新建一个基于调色板的图像
2、获取颜色		imagecolorallocate — 为一幅图像分配颜色
3、填充背景色	imagefill — 区域填充
4、写上随机的文字(1D2L)    imagestring — 水平地画一行字符串
5、添加一些干扰元素(线条、圆点)   imageline — 画一条线段; imagesetpixel — 画一个单一像素
6、输出验证码图片	imagepng — 以 PNG 格式将图像输出到浏览器或文件

*/
header("Content-type: image/PNG");

// 初始化
session_start();

// 声明画布的宽度、高度
$width = 100;
$height = 45;

// 创建一个画布
$im = imagecreate($width, $height);

// 获取颜色 0-255  背景色是深色，文字颜色是浅色
$bgColor = imagecolorallocate($im, mt_rand(0,100), mt_rand(0,100), mt_rand(0,100));

// var_dump($bgColor);

// 填充背景色
imagefill($im, 0, 0, $bgColor);

// 验证码的位数
$num = 4;

// 定义一个初始的横坐标
$step = 10;
$x = ($width - $step * $num) / 2;
$y = ($height - 16) / 2;

// 声明一个字符串的变量，存储验证码
$code = "";

// 写上随机文字
for($i=0; $i<$num; $i++)
{
	// 文字的颜色
	$textColor = imagecolorallocate($im, mt_rand(150,255), mt_rand(150,255), mt_rand(150,255));
	$text = mt_rand(0, 9);
	$code .= $text;
	// 文字绘制到图像上
	imagestring($im, 5, $x, $y, $text, $textColor);
	$x += $step;
}

// 把验证码的值，写入session
$_SESSION['vcode'] = $code;

// 添加一些干扰元素
for($i=0; $i< 3; $i++)
{
	$lineColor = imagecolorallocate($im, mt_rand(150,200), mt_rand(150,200), mt_rand(150,200));
	imageline($im, mt_rand(0, $width), mt_rand(0, $height), mt_rand(0, $width), mt_rand(0, $height), $lineColor);
}

// 输出图像
imagepng($im);
?>