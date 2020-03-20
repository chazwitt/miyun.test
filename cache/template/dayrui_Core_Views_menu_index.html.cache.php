<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<div class="note note-danger">
    <p><a href="javascript:dr_update_cache_all();"><?php echo dr_lang('更改数据之后请更新下全站缓存'); ?></a></p>
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
                    <label class="mt-table mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="group-checkable" data-set=".checkboxes" />
                        <span></span>
                    </label>
                </th>
                <?php } ?>
                <th class="hidden-mobile" width="70" style="text-align:center"> <?php echo dr_lang('排序'); ?> </th>
                <th class="hidden-mobile" width="60" style="text-align:center"> <?php echo dr_lang('可用'); ?> </th>
                <th> <?php echo dr_lang('名称'); ?> </th>
                <th width="130">
                    <?php if (\Phpcmf\Service::C()->_is_admin_auth('add')) { ?><a href="javascript:dr_iframe('add', '<?php echo dr_url('menu/add', ['pid'=>0]); ?>');" class="btn btn-xs blue"> <i class="fa fa-plus"></i> <?php echo dr_lang('添加'); ?> </a><?php } ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <?php $top=array();  if (is_array($data)) { $key_t=-1;$count_t=dr_count($data);foreach ($data as $t) { $key_t++;  $t['pid'] == 0 && $top[] = $t['id']; ?>
            <tr class="odd gradeX" id="dr_row_<?php echo $t['id']; ?>">
                <?php if (\Phpcmf\Service::C()->_is_admin_auth('del')) { ?>
                <td class="myselect">
                    <label class="mt-table mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                        <input type="checkbox" class="checkboxes" name="ids[]" value="<?php echo $t['id']; ?>" />
                        <span></span>
                    </label>
                </td>
                <?php } ?>
                <td class="hidden-mobile" style="text-align:center"> <input type="text" onblur="dr_ajax_save(this.value, '<?php echo dr_url('menu/save_edit', ['id'=>$t['id']]); ?>', 'displayorder')" value="<?php echo $t['displayorder']; ?>" class="displayorder form-control input-sm input-inline input-mini"> </td>
                <td class="hidden-mobile" style="text-align:center">
                    <a href="javascript:;" onclick="dr_ajax_open_close(this, '<?php echo dr_url('menu/use_edit', ['id'=>$t['id']]); ?>', 1);" class="badge badge-<?php if ($t['hidden']) { ?>no<?php } else { ?>yes<?php } ?>"><i class="fa fa-<?php if ($t['hidden']) { ?>times<?php } else { ?>check<?php } ?>"></i></a>
                </td>
                <td>
                    <?php echo $t['spacer']; ?> <a href="javascript:dr_iframe('edit', '<?php echo dr_url('menu/edit', ['id'=>$t['id']]); ?>');"><i class="<?php echo $t['icon']; ?>"></i> <?php echo $t['name']; ?></a>
                </td>
                <td>
                    <?php if (\Phpcmf\Service::C()->_is_admin_auth('add') && ($t['pid'] == 0 || @in_array($t['pid'], (array)$top))) { ?><a href="javascript:dr_iframe('add', '<?php echo dr_url('menu/add', ['pid'=>$t['id']]); ?>', '', '<?php if (@in_array($t['pid'], $top)) { ?>500px<?php } ?>');" class="btn btn-xs blue"> <i class="fa fa-plus"></i> <?php echo dr_lang('添加'); ?> </a><?php } ?>
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
            <button type="button" onclick="dr_ajax_option('<?php echo dr_url('menu/del'); ?>', '<?php echo dr_lang('你确定要删除它们吗？'); ?>', 1)" class="btn red btn-sm"> <i class="fa fa-trash"></i> <?php echo dr_lang('删除'); ?></button>
            <?php } ?>
         </div>
         <div class="col-md-7 fc-list-page">
             <?php echo $mypages; ?>
         </div>
     </div>
</form>
</div>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>