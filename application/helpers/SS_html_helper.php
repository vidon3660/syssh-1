<?php
/**
 * 在view中载入js的简写
 * @param string $js_file_path js文件的路径文件名（不含"web/js/"和".js"）
 */
function javascript($js_file_path){
	$path='js/'.$js_file_path.'.js';
	$hash=filemtime($path);
	return '<script type="text/javascript" src="/'.$path.'?'.$hash.'"></script>'."\n";
}

/**
 * 在view中载入外部css链接的简写
 */
function stylesheet($stylesheet_path){
	$path=$stylesheet_path.'.css';
	$hash=filemtime($path);
	return '<link rel="stylesheet" href="/'.$path.'?'.$hash.'" type="text/css" />'."\n";
}

/*
 * 包围，生成html标签的时候很有用
 * $wrap=array(
 * 		'mark'=>'div',
 * 		'attrib1'=>'value1',
 * 		'attrib2'=>'value2'
 * );
 * wrap('str',$wrap)
 * 将返回<div attrib1="value1" attrib2="value2">str</div>
 */
function wrap($str,$wrap){
	if($str=='')
		return '';

	$mark=$wrap['mark'];
	unset($wrap['mark']);
	$property=db_implode($wrap,' ',NULL,'=','"','"','','value',false);
	return '<'.$mark.' '.$property.'>'.$str.'</'.$mark.'>';

}

/**
 * 重定向，对于站内跳转，url写成REQUEST_URI即可，如'user?browser'
 * 有php和js两种方式
 * 对于php跳转，采用发送301header的方式，因此之前整个系统不能输出任何内容
 * 对于js跳转，输出js代码交给浏览器完成跳转，因此会发生内容输出
 * $unsetPara目前只适用于js跳转，用以将原来url中的某个变量去除
 */
function redirect($url='',$method='php',$unsetPara=NULL,$jump_to_top_frame=false){
	$CI=&get_instance();
	$base_url=$CI->config->item('base_url');
	
	if($method=='php'){
		if(is_null($unsetPara)){
			header("location:{$base_url}".$url);
		}else{
			$query_string='?';
			$glue='';
			foreach($_GET as $k=>$v){
				if($k!=$unsetPara){
					$query_string.=$glue.$k.'='.$v;
					$glue='&';
				}
			}
			header('location:'.$q);//待开发
		}
	}elseif($method=='js'){
		echo '<script>'.(is_null($unsetPara)?($jump_to_top_frame?'top.':'')."location.href='{$base_url}".$url."';":"location.href=unsetURLPar('".$url."','".$unsetPara."');").'</script>';
	}
	exit;
}

/**
 * 输出1K的空格来强制浏览器输出
 * 使用后在下文执行任何输出，再紧跟flush();即可即时看到
 */
function forceExport(){
	ob_end_clean();   //清空并关闭输出缓冲区
	echo str_repeat(' ',1024);
}

/**
 * deprecated
 */
function showMessage($message,$type='notice',$direct_export=false){
	$output='';
	if($direct_export){
		$output=$message;
	}else{
		if($type=='notice'){
			$notice_class='ui-state-highlight ';
			$notice_symbol='<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>';
		}elseif($type=='warning'){
			$notice_class='ui-state-error';
			$notice_symbol='<span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>';
		}
		$output='<span class="message ui-corner-all '.$notice_class.'" title="点击隐藏提示">'.$notice_symbol.$message.'</span>';
	}
	$CI=&get_instance();
	$CI->output->append_output($output);
}
?>