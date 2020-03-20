<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-cn" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="zh-cn" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-cn">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title><?php echo dr_lang('%s - 后台管理平台', SITE_NAME); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="<?php echo THEME_PATH; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo THEME_PATH; ?>assets/global/css/xunruicms.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo THEME_PATH; ?>assets/global/css/login.min.css" rel="stylesheet" type="text/css" />
</head>
<body class=" login" style="padding-top: 50px !important;">
<div class="logo">
    <a href="/"><img src="<?php echo THEME_PATH; ?>assets/logo.png" /> </a>
</div>
<div class="content">
    <form class="login-form" action="" onsubmit="return dr_submit()" method="post" style="padding:50px 0">
        <?php echo $form; ?>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            <span>  </span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9"><?php echo dr_lang('账号'); ?></label>
            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" value="<?php echo  defined('DEMO_ADMIN_USERNAME') ? DEMO_ADMIN_USERNAME : ''?>" autocomplete="off" placeholder="<?php echo dr_lang('账号'); ?>" name="data[username]" /> </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9"><?php echo dr_lang('密码'); ?></label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" value="<?php echo  defined('DEMO_ADMIN_PASSWORD') ? DEMO_ADMIN_PASSWORD : ''?>" autocomplete="off" placeholder="<?php echo dr_lang('密码'); ?>" name="data[password]" /> </div>
        </div>
        <?php if (SYS_ADMIN_CODE) {  if ($is_mobile) { ?>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9"><?php echo dr_lang('验证码'); ?></label>
            <div class="input-icon">
                <i class="fa fa-code"></i>
                <input class="form-control placeholder-no-fix" type="text"  autocomplete="off" placeholder="<?php echo dr_lang('验证码'); ?>" name="code" />
            </div>
        </div>
        <div class="form-group text-center">
            <?php echo dr_code(120, 35); ?>
        </div>
        <?php } else { ?>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9"><?php echo dr_lang('验证码'); ?></label>
            <div class="input-group">
                <div class="input-icon">
                    <input style="padding-left: 10px !important;" type="text" class="form-control placeholder-no-fix" autocomplete="off" placeholder="<?php echo dr_lang('验证码'); ?>" name="code">
                </div>
                <div class="input-group-btn fc-code" style="padding-left: 10px;">
                    <?php echo dr_code(120, 35); ?>
                </div>
            </div>
        </div>
        <?php }  } ?>
        <div class="form-actions">
            <button type="submit" class="btn default btn-block  "> <?php echo dr_lang('登录后台'); ?> </button>
        </div>
        <?php if (SYS_ADMIN_OAUTH && $oauth) { ?>
        <div class="login-oauth">
            <?php if (is_array($oauth)) { $key_t=-1;$count_t=dr_count($oauth);foreach ($oauth as $t) { $key_t++; ?>
            <a href="<?php echo $t['url']; ?>"><i class="fa fa-<?php echo $t['name']; ?>"></i></a>
            <?php } } ?>
        </div>
        <?php } ?>
    </form>
</div>
<?php if ($license['name']) {  if ($license['url']) { ?>
<div class="copyright"> <a style="color: #fff" href="<?php echo $license['url']; ?>" target="_blank"><?php echo $license['name']; ?></a> </div>
<?php }  } else { ?>
<div class="copyright"> <a style="color: #fff" href="http://www.xunruicms.com" target="_blank">思考豆CMS开源建站框架</a> </div>
<?php } ?>
<!--[if lt IE 9]>
<script src="<?php echo THEME_PATH; ?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo THEME_PATH; ?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo THEME_PATH; ?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?php echo THEME_PATH; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo THEME_PATH; ?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
<script src="<?php echo THEME_PATH; ?>assets/global/scripts/app.min.js" type="text/javascript"></script>
<script src="<?php echo THEME_PATH; ?>assets/layer/layer.js" type="text/javascript"></script>
<script src="<?php echo LANG_PATH; ?>lang.js" type="text/javascript"></script>
<script src="<?php echo THEME_PATH; ?>assets/js/cms.js" type="text/javascript"></script>
<script type="text/javascript">
    var is_admin = 1;
    if (typeof parent.layer == 'function') {
        parent.layer.closeAll('loading');
    }
    function dr_submit() {
        $('.alert-danger', $('.login-form')).hide();
        $.ajax({type: "POST",dataType:"json", url: '<?php echo dr_now_url(); ?>', data: $(".login-form").serialize(),
            success: function(json) {
                if (json.code == 1) {
                    window.location.href = json.data.url;
                } else {
                    $('.fc-code img').click();
                    $('.alert-danger span', $('.login-form')).html(json.msg);
                    $('.alert-danger', $('.login-form')).show();
                }
            },
            error: function(HttpRequest, ajaxOptions, thrownError) {
                $('.fc-code img').click();
                dr_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
            }
        });
        return false;
    }
    <?php $bg = array('"'.THEME_PATH.'assets/global/login/1.jpg"',
            '"'.THEME_PATH.'assets/global/login/2.jpg"',
            '"'.THEME_PATH.'assets/global/login/3.jpg"',
            '"'.THEME_PATH.'assets/global/login/4.jpg"');
    shuffle($bg);
    ?>
    jQuery(document).ready(function() {
        $.backstretch([
            <?php echo implode(',', $bg); ?>
        ], {
            fade: 1000,
            duration: 8000
        }
        );
        $('.login-form input').keypress(function (e) {
            if (e.which == 13) {
                dr_submit();
                return false;
            }
        });

    });
</script>
<?php if (isset($_GET['isback']) && $_GET['isback']) { ?>
<script type="text/javascript">
    $(function(){
        dr_tips(<?php echo intval($_GET['iscode']); ?>, "<?php echo dr_safe_replace($_GET['isback']); ?>")
    });
</script>
<?php } ?>
</body>
</html>