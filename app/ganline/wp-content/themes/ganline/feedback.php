<?php
	/*
	Template Name: feedback
	*/ 
?>
<?php get_header(); ?>

<script type = "text/javascript" >
	function countDown(secs, surl) {
		var jumpTo = document.getElementById('jumpTo');
		jumpTo.innerHTML = secs;
		if (--secs > 0) {
			setTimeout("countDown(" + secs + ",'" + surl + "')", 800);
		} else {
			location.href = surl;
		}
	}
</script>

<section class="content fn-ov">
	<div class="page_feedback">
		<p>
			<?php
				session_start();
				$hide = $_POST['hidden'];
				// var_dump($_SESSION);
				if($hide == $_SESSION['conn']) {
				?>
					您好，贵单位的需求已提交到销售部，稍后会有销售人员与您联系。<br>
					<span id="jumpTo">8</span>秒后自动跳转，如果页面没有跳转，请<a href="<?php bloginfo('url'); ?>" class="go_back">点击这里</a>
					<?php 
						//载入phpmailer模块

						include ('class-phpmailer.php');

						//读取传来的数据
						$mail_name = $_POST['user'];
						$mail_contact = $_POST['contact'];
						$mail_min_money = $_POST['min_money'];
						$mail_max_money = $_POST['max_money'];
						$mail_demand = $_POST['demand'];
						$mail_time = date('Y-m-d H:i:s');

						//phpmailer配置
						$mail=new PHPMailer();

						// 设置PHPMailer使用SMTP服务器发送Email
						$mail->IsSMTP();

						// 设置邮件的字符编码，若不指定，则为'UTF-8'
						$mail->CharSet='UTF-8';

						// 添加收件人地址，可以多次使用来添加多个收件人
						$mail->AddAddress('sales@ganline.com');

						// 设置邮件正文
						// $message = "你好，这是来自橄榄传媒官方网站的客户留言：" . $mail_demand . "<br/>最低预算：" . $mail_min_money . "<br/>最高预算：" . $mail_max_money . "请通过" . $mail_contact . "来联系TA进行回访";

						//声明邮件使用HTML
						$mail->IsHTML(true);

						// 设置邮件正文
						$mail->Body="你好，这是来自橄榄传媒官方网站的客户留言：<br>" . $mail_demand . "<br><br/>项目费用预算在：" . $mail_min_money . " 至 " . $mail_max_money . "之间<br><br>请通过 " . $mail_contact . " 来联系客户进行回访<br><br><br>" . "<i>发送时间：" . $mail_time . "</i>";

						// 设置邮件头的From字段。
						$mail->From='mail@ganline.com';

						// 设置发件人名字
						$mail->FromName='mail@橄榄传媒';

						// 设置邮件标题
						$mail->Subject = "来自" . $mail_name . "的新项目需求";

						// 设置SMTP服务器
						$mail->Host='smtp.exmail.qq.com';

						// 设置为“需要验证”
						$mail->SMTPAuth=true;

						// SMTP 安全协议
						$mail->SMTPSecure="ssl";

						// SMTP服务器的端口号
						$mail->Port=465;

						// 设置用户名和密码
						$mail->Username='mail@ganline.com';
						$mail->Password='ganline123';

						// 发送邮件
						$mail->Send();
					?>
				<?php 
				} else {
				?>
					非法操作，请<a href="<?php bloginfo('url'); ?>" class="go_back">返回</a>
				<?php 
				}
				session_destroy();
			?>
		</p>
	</div>
	<script type="text/javascript">countDown(8,'/');</script> 
</section>


<?php get_footer(); ?>