<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="note note-danger">
    <p><a href="javascript:dr_update_cache('member', '');"><?php echo dr_lang('更改数据之后需要更新缓存之后才能生效'); ?></a></p>
</div>
<form action="" class="form-horizontal" method="post" name="myform" id="myform">
    <?php echo $form; ?>
    <div class="portlet bordered light myfbody">
        <div class="portlet-title tabbable-line">
            <ul class="nav nav-tabs" style="float:left;">
                <li class="<?php if ($page==0) { ?>active<?php } ?>">
                    <a href="#tab_0" data-toggle="tab" onclick="$('#dr_page').val('0')"> <i class="fa fa-cog"></i> <?php echo dr_lang('常用设置'); ?> </a>
                </li>
                <li class="<?php if ($page==4) { ?>active<?php } ?>">
                    <a href="#tab_4" data-toggle="tab" onclick="$('#dr_page').val('4')"> <i class="fa fa-user"></i> <?php echo dr_lang('登录设置'); ?> </a>
                </li>
                <li class="<?php if ($page==1) { ?>active<?php } ?>">
                    <a href="#tab_1" data-toggle="tab" onclick="$('#dr_page').val('1')"> <i class="fa fa-user-plus"></i> <?php echo dr_lang('注册设置'); ?> </a>
                </li>
                <li class="<?php if ($page==2) { ?>active<?php } ?>">
                    <a href="#tab_2" data-toggle="tab" onclick="$('#dr_page').val('2')"> <i class="fa fa-qq"></i> <?php echo dr_lang('快捷登录'); ?> </a>
                </li>
                <li class="<?php if ($page==3) { ?>active<?php } ?>">
                    <a href="#tab_3" data-toggle="tab" onclick="$('#dr_page').val('3')"> <i class="fa fa-code"></i> <?php echo dr_lang('分页设置'); ?> </a>
                </li>
            </ul>
        </div>
        <div class="portlet-body">
            <div class="tab-content">

                <div class="tab-pane <?php if ($page==0) { ?>active<?php } ?>" id="tab_0">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('允许修改姓名'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[config][edit_name]" value="1" <?php if ($data['config']['edit_name']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('允许修改手机'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[config][edit_mobile]" value="1" <?php if ($data['config']['edit_mobile']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('允许多个用户组'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[config][groups]" value="1" <?php if ($data['config']['groups']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo dr_lang('开启之后用户将可以同时拥有多个用户组权限'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('登录超时时间'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[config][logintime]" value="<?php echo $data['config']['logintime']; ?>" ></label>
                                <span class="help-block"><?php echo dr_lang('单位秒，默认为86400秒，超时之后自动退出账号'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('用户组拒绝审核理由'); ?></label>
                            <div class="col-md-9">
                                <textarea class="form-control" style="height:150px; width:100%;" name="data[config][verify_msg]"><?php echo $data['config']['verify_msg']; ?></textarea>
                                <span class="help-block"><?php echo dr_lang('申请用户组时常用的拒绝审核理由，一行一个'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane <?php if ($page==4) { ?>active<?php } ?>" id="tab_4">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('登录验证码'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[login][code]" value="1" <?php if ($data['login']['code']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('登录主字段'); ?></label>
                            <div class="col-md-9">
                                <div class="mt-checkbox-inline">
                                    <label class="mt-checkbox mt-checkbox-outline"><input type="checkbox" checked disabled /> <?php echo dr_lang('账号'); ?> <span></span></label>
                                    <label class="mt-checkbox mt-checkbox-outline"><input type="checkbox" name="data[login][field][]" value="phone" <?php if (@in_array('phone', (array)$data['login']['field'])) { ?> checked<?php } ?> /> <?php echo dr_lang('手机号'); ?> <span></span></label>
                                    <label class="mt-checkbox mt-checkbox-outline"><input type="checkbox" name="data[login][field][]" value="email" <?php if (@in_array('email', (array)$data['login']['field'])) { ?> checked<?php } ?> /> <?php echo dr_lang('邮箱'); ?> <span></span></label>
                                </div>
                                <span class="help-block"><?php echo dr_lang('可同时选择多个字段作为登录主字段'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('短信验证码登录'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[login][sms]" value="1" <?php if ($data['login']['sms']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><a href="javascript:dr_help(501);"><?php echo dr_lang('登录字段必须包含手机号码才能使用此功能'); ?></a></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane <?php if ($page==3) { ?>active<?php } ?>" id="tab_3">
                    <div class="form-body">

                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('电脑列表分页数量'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[config][pagesize]" value="<?php echo $data['config']['pagesize']; ?>" ></label>
                                <span class="help-block"><?php echo dr_lang('用户中心数据列表在电脑网页每页显示数量'); ?></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('手机列表分页数量'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[config][pagesize_mobile]" value="<?php echo $data['config']['pagesize_mobile']; ?>" ></label>
                                <span class="help-block"><?php echo dr_lang('用户中心数据列表在手机网页每页显示数量'); ?></span>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('API接口列表分页数量'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[config][pagesize_api]" value="<?php echo $data['config']['pagesize_api']; ?>" ></label>
                                <span class="help-block"><?php echo dr_lang('用户中心数据列表在API数据请求时每页返回的数量'); ?></span>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="tab-pane <?php if ($page==1) { ?>active<?php } ?>" id="tab_1">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('注册功能'); ?></label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio mt-checkbox-outline"><input type="radio" name="data[register][close]" value="0" <?php if (!$data['register']['close']) { ?>checked<?php } ?> /> <?php echo dr_lang('开启注册'); ?> <span></span></label>
                                    <label class="mt-radio mt-checkbox-outline"><input type="radio" name="data[register][close]" value="1" <?php if ($data['register']['close']) { ?>checked<?php } ?> /> <?php echo dr_lang('关闭注册'); ?> <span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('默认注册组'); ?></label>
                            <div class="col-md-9">
                                <label>
                                    <select class="form-control" name="data[register][groupid]">
                                        <?php if (is_array($group)) { $key_t=-1;$count_t=dr_count($group);foreach ($group as $t) { $key_t++;  if ($t['register']) { ?>
                                        <option value="<?php echo $t['id']; ?>" <?php if ($t['id']==$data['register']['groupid']) { ?> selected<?php } ?>><?php echo $t['name']; ?></option>
                                        <?php }  } } ?>
                                    </select>
                                </label>
                                <span class="help-block"><a href="<?php echo dr_url('member_group/index'); ?>"><?php echo dr_lang('必须选择一个默认注册的用户组'); ?></a></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('注册字段选择'); ?></label>
                            <div class="col-md-9">
                                <div class="mt-checkbox-inline">
                                    <label class="mt-checkbox mt-checkbox-outline"><input type="checkbox" name="data[register][field][]" value="username" <?php if (@in_array('username', (array)$data['register']['field'])) { ?> checked<?php } ?> /> <?php echo dr_lang('账号'); ?> <span></span></label>
                                    <label class="mt-checkbox mt-checkbox-outline"><input type="checkbox" name="data[register][field][]" value="phone" <?php if (@in_array('phone', (array)$data['register']['field'])) { ?> checked<?php } ?> /> <?php echo dr_lang('手机号'); ?> <span></span></label>
                                    <label class="mt-checkbox mt-checkbox-outline"><input type="checkbox" name="data[register][field][]" value="email" <?php if (@in_array('email', (array)$data['register']['field'])) { ?> checked<?php } ?> /> <?php echo dr_lang('邮箱'); ?> <span></span></label>
                                    <label class="mt-checkbox mt-checkbox-outline"><input type="checkbox" name="data[register][field][]" value="name" <?php if (@in_array('name', (array)$data['register']['field'])) { ?> checked<?php } ?> /> <?php echo dr_lang('姓名'); ?> <span></span></label>
                                </div>
                                <span class="help-block"><?php echo dr_lang('至少选择一个字段或多个字段组合'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('用户姓名长度'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[register][cutname]" value="<?php echo intval($data['register']['cutname']); ?>" ></label>
                                <span class="help-block"><?php echo dr_lang('用户姓名的最大长度，设置0表示不限制，最大设置100'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('随机用户名前缀'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control" type="text" name="data[register][unprefix]" value="<?php echo $data['register']['unprefix']; ?>" ></label>
                                <span class="help-block"><?php echo dr_lang('当注册字段没有选择"账号"时，系统会随机注册一个账号，格式为：前缀+随机用户名字符'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('注册短信验证'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[register][sms]" value="1" <?php if ($data['register']['sms']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo dr_lang('注册字段必须包含手机号码才能使用此功能，用于手机短信验证码'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('注册图片验证码'); ?></label>
                            <div class="col-md-9">
                                <input type="checkbox" name="data[register][code]" value="1" <?php if ($data['register']['code']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
                                <span class="help-block"><?php echo dr_lang('网页中的图片验证码'); ?></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('注册审核方式'); ?></label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio mt-radio-outline"><input type="radio" name="data[register][verify]" value="" <?php if (empty($data['register']['verify'])) { ?>checked<?php } ?> /> <?php echo dr_lang('关闭'); ?> <span></span></label>
                                    <label class="mt-radio mt-radio-outline"><input type="radio" name="data[register][verify]" value="email" <?php if ($data['register']['verify']=='email') { ?>checked<?php } ?> /> <?php echo dr_lang('邮件审核'); ?> <span></span></label>
                                    <label class="mt-radio mt-radio-outline"><input type="radio" name="data[register][verify]" value="phone" <?php if ($data['register']['verify']=='phone') { ?>checked<?php } ?> /> <?php echo dr_lang('短信审核'); ?> <span></span></label>
                                    <label class="mt-radio mt-radio-outline"><input type="radio" name="data[register][verify]" value="admin" <?php if ($data['register']['verify']=='admin') { ?>checked<?php } ?> /> <?php echo dr_lang('人工审核'); ?> <span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('用户名规则（正则）'); ?></label>
                            <div class="col-md-9">
                                <label><input class="form-control input-large" type="text" name="data[register][preg]" id="dr_regnamerule" value="<?php echo $data['register']['preg']; ?>"/></label>
                                <label><select class="form-control" onchange="javascript:$('#dr_regnamerule').val(this.value)" name="pattern_select">
                                    <option value=""><?php echo dr_lang('正则验证'); ?></option>
                                    <option value="/^[0-9.-]+$/"><?php echo dr_lang('数字'); ?></option>
                                    <option value="/^[0-9-]+$/"><?php echo dr_lang('整数'); ?></option>
                                    <option value="/^[a-z]+$/i"><?php echo dr_lang('字母'); ?></option>
                                    <option value="/^[0-9a-z]+$/i"><?php echo dr_lang('数字+字母'); ?></option>
                                    <option value="/^[\w\-\.]+@[\w\-\.]+(\.\w+)+$/">Email</option>
                                </select></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('不允许注册的用户名'); ?></label>
                            <div class="col-md-9">
                                <textarea class="form-control" style="height:150px; width:100%;" name="data[register][notallow]"><?php echo $data['register']['notallow']; ?></textarea>
                                <span class="help-block"><?php echo dr_lang('多个用户名以分号“,”分隔'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane <?php if ($page==2) { ?>active<?php } ?>" id="tab_2">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('登录模式'); ?></label>
                            <div class="col-md-9">
                                <div class="mt-radio-inline">
                                    <label class="mt-radio mt-radio-outline"><input type="radio" name="data[oauth][login]" value="0" <?php if (empty($data['oauth']['login'])) { ?>checked<?php } ?> /> <?php echo dr_lang('绑定账号'); ?> <span></span></label>
                                    <label class="mt-radio mt-radio-outline"><input type="radio" name="data[oauth][login]" value="1" <?php if ($data['oauth']['login']) { ?>checked<?php } ?> /> <?php echo dr_lang('直接登录'); ?> <span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 control-label"><?php echo dr_lang('账号设置'); ?></label>
                            <div class="col-md-9">
                                <table class="table table-striped table-bordered table-hover table-checkable dataTable">
                                    <thead>
                                    <tr class="heading">
                                        <th width="90"> <?php echo dr_lang('接入商'); ?> </th>
                                        <th width="210"> <?php echo dr_lang('ID'); ?> </th>
                                        <th> <?php echo dr_lang('密钥'); ?> </th>
                                        <th width="90">  </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="odd gradeX">
                                        <td>QQ</td>
                                        <td><input class="form-control" name="data[oauth][qq][id]" type="text" value="<?php echo $data['oauth']['qq']['id']; ?>"></td>
                                        <td><input class="form-control" name="data[oauth][qq][value]" type="text" value="<?php echo $data['oauth']['qq']['value']; ?>"></td>
                                        <td style="text-align: center"><a href="javascript:dr_help(586);"><?php echo dr_lang('申请接口'); ?></a></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>微信</td>
                                        <td><input class="form-control" name="data[oauth][weixin][id]" type="text" value="<?php echo $data['oauth']['weixin']['id']; ?>"></td>
                                        <td><input class="form-control" name="data[oauth][weixin][value]" type="text" value="<?php echo $data['oauth']['weixin']['value']; ?>"></td>
                                        <td style="text-align: center"><a href="javascript:dr_help(587);"><?php echo dr_lang('申请接口'); ?></a></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>微博</td>
                                        <td><input class="form-control" name="data[oauth][weibo][id]" type="text" value="<?php echo $data['oauth']['weibo']['id']; ?>"></td>
                                        <td><input class="form-control" name="data[oauth][weibo][value]" type="text" value="<?php echo $data['oauth']['weibo']['value']; ?>"></td>
                                        <td style="text-align: center"><a href="javascript:dr_help(588);"><?php echo dr_lang('申请接口'); ?></a></td>
                                    </tr>
                                    <tr class="odd gradeX">
                                        <td>微信公众号</td>
                                        <td colspan="3">
										<?php if (dr_is_app('weixin')) { ?><input type="checkbox" name="data[oauth][wechat][id]" value="1" <?php if ($data['oauth']['wechat']['id']) { ?>checked<?php } ?> data-on-text="<?php echo dr_lang('开启'); ?>" data-off-text="<?php echo dr_lang('关闭'); ?>" data-on-color="success" data-off-color="danger" class="make-switch" data-size="small">
											&nbsp;用于关注微信公众号绑定账号使用<?php } else { ?><font color="red">没有安装[微信]插件，无法使用此功能</font><?php } ?></td>
                                    </tr>
                                    </tbody>
                                </table>
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
        </div>
    </div>
</form>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>