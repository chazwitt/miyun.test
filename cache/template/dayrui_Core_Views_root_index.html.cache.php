<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>

<div class="right-card-box">
<div class="row table-search-tool">
    <form action="<?php echo SELF; ?>" method="get">
        <?php echo dr_form_search_hidden(); ?>
        <div class="col-md-12 col-sm-12">
            <label>
                <select name="rid" class="form-control">
                    <option value=""> <?php echo dr_lang('全部'); ?> </option>
                    <?php if (is_array(\Phpcmf\Service::C()->role)) { $key_t=-1;$count_t=dr_count(\Phpcmf\Service::C()->role);foreach (\Phpcmf\Service::C()->role as $t) { $key_t++; ?>
                    <option value="<?php echo $t['id']; ?>" <?php if ($p['rid']==$t['id']) { ?>selected<?php } ?>><?php echo $t['name']; ?></option>
                    <?php } } ?>
                </select>
            </label>
        </div>
        <div class="col-md-12 col-sm-12">
            <label>
                <?php echo dr_lang('账号'); ?>
            </label>
            <label><i class="fa fa-caret-right"></i></label>
            <label><input type="text" class="form-control" placeholder="" value="<?php echo $p['keyword']; ?>" name="keyword" /></label>
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
                <?php if (\Phpcmf\Service::C()->_is_admin_auth('del')) { ?>
                <th class="myselect">
                    <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="group-checkable" data-set=".checkboxes" />
                        <span></span>
                    </label>
                </th>
                <?php } ?>
                <th width="200" class="<?php echo dr_sorting('username'); ?>" name="username"><?php echo dr_lang('账号'); ?></th>
                <th><?php echo dr_lang('角色组'); ?></th>
                <th><?php echo dr_lang('操作'); ?></th>
            </tr>
            </thead>
            <tbody>
            <?php if (is_array($list)) { $key_t=-1;$count_t=dr_count($list);foreach ($list as $t) { $key_t++;  $verify = dr_string2array($t['verify']); ?>
            <tr class="odd gradeX" id="dr_row_<?php echo $t['id']; ?>">
                <?php if (\Phpcmf\Service::C()->_is_admin_auth('del')) { ?>
                <td class="myselect">
                    <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" name="ids[]" value="<?php echo $t['id']; ?>" />
                        <span></span>
                    </label>
                </td>
                <?php } ?>
                <td><a href="javascript:;" class="fc_member_show" member="<?php echo $t['username']; ?>"><?php echo $t['username']; ?></a></td>
                <td>
                    <?php if (is_array($t['role'])) { $key_c=-1;$count_c=dr_count($t['role']);foreach ($t['role'] as $c) { $key_c++; ?>
                    <span class="badge badge-blue"> <?php echo $c; ?> </span>
                    <?php } } ?>
                </td>
                <td>
                    <?php if (\Phpcmf\Service::C()->_is_admin_auth('edit')) { ?>
                    <label><a href="<?php echo dr_url($uriprefix.'/edit', ['id'=>$t['id']]); ?>" class="btn btn-xs green"> <i class="fa fa-edit"></i> <?php echo dr_lang('修改'); ?></a></label>
                    <?php } ?>
                    <label><a href="javascript:dr_iframe_show('<?php echo dr_lang('登录记录'); ?>', '<?php echo dr_url($uriprefix.'/login_index', ['id'=>$t['id']]); ?>', '80%')" class="btn btn-xs blue"> <i class="fa fa-calendar"></i> <?php echo dr_lang('登录记录'); ?></a></label>

                </td>
            </tr>
            <?php } } ?>
            </tbody>
        </table>
    </div>

     <div class="row fc-list-footer table-checkable ">
         <div class="col-md-5 fc-list-select">
            <?php if (\Phpcmf\Service::C()->_is_admin_auth('del')) { ?>
            <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                <input type="checkbox" class="group-checkable" data-set=".checkboxes" />
                <span></span>
            </label>
            <button type="button" onclick="dr_ajax_option('<?php echo dr_url($uriprefix.'/del'); ?>', '<?php echo dr_lang('你确定要把它们的管理员身份取消吗？'); ?>', 1)" class="btn red btn-sm"> <i class="fa fa-trash"></i> <?php echo dr_lang('删除'); ?></button>
            <?php } ?>
         </div>
         <div class="col-md-7 fc-list-page">
             <?php echo $mypages; ?>
         </div>
     </div>
</form>
</div>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>