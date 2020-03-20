<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="note note-danger" style="margin-top: -15px;">
    <p><a href="javascript:dr_update_cache();"><?php echo dr_lang('更改数据之后需要更新缓存之后才能生效'); ?></a></p>
</div>

<form action="" class="form-horizontal" method="post" name="myform" id="myform">
    <?php echo $form; ?>
    <div class="portlet bordered light myfbody">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs" style="float:left;">
                <?php if (is_array($module)) { $key_t=-1;$count_t=dr_count($module);foreach ($module as $i=>$t) { $key_t++; ?>
                <li class="<?php if ($page==$i) { ?>active<?php } ?>">
                    <a href="#tab_<?php echo $i; ?>" data-toggle="tab" onclick="$('#dr_page').val('<?php echo $i; ?>')"> <i class="<?php echo dr_icon($t['icon']); ?>"></i> <?php echo $t['name']; ?> - <?php echo dr_lang('搜索设置'); ?> </a>
                </li>
                <?php } } ?>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">


                <?php if (is_array($module)) { $key_m=-1;$count_m=dr_count($module);foreach ($module as $i=>$m) { $key_m++; ?>
                <div class="tab-pane <?php if ($i == $page) { ?>active<?php } ?>" id="tab_<?php echo $i; ?>">
                    <div class="form-body">


                        <div class="form-group">
                            <label class="col-md-2 control-label" style="padding-top: 10px;"><?php echo dr_lang('搜索功能'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[<?php echo $i; ?>][use]" value="1" <?php if ($m['setting']['search']['use']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">

                                <span class="help-block"><?php echo dr_lang('选择关闭将不能进行内容搜索'); ?></span>
                            </div>
                        </div>

                        <div class="form-group dr_search">
                            <label class="col-md-2 control-label"><?php echo dr_lang('集成栏目页'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[<?php echo $i; ?>][catsync]" value="1" <?php if ($m['setting']['search']['catsync']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo dr_lang('访问栏目页会定向到搜索页面，使栏目模板无效'); ?></span>
                            </div>
                        </div>
                        <div class="form-group dr_search">
                            <label class="col-md-2 control-label"><?php echo dr_lang('集成模块首页'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[<?php echo $i; ?>][indexsync]" value="1" <?php if ($m['setting']['search']['indexsync']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo dr_lang('访问模块首页会定向到搜索页面，使模块首页模板无效'); ?></span>
                            </div>
                        </div>
                        <div class="form-group dr_search">
                            <label class="col-md-2 control-label"><?php echo dr_lang('关键词匹配字段'); ?></label>
                            <div class="col-md-9">
                                <div class="mt-checkbox-inline">
                                    <?php if (is_array($field)) { $key_f=-1;$count_f=dr_count($field);foreach ($field as $f) { $key_f++; ?>
                                    <label class="mt-checkbox mt-checkbox-outline"><input type="checkbox" name="search_field[<?php echo $i; ?>][]" value="<?php echo $f['fieldname']; ?>" <?php if (@in_array($f['fieldname'], (array)explode(',', $m['setting']['search']['field']))) { ?> checked<?php } ?> /> <?php echo $f['name']; ?> <span></span></label>
                                    <?php } } ?>
                                </div>
                                <span class="help-block"><?php echo dr_lang('搜索关键词匹配字段只能设置主表字段，勾选字段越多查询速度就越慢'); ?></span>
                            </div>
                        </div>

                        <div class="form-group dr_search">
                            <label class="col-md-2 control-label"><?php echo dr_lang('最大搜索量'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[<?php echo $i; ?>][total]" value="<?php if (isset($m['setting']['search']['total'])) {  echo $m['setting']['search']['total'];  } else { ?>500<?php } ?>" ></label>
                                <span class="help-block"><?php echo dr_lang('指搜索时最大显示的数据量，填写0表示全部显示（不建议填写0，一般用户只会看前几页）'); ?></span>
                            </div>
                        </div>
                        <div class="form-group dr_search">
                            <label class="col-md-2 control-label"><?php echo dr_lang('最小关键字长度'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[<?php echo $i; ?>][length]" value="<?php if ($m['setting']['search']['length']) {  echo $m['setting']['search']['length'];  } else { ?>4<?php } ?>" ></label>
                                <span class="help-block"><?php echo dr_lang('搜索关键字最小字符长度，一个汉字占两位'); ?></span>
                            </div>
                        </div>
                        <div class="form-group dr_search">
                            <label class="col-md-2 control-label"><?php echo dr_lang('搜索参数连接符号'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[<?php echo $i; ?>][param_join]" value="<?php if ($m['setting']['search']['param_join']) {  echo $m['setting']['search']['param_join'];  } else { ?>-<?php } ?>" ></label>
                                <span class="help-block"><?php echo dr_lang('用于伪静态时搜索参数的连接，默认-，例如: 字段1-值-字段2-值'); ?></span>
                            </div>
                        </div>
                        <div class="form-group dr_search">
                            <label class="col-md-2 control-label"><?php echo dr_lang('搜索参数字符串规则'); ?></label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio"><input onclick="$('.param_rule_<?php echo $i; ?>_0').hide();$('.param_rule_<?php echo $i; ?>_1').show()" type="radio" name="data[<?php echo $i; ?>][param_rule]" value="1" <?php if ($m['setting']['search']['param_rule']) { ?>checked<?php } ?> /> <?php echo dr_lang('固定匹配'); ?> <span></span></label>
                                    <label class="mt-radio"><input onclick="$('.param_rule_<?php echo $i; ?>_0').show();$('.param_rule_<?php echo $i; ?>_1').hide()" type="radio" name="data[<?php echo $i; ?>][param_rule]" value="0" <?php if (!$m['setting']['search']['param_rule']) { ?>checked<?php } ?> /> <?php echo dr_lang('自由组合'); ?> <span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group dr_search param_rule_<?php echo $i; ?>_0" style="display: none;">
                            <label class="col-md-2 control-label"><?php echo dr_lang('自由组合字段映射关系'); ?></label>
                            <div class="col-md-9">
                                <textarea class="form-control" rows="7" name="data[<?php echo $i; ?>][param_field]"><?php echo $m['setting']['search']['param_field']; ?></textarea>
                                <span class="help-block"><?php echo dr_lang('字段映射是指伪静态时将搜索字段重新命名，字段全称|缩写字母，例如keyword|k: 意思是把k作为keyword，多个字段映射回车符号分隔'); ?></span>
                            </div>
                        </div>
                        <div class="form-group dr_search param_rule_<?php echo $i; ?>_1" style="display: none;">
                            <label class="col-md-2 control-label"><?php echo dr_lang('固定匹配字段参数设置'); ?></label>
                            <div class="col-md-9">
                                <?php $c=0;  if (is_array($m['search_field'])) { $key_f1=-1;$count_f1=dr_count($m['search_field']);foreach ($m['search_field'] as $k1=>$f1) { $key_f1++; ?>
                                <label><select name="data[<?php echo $i; ?>][param_join_field][<?php echo $c; ?>]" class="form-control">
                                    <option value="">-</option>
                                    <?php if (is_array($m['search_field'])) { $key_f=-1;$count_f=dr_count($m['search_field']);foreach ($m['search_field'] as $k=>$f) { $key_f++; ?>
                                    <option value="<?php echo $k; ?>" <?php if ($k == $m['setting']['search']['param_join_field'][$c]) { ?> selected<?php } ?>><?php echo $f; ?></option>
                                    <?php } } ?>
                                </select></label>
                                <?php $c++;  } } ?>
                                <span class="help-block"><?php echo dr_lang('由一组固定的字符串参数作为搜索变量，例如：栏目id-城市-分类-关键词-排序-分页.html'); ?></span>
                            </div>
                        </div>
                        <div class="form-group dr_search param_rule_<?php echo $i; ?>_1" style="display: none;">
                            <label class="col-md-2 control-label"><?php echo dr_lang('匹配字段默认填充值'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[<?php echo $i; ?>][param_join_default_value]" value="<?php if ($m['setting']['search']['param_join_default_value']) {  echo $m['setting']['search']['param_join_default_value'];  } else { ?>0<?php } ?>" ></label>
                                <span class="help-block"><?php echo dr_lang('搜索变量为空时的填充值，例如：0-0-0-关键词-排序-分页.html'); ?></span>
                            </div>
                        </div>
                        <script>
                            $('.param_rule_<?php echo $i; ?>_<?php echo intval($m['setting']['search']['param_rule']); ?>').show();
                        </script>

                    </div>
                </div>
                <?php } } ?>





            </div>
        </div>
    </div>

    <div class="portlet-body form myfooter">
        <div class="form-actions text-center">
            <button type="button" onclick="dr_ajax_submit('<?php echo dr_now_url(); ?>&page='+$('#dr_page').val(), 'myform', '2000')" class="btn green"> <i class="fa fa-save"></i> <?php echo dr_lang('保存'); ?></button>
        </div>
    </div>
</form>



<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>