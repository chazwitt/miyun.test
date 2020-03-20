<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="note note-danger">
    <p><a href="javascript:dr_update_cache('module', 'module');"><?php echo dr_lang('更改数据之后需要更新缓存之后才能生效'); ?></a></p>
</div>
<form action="" class="form-horizontal" method="post" name="myform" id="myform">
    <?php echo $form; ?>
    <div class="portlet bordered light myfbody">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs" style="float:left;">
                <li class="<?php if ($page==0) { ?>active<?php } ?>">
                    <a href="#tab_0" data-toggle="tab" onclick="$('#dr_page').val('0')"> <i class="fa fa-cog"></i> <?php echo dr_lang('模块设置'); ?> </a>
                </li>
                <li class="<?php if ($page==3) { ?>active<?php } ?>">
                    <a href="#tab_3" data-toggle="tab" onclick="$('#dr_page').val('3')"> <i class="fa fa-table"></i> <?php echo dr_lang('后台列表显示字段'); ?> </a>
                </li>
                <li class="<?php if ($page==4) { ?>active<?php } ?>">
                    <a href="#tab_4" data-toggle="tab" onclick="$('#dr_page').val('4')"> <i class="fa fa-comments"></i> <?php echo dr_lang('后台评论显示字段'); ?> </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">

                <div class="tab-pane <?php if ($page==0) { ?>active<?php } ?>" id="tab_0">
                    <div class="form-body">
                        <?php if (!$data['share']) { ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('首页静态'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[setting][module_index_html]" value="1" <?php if ($data['setting']['module_index_html']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo dr_lang('开启之后当前模块的首页将会自动生成静态文件'); ?></span>
                            </div>
                        </div>
                        <?php }  if (!$is_hcategory) { ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('同步其他栏目'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[setting][sync_category]" value="1" <?php if ($data['setting']['sync_category']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo dr_lang('将内容同步发布到其他的栏目之中'); ?></span>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('自动存储关键词'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[setting][auto_save_tag]" value="1" <?php if ($data['setting']['auto_save_tag']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo dr_lang('增加内容时自动将关键词存储到关键字库之中'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('后台默认排序'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control input-xlarge" type="text" name="data[setting][order]" value="<?php if ($data['setting']['order']) {  echo $data['setting']['order'];  } else { ?>displayorder DESC,updatetime DESC<?php } ?>" ></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('拒绝审核理由'); ?></label>
                            <div class="col-md-9">
                                <textarea class="form-control" style="height:150px; width:100%;" name="data[setting][verify_msg]"><?php echo $data['setting']['verify_msg']; ?></textarea>
                                <span class="help-block"><?php echo dr_lang('常用的拒绝审核理由，一行一个'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('删除内容理由'); ?></label>
                            <div class="col-md-9">
                                <textarea class="form-control" style="height:150px; width:100%;" name="data[setting][delete_msg]"><?php echo $data['setting']['delete_msg']; ?></textarea>
                                <span class="help-block"><?php echo dr_lang('常用的删除理由，一行一个'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="tab-pane <?php if ($page==3) { ?>active<?php } ?>" id="tab_3">
                    <div class="form-body">
                        <table class="table table-striped table-bordered table-hover table-checkable dataTable">
                            <thead>
                            <tr class="heading">
                                <th class="myselect">
                                    <?php echo dr_lang('显示'); ?>
                                </th>
                                <th width="180"> <?php echo dr_lang('字段'); ?> </th>
                                <th width="150"> <?php echo dr_lang('名称'); ?> </th>
                                <th width="100"> <?php echo dr_lang('宽度'); ?> </th>
                                <th> <?php echo dr_lang('回调方法'); ?> </th>
                            </tr>
                            </thead>
                            <tbody class="field-sort-items">
                            <?php if (is_array($field)) { $key_t=-1;$count_t=dr_count($field);foreach ($field as $n=>$t) { $key_t++;  if ((dr_is_app('fstatus') && $t['fieldname'] != 'fstatus') || !dr_is_app('fstatus')) { ?>
                            <tr class="odd gradeX">
                                <td class="myselect">
                                    <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkboxes" name="data[setting][list_field][<?php echo $t['fieldname']; ?>][use]" value="1" <?php if ($data['setting']['list_field'][$t['fieldname']]['use']) { ?> checked<?php } ?> />
                                        <span></span>
                                    </label>
                                </td>
                                <td><?php echo dr_lang($t['name']); ?> (<?php echo $t['fieldname']; ?>)</td>
                                <td><input class="form-control" type="text" name="data[setting][list_field][<?php echo $t['fieldname']; ?>][name]" value="<?php echo $data['setting']['list_field'][$t['fieldname']]['name'] ? $data['setting']['list_field'][$t['fieldname']]['name'] : $t['name'] ?>" /></td>
                                <td> <input class="form-control" type="text" name="data[setting][list_field][<?php echo $t['fieldname']; ?>][width]" value="<?php echo $data['setting']['list_field'][$t['fieldname']]['width']; ?>" /></td>
                                <td> <div class="input-group" style="width:250px">
                                        <span class="input-group-btn">
                                            <a class="btn btn-success" href="javascript:dr_call_alert();"><?php echo dr_lang('回调'); ?></a>
                                        </span>
                                    <input class="form-control" type="text" name="data[setting][list_field][<?php echo $t['fieldname']; ?>][func]" value="<?php echo $data['setting']['list_field'][$t['fieldname']]['func']; ?>" />
                                </div></td>
                            </tr>
                            <?php }  } } ?>
                            </tbody>
                        </table>


                    </div>
                </div>


                <div class="tab-pane <?php if ($page==4) { ?>active<?php } ?>" id="tab_4">
                    <div class="form-body">

                        <table class="table table-striped table-bordered table-hover table-checkable dataTable">
                            <thead>
                            <tr class="heading">
                                <th class="myselect">
                                    <?php echo dr_lang('显示'); ?>
                                </th>
                                <th width="180"> <?php echo dr_lang('字段'); ?> </th>
                                <th width="150"> <?php echo dr_lang('名称'); ?> </th>
                                <th width="100"> <?php echo dr_lang('宽度'); ?> </th>
                                <th> <?php echo dr_lang('回调方法'); ?> </th>
                            </tr>
                            </thead>
                            <tbody class="field-sort-items">
                            <?php if (is_array($comment_field)) { $key_t=-1;$count_t=dr_count($comment_field);foreach ($comment_field as $n=>$t) { $key_t++; ?>
                            <tr class="odd gradeX">
                                <td class="myselect">
                                    <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkboxes" name="data[setting][comment_list_field][<?php echo $t['fieldname']; ?>][use]" value="1" <?php if ($data['setting']['comment_list_field'][$t['fieldname']]['use']) { ?> checked<?php } ?> />
                                        <span></span>
                                    </label>
                                </td>
                                <td><?php echo dr_lang($t['name']); ?> (<?php echo $t['fieldname']; ?>)</td>
                                <td><input class="form-control" type="text" name="data[setting][comment_list_field][<?php echo $t['fieldname']; ?>][name]" value="<?php echo $data['setting']['comment_list_field'][$t['fieldname']]['name'] ? $data['setting']['comment_list_field'][$t['fieldname']]['name'] : $t['name'] ?>" /></td>
                                <td> <input class="form-control" type="text" name="data[setting][comment_list_field][<?php echo $t['fieldname']; ?>][width]" value="<?php echo $data['setting']['comment_list_field'][$t['fieldname']]['width']; ?>" /></td>
                                <td> <div class="input-group" style="width:250px">
                                        <span class="input-group-btn">
                                            <a class="btn btn-success" href="javascript:dr_call_alert();"><?php echo dr_lang('回调'); ?></a>
                                        </span>
                                    <input class="form-control" type="text" name="data[setting][comment_list_field][<?php echo $t['fieldname']; ?>][func]" value="<?php echo $data['setting']['comment_list_field'][$t['fieldname']]['func']; ?>" />
                                </div></td>
                            </tr>
                            <?php } } ?>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="portlet-body form myfooter">
        <div class="form-actions text-center">
            <button type="button" onclick="dr_ajax_submit('<?php echo dr_now_url(); ?>&page='+$('#dr_page').val(), 'myform', '2000')" class="btn green"> <i class="fa fa-save"></i> <?php echo dr_lang('保存'); ?></button>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(function() {
        dr_theme(<?php echo $is_theme; ?>);
        $(".field-sort-items").sortable();
    });
    function dr_theme(id) {
        if (id == 1) {
            $("#dr_theme_html").html($("#dr_web").html());
        } else {
            $("#dr_theme_html").html($("#dr_local").html());
        }
    }
</script>
<div id="dr_local" style="display: none">
    <label class="col-md-2 control-label"><?php echo dr_lang('主题风格'); ?></label>
    <div class="col-md-9">
        <label><select class="form-control" name="site[theme]">
            <option value="default"> -- </option>
            <?php if (is_array($theme)) { $key_t=-1;$count_t=dr_count($theme);foreach ($theme as $t) { $key_t++; ?>
            <option<?php if ($t==$site['theme']) { ?> selected=""<?php } ?> value="<?php echo $t; ?>"><?php echo $t; ?></option>
            <?php } } ?>
        </select></label>
        <span class="help-block"><?php echo dr_lang('位于网站主站根目录下：/static/风格名称/'); ?></span>
    </div>
</div>
<div id="dr_web" style="display: none">
    <label class="col-md-2 control-label"><?php echo dr_lang('远程资源'); ?></label>
    <div class="col-md-9">
        <input class="form-control  input-xlarge" type="text" placeholder="http://" name="site[theme]" value="<?php echo strpos($site['theme'], 'http') === 0 ? $site['theme'] : ''; ?>">
        <span class="help-block"><?php echo dr_lang('网站将调用此地址的css,js,图片等静态资源'); ?></span>
    </div>
</div>
<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>