<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>


<div class="right-card-box">
<div class="row table-search-tool">
    <form action="<?php echo SELF; ?>" method="get">
        <?php echo dr_form_search_hidden(); ?>
        <div class="col-md-12 col-sm-12">
            <label>
                <select name="groupid" class="form-control">
                    <option value=""> <?php echo dr_lang('全部'); ?> </option>
                    <?php if (is_array($group)) { $key_t=-1;$count_t=dr_count($group);foreach ($group as $t) { $key_t++; ?>
                    <option value="<?php echo $t['id']; ?>" <?php if ($param['groupid']==$t['id']) { ?>selected<?php } ?>><?php echo $t['name']; ?></option>
                    <?php } } ?>
                </select>
            </label>
        </div>
        <div class="col-md-12 col-sm-12">
            <label>
                <select name="field" class="form-control">
                    <option value="id"> Id </option>
                    <?php if (is_array($field)) { $key_t=-1;$count_t=dr_count($field);foreach ($field as $t) { $key_t++;  if ($t['ismain']) { ?>
                    <option value="<?php echo $t['fieldname']; ?>" <?php if ($param['field']==$t['fieldname']) { ?>selected<?php } ?>><?php echo $t['name']; ?></option>
                    <?php }  } } ?>
                </select>
            </label>
            <label><i class="fa fa-caret-right"></i></label>
            <label><input type="text" class="form-control" placeholder="" value="<?php echo $param['keyword']; ?>" name="keyword" /></label>
        </div>


        <div class="col-md-12 col-sm-12">
            <label><button type="submit" class="btn green btn-sm onloading" name="submit" > <i class="fa fa-search"></i> <?php echo dr_lang('搜索'); ?></button></label>
        </div>
    </form>
</div>

