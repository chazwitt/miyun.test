<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="note note-danger">
    <p><?php echo dr_lang('用户详细资料'); ?></p>
</div>

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
            data: $("#myform").serialize(),
            success: function(json) {
                layer.close(loading);
                if (json.code == 1) {
                    setTimeout("window.location.href='<?php echo dr_now_url(); ?>&page="+$('#dr_page').val()+"'", 1000)
                }
                dr_layer_tips(json.msg);
            },
            error: function(HttpRequest, ajaxOptions, thrownError) {
                dr_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
            }
        });
    }
    function dr_delete(id) {
        var loading = layer.load(2, {
            shade: [0.3,'#fff'], //0.1透明度的白色背景
            time: 10000
        });
        $.ajax({
            type: "POST",
            dataType: "json",
            url: '<?php echo dr_url('member/group_del', ['uid'=>$id]); ?>&id='+id,
            data: $("#myform").serialize(),
            success: function(json) {
                layer.close(loading);
                if (json.code == 1) {
                    setTimeout("window.location.href='<?php echo dr_now_url(); ?>&page="+$('#dr_page').val()+"'", 1000)
                }
                dr_layer_tips(json.msg);
            },
            error: function(HttpRequest, ajaxOptions, thrownError) {
                dr_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
            }
        });
    }
