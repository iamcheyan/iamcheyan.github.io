<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
数据更新成功...<br>
======================================<br>
<!-- 循环接收数据 -->
<?php
	// echo $_POST['poll'];
	//循环次数由post传入
	for ($i = 0; $i <= $_POST['poll']; $i++) {
?>
	案例标题：<?php echo $_POST['name-'.$i]; ;?><br>
	案例描述： <?php echo $_POST['describe-'.$i]; ?><br />
	案例网址： <?php echo $_POST['link-'.$i]; ?><br />
	图片地址： <?php echo $_POST['image-'.$i]; ?><br />
	======================================<br>
<?php
	}
?>

<a href="/wp-admin/admin.php?page=ganline_admin">返回</a><br>

<?php
	//写入 xml 文件，声明文件头
	$xml = new SimpleXMLElement('<?xml version="1.0" encoding="utf-8"?><list />');

	//添加循环
	for ($i = 0; $i <= $_POST['poll']; $i++) {
		//循环时添加条目
		$iteam = $xml -> addChild('iteam');
		$iteam -> addChild('title' , $_POST['name-'.$i] );
		$iteam -> addChild('link' , $_POST['link-'.$i] );
		$iteam -> addChild('describe' , $_POST['describe-'.$i] );
		$iteam -> addChild('image' , $_POST['image-'.$i] );
	};

	// 存储xml结构到index_top_img.xml
	$xml->asXML('../admin/index_top_img.xml');
?>
