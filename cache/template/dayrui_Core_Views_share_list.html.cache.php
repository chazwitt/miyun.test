<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>

<link href="<?php echo THEME_PATH; ?>assets/global/plugins/bootstrap-daterangepicker/daterangepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo THEME_PATH; ?>assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo THEME_PATH; ?>assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo THEME_PATH; ?>assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
<script src="<?php echo THEME_PATH; ?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.finecms.js" type="text/javascript"></script>

<script type="text/javascript">
    if (App.isAngularJsApp() === false) {
        jQuery(document).ready(function() {
            if (jQuery().datepicker) {
                $('.date-picker').datepicker({
                    rtl: App.isRTL(),
                    orientation: "left",
                    autoclose: true
                });
            }
        });
    }
    function dr_module_delete() {
        var url = '<?php echo dr_url(APP_DIR.'/home/del'); ?>&is_ajax=1';
        var width = '50%';
        var height = '60%';
        if (is_mobile_cms == 1) {
            width = height = '90%';
        }
        var data = $("#myform").serialize();
        layer.open({
            type: 2,
            title: '<?php echo dr_lang('删除确认'); ?>',
            shadeClose: true,
            shade: 0,
            area: [width, height],
            btn: [lang['ok']],
            yes: function(index, layero){
                var body = layer.getChildFrame('body', index);
                $(body).find('.form-group').removeClass('has-error');
                // 延迟加载
                var loading = layer.load(2, {
                    shade: [0.3,'#fff'], //0.1透明度的白色背景
                    time: 5000
                });
                $.ajax({type: "POST",dataType:"json", url: url, data: $(body).find('#myform').serialize(),
                    success: function(json) {
                        layer.close(loading);
                        if (json.code == 1) {
                            layer.close(index);
                            setTimeout("window.location.reload(true)", 2000)
                        } else {
                            $(body).find('#dr_row_'+json.data.field).addClass('has-error');
                        }
                        dr_tips(json.code, json.msg);
                        return false;
                    },
                    error: function(HttpRequest, ajaxOptions, thrownError) {
                        dr_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
                    }
                });
                return false;
            },
            content: url+'&'+data
        });
    }
</script>


<div class="right-card-box">
<div class="row table-search-tool">
    <form action="<?php echo SELF; ?>" method="get">
        <?php echo dr_form_search_hidden($p);  if ($is_category_show) { ?>
        <div class="col-md-12 col-sm-12">
            <label>
                <?php echo $category_select; ?>
            </label>
        </div>
        <?php } ?>
        <div class="col-md-12 col-sm-12">
            <label>
                <select name="field" class="form-control">
                    <option value="id"> Id </option>
                    <?php if (is_array($field)) { $key_t=-1;$count_t=dr_count($field);foreach ($field as $t) { $key_t++;  if ($t['ismain']) { ?>
                    <option value="<?php echo $t['fieldname']; ?>" <?php if ($param['field']==$t['fieldname']) { ?>selected<?php } ?>><?php echo $t['name']; ?></option>
                    <?php }  } } ?>
                </select>
            </label>
            <label><i class="fa fa-caret-right"></i></label>
            <label><input type="text" class="form-control" placeholder="" value="<?php echo $param['keyword']; ?>" name="keyword" /></label>
        </div>

        <div class="col-md-12 col-sm-12">
            <label>
                <div class="input-group input-medium date-picker input-daterange" data-date="" data-date-format="yyyy-mm-dd">
                    <input type="text" class="form-control" value="<?php echo $param['date_form']; ?>" name="date_form">
                    <span class="input-group-addon"> <?php echo dr_lang('到'); ?> </span>
                    <input type="text" class="form-control" value="<?php echo $param['date_to']; ?>" name="date_to">
                </div>
            </label>
        </div>
        <div class="col-md-12 col-sm-12">
            <label><button type="submit" class="btn green btn-sm onloading" name="submit" > <i class="fa fa-search"></i> <?php echo dr_lang('搜索'); ?></button></label>
        </div>
    </form>
</div>


