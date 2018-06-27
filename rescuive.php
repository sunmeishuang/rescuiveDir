<?php 
header("Content-type:text/html;charset=utf-8");

// 递归读取目录函数
function recursive($dirname){
	// 打开目录，返回句柄
	$handle = opendir($dirname);
	// 循环读取条目
	echo "<ul>";
	while($line = readdir($handle)){
		// 如果是‘.’或者'..',则继续
		if($line == '.' || $line == '..') continue;
		echo "<li>" . iconv("gbk","utf-8",$line) . "</li>";
		// 如果是目录，则递归调用
		if(is_dir($dirname ."/". $line)){
			recursive($dirname ."/". $line);
		}
	}
	echo "</ul>";
	// 关闭目录
	closedir($handle);
}


// 递归删除目录函数,只有空目录才可以删除
function delAll($dirname)
{
	// 打开目录
	$handle = opendir($dirname);
	// 循环读取目录中的所有条目
	while ($line = readdir($handle)) {
		if($line == '.' || $line == '..') continue;
		// 判断当前文件是否是目录
		if(is_dir($dirname . "/" . $line)){
			delAll($dirname . "/" . $line);
		}else{
			// 如果是文件，使用unlink文件删除
			unlink($dirname . "/" . $line);
		}
	}
	// 关闭目录
	closedir($handle);
	// 删除目录，关闭目录才可以删除目录
	rmdir($dirname);
}