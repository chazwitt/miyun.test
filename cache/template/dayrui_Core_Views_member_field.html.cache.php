<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>

<div class="note note-danger">
    <p><a href="javascript:dr_update_cache('member');"><?php echo dr_lang('更改数据之后需要更新缓存之后才能生效'); ?></a></p>
</div>

<div class="right-card-box">
    <form class="form-horizontal" role="form" id="myform">
        <?php echo dr_form_hidden(); ?>
        <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover table-checkable dataTable">
                <thead>
                <tr class="heading">
                    <th width="45"></th>
                    <th width="250"><?php echo dr_lang('字段信息'); ?></th>
                    <th width="80" style="text-align:center"><?php echo dr_lang('注册显示'); ?></th>
                    <th><?php echo dr_lang('字段划分情况'); ?></th>
                </tr>
                </thead>
                <tbody>
                <?php if (is_array($list)) { $key_t=-1;$count_t=dr_count($list);foreach ($list as $t) { $key_t++; ?>
                <tr class="odd gradeX" id="dr_row_<?php echo $t['id']; ?>">
                    <?php if (\Phpcmf\Service::C()->_is_admin_auth('add')) { ?>
                    <td class="myselect">
                        <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                            <input type="checkbox" class="checkboxes" name="ids[]" value="<?php echo $t['id']; ?>" />
                            <span></span>
                        </label>
                    </td>
                    <?php } ?>
                    <td><?php echo $t['name']; ?> / <?php echo $t['fieldname']; ?></td>
                    <td style="text-align:center">
                        <a href="javascript:;" onclick="dr_ajax_open_close(this, '<?php echo dr_url($uriprefix.'/reg_edit', ['id'=>$t['id']]); ?>', 1);" class="badge badge-<?php if (!$t['register']) { ?>no<?php } else { ?>yes<?php } ?>"><i class="fa fa-<?php if (!$t['register']) { ?>times<?php } else { ?>check<?php } ?>"></i></a>
                    </td>
                    <td>
                        <?php if (is_array($t['group'])) { $key_gid=-1;$count_gid=dr_count($t['group']);foreach ($t['group'] as $gid) { $key_gid++; ?>
                        <label id="dr_row_<?php echo $t['id']; ?>_<?php echo $gid; ?>"><a href="javascript:dr_delete('<?php echo $t['id']; ?>', '<?php echo $gid; ?>');" class="btn btn-xs <?php echo $color[$gid]; ?>"><?php echo $group[$gid][name]; ?> <i class="fa fa-times"></i> </a></label>
                        <?php } }  if (!$t['group']) { ?>
                        <font color="red"><?php echo dr_lang('未划分字段不能在前端显示'); ?></font>
                        <?php } ?>
                    </td>
                </tr>
                <?php } } ?>
                </tbody>
            </table>
        </div>

        <div class="row fc-list-footer table-checkable ">
            <div class="col-md-12 fc-list-select">
            <?php if (\Phpcmf\Service::C()->_is_admin_auth('add')) { ?>
            <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="group-checkable" data-set=".checkboxes" />
                <span></span>
            </label>
            <label><button type="button" onclick="dr_ajax_option('<?php echo dr_url($uriprefix.'/add'); ?>', '<?php echo dr_lang('你确定要这样操作吗？'); ?>', 1)" class="btn green btn-sm"> <i class="fa fa-edit"></i> <?php echo dr_lang('批量划分'); ?></button></label>
            <label>
                <select name="groupid" class="form-control">
                    <option value=""> <?php echo dr_lang('--'); ?> </option>
                    <?php if (is_array($group)) { $key_t=-1;$count_t=dr_count($group);foreach ($group as $t) { $key_t++; ?>
                    <option value="<?php echo $t['id']; ?>"><?php echo $t['name']; ?></option>
                    <?php } } ?>
                </select>
            </label>
            <?php } ?>
            </div>
        </div>
    </form>
</div>
<script type="text/javascript">
    function dr_delete(fid, gid) {
        <?php if (!\Phpcmf\Service::C()->_is_admin_auth('del')) { ?>
        dr_tips(0, '<?php echo dr_lang('无权限删除'); ?>');
        return;
        <?php } ?>
            var index = layer.load(2, {
                shade: [0.3,'#fff'], //0.1透明度的白色背景
                time: 10000
            });
            $.ajax({
                type: "GET",
                cache: false,
                url: '<?php echo dr_url($uriprefix.'/del'); ?>&fid='+fid+'&gid='+gid,
                dataType: "json",
                success: function (json) {
                    layer.close(index);
                    if (json.code == 1) {
                        $('#dr_row_'+fid+'_'+gid).hide();
                        dr_tips(1, json.msg);
                    } else {
                        dr_tips(0, json.msg);
                    }
                },
                error: function(HttpRequest, ajaxOptions, thrownError) {
                    dr_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
                }
            });
        }
</script>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>