<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>

<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <div class="page-content">

            <div class="container">

                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="<?php echo SITE_URL; ?>">首页</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <a href="<?php echo MEMBER_URL; ?>">用户中心</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>登录</span>
                    </li>
                </ul>

                <div class="page-content-inner">
                    <div class="search-page search-content-2">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject font-dark">用户登录</span>
                                </div>
                            </div>
                            <div class="portlet-body login">

                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">

                                        <form class="content" id="myform" method="post" novalidate="novalidate">
                                            <?php echo $form; ?>
                                            <div class="form-group">
                                                <div class="input-icon">
                                                    <i class="fa fa-user"></i>
                                                    <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="账号/邮箱/手机" name="data[username]">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-icon">
                                                    <i class="fa fa-lock"></i>
                                                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="登录密码" name="data[password]">
                                                </div>
                                            </div>
                                            <?php if ($is_code) { ?>
                                            <div class="form-group">
                                                <div class="input-group login-code">
                                                    <div class="input-icon">
                                                        <i class="fa fa-code"></i>
                                                        <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="验证码" name="code">
                                                    </div>
                                                    <div class="input-group-btn fc-code">
                                                        <?php echo dr_code(120, 35); ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <div class="form-actions">
                                                <label class="rememberme mt-checkbox mt-checkbox-outline">
                                                    <input type="checkbox" name="remember" value="1"> 记住登录
                                                    <span></span>
                                                </label>
                                                <button type="button" onclick="dr_ajax_member('<?php echo dr_now_url(); ?>', 'myform');" class="btn green pull-right"> 登录 </button>
                                            </div>
                                            <div class="login-options">
                                                <ul class="login-oauth">
                                                    <li>
                                                        <a href="<?php echo \Phpcmf\Service::L('Router')->oauth_url('qq', 'login'); ?>"> <img src="<?php echo THEME_PATH; ?>assets/oauth/qq.png"> </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo \Phpcmf\Service::L('Router')->oauth_url('weibo', 'login'); ?>"> <img src="<?php echo THEME_PATH; ?>assets/oauth/weibo.png"> </a>
                                                    </li>
                                                    <li>
                                                        <a href="<?php echo \Phpcmf\Service::L('Router')->oauth_url('weixin', 'login'); ?>"> <img src="<?php echo THEME_PATH; ?>assets/oauth/weixin.png"> </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="create-account">
                                                <p>
                                                    <a href="<?php echo dr_member_url('register/index'); ?>"> 注册账号 </a>
                                                    <a href="<?php echo dr_member_url('login/find'); ?>"> 找回密码 </a>
                                                </p>
                                            </div>
                                        </form>

                                    </div>
                                    <div class="col-md-4"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($fn_include = $this->_include("footer.html", "/")) include($fn_include); ?>