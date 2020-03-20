<?php if ($fn_include = $this->_include("mheader.html")) include($fn_include); ?>

<div class="portlet light ">
    <div class="portlet-title tabbable-line">
        <ul class="nav nav-tabs" style="float:left;">
            <?php if (is_array($module_memu)) { $key_t=-1;$count_t=dr_count($module_memu);foreach ($module_memu as $i=>$t) { $key_t++; ?>
            <li class="<?php if ($mcid==$i) { ?>active<?php } ?>">
                <a href="<?php echo $t['url']; ?>"> <i class="<?php echo $t['icon']; ?>"></i> <?php echo $t['name']; ?> </a>
            </li>
            <?php } } ?>
        </ul>
    </div>
    <div class="portlet-body">

        <form class="form-horizontal" role="form" id="myform">
            <?php echo dr_form_hidden(); ?>
        <div class="table-scrollable">
            <table class="table table-striped table-bordered table-hover table-checkable dataTable">
                <thead>
                <tr class="heading">
                    <th width="70" class="<?php echo dr_sorting('id'); ?>" name="id"> Id </th>
                    <th class="<?php echo dr_sorting('title'); ?>" name="title">主题</th>
                    <th width="150" class="<?php echo dr_sorting('catid'); ?>" name="catid">栏目</th>
                    <th width="150" class="<?php echo dr_sorting('inputtime'); ?>" name="inputtime">更新时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody>
                <?php if (is_array($list)) { $key_t=-1;$count_t=dr_count($list);foreach ($list as $t) { $key_t++; ?>
                <tr class="odd gradeX" id="dr_row_<?php echo $t['id']; ?>">
                    <td> <a href="<?php echo $t['url']; ?>" target="_blank"><?php echo $t['id']; ?></a> </td>
                    <td> <?php echo \Phpcmf\Service::L('Function_list')->title($t['title'], $param, $t); ?> </td>
                    <td> <?php echo \Phpcmf\Service::L('Function_list')->catid($t['catid']); ?> </td>
                    <td> <?php echo \Phpcmf\Service::L('Function_list')->datetime($t['updatetime'], $param, $t); ?> </td>
                    <td>
                        <?php if (is_array($clink)) { $key_a=-1;$count_a=dr_count($clink);foreach ($clink as $a) { $key_a++; ?>
                        <label><a class="btn <?php if ($a['color']) {  echo $a['color'];  } ?> btn-xs" href="<?php echo str_replace(array('{mid}', '{id}', '{cid}'), array(APP_DIR, $t['id'], $t['id']), $a['murl']); ?>"><i class="<?php echo $a['icon']; ?>"></i> <?php echo $a['name'];  if ($a['field']) { ?> (<?php echo intval($t[$a['field']]); ?>)<?php } ?> </a></label>
                        <?php } }  if (is_array($mform)) { $key_a=-1;$count_a=dr_count($mform);foreach ($mform as $a) { $key_a++; ?>
                        <label><a class="btn blue btn-xs" href="<?php echo dr_member_url(APP_DIR.'/'.$a['table'].'/index', ['cid'=>$t['id']]); ?>"><i class="<?php echo dr_icon($a['setting']['icon']); ?>"></i> <?php echo dr_lang($a['name']);  if (isset($t[$a['table'].'_total'])) { ?> (<?php echo intval($t[$a['table'].'_total']); ?>) <?php } ?> </a></label>
                        <?php } } ?>
                        <label><a href="<?php echo dr_member_url($uriprefix.'/edit', ['id'=>$t['id']]); ?>" class="btn btn-xs green"> <i class="fa fa-edit"></i> </a></label>
                        <label><a href="javascript:dr_ajax_option('<?php echo dr_member_url($uriprefix.'/del', ['id'=>$t['id']]); ?>', '你确定要删除吗？', 1);" class="btn btn-xs red"> <i class="fa fa-trash"></i> </a></label>
                    </td>
                </tr>
                <?php } } ?>
                </tbody>
            </table>
        </div>
        </form>

        <?php if ($mypages) { ?>
        <div class="fc-pages text-center"><?php echo $mypages; ?></div>
        <?php } ?>
    </div>
</div>



<?php if ($fn_include = $this->_include("mfooter.html")) include($fn_include); ?>