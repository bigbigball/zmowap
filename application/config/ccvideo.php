<?php

if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
$config ['ccvideo'] ['charset'] = 'utf8';
$config ['ccvideo'] ['uid'] = '679140E95FB4BB36';
$config ['ccvideo'] ['key'] = '5EYhWHaSZtA4dglRT0SHPutpH5V55sAb';
$config ['ccvideo'] ['playerid'] = '4C5439AF15AA2679';
// 获取用户信息
$config ['ccvideo'] ['api'] ['user_info'] = 'http://spark.bokecc.com/api/user';
// 获取视频列表
$config ['ccvideo'] ['api'] ['videos'] = 'http://spark.bokecc.com/api/videos';
// 获取播放视频
$config ['ccvideo'] ['api'] ['playcode'] = 'http://spark.bokecc.com/api/video/playcode';
// 删除视频
$config ['ccvideo'] ['api'] ['deletevideo'] = 'http://spark.bokecc.com/api/video/delete';
// 更新视频
$config ['ccvideo'] ['api'] ['editvideo'] = 'http://spark.bokecc.com/api/video/update';
// 获取单个视频
$config ['ccvideo'] ['api'] ['video'] = 'http://spark.bokecc.com/api/video';
// 获取视频分类
$config ['ccvideo'] ['api'] ['category'] = 'http://spark.bokecc.com/api/video/category';
