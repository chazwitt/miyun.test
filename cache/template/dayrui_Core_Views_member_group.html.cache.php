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
    function dr_add_group() {
        var loading = layer.load(2, {
            shade: [0.3,'#fff'], //0.1透明度的白色背景
            time: 10000
        });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '<?php echo dr_url('member/group_all_edit'); ?>',
            data: $("#myform2").serialize(),
            success: function(json) {
                layer.close(loading);
                if (json.code == 1) {
                    setTimeout("window.location.reload(true)", 1000)
                }
                dr_layer_tips(json.msg);
            },
            error: function(HttpRequest, ajaxOptions, thrownError) {
                dr_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
            }
        });
    }
    function dr_delete(gid) {
        var loading = layer.load(2, {
            shade: [0.3,'#fff'], //0.1透明度的白色背景
            time: 10000
        });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '<?php echo dr_url('member/group_del', ['uid'=>$id]); ?>&gid='+gid,
            data: $("#myform2").serialize(),
            success: function(json) {
                layer.close(loading);
                if (json.code == 1) {
                    setTimeout("window.location.reload(true)", 1000)
                }
                dr_layer_tips(json.msg);
            },
            error: function(HttpRequest, ajaxOptions, thrownError) {
                dr_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
            }
        });
    }
</script>

<form class="form-horizontal " role="form" id="myform2">
    <?php echo $form; ?>
    <input name="ids[]" value="<?php echo $id; ?>" type="hidden">
    <label>
        <select name="groupid" class="form-control">
            <option value=""> -- </option>
            <?php if (is_array($group)) { $key_t=-1;$count_t=dr_count($group);foreach ($group as $t) { $key_t++; ?>
            <option value="<?php echo $t['id']; ?>" <?php if ($param['groupid']==$t['id']) { ?>selected<?php } ?>><?php echo $t['name']; ?></option>
            <?php } } ?>
        </select>
    </label>
    <label><button style="padding: 6px;" type="button" onclick="dr_add_group()" class="btn green btn-sm"> <i class="fa fa-plus"></i> <?php echo dr_lang('添加用户组'); ?></button></label>

</form>
<form class="form-horizontal myfbody" role="form" id="myform">
    <?php echo $form; ?>
    <div class="table-scrollable ">
        <table class="table table-striped table-bordered table-hover table-checkable dataTable">
            <thead>
            <tr class="heading">
                <th width="50"> </th>
                <th width="150"> <?php echo dr_lang('用户组'); ?> </th>
                <th width="150"> <?php echo dr_lang('等级'); ?> </th>
                <th> <?php echo dr_lang('有效期'); ?> </th>
            </tr>
            </thead>
            <tbody>
            <?php if (is_array($mygroup)) { $key_t=-1;$count_t=dr_count($mygroup);foreach ($mygroup as $i=>$t) { $key_t++; ?>
            <tr class="odd gradeX">
                <td><a href="javascript:dr_delete('<?php echo $t['gid']; ?>');" class="btn btn-xs red"> <i class="fa fa-times"></i> </a></td>
                <td><?php echo $group[$t['gid']]['name']; ?></td>
                <td>
                    <?php if ($group[$t['gid']]['setting']['level']['auto']) {  echo $group[$t[gid]]['level'][$t['lid']]['name'];  } else { ?>
                        <select name="data[<?php echo $t['gid']; ?>][lid]" class="form-control">
                            <option value="0"> -- </option>
                            <?php if (is_array($group[$t[gid]]['level'])) { $key_lv=-1;$count_lv=dr_count($group[$t[gid]]['level']);foreach ($group[$t[gid]]['level'] as $lv) { $key_lv++; ?>
                            <option value="<?php echo $lv['id']; ?>" <?php if ($lv['id']==$t['lid']) { ?>selected<?php } ?>><?php echo $lv['name']; ?></option>
                            <?php } } ?>
                        </select>
                    <?php } ?>
                </td>
                <td>
                    <div class="input-group input-medium date-picker input-daterange" data-date="" data-date-format="yyyy-mm-dd">
                        <input type="text" class="form-control" value="<?php echo dr_date($t['stime'], 'Y-m-d'); ?>" name="data[<?php echo $t['gid']; ?>][stime]">
                        <span class="input-group-addon"> <?php echo dr_lang('到'); ?> </span>
                        <input type="text" class="form-control" value="<?php echo dr_date($t['etime'], 'Y-m-d'); ?>" name="data[<?php echo $t['gid']; ?>][etime]">
                    </div>
                </td>
            </tr>
            <?php } } ?>
            </tbody>
        </table>
    </div>


</form>



<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>