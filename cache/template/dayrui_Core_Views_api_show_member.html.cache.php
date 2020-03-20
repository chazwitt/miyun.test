<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>

<div class="row">
    <div class="col-xs-4">
        <div class="text-center ">
            <a href="<?php echo dr_url('member/alogin_index', ['id'=>$m['id']]); ?>" target="_blank"><img src="<?php echo $m['avatar']; ?>" style="border-radius:40%;height: 70px!important;"></a>
        </div>
        <div class="text-left fc-user-group">
            <?php if (is_array($m['group'])) { $key_g=-1;$count_g=dr_count($m['group']);foreach ($m['group'] as $g) { $key_g++; ?>
            <h5 class=""> <?php echo \Phpcmf\Service::C()->member_cache['group'][$g['gid']][name];  if ($g['lid']) { ?>
            <br>
            <span>
                <?php echo \Phpcmf\Service::C()->member_cache['group'][$g['gid']][level][$g['lid']][name]; ?>
            </span>
            <?php } ?></h5>
            <?php } } ?>
        </div>
    </div>
    <div class="col-xs-8">
        <ul class="u-ul">
            <li>
                <label class="u-name">Id</label>
                <label class="u-value"><?php echo $m['id']; ?> </label>
            </li>
            <li>
                <label class="u-name"><?php echo dr_lang('账号'); ?></label>
                <label class="u-value"><?php echo $m['username']; ?> </label>
            </li>
            <li>
                <label class="u-name"><?php echo dr_lang('邮箱'); ?></label>
                <label class="u-value"><?php echo $m['email']; ?> </label>
            </li>
            <li>
                <label class="u-name"><?php echo dr_lang('手机'); ?></label>
                <label class="u-value"><?php echo $m['phone']; ?> </label>
            </li>
            <li>
                <label class="u-name"><?php echo dr_lang('姓名'); ?></label>
                <label class="u-value"><?php echo $m['name']; ?> </label>
            </li>
            <li>
                <label class="u-name"><?php echo dr_lang('余额'); ?></label>
                <label class="u-value">￥<?php echo $m['money']; ?> &nbsp;&nbsp;(<?php echo dr_lang('冻结'); ?>&nbsp;&nbsp;￥<?php echo $m['freeze']; ?>)</label>
            </li>
            <li>
                <label class="u-name"><?php echo dr_lang('消费'); ?></label>
                <label class="u-value"><?php echo $m['spend']; ?> </label>
            </li>
            <li>
                <label class="u-name"><?php echo SITE_SCORE; ?></label>
                <label class="u-value"><?php echo $m['score']; ?> </label>
                <label class="u-name"><?php echo SITE_EXPERIENCE; ?></label>
                <label class="u-value"><?php echo $m['experience']; ?> </label>
            </li>
            <li>
                <label class="u-name"><?php echo dr_lang('注册'); ?></label>
                <label class="u-value"><?php echo dr_date($m['regtime']); ?> </label>
            </li>
            <li>
                <label class="u-name"><?php echo dr_lang('随机码'); ?></label>
                <label class="u-value"><?php echo $m['randcode']; ?> </label>
            </li>
        </ul>
    </div>
</div>
<style>
    .u-ul, .u-ul li {
        list-style: none;
        padding: 0;
    }
    .u-ul li {
        line-height: 30px;
    }
    .u-ul .u-value {
        padding-left: 8px;
    }
    .u-ul .u-name {
        width: 80px;
        text-align: right;
    }
</style>
<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>