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
                        <span>404</span>
                    </li>
                </ul>

                <div class="search-page">

                    <div class="portlet light ">
                        <div class="portlet-title">
                            <div class="caption">
                                <span class="caption-subject font-green-sharp"> 404错误 </span>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row fc-msg-body">
                                <div class="col-md-12 text-center">
                                    <i class="fa fa-ban fc-search-null-icon"></i>
                                    <label class="fc-404-title"><?php echo $msg; ?></label>
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