<form class="form-horizontal" role="form" id="myform">
    <?php echo dr_form_hidden(); ?>
    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-hover table-checkable dataTable">
            <thead>
            <tr class="heading">
                <?php if (\Phpcmf\Service::C()->_is_admin_auth('member/del') || \Phpcmf\Service::C()->_is_admin_auth('member/edit') || \Phpcmf\Service::C()->_is_admin_auth('member_verify/edit')) { ?>
                <th class="myselect">
                    <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="group-checkable" data-set=".checkboxes" />
                        <span></span>
                    </label>
                </th>
                <?php } ?>
                <th style="text-align:center" width="70" class="<?php echo dr_sorting('id'); ?>" name="id"><?php echo dr_lang('头像'); ?></th>
                <th width="200" class="<?php echo dr_sorting('username'); ?>" name="username"><?php echo dr_lang('账号 / 邮箱'); ?></th>
                <th width="130" class="<?php echo dr_sorting('name'); ?> dr_username_phone" name="name"><?php echo dr_lang('姓名 / 手机'); ?></th>
                <th width="140" class="<?php echo dr_sorting('money'); ?>" name="money"><?php echo dr_lang('实际资金'); ?></th>
                <th width="130" class="<?php echo dr_sorting('experience'); ?>" name="score"><?php echo dr_lang('虚拟资产'); ?></th>
                <th width="160" class="<?php echo dr_sorting('regtime'); ?>" name="regtime"><?php echo dr_lang('注册时间'); ?></th>
                <th><?php echo dr_lang('操作'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (is_array($list)) { $key_t=-1;$count_t=dr_count($list);foreach ($list as $t) { $key_t++; ?>
            <tr class="odd gradeX" id="dr_row_<?php echo $t['id']; ?>">
                <?php if (\Phpcmf\Service::C()->_is_admin_auth('member/del') || \Phpcmf\Service::C()->_is_admin_auth('member/edit') || \Phpcmf\Service::C()->_is_admin_auth('member_verify/edit')) { ?>
                <td class="myselect">
                    <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" name="ids[]" value="<?php echo $t['id']; ?>" />
                        <span></span>
                    </label>
                </td>
                <?php } ?>
                <td style="text-align:center"> <a class="fc_member_show" href="javascript:;" uid="<?php echo $t['id']; ?>"><img class="img-circle" src="<?php echo dr_avatar($t['id']); ?>" style="width:50px;height:50px"></a> </td>
                <td class="member_info_p">
                    <p><?php echo \Phpcmf\Service::L('Function_list')->uid($t['id']); ?></p>
                    <p><?php echo $t['email']; ?></p>
                </td>
                <td class="member_info_p dr_username_phone" name="username">
                    <?php if ($t['name']) { ?><p><?php echo $t['name']; ?></p><?php }  if ($t['phone']) { ?><p><?php echo $t['phone']; ?></p><?php } ?>
                </td>
                <td class="member_info_p">
                    <p><a href="<?php echo \Phpcmf\Service::M('auth')->_menu_link_url('member_paylog/index', 'member_paylog/index', ['field'=>'uid','keyword'=>$t['id']]) ?>"><?php echo dr_lang('余额'); ?>: <?php echo $t['money']; ?></a></p>
                    <p><?php echo dr_lang('消费'); ?>: <?php echo $t['spend']; ?></p>
                </td>
                <td class="member_info_p">
                    <p><a href="<?php echo \Phpcmf\Service::M('auth')->_menu_link_url('member_scorelog/index', 'member_scorelog/index', ['field'=>'uid','keyword'=>$t['id']]) ?>"><?php echo SITE_SCORE; ?>: <?php echo $t['score']; ?></a></p>
                    <p><a href="<?php echo \Phpcmf\Service::M('auth')->_menu_link_url('member_explog/index', 'member_explog/index', ['field'=>'uid','keyword'=>$t['id']]) ?>"><?php echo SITE_EXPERIENCE; ?>: <?php echo $t['experience']; ?></a></p>
                </td>
                <td class="member_info_p">
                    <p><?php echo dr_date($t['regtime'], 'Y-m-d H:i:s', 'red'); ?></p>
                    <p><?php echo \Phpcmf\Service::L('Function_list')->ip($t['regip'], 0, 0, 15); ?></p>
                </td>
                <td>
                    <label><a href="javascript:dr_iframe_show('<?php echo dr_lang('登录记录'); ?>', '<?php echo dr_url($uriprefix.'/login_index', ['id'=>$t['id']]); ?>', '80%')" class="btn btn-xs blue"> <i class="fa fa-calendar"></i> <?php echo dr_lang('记录'); ?></a></label>
                    <?php if (\Phpcmf\Service::C()->_is_admin_auth('member/edit')) { ?>
                    <label><a href="<?php echo dr_url($uriprefix.'/edit', ['id'=>$t['id']]); ?>" class="btn btn-xs green"> <i class="fa fa-edit"></i> <?php echo dr_lang('资料'); ?></a></label>
                    <label><a href="javascript:dr_iframe('<?php echo dr_lang('设置用户组'); ?>', '<?php echo dr_url($uriprefix.'/group_edit', ['id'=>$t['id']]); ?>', '60%')" class="btn btn-xs dark"> <i class="fa fa-users"></i> <?php echo dr_lang('权限'); ?></a></label>
                    <?php } ?>

                    <label><a href="<?php echo dr_url($uriprefix.'/alogin_index', ['id'=>$t['id']]); ?>" class="btn btn-xs red" target="_blank"> <i class="fa fa-user"></i> <?php echo dr_lang('登录'); ?></a></label>
                </td>
            </tr>
            <?php } } ?>
            </tbody>
        </table>
    </div>

         <div class="row fc-list-footer table-checkable ">
             <div class="col-md-7 fc-list-select">
                <?php if (\Phpcmf\Service::C()->_is_admin_auth('member/del') || \Phpcmf\Service::C()->_is_admin_auth('member/edit') || \Phpcmf\Service::C()->_is_admin_auth('member_verify/edit')) { ?>
                <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="group-checkable" data-set=".checkboxes" />
                    <span></span>
                </label>
                <?php }  if (\Phpcmf\Service::C()->_is_admin_auth('member/del')) { ?>
                <label><button type="button" onclick="dr_ajax_option('<?php echo dr_url('member/del'); ?>', '<?php echo dr_lang('你确定要删除吗？'); ?>', 1)" class="btn red btn-sm"> <i class="fa fa-trash"></i> <?php echo dr_lang('删除'); ?></button></label>
                <?php }  if ($is_verify && \Phpcmf\Service::C()->_is_admin_auth('member_verify/edit')) { ?>
                <label><button type="button" onclick="dr_ajax_option('<?php echo dr_url('member_verify/edit'); ?>', '<?php echo dr_lang('你确定要通过审核吗？'); ?>', 1)" class="btn blue btn-sm"> <i class="fa fa-check-square-o"></i> <?php echo dr_lang('通过'); ?></button></label>
                <?php }  if (\Phpcmf\Service::C()->_is_admin_auth('member/edit')) { ?>
                <label>
                    <select name="groupid" class="form-control">
                        <option value=""> -- </option>
                        <?php if (is_array($group)) { $key_t=-1;$count_t=dr_count($group);foreach ($group as $t) { $key_t++; ?>
                        <option value="<?php echo $t['id']; ?>" <?php if ($param['groupid']==$t['id']) { ?>selected<?php } ?>><?php echo $t['name']; ?></option>
                        <?php } } ?>
                    </select>
                </label>
                <label><button type="button" onclick="dr_ajax_option('<?php echo dr_url('member/group_all_edit'); ?>', '<?php echo dr_lang('你确定要这样操作吗？'); ?>', 1)" class="btn green btn-sm"> <i class="fa fa-edit"></i> <?php echo dr_lang('更改'); ?></button></label>
                <?php } ?>
             </div>
             <div class="col-md-5 fc-list-page">
                 <?php echo $mypages; ?>
             </div>
         </div>
</form>
<script>
    $(function () {
        var up = 0;
        $('.dr_username_phone').each(function () {
            var html = $(this).html();
            if (html.length > 44) {
                up = 1;
            }
        });
        if (up == 0) {
            $('.dr_username_phone').remove();
        }
    });
</script>
</div>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>