<!DOCTYPE html>
<!--[if IE 8]> <html lang="zh-cn" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="zh-cn" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-cn">
<!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <title><?php if ($meta_title) {  echo $meta_title;  } else {  echo dr_lang('%s - 后台管理平台', SITE_NAME);  } ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href="<?php echo THEME_PATH; ?>assets/global/css/xunruicms.css?v=<?php echo $cmf_updatetime; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo THEME_PATH; ?>assets/global/css/my.css?v=<?php echo $cmf_updatetime; ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo THEME_PATH; ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
    <script src="<?php echo THEME_PATH; ?>assets/global/plugins/respond.min.js"></script>
    <script src="<?php echo THEME_PATH; ?>assets/global/plugins/excanvas.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        var admin_file = '<?php echo SELF; ?>';
        var is_mobile_cms = '<?php echo $is_mobile; ?>';
        var is_admin = 1;
    </script>
    <script src="<?php echo LANG_PATH; ?>lang.js?v=<?php echo $cmf_updatetime; ?>" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/global/plugins/jquery.min.js?v=<?php echo $cmf_updatetime; ?>" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/global/plugins/bootstrap/js/bootstrap.min.js?v=<?php echo $cmf_updatetime; ?>" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/global/scripts/app.min.js?v=<?php echo $cmf_updatetime; ?>" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/js/cms.js?v=<?php echo $cmf_updatetime; ?>" type="text/javascript"></script>
    <script src="<?php echo THEME_PATH; ?>assets/global/plugins/js.cookie.min.js?v=<?php echo $cmf_updatetime; ?>" type="text/javascript"></script>
    <script type="text/javascript">
        function dr_update_cache_all() {
            var index = layer.load(2, {
                shade: [0.3,'#fff'], //0.1透明度的白色背景
                time: 10000
            });
            $.ajax({type: "GET",dataType:"json", url: admin_file+"?c=api&m=cache_update",
                success: function(json) {
                    layer.close(index);
                    dr_tips(1, "<?php echo dr_lang('全站缓存更新完成'); ?>");
                },
                error: function(HttpRequest, ajaxOptions, thrownError) {
                    layer.closeAll('loading');
                    dr_tips(0, "<?php echo dr_lang('更新失败，请检查错误日志'); ?>");
                }
            });
        }
        function dr_update_cache_data() {
            var index = layer.load(2, {
                shade: [0.3,'#fff'], //0.1透明度的白色背景
                time: 10000
            });
            $.ajax({type: "GET",dataType:"json", url: admin_file+"?c=api&m=cache_clear",
                success: function(json) {
                    layer.close(index);
                    dr_tips(1, "<?php echo dr_lang('前端数据缓存更新完成'); ?>");
                },
                error: function(HttpRequest, ajaxOptions, thrownError) {
                    layer.closeAll('loading');
                    dr_tips(0, "<?php echo dr_lang('更新失败，请检查错误日志'); ?>");
                }
            });
        }
        function show_category_field(catid) {
            <?php if ($category_field_url) { ?>
            window.location.href = '<?php echo $category_field_url; ?>&catid='+catid;
            <?php } ?>
        }
    </script>
</head>