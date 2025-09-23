<!-- bootstrap -->
<link rel="stylesheet" href="/static/bootstrap/css/bootstrap.css">
<!-- ganline_admin -->
<link rel="stylesheet" href="/static/css/admin.css">
<script type="text/javascript" src="/static/js/jquery-1.8.3.min.js"></script>
<script src="/static/js/admin.js" type="text/javascript"></script>
<div class="wrap">
	<div id="icon-index" class="icon32"><br></div>
	<h2>橄榄传媒后台管理系统</h2>
	<div class="col-md-9 up_data_page">
		<form action="<?php bloginfo('template_url'); ?>/admin/comment_index_img.php" method="post">
			<!-- 管理项目案例 -->
			<div class="panel panel-default ">
				<div class="panel-heading">
					<h3 class="panel-title">管理项目案例</h3>
				</div>
				<form action="comment_index_img.php" method="post">
				<div class="panel-body input_white_input up_data_html">

					<?php
						$xml = simplexml_load_file(TEMPLATEPATH . '/admin/index_top_img.xml');
						// foreach ($xml -> iteam  as $iteams) {
						for($i = 0; $i < count($xml -> iteam); $i ++) {
					?>
					<div class="up_iteam">
						<h5 class="h5">
							<i class="eq"><?php echo $i ?></i>
							案例：

							<span><?php print ($xml->iteam[$i] -> title); ?></span>
							&nbsp;&nbsp;
							<div class="fn-right act">
								<a href="javascript:;" class="glyphicon glyphicon-arrow-up"></a>
								<a href="javascript:;" class="glyphicon glyphicon-arrow-down"></a>
								<button type="button" class="close" aria-hidden="true">&times;</button>
							</div>
						</h3>
						<img style="margin-bottom:10px; display:block;" src="<?php print ($xml->iteam[$i] -> image)?>" width="782" height="383">
						<div class="bs-example-form">
							<div class="input-group">
								<span class="input-group-addon">名称：</span>
								<input type="text" class="form-control" placeholder="最长16个字" data-attr="name" name="name-<?php echo $i ?>" value="<?php print ($xml->iteam[$i] -> title); ?>">
							</div>
							<div class="input-group">
								<span class="input-group-addon">简介：</span>
								<input type="text" class="form-control" placeholder="最长80字，以<br>分行" name="describe-<?php echo $i ?>" value="<?php print ($xml->iteam[$i] -> describe)?>" data-attr="describe"></div>
							<div class="input-group">
								<span class="input-group-addon">网址：</span>
								<input type="text" class="form-control" placeholder="http://" name="link-<?php echo $i ?>" value="<?php print ($xml->iteam[$i] -> link) ?>" data-attr="link"></div>
							<div class="input-group">
								<span class="input-group-addon">图片地址：</span>
								<input type="text" class="form-control" placeholder="" d name="image-<?php echo $i ?>" value="<?php print ($xml->iteam[$i] -> image)?>" data-attr="image">
							</div>
						</div>
					</div>
					<?php
						}
					?>
				</div>
			</div>
			<div class="text-center">
				<div class="btn-group">
					<button class="btn btn-default add_iteam_btn" type="button">
					添加一组新条目
					</button>
					<!-- 隐藏的input，count用来计算一共循环了多少次 -->
					<input type="hidden" class="poll_post" name="poll" value="<?php echo count($xml -> iteam) - 1?>">
					<button class="btn btn-success" type="submit">
					完成编辑
					</button>
				</div>
			</div>
		</form>
	</div>
	<script>
		$(function(){
			eqIteam();
		});
	</script>
</div>