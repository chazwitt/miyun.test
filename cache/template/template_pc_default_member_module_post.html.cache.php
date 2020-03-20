<?php if ($fn_include = $this->_include("mheader.html")) include($fn_include); ?>

<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <ul class="nav nav-tabs" style="float:left;">
            <?php if (is_array($module_memu)) { $key_t=-1;$count_t=dr_count($module_memu);foreach ($module_memu as $i=>$t) { $key_t++; ?>
            <li class="<?php if ($mcid==$i) { ?>active<?php } ?>">
                <a href="<?php echo $t['url']; ?>"> <i class="<?php echo $t['icon']; ?>"></i> <?php echo $t['name']; ?> </a>
            </li>
            <?php } }  if ($id) { ?>
            <li class="active">
                <a href="<?php echo dr_now_url(); ?>"> <i class="fa fa-edit"></i> 修改 </a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="portlet-body">

        <form action="" class="form-horizontal" method="post" name="myform" id="myform">
            <?php echo $form; ?>
            <div class="row myfbody">
                <div class="col-md-12">

                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-green sbold "><?php echo dr_lang('基本内容'); ?></span>
                            </div>

                            <div class="actions">
                                <?php if ($draft_list && !$is_verify) { ?>
                                <div class="btn-group">
                                    <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="javascript:;" aria-expanded="false">
                                        <?php echo dr_lang('草稿'); ?>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="<?php echo $draft_url; ?>"> <?php echo dr_lang('查看原文'); ?> </a>
                                        </li>
                                        <?php if (is_array($draft_list)) { $key_t=-1;$count_t=dr_count($draft_list);foreach ($draft_list as $t) { $key_t++; ?>
                                        <li>
                                            <a href="<?php echo $draft_url; ?>&did=<?php echo $t['id']; ?>" <?php if ($t['id']==$did) { ?>style="color:red"<?php } ?>> <?php echo dr_date($t['inputtime']); ?> </a>
                                        </li>
                                        <?php } } ?>
                                    </ul>
                                </div>
                                <?php } ?>
                                <div class="btn-group">
                                    <a class="btn" href="<?php echo $reply_url; ?>"> <i class="fa fa-mail-reply"></i> <?php echo dr_lang('返回列表'); ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-2 control-label"><?php echo dr_lang('栏目'); ?></label>
                                    <div class="col-md-9">

                                        <?php if ($module['category'][$catid]['setting']['notedit']) { ?>
                                        <label style="margin-top: 7px;">
                                            <span class="label label-sm label-success circle"><?php echo $module['category'][$catid]['name']; ?></span>
                                        </label>
                                        <input type="hidden" id="dr_catid" name="catid" value="<?php echo $catid; ?>">
                                        <?php } else { ?>
                                        <label><?php echo $select; ?></label>
                                        <?php if ($module['setting']['sync_category']) {  if (!$id || $is_sync_cat) { ?>
                                        <label style="margin-right:10px"><a href="javascript:;" onclick="dr_syncat()">[<?php echo dr_lang('同步发布到其他栏目'); ?>]</a></label>
                                        <label>
                                            <input id="dr_syncatid" name="sync_cat" type="hidden" value="<?php echo $is_sync_cat; ?>" />
                                            <span id="dr_syncat_text" class="label label-success" style="display: <?php if ($is_sync_cat) { ?>blank<?php } else { ?>none<?php } ?>;"><b id="dr_syncat_num"><?php echo substr_count($is_sync_cat, ',') + 1; ?></b></span>
                                        </label>
                                        <?php } else if ($link_id != 0) { ?>
                                        <label><?php echo dr_lang('修改内容时会同步更新其他外联文档'); ?></label>
                                        <?php }  }  } ?>
                                    </div>

                                </div>
                                <?php echo $myfield;  if ($is_post_code) { ?>
                                <div class="form-group" id="dr_row_code">
                                    <label class="control-label col-md-2"><span class="required" aria-required="true"> * </span> <?php echo dr_lang('验证码'); ?></label>
                                    <div class="col-md-5">
                                        <label>
                                            <div class="form-recaptcha" style="width:270px;">
                                                <div class="input-group">
                                                    <input type="text" id="dr_code" class="form-control" name="code">
                                                    <div class="input-group-btn fc-code">
                                                        <?php echo dr_code(120, 35); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <?php if ($diyfield) { ?>
                    <div class="portlet  ">
                        <div class="portlet-body">
                            <div class="form-body">
                                <?php echo $diyfield; ?>
                            </div>
                        </div>
                    </div>
                    <?php }  if ($is_verify) { ?>
                    <div class="portlet  ">
                        <div class="portlet-body">
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">审核人</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                            <?php echo $backinfo['author']; ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">审核时间</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                            <?php echo dr_date($backinfo['optiontime']); ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">拒绝理由</label>
                                    <div class="col-md-9">
                                        <p class="form-control-static">
                                            <?php echo $backinfo['backcontent']; ?>
                                        </p>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                    <?php } ?>

                </div>
            </div>

            <div class="portlet-body form myfooter">
                <div class="form-actions text-center">
                    <?php if ($is_verify) { ?>
                    <button type="button" onclick="$('#dr_is_draft').val(0);dr_ajax_submit('<?php echo dr_now_url(); ?>', 'myform', '2000', '<?php echo $reply_url; ?>')" class="btn green"> <i class="fa fa-save"></i> <?php echo dr_lang('提交重新审核'); ?></button>
                    <?php } else { ?>
                    <label><button type="button" onclick="$('#dr_is_draft').val(0);dr_ajax_submit('<?php echo dr_now_url(); ?>', 'myform', '2000')" class="btn green"> <i class="fa fa-save"></i> <?php echo dr_lang('保存内容'); ?></button></label>
                    <label><button type="button" onclick="$('#dr_is_draft').val(0);dr_ajax_submit('<?php echo dr_now_url(); ?>', 'myform', '2000', '<?php echo $post_url; ?>&catid='+$('#dr_catid').val())" class="btn blue"> <i class="fa fa-plus"></i> <?php echo dr_lang('保存再添加'); ?></button></label>
                    <label><button type="button" onclick="$('#dr_is_draft').val(0);dr_ajax_submit('<?php echo dr_now_url(); ?>', 'myform', '2000', '<?php echo $reply_url; ?>')" class="btn yellow"> <i class="fa fa-mail-reply-all"></i> <?php echo dr_lang('保存并返回'); ?></button></label>
                    <label><button type="button" onclick="$('#dr_is_draft').val(1);dr_ajax_submit('<?php echo dr_now_url(); ?>', 'myform', '2000')" class="btn red"> <i class="fa fa-pencil"></i> <?php echo dr_lang('保存草稿'); ?></button></label>
                    <?php } ?>
                </div>
            </div>
        </form>

    </div>
</div>


<script>
    function show_category_field(catid) {
        <?php if ($category_field_url) { ?>
        window.location.href = '<?php echo $category_field_url; ?>&catid='+catid;
        <?php } ?>
        }
        function dr_syncat() {
            var width = '40%';
            var height = '60%';
            var title = '<i class="fa fa-refresh"></i> <?php echo dr_lang('同步到其他栏目'); ?>';
            var url = '<?php echo dr_member_url(MOD_DIR.'/home/syncat_edit'); ?>&catid='+$('#dr_syncatid').val();
            layer.open({
                type: 2,
                title: title,
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
                        time: 10000
                    });
                    $.ajax({type: "POST",dataType:"json", url: url, data: $(body).find('#myform').serialize(),
                        success: function(json) {
                            layer.close(loading);
                            if (json.code == 1) {
                                layer.close(index);
                                $('#dr_syncatid').val(json.data);
                                $('#dr_syncat_text').show();
                                $('#dr_syncat_num').html(json.msg);
                            } else {
                                dr_tips(json.code, json.msg);
                            }
                            return false;
                        },
                        error: function(HttpRequest, ajaxOptions, thrownError) {
                            dr_ajax_alert_error(HttpRequest, ajaxOptions, thrownError);
                        }
                    });
                    return false;
                },
                content: url+'&is_ajax=1'
            });
        }
</script>
<?php if ($fn_include = $this->_include("mfooter.html")) include($fn_include); ?>