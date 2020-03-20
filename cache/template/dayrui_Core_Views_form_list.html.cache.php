<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="note note-danger">
    <p><?php echo dr_lang('表单可以用于前端数据展示与收集，如留言板、反馈、证书展示，需要配合前端页面使用'); ?></p>
</div>

<div class="right-card-box">
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
            <th width="200"> <?php echo dr_lang('名称'); ?> </th>
            <th width="200"> <?php echo dr_lang('别名'); ?> </th>
            <th>  </th>
        </tr>
        </thead>
        <tbody>
        <?php if (is_array($list)) { $key_t=-1;$count_t=dr_count($list);foreach ($list as $t) { $key_t++;  $cg = dr_string2array($t['setting']); if (!$cg['dev'] || $cg['dev'] == 1) { ?>
        <tr class="odd gradeX" id="dr_row_<?php echo $t['id']; ?>">
            <?php if (\Phpcmf\Service::C()->_is_admin_auth('del')) { ?>
            <td class="myselect">
                <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                    <input type="checkbox" class="checkboxes" name="ids[]" value="<?php echo $t['id']; ?>" />
                    <span></span>
                </label>
            </td>
            <?php } ?>
            <td><?php echo $t['name']; ?></td>
            <td><?php echo $t['table']; ?></td>
            <td>
                <?php if (!$cg['dev']) { ?><label><a href="/index.php?s=form&c=<?php echo $t['table']; ?>&m=post" target="_blank" class="btn btn-xs yellow"> <i class="fa fa-send"></i> <?php echo dr_lang('预览'); ?> </a></label><?php }  if (\Phpcmf\Service::C()->_is_admin_auth('edit')) { ?><label><a href="<?php echo dr_url('form/edit', ['id'=>$t['id']]); ?>" class="btn btn-xs green"> <i class="fa fa-edit"></i> <?php echo dr_lang('修改'); ?> </a></label><?php }  if (\Phpcmf\Service::C()->_is_admin_auth()) { ?><label><a href="<?php echo dr_url('field/index', ['rname'=>'form-'.SITE_ID, 'rid'=>$t['id']]); ?>" class="btn btn-xs dark"> <i class="fa fa-code"></i> <?php echo dr_lang('自定义字段'); ?> </a></label><?php }  if (\Phpcmf\Service::C()->_is_admin_auth()) { ?><label><a href="javascript:dr_iframe_show('<?php echo dr_lang('导出'); ?>', '<?php echo dr_url('form/export', ['id'=>$t['id']]); ?>');" class="btn btn-xs red"> <i class="fa fa-sign-out"></i> <?php echo dr_lang('导出'); ?> </a></label><?php } ?>
            </td>
        </tr>
        <?php }  } } ?>
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
                <button type="button" onclick="dr_ajax_option('<?php echo dr_url('form/del'); ?>', '<?php echo dr_lang('你确定要删除它们吗？'); ?>', 1)" class="btn red btn-sm"> <i class="fa fa-trash"></i> <?php echo dr_lang('删除'); ?></button>
                <?php } ?>
            </div>
             <div class="col-md-7 fc-list-page">
                 <?php echo $mypages; ?>
             </div>
         </div>

</form>
</div>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>