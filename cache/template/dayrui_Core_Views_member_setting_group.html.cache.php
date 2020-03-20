<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="note note-danger">
    <p><a href="javascript:dr_update_cache('member', '');"><?php echo dr_lang('更改数据之后需要更新缓存之后才能生效'); ?></a></p>
</div>

<div class="right-card-box">
<form class="form-horizontal myfbody" id="myform">
    <?php echo dr_form_hidden(); ?>
    <div class="table-scrollable ">
        <table class="table table-striped table-bordered  table-checkable dataTable">
            <thead>
            <tr class="heading">
                <th width="100">AuthId</th>
                <th width="300"><?php echo dr_lang('用户组'); ?></th>
                <th><?php echo dr_lang('操作'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (is_array($group)) { $key_t=-1;$count_t=dr_count($group);foreach ($group as $i=>$t) { $key_t++; ?>
            <tr class="odd gradeX">
                <td><?php if ($t['use']) {  echo $i;  } ?></td>
                <td <?php echo $t['space']; ?>><?php echo $t['name']; ?></td>
                <td>
                    <?php if ($t['use']) { ?>
                    <button onclick="dr_show_value('<?php echo $i; ?>')" type="button" class="btn blue btn-xs"> <i class="fa fa-cog"></i> <?php echo dr_lang('设置权限'); ?></button>
                    <?php } ?>
                </td>
            </tr>
            <tr class="dr_cat_<?php echo $i; ?> fc-cat-user" style="display: none">
                <td colspan="3" style="text-align: left">
                    <div class="table-scrollable" style="padding-top:20px; border: none">

                        <?php if ($i != 0) { ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('强制上传头像'); ?></label>
                            <div class="col-md-9">
                                <?php if ($data[config][avatar]) { ?>
                                <p class="form-control-static"> <?php echo dr_lang('全局权限已开启'); ?> </p>
                                <?php } else { ?>
                                <input type="checkbox" name="data[<?php echo $i; ?>][avatar]" value="1" <?php if ($data[auth][$i]['avatar']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('是'); ?>" data-off-text="<?php echo dr_lang('否'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('强制完善资料'); ?></label>
                            <div class="col-md-9">
                                <?php if ($data[config][complete]) { ?>
                                <p class="form-control-static"> <?php echo dr_lang('全局权限已开启'); ?> </p>
                                <?php } else { ?>
                                <input type="checkbox" name="data[<?php echo $i; ?>][complete]" value="1" <?php if ($data[auth][$i]['complete']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('是'); ?>" data-off-text="<?php echo dr_lang('否'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('强制手机认证'); ?></label>
                            <div class="col-md-9">
                                <?php if ($data[config][mobile]) { ?>
                                <p class="form-control-static"> <?php echo dr_lang('全局权限已开启'); ?> </p>
                                <?php } else { ?>
                                <input type="checkbox" name="data[<?php echo $i; ?>][mobile]" value="1" <?php if ($data[auth][$i]['mobile']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('是'); ?>" data-off-text="<?php echo dr_lang('否'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <?php } ?>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('附件下载权限'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[<?php echo $i; ?>][downfile]" value="1" <?php if ($data[auth][$i]['downfile']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('是'); ?>" data-off-text="<?php echo dr_lang('否'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('附件上传权限'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[<?php echo $i; ?>][uploadfile]" value="1" <?php if ($data[auth][$i]['uploadfile']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('是'); ?>" data-off-text="<?php echo dr_lang('否'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">

                            </div>
                        </div>
                        <?php if ($i != 0) { ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('每日登录奖励'); ?></label>
                            <div class="col-md-9">
                                <label>
                                    <div class="input-group">
                                        <input type="text" name="data[<?php echo $i; ?>][login_score]" value="<?php echo $data[auth][$i]['login_score']; ?>" class="form-control">
                                        <span class="input-group-btn"><button class="btn default" type="button">+<?php echo SITE_SCORE; ?></button></span>
                                    </div>
                                </label>
                                <label>
                                    <div class="input-group">
                                        <input type="text" name="data[<?php echo $i; ?>][login_exp]" value="<?php echo $data[auth][$i]['login_exp']; ?>" class="form-control">
                                        <span class="input-group-btn"> <button class="btn default" type="button">+<?php echo SITE_EXPERIENCE; ?></button></span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('头像认证奖励'); ?></label>
                            <div class="col-md-9">
                                <label>
                                    <div class="input-group">
                                        <input type="text" name="data[<?php echo $i; ?>][avatar_score]" value="<?php echo $data[auth][$i]['avatar_score']; ?>" class="form-control">
                                        <span class="input-group-btn"><button class="btn default" type="button">+<?php echo SITE_SCORE; ?></button></span>
                                    </div>
                                </label>
                                <label>
                                    <div class="input-group">
                                        <input type="text" name="data[<?php echo $i; ?>][avatar_exp]" value="<?php echo $data[auth][$i]['avatar_exp']; ?>" class="form-control">
                                        <span class="input-group-btn"> <button class="btn default" type="button">+<?php echo SITE_EXPERIENCE; ?></button></span>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <?php } ?>

                    </div>
                </td>
            </tr>
            <?php } } ?>
            </tbody>
        </table>
    </div>
    <div class="portlet-body form myfooter">
        <div class="form-actions text-center">
            <button type="button" onclick="dr_ajax_submit('<?php echo dr_url('member_setting_group/add'); ?>', 'myform', '2000', '<?php echo dr_url('member_setting_group/index'); ?>')" class="btn green"> <i class="fa fa-save"></i> <?php echo dr_lang('保存'); ?></button>
        </div>
    </div>
</form>
</div>
<script>
    function dr_show_value(catid) {
        if ($('.dr_cat_'+catid).is(":hidden")){
            $('.fc-cat-user').hide();
            $('.dr_cat_'+catid).show(200);
        }else{
            $('.dr_cat_'+catid).hide(200);
        }
    }
    function dr_copy_value(catid) {
        dr_iframe('<?php echo dr_lang('复制'); ?>', '<?php echo dr_url('member_setting_group/edit'); ?>&authid='+catid);
    }

</script>
<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>