<?php if ($fn_include = $this->_include("mheader.html")) include($fn_include); ?>

<div class="row">

    <div class="col-md-6">
        <div class="profile-sidebar-portlet pull-left">
            <div class="profile-userpic">
                <a href="<?php echo dr_member_url('account/avatar'); ?>"><img src="<?php echo $member['avatar']; ?>" class="img-responsive"></a>
            </div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"> <?php echo $member['username']; ?> </div>
            </div>
        </div>
        <div class="profile-sidebar-m pull-left">
            <div class="user-body-title">
                余额<span class="home-colon">:</span>
            </div>
            <div class="user-body-main">
                <div class="user-balance-wrap">
                    <div class="user-balance">
                        <span class="ng-binding"><i class="fa fa-rmb"></i></span>
                        <span class="user-balance-small ng-binding"><?php echo number_format($member['money'], 2); ?></span>
                        <span class="user-small">元</span>
                    </div>
                    <div class="user-small">
                        冻结 <i class="fa fa-rmb"></i> <?php echo number_format($member['freeze'], 2); ?> 元
                    </div>

                </div>
                <div class="user-bottom">
                    <a href="<?php echo dr_member_url('recharge/index'); ?>" class="btn green btn-xs"> 在线充值 </a>
                </div>
            </div>
        </div>
        <div class="profile-sidebar-r pull-left">
            <div class="user-body-title">
                <?php echo SITE_SCORE; ?><span class="home-colon">:</span>
            </div>
            <div class="user-body-main" style="height: 30px;">
                <div class="user-balance-wrap">
                    <div class="user-balance">
                        <span class="user-balance-small"><?php echo $member['score']; ?></span>
                    </div>
                </div>
            </div>
            <div class="user-bottom">
                <a href="<?php echo dr_member_url('scorelog/index', ['tid'=>1]); ?>" class=""> 收入记录 </a>
                <a href="<?php echo dr_member_url('scorelog/index', ['tid'=>-1]); ?>" class=""> 消费记录 </a>
            </div>
        </div>
    </div>

</div>

<div class="row margin-top-20">

    <div class="col-md-12">
        <div class="portlet light">
            <div class="portlet-title">
                <div class="caption">
                    <span class="caption-subject"> 我的权限</span>
                </div>
            </div>
            <div class="portlet-body">
                <table class="table table-striped table-bordered table-advance ">
                    <thead>
                    <tr>
                        <th><i class="fa fa-users"></i> 用户组 </th>
                        <th><i class="fa fa-star"></i> 级别 </th>
                        <th><i class="fa fa-clock-o"></i> 有效期 </th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (is_array(\Phpcmf\Service::C()->member_cache['group'])) { $key_t=-1;$count_t=dr_count(\Phpcmf\Service::C()->member_cache['group']);foreach (\Phpcmf\Service::C()->member_cache['group'] as $gid=>$t) { $key_t++;  if ($member['groupid'][$gid]) { ?>
                    <tr>
                        <td class="highlight">
                            <div class="success"></div>
                            <a href="javascript:;"> <?php echo $t['name']; ?> </a>
                        </td>
                        <td><?php if ($t['level']) {  echo $t['level'][$member['levelid'][$gid]]['name'];  } else { ?>无<?php } ?></td>
                        <td><?php echo dr_date($member['group'][$gid]['stime'], 'Y-m-d'); ?> ~ <?php if ($member['group'][$gid]['etime']) {  echo dr_date($member['group'][$gid]['etime'], 'Y-m-d');  } else { ?>永久<?php } ?></td>
                        <td>
                            <?php $next = dr_level_next_value($t['level'], $member['levelid'][$gid]);  if ($next) {  if ($t[setting][level][auto]) { ?>
                            升级要求:
                                <?php if ($t[setting][level][unit]) { ?>
                                消费额<?php echo $member['spend']; ?> >= <?php echo $next['value'];  } else {  echo SITE_EXPERIENCE; ?> >= <?php echo $next['value'];  }  } else { ?>
                            <a href="<?php echo dr_member_url('apply/level', ['gid'=>$gid]); ?>" class="btn green btn-xs "> 我要升级 </a>
                            <?php }  } else { ?>
                            已开通
                            <?php } ?>

                        </td>
                    </tr>
                    <?php } else {  if ($t['apply']) { ?>
                    <tr>
                        <td class="highlight">
                            <div class="danger"></div>
                            <a href="javascript:;"> <?php echo $t['name']; ?> </a>
                        </td>
                        <td> 无 </td>
                        <td> <?php if ($t['days']) {  echo $t['days']; ?>天<?php } else { ?>永久<?php } ?> </td>
                        <td>
                            <?php $sq=\Phpcmf\Service::M()->table('member_group_verify')->where('uid', $member['uid'])->where('gid', $t['id'])->getRow();  if ($sq) { ?>
                            <a href="<?php echo dr_member_url('apply/index', ['gid'=>$gid]); ?>" class="btn red  btn-xs "> <?php if ($sq['status']) { ?>被拒绝<?php } else { ?>审核中<?php } ?> </a>
                            <?php } else { ?>
                            <a href="<?php echo dr_member_url('apply/index', ['gid'=>$gid]); ?>" class="btn red  btn-xs "> 申请开通 </a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php }  }  } } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php if ($fn_include = $this->_include("mfooter.html")) include($fn_include); ?>