</script>
<form action="" class="form-horizontal" method="post" name="myform" id="myform">
    <?php echo $form; ?>
    <div class="portlet bordered light myfbody">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs" style="float:left;">
                <li class="<?php if ($page==0) { ?>active<?php } ?>">
                    <a href="#tab_0" data-toggle="tab" onclick="$('#dr_page').val('0')"> <i class="fa fa-cog"></i> <?php echo dr_lang('基本信息'); ?> </a>
                </li>
                <li class="<?php if ($page==1) { ?>active<?php } ?>">
                    <a href="#tab_1" data-toggle="tab" onclick="$('#dr_page').val('1')"> <i class="fa fa-reorder"></i> <?php echo dr_lang('自定义字段'); ?> </a>
                </li>
                <li class="<?php if ($page==2) { ?>active<?php } ?>">
                    <a href="#tab_2" data-toggle="tab" onclick="$('#dr_page').val('2')"> <i class="fa fa-gear"></i> <?php echo dr_lang('状态设置'); ?> </a>
                </li>
                <li>
                    <a href="javascript:dr_iframe('<?php echo dr_lang('设置用户组'); ?>', '<?php echo dr_url('member/group_edit', ['id'=>$id]); ?>', '60%')" > <i class="fa fa-users"></i> <?php echo dr_lang('用户组'); ?> </a>
                </li>
                <li class="<?php if ($page==4) { ?>active<?php } ?>">
                    <a href="#tab_4" data-toggle="tab" onclick="$('#dr_page').val('4')"> <i class="fa fa-qq"></i> <?php echo dr_lang('绑定账号'); ?> </a>
                </li>
                <li class="<?php if ($page==5) { ?>active<?php } ?>">
                    <a href="#tab_5" data-toggle="tab" onclick="$('#dr_page').val('5')"> <i class="fa fa-calendar"></i> <?php echo dr_lang('登录记录'); ?> </a>
                </li>
            </ul>
            <div class="actions">
                <div class="btn-group">
                    <a class="btn" href="<?php echo $reply_url; ?>"> <i class="fa fa-mail-reply"></i> <?php echo dr_lang('返回列表'); ?></a>
                </div>
            </div>
        </div>
        <div class="portlet-body">

            <div class="tab-content">

                <div class="tab-pane <?php if ($page==0) { ?>active<?php } ?>" id="tab_0">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label "></label>
                            <div class="col-md-9">
                                <a href="javascript:dr_iframe_show('<?php echo dr_lang('头像设置'); ?>', '<?php echo dr_url('member/avatar_edit', ['id'=>$id]); ?>', '500px');"><img class="img-circle" src="<?php echo dr_avatar($id); ?>" style="width:50px;height:50px"></a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label ">UID</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?php echo $id; ?> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label "><?php echo dr_lang('账号'); ?></label>
                            <div class="col-md-9">
                                <div class="input-group" style="width: 300px;">
                                    <input type="text" readonly value="<?php echo $username; ?>" class="form-control">
                                    <span class="input-group-btn">
                                        <a class="btn red" href="javascript:dr_iframe('<?php echo dr_lang("变更"); ?>', '<?php echo dr_url("member/username_edit", ['id' => $id]); ?>', '500px');"><i class="fa fa-edit"></i> <?php echo dr_lang('变更'); ?></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="dr_row_name">
                            <label class="col-md-2 control-label "><?php echo dr_lang('姓名'); ?></label>
                            <div class="col-md-9">
                                <label><input type="text" class="form-control input-large" id="dr_name" name="member[name]" value="<?php echo $name; ?>"></label>
                            </div>
                        </div>
                        <div class="form-group" id="dr_row_phone">
                            <label class="col-md-2 control-label "><?php echo dr_lang('手机'); ?></label>
                            <div class="col-md-9">
                                <label><input type="text" class="form-control input-large" id="dr_phone" name="member[phone]" value="<?php echo $phone; ?>"></label>
                            </div>
                        </div>
                        <div class="form-group" id="dr_row_email">
                            <label class="col-md-2 control-label "><?php echo dr_lang('邮箱'); ?></label>
                            <div class="col-md-9">
                                <label><input type="text" class="form-control input-large" id="dr_email" name="member[email]" value="<?php echo $email; ?>"></label>
                            </div>
                        </div>
                        <div class="form-group" id="dr_row_password">
                            <label class="col-md-2 control-label "><?php echo dr_lang('密码'); ?></label>
                            <div class="col-md-9">
                                <label><input type="text" class="form-control input-large" id="dr_password" name="password" placeholder="<?php echo dr_lang('留空表示不修改密码'); ?>"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label "><?php echo dr_lang('账户余额'); ?></label>
                            <div class="col-md-9">
                                <p class="form-control-static"> ￥<?php echo $money; ?> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label "><?php echo dr_lang('注册时间'); ?></label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?php echo dr_date($regtime); ?> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label "><?php echo dr_lang('注册地址'); ?></label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?php echo \Phpcmf\Service::L('Function_list')->ip($regip); ?> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label "><?php echo dr_lang('随机验证码'); ?></label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?php echo $randcode; ?> </p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="tab-pane <?php if ($page==1) { ?>active<?php } ?>" id="tab_1">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label "><?php echo dr_lang('账号'); ?></label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?php echo $username; ?> </p>
                            </div>
                        </div>
                        <?php echo $myfield;  echo $diyfield;  if ($field) { ?>
                        <script>
                            $(function () {
                                <?php if (is_array($field)) { $key_f=-1;$count_f=dr_count($field);foreach ($field as $f) { $key_f++; ?>
                                $('#dr_row_<?php echo $f['fieldname']; ?> .col-md-9').append('<a style="color:red" href="javascript:dr_help(774);" class="form-control-static"><?php echo dr_lang('此字段在前端不可用'); ?></a>');
                                <?php } } ?>
                            });
                            </script>
                        <?php } ?>
                    </div>
                </div>
                <div class="tab-pane <?php if ($page==2) { ?>active<?php } ?>" id="tab_2">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label "><?php echo dr_lang('账号'); ?></label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?php echo $username; ?> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('审核状态'); ?></label>
                            <div class="col-md-9" style="padding-top:3px">
                                <input type="checkbox" name="status[is_verify]" value="1" <?php if ($is_verify) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('已审核'); ?>" data-off-text="<?php echo dr_lang('未审核'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <p class="help-block"> <?php echo dr_lang('当审核通过后才能正常操作网站'); ?> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('锁定状态'); ?></label>
                            <div class="col-md-9" style="padding-top:3px">
                                <input type="checkbox" name="status[is_lock]" value="1" <?php if ($is_lock) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('已锁定'); ?>" data-off-text="<?php echo dr_lang('未锁定'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <p class="help-block"> <?php echo dr_lang('锁定账号后，不能登录此账号进行操作网站'); ?> </p>
                            </div>
                        </div>
                        <div class="form-group hide">
                            <label class="col-md-2 control-label"><?php echo dr_lang('实名认证'); ?></label>
                            <div class="col-md-9" style="padding-top:3px">
                                <input type="checkbox" name="status[is_auth]" value="1" <?php if ($is_auth) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('已认证'); ?>" data-off-text="<?php echo dr_lang('未认证'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <p class="help-block"> <?php echo dr_lang('账号是否实名认证'); ?> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('手机认证'); ?></label>
                            <div class="col-md-9" style="padding-top:3px">
                                <input type="checkbox" name="status[is_mobile]" value="1" <?php if ($is_mobile) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('已认证'); ?>" data-off-text="<?php echo dr_lang('未认证'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <p class="help-block"> <?php echo dr_lang('账号的手机号码是否认证'); ?> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('补全资料'); ?></label>
                            <div class="col-md-9" style="padding-top:3px">
                                <input type="checkbox" name="status[is_complete]" value="1" <?php if ($is_complete) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('已补全'); ?>" data-off-text="<?php echo dr_lang('未补全'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <p class="help-block"> <?php echo dr_lang('账号资料是否补全'); ?> </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('上传头像'); ?></label>
                            <div class="col-md-9" style="padding-top:3px">
                                <input type="checkbox" name="status[is_avatar]" value="1" <?php if ($is_avatar) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('已上传'); ?>" data-off-text="<?php echo dr_lang('未上传'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <p class="help-block"> <?php echo dr_lang('用户是否上传头像'); ?> </p>
                            </div>
                        </div>

                    </div>
                </div>



                <div class="tab-pane <?php if ($page==4) { ?>active<?php } ?>" id="tab_4">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label "><?php echo dr_lang('账号'); ?></label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?php echo $username; ?> </p>
                            </div>
                        </div>
                        <?php if (is_array($oauth)) { $key_t=-1;$count_t=dr_count($oauth);foreach ($oauth as $t) { $key_t++; ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label "><img class="img-circle" src="<?php echo $t['avatar']; ?>" style="width:50px;height:50px"></a> </label>
                            <div class="col-md-9">
                                <div class="form-control-static" style="padding-top: 18px;">
                                    <label style="padding-right: 8px;"> <img src="<?php echo THEME_PATH; ?>assets/oauth/<?php echo $t['oauth']; ?>.png"></label>
                                    <label style="padding-right: 8px;"> <?php echo dr_html2emoji($t['nickname']); ?> </label>
                                    <label> <a href="javascript:;" onclick="dr_ajax_url('<?php echo dr_url('member/jb_del', ['tid'=>$t['oauth'], 'id'=>$uid]); ?>', '<?php echo dr_lang('你确定要解绑它吗？'); ?>', 1)" class="btn red btn-xs"> <i class="fa fa-trash"></i> <?php echo dr_lang('解绑'); ?></a> </label>
                                </div>
                            </div>
                        </div>
                        <?php } } ?>
                    </div>
                </div>

                <div class="tab-pane <?php if ($page==5) { ?>active<?php } ?>" id="tab_5">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label "><?php echo dr_lang('账号'); ?></label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <?php echo $username; ?> </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 control-label "> </label>
                            <div class="col-md-9">

                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light">
                                        <thead>
                                        <tr class="uppercase">
                                            <th width="150"> 登录时间 </th>
                                            <th> 登录地点 </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $list_return = $this->list_tag("action=table table=member_login uid=$id order=logintime desc cache=0"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=dr_count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                        <tr>
                                            <td> <?php echo dr_date($t['logintime']); ?> </td>
                                            <td> <a href="http://www.ip138.com/ips138.asp?ip=<?php echo $t[loginip]; ?>&action=2" target="_blank"><?php echo \Phpcmf\Service::L('Ip')->address($t[loginip]); ?></a> </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"> <?php echo $t['useragent']; ?></td>
                                        </tr>
                                        <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="portlet-body form myfooter">
        <div class="form-actions text-center">
            <button type="button" onclick="dr_ajax_submit('<?php echo dr_now_url(); ?>&page='+$('#dr_page').val(), 'myform', '2000')" class="btn green"> <i class="fa fa-save"></i> <?php echo dr_lang('保存'); ?></button>
            <a href="<?php echo dr_url('member/alogin_index', ['id'=>$id]); ?>" target="_blank" class="btn red"> <i class="fa fa-user"></i> <?php echo dr_lang('授权登录'); ?></a>
        </div>
    </div>
</form>
<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>