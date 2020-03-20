<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>
<script>

    function dr_show_catid(catid) {
        if ($('.dr_cat_'+catid).is(":hidden")){
            $('.fc-cat-user').hide();
            $('.dr_cat_'+catid).show(200);
        }else{
            $('.dr_cat_'+catid).hide(200);
        }
    }
    function dr_copy_catid(catid) {
        dr_iframe('<?php echo dr_lang('复制'); ?>', '<?php echo dr_url('site_member/edit'); ?>&catid='+catid);
    }
    $(function(){
        var table = $('.table-checkable');
        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery("."+set).each(function () {
                if (checked) {
                    $(this).prop("checked", true);
                    $(this).parents('tr').addClass("active");
                } else {
                    $(this).prop("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
        });
    });
</script>
<div class="note note-danger  my-content-top-tool">
    <p><a href="javascript:dr_update_cache_all();"><?php echo dr_lang('更改数据之后需要更新缓存之后才能生效'); ?></a></p>
</div>

<div class="row finecms-tool-row">
    <div class="col-md-6">
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user font-dark"></i>
                    <span class="caption-subject font-dark  "> <?php echo dr_lang('访问权限'); ?></span>
                </div>
            </div>
            <div class="portlet-body form">
                <form id="form1">
                    <?php echo dr_form_hidden(); ?>
                    <div class="form-body">
                        <div class="table-scrollable">
                            <table class="fc-user-table table table-striped table-bordered table-checkable dataTable">
                                <thead>
                                <tr class="heading">
                                    <th class="myselect" style="height: 40px">
                                        <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" class="checkboxes group-checkable home2" data-set="home2" />
                                            <span></span>
                                        </label>
                                    </th>
                                    <th>

                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if (is_array($list)) { $key_t=-1;$count_t=dr_count($list);foreach ($list as $i=>$t) { $key_t++; ?>
                                <tr class="odd gradeX">
                                    <td class="myselect myselect">
                                        <?php if (!$t['level']) { ?>
                                        <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                            <input type="checkbox" <?php if (!in_array($i, (array)$auth[home])) { ?> checked <?php } ?> class="checkboxes home2" name="id[]" value="<?php echo $i; ?>" />
                                            <span></span>
                                        </label>
                                        <?php } ?>
                                    </td>
                                    <td <?php echo $t['space']; ?>><?php echo $t['name']; ?></td>
                                </tr>
                                <?php } } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="form-actions">
                            <button type="button" onclick="dr_submit_post_todo('form1', '<?php echo dr_url('site_member/add'); ?>&at=home')" class="btn blue"> <i class="fa fa-save"></i> <?php echo dr_lang('保存配置'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php if ($categroy) { ?>
<div class="portlet light bordered ">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-reorder font-dark"></i>
            <span class="caption-subject font-dark"> <?php echo dr_lang('共享栏目权限'); ?></span>
        </div>
    </div>
    <div class="portlet-body form">
        <form id="form3cate">
            <?php echo dr_form_hidden(); ?>
            <div class="form-body">
                <div class="table-scrollable">
                    <table class="fc-user-table table table-striped table-bordered table-checkable dataTable">
                        <thead>
                        <tr class="heading">
                            <th class="myselect">Id</th>
                            <th><?php echo dr_lang('栏目'); ?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (is_array($categroy)) { $key_cat=-1;$count_cat=dr_count($categroy);foreach ($categroy as $catid=>$cat) { $key_cat++; ?>
                        <tr class="">
                            <td width="70"> <?php echo $cat['id']; ?></td>
                            <td> <?php echo $cat['spacer'];  echo $cat['name']; ?></td>
                            <td>
                                <button onclick="dr_iframe('<?php echo dr_lang('[%s]用户权限', $cat['name']); ?>', '<?php echo dr_url('site_member/category_edit'); ?>&catid=<?php echo $catid; ?>', '95%', '', 'nogo')" type="button" class="btn blue btn-xs"> <i class="fa fa-cog"></i> <?php echo dr_lang('用户权限'); ?></button>
                                <button onclick="dr_copy_catid(<?php echo $catid; ?>)" type="button" class="btn red btn-xs"> <i class="fa fa-copy"></i> <?php echo dr_lang('同步到其他栏目'); ?></button>
                                <button onclick="dr_load_ajax('<?php echo dr_lang('你确定要初始化本栏目的权限配置吗？'); ?>', '<?php echo dr_url('site_member/del'); ?>&catid=<?php echo $catid; ?>', 1)" type="button" class="btn green btn-xs"> <i class="fa fa-trash"></i> <?php echo dr_lang('初始化权限'); ?></button>

                            </td>
                        </tr>
                        <?php } } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </form>
    </div>
</div>
<?php }  if ($page) { ?>
<div class="portlet light bordered ">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-safari font-dark"></i>
            <span class="caption-subject font-dark"> <?php echo dr_lang('自定义页面权限'); ?></span>
        </div>
    </div>
    <div class="portlet-body form">
        <form id="formpage">
            <?php echo dr_form_hidden(); ?>
            <div class="form-body">
                <div class="table-scrollable">
                    <table class="fc-user-table table table-striped table-bordered table-checkable dataTable">
                        <thead>
                        <tr class="heading">
                            <th class="myselect">Id</th>
                            <th><?php echo dr_lang('自定义页面'); ?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (is_array($page)) { $key_cat=-1;$count_cat=dr_count($page);foreach ($page as $catid=>$cat) { $key_cat++; ?>
                        <tr class="">
                            <td width="70"> <?php echo $cat['id']; ?></td>
                            <td> <?php echo $cat['spacer'];  echo $cat['name']; ?></td>
                            <td>
                                <button onclick="dr_show_catid('page_<?php echo $catid; ?>')" type="button" class="btn blue btn-xs"> <i class="fa fa-cog"></i> <?php echo dr_lang('用户权限'); ?></button>
                            </td>
                        </tr>
                        <tr class="dr_cat_page_<?php echo $catid; ?> fc-cat-user" style="display:none">
                            <td colspan="3" class="fc-cat-info">
                                <div class="table-scrollable">
                                    <table class="fc-cat-table table table-striped table-bordered  table-checkable dataTable">
                                        <thead>
                                        <tr class="heading">
                                            <th width="200"></th>
                                            <th class="dr_option_xx">
                                                <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <?php echo dr_lang('访问'); ?>
                                                    <input type="checkbox" class="checkboxes group-checkable dr_p_<?php echo $catid; ?>_show" data-set="dr_p_<?php echo $catid; ?>_show" />
                                                    <span></span>
                                                </label>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (is_array($list)) { $key_t=-1;$count_t=dr_count($list);foreach ($list as $i=>$t) { $key_t++; ?>
                                        <tr class="odd gradeX">
                                            <?php if ($t['level']) { ?>
                                            <td colspan="99"> <?php echo $t['name']; ?> </td>
                                            <?php } else { ?>
                                            <td <?php echo $t['space']; ?>><?php echo $t['name']; ?></td>
                                            <td class="dr_option_xx">
                                                <label class="mt-table mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                                    <?php echo dr_lang('访问'); ?>
                                                    <input type="checkbox" class="checkboxes dr_p_<?php echo $catid; ?>_show" <?php if (!in_array($i, (array)$auth[page][$cat['id']]['show'])) { ?> checked <?php } ?> name="id[<?php echo $cat['id']; ?>][show][]" value="<?php echo $i; ?>" />
                                                    <span></span>
                                                </label>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                        <?php } } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                        <?php } } ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-actions text-center">
                    <button type="button" onclick="dr_submit_post_todo('formpage', '<?php echo dr_url('site_member/add'); ?>&at=page')" class="btn blue"> <i class="fa fa-save"></i> <?php echo dr_lang('保存配置'); ?></button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php }  if ($form) { ?>
<div class="portlet light bordered ">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-list font-dark"></i>
            <span class="caption-subject font-dark"> <?php echo dr_lang('表单权限'); ?></span>
        </div>
    </div>
    <div class="portlet-body form">
        <form id="form7">
            <?php echo dr_form_hidden(); ?>
            <div class="form-body">
                <div class="table-scrollable">
                    <table class="fc-user-table table table-striped table-bordered table-checkable dataTable">
                        <thead>
                        <tr class="heading">
                            <th width="150"></th>
                            <th><?php echo dr_lang('表单'); ?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (is_array($form)) { $key_cat=-1;$count_cat=dr_count($form);foreach ($form as $catid=>$cat) { $key_cat++; ?>
                        <tr class="">
                            <th><?php echo $catid; ?></th>
                            <td> <?php echo $cat['spacer'];  echo $cat['name']; ?></td>
                            <td>
                                <button onclick="dr_iframe('<?php echo dr_lang('网站表单[%s]', $cat['name']); ?>', '<?php echo dr_url('site_member/form_edit'); ?>&table=<?php echo $catid; ?>', '95%', '', 'nogo')" type="button" class="btn blue btn-xs"> <i class="fa fa-cog"></i> <?php echo dr_lang('用户权限'); ?></button>

                            </td>
                        </tr>
                        <?php } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>
<?php } ?>

<style>
    .dr_option_xx {
        text-align: left !important;
    }
    .dr_option_xx .mt-checkbox {
        margin-right: 10px;
        margin-bottom: 5px;
    }
</style>
<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>