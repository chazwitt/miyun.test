<?php if ($fn_include = $this->_include("header.html")) include($fn_include); ?>

<div class="page-wrapper-row full-height">
    <div class="page-wrapper-middle">
        <div class="page-head">
            <div class="container">
                <div class="page-title">
                   这里是<?php echo MODULE_NAME; ?>模块栏目内容页
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
                        <span><?php echo $title; ?></span>
                    </li>
                </ul>

                <div class="search-page search-content-2">
                    <div class="row">
                        <div class="col-md-8">

                            <div class="portlet light">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject font-dark  "><?php echo $title; ?></span>
                                    </div>
                                    <div class="actions">
                                        <a class="btn btn-circle btn-icon-only btn-default fullscreen" href="javascript:;" data-original-title="" title="全屏查看"> </a>
                                    </div>
                                </div>
                                <div class="search-post-foot fc-content-tool">
                                    <div class="search-post-meta">
                                        <i class="fa fa-user font-blue"></i>
                                        <a href="javascript:;"><?php echo $author; ?></a>
                                    </div>
                                    <div class="search-post-meta">
                                        <i class="fa fa-calendar font-blue"></i>
                                        <a href="javascript:;"><?php echo $updatetime; ?></a>
                                    </div>
                                    <div class="search-post-meta">
                                        <i class="fa fa-eye font-blue"></i>
                                        <a href="javascript:;"><?php echo dr_show_hits($id); ?>次</a>
                                    </div>
                                    <div class="search-post-meta">
                                        <i class="fa fa-comments font-blue"></i>
                                        <a href="<?php echo \Phpcmf\Service::L('Router')->comment_url($id); ?>"><?php echo $comments; ?></a>
                                    </div>
                                </div>
                                <div class="portlet-body" style="height: auto;overflow: hidden;">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo $content; ?>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="blog-single-foot fc-news-tag-list">
                                                <ul class="blog-post-tags">
                                                    <?php if (is_array($tags)) { $key_url=-1;$count_url=dr_count($tags);foreach ($tags as $name=>$url) { $key_url++; ?>
                                                    <li class="uppercase">
                                                        <a href="<?php echo $url; ?>" target="_blank"><?php echo $name; ?></a>
                                                    </li>
                                                    <?php } } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row fc-show-total">
                                        <div class="col-md-12 text-center">
                                            <a href="javascript:dr_module_favorite('<?php echo MOD_DIR; ?>', '<?php echo $id; ?>');" class="icon-btn">
                                                <i class="fa fa-star"></i>
                                                <div> 收藏 </div>
                                                <span class="badge badge-danger" id="module_favorite_<?php echo $id; ?>"> <?php echo intval($favorites); ?> </span>
                                            </a>
                                            <a href="javascript:dr_module_digg('<?php echo MOD_DIR; ?>', '<?php echo $id; ?>', 1);" class="icon-btn">
                                                <i class="fa fa-thumbs-o-up"></i>
                                                <div> 有帮助 </div>
                                                <span class="badge badge-danger" id="module_digg_<?php echo $id; ?>_1"> <?php echo intval($support); ?> </span>
                                            </a>
                                            <a href="javascript:dr_module_digg('<?php echo MOD_DIR; ?>', '<?php echo $id; ?>', 0);" class="icon-btn">
                                                <i class="fa fa-thumbs-o-down"></i>
                                                <div> 没帮助 </div>
                                                <span class="badge badge-danger" id="module_digg_<?php echo $id; ?>_0"> <?php echo intval($oppose); ?> </span>
                                            </a>
                                            <?php if (dr_is_app('shang')) { ?>
                                            <a href="<?php echo \Phpcmf\Service::L('Router')->donation_url($id); ?>" class="icon-btn">
                                                <i class="fa fa-rmb"></i>
                                                <div> 打赏 </div>
                                                <span class="badge badge-danger"> <?php echo floatval($donation); ?> </span>
                                            </a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="blog-single-foot">
                                    <p class="fc-show-prev-next">
                                        <strong>上一篇：</strong><?php if ($prev_page) { ?><a href="<?php echo $prev_page['url']; ?>"><?php echo $prev_page['title']; ?></a><?php } else { ?>没有了<?php } ?><br>
                                    </p>
                                    <p class="fc-show-prev-next">
                                        <strong>下一篇：</strong><?php if ($next_page) { ?><a href="<?php echo $next_page['url']; ?>"><?php echo $next_page['title']; ?></a><?php } else { ?>没有了<?php } ?>
                                    </p>
                                </div>

                                <!--调用ajax评论-->
                                <?php if (IS_COMMENT) {  echo dr_module_comment(MOD_DIR, $id);  } ?>
                            </div>


                        </div>
                        <div class="col-md-4">
                            <!-- BEGIN PORTLET-->
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject font-dark bold uppercase">栏目索引</span>
                                    </div>

                                </div>
                                <div class="portlet-body">
                                    <div class="todo-project-list">
                                        <ul class="nav nav-stacked">
                                            <!--循环输出当前栏目的同级栏目，定义返回值return=c-->
                                            <?php $a = array('badge-info', 'badge-success', 'badge-default', 'badge-danger'); ?>
                                            <?php $list_return_c = $this->list_tag("action=category module=MOD_DIR pid=$cat[pid]  return=c"); if ($list_return_c) extract($list_return_c, EXTR_OVERWRITE); $count_c=dr_count($return_c); if (is_array($return_c)) { foreach ($return_c as $key_c=>$c) {  $is_first=$key_c==0 ? 1 : 0;$is_last=$count_c==$key_c+1 ? 1 : 0; ?>
                                            <li <?php if ($c['id']==$catid) { ?> class="active"<?php } ?>><a href="<?php echo $c['url']; ?>"><span class="badge <?php echo $a[array_rand($a)]; ?>"> <?php echo $c['total']; ?> </span><?php echo $c['name']; ?></a></li>
                                            <?php } } ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet light ">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <span class="caption-subject font-dark bold uppercase">相关内容</span>
                                    </div>

                                </div>
                                <div class="portlet-body">
                                    <div class="todo-project-list">
                                        <ul class="nav nav-stacked">
                                            <!--此标签用于调用相关文章，tag=关键词1,关键词2，多个关键词,分隔，num=显示条数，field=显示字段-->
                                            <?php $list_return = $this->list_tag("action=related module=MOD_DIR tag=$tag num=5"); if ($list_return) extract($list_return, EXTR_OVERWRITE); $count=dr_count($return); if (is_array($return)) { foreach ($return as $key=>$t) { $is_first=$key==0 ? 1 : 0;$is_last=$count==$key+1 ? 1 : 0; ?>
                                            <li>
                                                <a href="<?php echo $t['url']; ?>" title="<?php echo $t['title']; ?>">
                                                <span class="badge fc-icon-left <?php echo $a[array_rand($a)]; ?>"> <?php echo $key+1; ?> </span>
                                                <?php echo dr_strcut($t['title'], 20); ?></a>
                                            </li>
                                            <?php } } ?>
                                        </ul>
                                    </div>
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