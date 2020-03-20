<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="note note-danger">
    <p><a href="javascript:dr_update_cache_all();"><?php echo dr_lang('更改数据之后请更新下全站缓存'); ?></a></p>
</div>

<div class="right-card-box">
<form class="form-horizontal" role="form" id="myform">
    <?php echo dr_form_hidden(); ?>
    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-hover table-checkable dataTable">
            <thead>
            <tr class="heading">
                <?php if (\Phpcmf\Service::C()->_is_admin_auth('del')) { ?>
                <th class="myselect">
                    <label class="mt-table mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="group-checkable" data-set=".checkboxes" />
                        <span></span>
                    </label>
                </th>
                <?php } ?>
                <th class="hidden-mobile" width="70" style="text-align:center"> <?php echo dr_lang('排序'); ?> </th>
                <th class="hidden-mobile" width="60" style="text-align:center"> <?php echo dr_lang('可用'); ?> </th>
                <th width="250"> <?php echo dr_lang('名称'); ?> </th>
                <th style="text-align:center" width="80">
                    <?php if (\Phpcmf\Service::C()->_is_admin_auth('add')) { ?><a href="javascript:dr_iframe('add', '<?php echo dr_url('member_menu/add', ['pid'=>0]); ?>');" class="btn btn-xs blue"> <i class="fa fa-plus"></i> <?php echo dr_lang('添加'); ?> </a><?php } ?>
                </th>
                <th> <?php echo dr_lang('用户组划分(默认全部组)'); ?> </th>
                <th> <?php echo dr_lang('站点划分(默认全部站点)'); ?> </th>
            </tr>
            </thead>
            <tbody>
            <?php $top=array();  if (is_array($data)) { $key_t=-1;$count_t=dr_count($data);foreach ($data as $t) { $key_t++;  $t['pid'] == 0 && $top[] = $t['id']; $t['group'] = dr_string2array($t['group']);$t['site'] = dr_string2array($t['site']); ?>
            <tr class="odd gradeX" id="dr_row_<?php echo $t['id']; ?>">
                <?php if (\Phpcmf\Service::C()->_is_admin_auth('del')) { ?>
                <td class="myselect">
                    <label class="mt-table mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" name="ids[]" value="<?php echo $t['id']; ?>" />
                        <span></span>
                    </label>
                </td>
                <?php } ?>
                <td class="hidden-mobile" style="text-align:center"> <input type="text" onblur="dr_ajax_save(this.value, '<?php echo dr_url('member_menu/save_edit', ['id'=>$t['id']]); ?>', 'displayorder')" value="<?php echo $t['displayorder']; ?>" class="displayorder form-control input-sm input-inline input-mini"> </td>
                <td class="hidden-mobile" style="text-align:center">
                    <a href="javascript:;" onclick="dr_ajax_open_close(this, '<?php echo dr_url('member_menu/use_edit', ['id'=>$t['id']]); ?>', 1);" class="badge badge-<?php if ($t['hidden']) { ?>no<?php } else { ?>yes<?php } ?>"><i class="fa fa-<?php if ($t['hidden']) { ?>times<?php } else { ?>check<?php } ?>"></i></a>
                </td>
                <td>
                    <?php echo $t['spacer']; ?> <a href="javascript:dr_iframe('edit', '<?php echo dr_url('member_menu/edit', ['id'=>$t['id']]); ?>');"><i class="<?php echo $t['icon']; ?>"></i> <?php echo $t['name']; ?></a>
                </td>
                <td style="text-align:center">
                    <?php if (\Phpcmf\Service::C()->_is_admin_auth('add') && $t['pid'] == 0) { ?><a href="javascript:dr_iframe('add', '<?php echo dr_url('member_menu/add', ['pid'=>$t['id']]); ?>', '', '<?php if (@in_array($t['pid'], $top)) { ?>500px<?php } ?>');" class="btn btn-xs blue"> <i class="fa fa-plus"></i> <?php echo dr_lang('添加'); ?> </a><?php } ?>
                </td>
                <td>
                    <?php if (is_array($t['group'])) { $key_gid=-1;$count_gid=dr_count($t['group']);foreach ($t['group'] as $b=>$gid) { $key_gid++; ?>
                    <label id="dr_row_<?php echo $t['id']; ?>_<?php echo $gid; ?>"><a href="javascript:dr_delete('<?php echo $t['id']; ?>', '<?php echo $gid; ?>');" class="btn btn-xs <?php echo $color[$b]; ?>"><?php echo $group[$gid][name]; ?> <i class="fa fa-times"></i> </a></label>
                    <?php } } ?>
                </td>
                <td>
                    <?php if (is_array($t['site'])) { $key_sid=-1;$count_sid=dr_count($t['site']);foreach ($t['site'] as $b=>$sid) { $key_sid++; ?>
                    <label id="dr_site_<?php echo $t['id']; ?>_<?php echo $sid; ?>"><a href="javascript:dr_site_delete('<?php echo $t['id']; ?>', '<?php echo $sid; ?>');" class="btn btn-xs <?php echo $color[$b]; ?>"><?php echo \Phpcmf\Service::C()->site_info[$sid]['SITE_NAME']; ?> <i class="fa fa-times"></i> </a></label>
                    <?php } } ?>
                </td>
            </tr>
            <?php } } ?>
            </tbody>
        </table>
    </div>
         <div class="row fc-list-footer table-checkable ">
             <div class="col-md-12 fc-list-select">
                <?php if (\Phpcmf\Service::C()->_is_admin_auth('del')) { ?>
                <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set=".checkboxes" />
                    <span></span>
                </label>
                <label><button type="button" onclick="dr_ajax_option('<?php echo dr_url('member_menu/del'); ?>', '<?php echo dr_lang('你确定要删除它们吗？'); ?>', 1)" class="btn red btn-sm"> <i class="fa fa-trash"></i> <?php echo dr_lang('删除'); ?></button></label>

                <label style="margin-left: 20px;"><button type="button" onclick="dr_ajax_option('<?php echo dr_url('member_menu/group_add'); ?>', '<?php echo dr_lang('你确定要这样操作吗？'); ?>', 1)" class="btn green btn-sm"> <i class="fa fa-edit"></i> <?php echo dr_lang('批量划分用户组权限'); ?></button></label>
                <label>
                    <select name="groupid" class="form-control">
                        <option value=""> <?php echo dr_lang('--'); ?> </option>
                        <?php if (is_array($group)) { $key_t=-1;$count_t=dr_count($group);foreach ($group as $t) { $key_t++; ?>
                        <option value="<?php echo $t['id']; ?>"><?php echo $t['name']; ?></option>
                        <?php } } ?>
                    </select>
                </label>

                <label style="margin-left: 20px;"><button type="button" onclick="dr_ajax_option('<?php echo dr_url('member_menu/site_add'); ?>', '<?php echo dr_lang('你确定要这样操作吗？'); ?>', 1)" class="btn blue btn-sm"> <i class="fa fa-edit"></i> <?php echo dr_lang('批量划分站点权限'); ?></button></label>
                <label>
                    <select name="siteid" class="form-control">
                        <option value=""> <?php echo dr_lang('--'); ?> </option>
                        <?php if (is_array(\Phpcmf\Service::C()->site_info)) { $key_t=-1;$count_t=dr_count(\Phpcmf\Service::C()->site_info);foreach (\Phpcmf\Service::C()->site_info as $t) { $key_t++; ?>
                        <option value="<?php echo $t['SITE_ID']; ?>"><?php echo $t['SITE_NAME']; ?></option>
                        <?php } } ?>
                    </select>
                </label>
                <?php } ?>
             </div>
         </div>
</form>
</div>
<script type="text/javascript">
    function dr_delete(id, gid) {
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
            url: '<?php echo dr_url('member_menu/group_del'); ?>&id='+id+'&gid='+gid,
            dataType: "json",
            success: function (json) {
                layer.close(index);
                if (json.code == 1) {
                    $('#dr_row_'+id+'_'+gid).hide();
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
    function dr_site_delete(id, sid) {
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
            url: '<?php echo dr_url('member_menu/site_del'); ?>&id='+id+'&sid='+sid,
            dataType: "json",
            success: function (json) {
                layer.close(index);
                if (json.code == 1) {
                    $('#dr_site_'+id+'_'+sid).hide();
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