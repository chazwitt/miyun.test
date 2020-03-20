<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>

<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <div class="page-head">
            <div class="container">
                <div class="page-title">
                   这里是<?php echo MODULE_NAME; ?>模块栏目封面页
                </div>
            </div>
        </div>
        <div class="page-content">

            <div class="container">

                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="<?php echo SITE_URL; ?>">网站首页</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <?php if (!IS_SHARE) { ?>
                    <li>
                        <a href="<?php echo MODULE_URL; ?>"><?php echo MODULE_NAME; ?></a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <?php }  echo dr_catpos($catid, '', true, '<li> <a href="[url]">[name]</a> <i class="fa fa-circle"></i> </li>'); ?>
                    <li>
                        <span>封面</span>
                    </li>
                </ul>

                <!--循环输出顶级栏目下面的子栏目及其内容，运用到了双list循环标签因此需要定义返回值return=c（都懂得）-->
                <?php $list_return_c = $this->list_tag("action=category pid=$catid  return=c"); if ($list_return_c) extract($list_return_c, EXTR_OVERWRITE); $count_c=dr_count($return_c); if (is_array($return_c)) { foreach ($return_c as $key_c=>$c) {  $is_first=$key_c==0 ? 1 : 0;$is_last=$count_c==$key_c+1 ? 1 : 0; ?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="portlet light">
                            <div class="portlet-title">
                                <div class="caption">
                                    <span class="caption-subject bold uppercase"><a class=" font-green" href="<?php echo $c['url']; ?>"><?php echo $c['name']; ?></a></span>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-lg-7">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <ul class="list-unstyled fc-list-row">
                                                    <!-- 调用MOD_DIR模块的指定栏目下的最新的数据,9条 -->
                                                    <?php $list_return = $this->list_tag("action=module module=MOD_DIR catid=$c[id] order=updatetime num=9"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=dr_count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                                    <li><span class="badge badge-empty badge-success"></span> <a href="<?php echo $t['url']; ?>" class="title"><?php echo dr_strcut($t['title'], 18); ?></a></li>
                                                    <?php } } ?>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <ul class="list-unstyled fc-list-row">
                                                    <!-- 调用MOD_DIR模块的指定栏目下的最新的数据,从第9条开始,显示9条数据 -->
                                                    <?php $list_return = $this->list_tag("action=module module=MOD_DIR catid=$c[id] order=updatetime num=9,9"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=dr_count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                                    <li><span class="badge badge-empty badge-success"></span> <a href="<?php echo $t['url']; ?>" class="title"><?php echo dr_strcut($t['title'], 18); ?></a></li>
                                                    <?php } } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="row">
                                            <!-- 调用MOD_DIR模块的指定栏目下带“图片”的数据 -->
                                            <?php $list_return = $this->list_tag("action=module module=MOD_DIR thumb=1 catid=$c[id] order=updatetime num=6"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=dr_count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                            <div class="col-sm-4">
                                                <div class="tile-container">
                                                    <div class="tile-thumbnail">
                                                        <a href="javascript:;">
                                                            <a href="<?php echo $t['url']; ?>" ><img src="<?php echo dr_thumb($t['thumb'], 120, 75); ?>" width="120" height="75"></a>
                                                        </a>
                                                    </div>
                                                    <div class="tile-title">
                                                        <h5><a href="<?php echo $t['url']; ?>" class="title"><?php echo dr_strcut($t['title'], 7); ?></a></h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php } } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } } ?>


            </div>

        </div>
    </div>
</div>

<?php if ($fn_include = $this->_include("footer.html")) include($fn_include); ?>