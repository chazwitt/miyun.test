<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>

<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <div class="page-content">

            <div class="container">

                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="<?php echo SITE_URL; ?>">网站首页</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>提示</span>
                    </li>
                </ul>

                <div class="search-page">

                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-green-sharp"> 提示信息 </span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row fc-msg-body">


                                <div class="col-md-12 text-center">
                                    <?php if ($code == 1) { ?>
                                    <i class="fa fa-check fc-msg-icon font-green-sharp"></i>
                                    <?php } else if ($code == 2) { ?>
                                    <i class="fa fa-info fc-msg-icon"></i>
                                    <?php } else { ?>
                                    <i class="fa fa-close fc-msg-icon"></i>
                                    <?php } ?>
                                    <label class="fc-msg-info">
                                        <label class="fc-msg-title"><?php echo $msg; ?></label>
                                        <p class="fc-msg-url">
                                        <?php if ($url) { ?>
                                        <a href="<?php echo $url; ?>">如果您的浏览器没有自动跳转，请点击这里</a>
                                        <meta http-equiv="refresh" content="<?php echo $time; ?>; url=<?php echo $url; ?>">
                                        <?php } else { ?>
                                        <a href="<?php echo $backurl; ?>" >[点击返回上一页]</a>
                                        <?php } ?>
                                        </p>
                                    </label>
                                </div>


                                <div class="col-md-6 text-right">

                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>