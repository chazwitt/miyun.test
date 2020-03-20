<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-cn" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="zh-cn" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-cn">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title><?php echo dr_clearhtml($msg); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta content="width=device-width, initial-scale=1" name="viewport" />
	<link href="<?php echo ROOT_THEME_PATH; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo THEME_PATH; ?>assets/global/css/xunruicms.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo THEME_PATH; ?>assets/global/css/my.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript">var admin_file = '<?php echo SELF; ?>'; var assets_path = '<?php echo THEME_PATH; ?>assets/';</script>
	<script src="<?php echo LANG_PATH; ?>lang.js" type="text/javascript"></script>
	<script src="<?php echo ROOT_THEME_PATH; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo ROOT_THEME_PATH; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo ROOT_THEME_PATH; ?>assets/global/scripts/app.js" type="text/javascript"></script>
	<script src="<?php echo ROOT_THEME_PATH; ?>assets/global/scripts/layout.js" type="text/javascript"></script>
	<script src="<?php echo ROOT_THEME_PATH; ?>assets/layer/layer.js" type="text/javascript"></script>
	<script src="<?php echo ROOT_THEME_PATH; ?>assets/js/cms.js" type="text/javascript"></script>
	<script src="<?php echo ROOT_THEME_PATH; ?>assets/js/admin.js" type="text/javascript"></script>
</head>

<body style="background: #ffffff">

<div class="page-404-full-page" style="padding-top:10px">
<div class="row">
	<div class="col-xs-12 page-404">
		<?php if ($mark==1) { ?>
		<div class="admin_msg number font-green-turquoise"> <i class="fa fa-check-circle-o"></i> </div>
		<?php } else if ($mark==2) { ?>
		<div class="admin_msg number font-blue" > <i class="fa fa-info-circle"></i> </div>
		<?php } else { ?>
		<div class="admin_msg number font-red"> <i class="fa fa-times-circle-o"></i> </div>
		<?php } ?>
		<div class="details">
			<h4><?php echo $msg; ?></h4>
			<p class="alert_btnleft">
				<?php if ($url) { ?>
				<a href="<?php echo $url; ?>"><?php echo dr_lang('如果您的浏览器没有自动跳转，请点击这里'); ?></a>
				<meta http-equiv="refresh" content="<?php echo $time; ?>; url=<?php echo $url; ?>">
				<?php } else { ?>
				<a href="<?php echo $backurl; ?>" >[<?php echo dr_lang('点击返回上一页'); ?>]</a>
				<?php } ?>
			</p>

		</div>
	</div>
</div>
</div>
<script>
$(function(){
	$('.page-bar').hide();
	//parent.$('.page-bar').hide();
	parent.$('.module-content-left').hide();
	parent.$('.module-content-right').addClass('page-content4');
	parent.$('.module-content-right').removeClass('page-content2');
});
</script>
</body>
</html>