<form class="form-horizontal" role="form" id="myform">
    <?php echo dr_form_hidden(); ?>
    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-hover table-checkable dataTable">
            <thead>
            <tr class="heading">
                <th class="myselect">
                    <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="group-checkable" data-set=".checkboxes" />
                        <span></span>
                    </label>
                </th>
                <?php if (\Phpcmf\Service::C()->_is_admin_auth('edit')) { ?>
                <th style="text-align:center" width="70" class="<?php echo dr_sorting('displayorder'); ?>" name="displayorder"><?php echo dr_lang('排序'); ?></th>
                <?php }  if (is_array($list_field)) { $key_t=-1;$count_t=dr_count($list_field);foreach ($list_field as $i=>$t) { $key_t++; ?>
                <th <?php if ($t['width']) { ?> width="<?php echo $t['width']; ?>"<?php } ?> class="<?php echo dr_sorting($i); ?>" name="<?php echo $i; ?>"><?php echo dr_lang($t['name']); ?></th>
                <?php } } ?>
                <th><?php echo dr_lang('操作'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (is_array($list)) { $key_t=-1;$count_t=dr_count($list);foreach ($list as $t) { $key_t++; ?>
            <tr class="odd gradeX" id="dr_row_<?php echo $t['id']; ?>">
                <td class="myselect">
                    <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" name="ids[]" value="<?php echo $t['id']; ?>" />
                        <span></span>
                    </label>
                </td>
                <?php if (\Phpcmf\Service::C()->_is_admin_auth('edit')) { ?>
                <td style="text-align:center"> <input type="text" onblur="dr_ajax_save(this.value, '<?php echo dr_url(APP_DIR.'/home/order_edit', ['id'=>$t['id']]); ?>')" value="<?php echo $t['displayorder']; ?>" class="displayorder form-control input-sm input-inline input-mini"> </td>
                <?php }  if (is_array($list_field)) { $key_tt=-1;$count_tt=dr_count($list_field);foreach ($list_field as $i=>$tt) { $key_tt++; ?>
                <td><?php echo dr_list_function($tt['func'], $t[$i], $param, $t, $field[$i]); ?></td>
                <?php } } ?>

                <td style="overflow:visible">
                    <?php if (\Phpcmf\Service::C()->_is_admin_auth('edit')) { ?>
                    <label><a href="<?php echo dr_url($uriprefix.'/edit', ['id'=>$t['id']]); ?>" class="btn btn-xs red"> <i class="fa fa-edit"></i> <?php echo dr_lang('修改'); ?></a></label>
                    <?php }  if (\Phpcmf\Service::C()->_is_admin_auth('edit') && dr_is_app('copy')) { ?>
                    <label><a href="JavaScript:;" onclick="dr_ajax_confirm_url('<?php echo dr_url('copy/home/content_edit', ['dir'=>MOD_DIR, 'id'=>$t['id']]); ?>', '<?php echo dr_lang('复制将把此内容生成一条新内容'); ?>', '<?php echo dr_now_url(); ?>')" class="btn btn-xs green"> <i class="fa fa-copy"></i> <?php echo dr_lang('复制'); ?></a></label>
                    <?php }  if (is_array($clink)) { $key_a=-1;$count_a=dr_count($clink);foreach ($clink as $a) { $key_a++; ?>
                    <label><a class="btn <?php if ($a['color']) {  echo $a['color'];  } ?> btn-xs" href="<?php echo str_replace(array('{mid}', '{id}', '{cid}'), array(APP_DIR, $t['id'], $t['id']), $a['url']); ?>"><i class="<?php echo $a['icon']; ?>"></i> <?php echo dr_lang($a['name']);  if ($a['field']) { ?> (<?php echo intval($t[$a['field']]); ?>)<?php } ?> </a></label>
                    <?php } }  if (is_array($module['form'])) { $key_a=-1;$count_a=dr_count($module['form']);foreach ($module['form'] as $a) { $key_a++;  if (\Phpcmf\Service::C()->_is_admin_auth(APP_DIR.'/'.$a['table'].'/index')) { ?>
                    <label><a class="btn blue btn-xs" href="<?php echo dr_url(APP_DIR.'/'.$a['table'].'/index', ['cid'=>$t['id']]); ?>"><i class="<?php echo dr_icon($a['setting']['icon']); ?>"></i> <?php echo dr_lang($a['name']);  if (isset($t[$a['table'].'_total'])) { ?> (<?php echo intval($t[$a['table'].'_total']); ?>) <?php } ?> </a></label>
                    <?php }  } }  if ($module['comment'] && \Phpcmf\Service::C()->_is_admin_auth(APP_DIR.'/comment/index')) { ?>
                    <label><a href="<?php echo dr_url(APP_DIR.'/comment/index', ['cid'=>$t['id']]); ?>" class="btn btn-xs dark"> <i class="fa fa-comments"></i> <?php echo dr_lang('%s(%s)', dr_comment_cname(\Phpcmf\Service::C()->module['comment']['cname']), intval($t['comments'])); ?> </a></label>
                    <?php } ?>
                </td>
            </tr>
            <?php } } ?>
            </tbody>
        </table>
    </div>

    <div class="row fc-list-footer table-checkable ">
        <div class="col-md-7 fc-list-select">
            <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="group-checkable" data-set=".checkboxes" />
                <span></span>
            </label>
            <?php if (\Phpcmf\Service::C()->_is_admin_auth('del')) { ?>
            <label><button type="button" onclick="dr_module_delete()" class="btn red btn-sm"> <i class="fa fa-trash"></i> <?php echo dr_lang('删除'); ?></button></label>
            <?php }  if ($is_flag && \Phpcmf\Service::C()->_is_admin_auth('del')) { ?>
            <label><button type="button" onclick="dr_ajax_option('<?php echo dr_now_url(); ?>', '<?php echo dr_lang('你确定要移除推荐位吗？'); ?>', 1)" class="btn red btn-sm"> <i class="fa fa-close"></i> <?php echo dr_lang('移除'); ?></button></label>
            <?php }  if (\Phpcmf\Service::C()->_is_admin_auth('edit')) {  if ($is_category_show) { ?>
            <label><?php echo $move_select; ?></label>
            <label><button type="button" onclick="dr_ajax_option('<?php echo dr_url(APP_DIR.'/home/move_edit'); ?>', '<?php echo dr_lang('你确定要更改栏目吗？'); ?>', 1)" class="btn green btn-sm"> <i class="fa fa-edit"></i> <?php echo dr_lang('更改'); ?></button></label>
            <?php } ?>
            <label>
                <div class="btn-group dropup">
                    <a class="btn  blue btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true" aria-expanded="false" href="javascript:;"> <?php echo dr_lang('批量'); ?>
                        <i class="fa fa-angle-up"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (is_array($cbottom)) { $key_a=-1;$count_a=dr_count($cbottom);foreach ($cbottom as $a) { $key_a++; ?>
                        <li>
                            <a href="<?php echo str_replace('{mid}', APP_DIR, urldecode($a['url'])); ?>"> <i class="<?php echo $a['icon']; ?>"></i> <?php echo dr_lang($a['name']); ?> </a>
                        </li>
                        <?php } } ?>

                    </ul>
                </div>
            </label>
            <?php } ?>
        </div>
        <div class="col-md-5 fc-list-page">
            <?php echo $mypages; ?>
        </div>
    </div>


</form>
</div>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>