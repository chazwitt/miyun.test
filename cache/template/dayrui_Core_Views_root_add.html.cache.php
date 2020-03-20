<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="note note-danger">
    <p><?php echo dr_lang('管理员账号允许同时拥有多个角色组'); ?></p>
</div>
<form action="" class="form-horizontal" method="post" name="myform" id="myform">
    <?php echo dr_form_hidden(); ?>
    <div class="portlet bordered light myfbody">
        <div class="portlet-title">
            <div class="caption">
                <span class="caption-subject font-green-sharp">
                    <?php echo dr_lang('管理员'); ?>
                </span>
            </div>
        </div>
        <div class="portlet-body form">
            <div class="form-body">

                <?php if ($edit) { ?>
                <div class="form-group">
                    <label class="col-md-2 control-label "><?php echo dr_lang('账号'); ?></label>
                    <div class="col-md-9">
                        <p class="form-control-static"> <?php echo $data['username']; ?> </p>
                    </div>
                </div>
                <?php } else { ?>
                <div class="form-group" id="dr_row_username">
                    <label class="col-md-2 control-label"><?php echo dr_lang('账号'); ?></label>
                    <div class="col-md-7">
                        <label>
                            <input type="text" onblur="dr_ck_username()" id="dr_username" name="data[username]" value="<?php echo $data['username']; ?>" class="form-control input-large">
                        </label>
                    </div>
                </div>
                <?php } ?>
                <div class="form-group fcreg">
                    <label class="col-md-2 control-label"><?php echo dr_lang('姓名'); ?></label>
                    <div class="col-md-7">
                        <label>
                            <input type="text" name="data[name]" value="<?php echo $data['name']; ?>" class="form-control input-large">
                        </label>
                    </div>
                </div>
                <div class="form-group fcreg" id="dr_row_password">
                    <label class="col-md-2 control-label"><?php echo dr_lang('密码'); ?></label>
                    <div class="col-md-7">
                        <label>
                            <input type="text" name="data[password]" value=""  placeholder="<?php echo dr_lang('留空表示不修改密码'); ?>" class="form-control input-large">
                        </label>
                    </div>
                </div>
                <div class="form-group fcreg" id="dr_row_email">
                    <label class="col-md-2 control-label"><?php echo dr_lang('邮箱'); ?></label>
                    <div class="col-md-7">
                        <label>
                            <input type="text" name="data[email]" value="<?php echo $data['email']; ?>" class="form-control input-large">
                        </label>
                    </div>
                </div>
                <div class="form-group fcreg" id="dr_row_phone">
                    <label class="col-md-2 control-label"><?php echo dr_lang('手机'); ?></label>
                    <div class="col-md-7">
                        <label>
                            <input type="text" name="data[phone]" value="<?php echo $data['phone']; ?>" class="form-control input-large">
                        </label>
                    </div>
                </div>
                <div class="form-group" id="dr_row_role">
                    <label class="col-md-2 control-label"><?php echo dr_lang('角色组'); ?></label>
                    <div class="col-md-7" style="padding-top: 10px">
                        <div class="mt-checkbox-list">
                            <?php if (is_array(\Phpcmf\Service::C()->role)) { $key_t=-1;$count_t=dr_count(\Phpcmf\Service::C()->role);foreach (\Phpcmf\Service::C()->role as $rid=>$t) { $key_t++; ?>
                            <label class="mt-checkbox mt-checkbox-outline">
                                <input type="checkbox" name="data[role][]" <?php if ($data[role][$rid]) { ?> checked<?php } ?> value="<?php echo $rid; ?>"> <?php echo $t['name']; ?>
                                <span></span>
                            </label>
                            <?php } } ?>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="portlet-body form myfooter">
        <div class="form-actions text-center">
            <button type="button" onclick="dr_ajax_submit('<?php echo dr_now_url(); ?>', 'myform', '2000')" class="btn green"> <i class="fa fa-save"></i> <?php echo dr_lang('保存内容'); ?></button>
            <button type="button" onclick="dr_ajax_submit('<?php echo dr_now_url(); ?>', 'myform', '2000', '<?php echo $post_url; ?>')" class="btn blue"> <i class="fa fa-plus"></i> <?php echo dr_lang('保存再添加'); ?></button>
            <button type="button" onclick="dr_ajax_submit('<?php echo dr_now_url(); ?>', 'myform', '2000', '<?php echo $reply_url; ?>')" class="btn yellow"> <i class="fa fa-mail-reply-all"></i> <?php echo dr_lang('保存并返回'); ?></button>
        </div>
    </div>
</form>
<?php if (!$edit) { ?>
<script>
    $('.fcreg').hide();
    function dr_ck_username() {
        var name = $('#dr_username').val();
        $.ajax({type: "GET",dataType:"json", url: "<?php echo dr_url('root/ck_index'); ?>&name="+name,
            success: function(json) {
                if (json.code) {
                    // 没有注册
                    $('.fcreg').show();
                } else {
                    $('.fcreg').hide();
                }
            },
            error: function(HttpRequest, ajaxOptions, thrownError) {
                dr_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
            }
        });
    }
</script>
<?php }  if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>