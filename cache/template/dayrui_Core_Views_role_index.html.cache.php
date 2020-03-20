<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="note note-danger">
    <p><a href="javascript:dr_update_cache_all();"><?php echo dr_lang('更改数据之后请更新下全站缓存'); ?></a></p>
</div>

<div class="right-card-box">
<form class="form-horizontal" role="form" id="myform">
    <?php echo dr_form_hidden(); ?>
    <div class="table-scrollable">
        <table class="table table-striped table-bordered table-hover table-checkable">
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
            <th width="300"> <?php echo dr_lang('角色组'); ?> </th>
            <th width="100" style="text-align:center"> <?php echo dr_lang('身份'); ?> </th>
            <th width="100" style="text-align:center"> <?php echo dr_lang('站点数'); ?> </th>
            <th>

            </th>
        </tr>
        </thead>
        <tbody>
        <?php if (is_array($data)) { $key_t=-1;$count_t=dr_count($data);foreach ($data as $t) { $key_t++; ?>
        <tr class="odd gradeX" id="dr_row_<?php echo $t['id']; ?>">
            <?php if (\Phpcmf\Service::C()->_is_admin_auth('del')) { ?>
            <td>
                <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" <?php if ($t['id']==1) { ?>disabled<?php } ?> class="checkboxes" name="ids[]" value="<?php echo $t['id']; ?>" />
                    <span></span>
                </label>
            </td>
            <?php } ?>
            <td>
                <?php echo $t['name']; ?>
            </td>
            <td style="text-align:center">
                <a <?php if (\Phpcmf\Service::C()->_is_admin_auth('edit')) { ?>href="<?php if ($t['id']>1) { ?>javascript:dr_iframe('<?php echo dr_lang('修改'); ?>', '<?php echo dr_url('role/edit', ['id'=>$t['id']]); ?>', '500px', '50%');<?php } else { ?>javascript:;<?php } ?>"<?php } ?> class="badge <?php if ($t['application']['tid']) { ?>badge-danger<?php } else { ?>badge-success<?php } ?>"><?php if ($t['application']['tid']) {  echo dr_lang('投稿者');  } else {  echo dr_lang('管理者');  } ?></a>
            </td>
            <td style="text-align:center">
                <a <?php if (\Phpcmf\Service::C()->_is_admin_auth('edit')) { ?>href="<?php if ($t['id']>1) { ?>javascript:dr_iframe('<?php echo dr_lang('站点权限'); ?>', '<?php echo dr_url('role/edit_site', ['id'=>$t['id']]); ?>', '500px', '50%');<?php } else { ?>javascript:;<?php } ?>"<?php } ?> class="badge badge-success"><?php if ($t['id']>1) {  echo count($t['site']);  } else {  echo dr_lang('全部');  } ?></a>
            </td>
            <td>
                <?php if (\Phpcmf\Service::C()->_is_admin_auth('edit') && $t['id']>1) { ?>
                <a href="<?php echo dr_url('role/edit_auth', ['id'=>$t['id']]); ?>" class="btn btn-xs dark"> <i class="fa fa-user-md"></i> <?php echo dr_lang('操作权限'); ?> </a>
                <a href="javascript:dr_iframe('<?php echo dr_lang('站点权限'); ?>', '<?php echo dr_url('role/edit_site', ['id'=>$t['id']]); ?>', '500px', '50%');"class="btn btn-xs red"> <i class="fa fa-cog"></i> <?php echo dr_lang('站点权限'); ?></a>
                <?php }  if (\Phpcmf\Service::C()->_is_admin_auth('edit')) { ?><a href="javascript:dr_iframe('edit', '<?php echo dr_url('role/edit', ['id'=>$t['id']]); ?>', '500px', '400px');" class="btn btn-xs green"> <i class="fa fa-edit"></i> <?php echo dr_lang('修改'); ?> </a><?php } ?>
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
                <button type="button" onclick="dr_ajax_option('<?php echo dr_url('role/del'); ?>', '<?php echo dr_lang('你确定要删除它们吗？'); ?>', 1)" class="btn red btn-sm"> <i class="fa fa-trash"></i> 删除</button>
                <?php } ?>
         </div>
             <div class="col-md-7 fc-list-page">
                 <?php echo $mypages; ?>
             </div>
         </div>
</form>
</div>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>