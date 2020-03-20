<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>

<div class="table-scrollable table-scrollable-borderless" style="margin-top: -20px !important;">
    <table class="table table-hover table-light">
        <thead>
        <tr class="heading">
            <th width="220"> <?php echo dr_lang('时间 / 地点'); ?> </th>
            <th> <?php echo dr_lang('客户端详情'); ?> </th>
        </tr>
        </thead>
        <tbody>
        <?php if (is_array($list)) { $key_t=-1;$count_t=dr_count($list);foreach ($list as $i=>$t) { $key_t++; ?>
        <tr class="odd gradeX">
            <td>
                <p style="margin: 8px 0"><?php echo dr_date($t['logintime']); ?></p>
                <p style="margin: 8px 0"><a href="http://www.ip138.com/ips138.asp?ip=<?php echo $t[loginip]; ?>&action=2" target="_blank"><?php echo \Phpcmf\Service::L('Ip')->address($t[loginip]); ?></a></p>
            </td>
            <td> <?php echo str_replace(') ', ') <br>', $t['useragent']); ?> </td>
        </tr>
        <?php } } ?>
        </tbody>
    </table>
</div>
<div class="row fc-list-footer table-checkable ">
    <div class="col-md-7 fc-list-page">
        <?php echo $mypages; ?>
    </div>
</div>


<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>