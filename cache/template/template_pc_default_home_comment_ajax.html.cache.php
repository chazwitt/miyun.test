<!--评论主体-->
<link rel="stylesheet" type="text/css" href="<?php echo THEME_PATH; ?>assets/comment/css/embed.css" />
<script type="text/javascript">
    var comment_url = '<?php echo $post_url; ?>';
    function dr_todo_ajax() {
        <?php echo $js; ?>(0, 1);
    }
</script>
<script type="text/javascript" src="<?php echo THEME_PATH; ?>assets/comment/embed.js"></script>
<div id="ds-reset">
    <div class="ds-replybox" id="dr_post_form">
        <form class="ds_form_post form" method="post" id="myform">
            <?php echo dr_form_hidden();  if ($myfield) { ?>
            <div class="ds-myfield form-horizontal">
                <div class="form-body">
                    <?php echo $myfield; ?>
                </div>
            </div>
            <?php }  if ($review) { ?>
            <style>
                .ds-avatar-top { margin-top: 10px; }
            </style>
            <div class="ds-review" id="dr_review_post">
                <ul>
                    <?php if (is_array($review['option'])) { $key_name=-1;$count_name=dr_count($review['option']);foreach ($review['option'] as $i=>$name) { $key_name++; ?>
                    <li>
                        <input id="dr_review_option_<?php echo $i; ?>" type="hidden" name="review[<?php echo $i; ?>]" value="0">
                        <span class="opname"><?php echo $name; ?>：</span>
                        <span class="commstar">
                            <?php if (is_array($review['value'])) { $key_v=-1;$count_v=dr_count($review['value']);foreach ($review['value'] as $ii=>$v) { $key_v++; ?>
                            <a id="dr_review_value_<?php echo $i; ?>_<?php echo $ii; ?>" class="dr_review_value_<?php echo $i; ?> star<?php echo $ii; ?>" href="javascript:dr_review_value(<?php echo $i; ?>, <?php echo $ii; ?>);" title="<?php echo $v; ?>">&nbsp;</a>
                            <?php } } ?>
                        </span>
                    </li>
                    <?php } } ?>
                </ul>
            </div>
            <div class="ds-clear"></div>
            <?php } ?>

            <a class="ds-avatar ds-avatar-top" href="javascript:;">
                <img src="<?php echo dr_avatar($member['uid']); ?>">
            </a>

            <div class="ds-textarea-wrapper ds-rounded-top">
                <textarea class="J_CmFormField" name="content" placeholder="说点什么吧…"></textarea>
            </div>

            <div class="ds-post-toolbar">
                <div class="ds-post-options ds-gradient-bg"></div>
                <button class="ds-post-button" type="button" onclick="dr_post_comment()">评论</button>
                <div class="ds-toolbar-buttons">
                    <a class="ds-toolbar-button ds-add-emote" onclick="dr_show_bq()" title="插入表情"></a>
                </div>
            </div>

        </form>
    </div>

    <div class="ds-comments-info">
        <div class="ds-sort">
            <a class="ds-order-desc <?php if (!$type) { ?>ds-current<?php } ?>" href="javascript:<?php echo $js; ?>(0, 1);">
                最新
            </a>
            <a class="ds-order-asc <?php if ($type==1) { ?>ds-current<?php } ?>" href="javascript:<?php echo $js; ?>(1, 1);">
                最早
            </a>
            <a class="ds-order-hot <?php if ($type==2) { ?>ds-current<?php } ?>" href="javascript:<?php echo $js; ?>(2, 1);">
                最热
            </a>
            <a class="ds-order-hot <?php if ($type==3) { ?>ds-current<?php } ?>" href="javascript:<?php echo $js; ?>(3, 1);">
                评分最高
            </a>
        </div>
        <span class="ds-comment-count">
            <a class="ds-comments-tab-duoshuo ds-current" href="javascript:void(0);">
                <span class="ds-highlight"><?php echo $commnets; ?></span>条评论
            </a>
        </span>
    </div>

    <ul id="dr_comment_list" class="ds-comments">

        <?php if (is_array($list)) { $key_t=-1;$count_t=dr_count($list);foreach ($list as $t) { $key_t++; ?>
        <li class="ds-post">
            <div class="ds-post-self">
                <div class="ds-avatar">
                    <a rel="nofollow author" href="javascript:;;">
                        <img src="<?php echo dr_avatar($t['uid']); ?>" >
                    </a>
                </div>
                <div class="ds-comment-body">
                    <div class="ds-comment-header">
                        <a class="ds-user-name ds-highlight" href="javascript:;;">
                            <?php echo $t['author']; ?>
                        </a>
                    </div>
                    <p>
                        <?php echo dr_replace_emotion($t['content']); ?>
                    </p>
                    <div class="ds-comment-footer ds-comment-actions">
                        <span class="ds-time">
                            <?php echo dr_fdate($t['inputtime']); ?>
                        </span>
                        <?php if (dr_comment_is_reply($is_reply, $member, $t['uid'])) { ?>
                        <a class="ds-post-reply" href="javascript:void(0);" onclick="dr_reply_show(<?php echo $t['id']; ?>, '<?php echo $t['author']; ?>', <?php echo $t['id']; ?>)">
                            <span class="ds-ui-icon"></span>
                            回复(<?php echo count($t['rlist']); ?>)
                        </a>
                        <?php } ?>
                        <a class="ds-post-likes" href="javascript:void(0);" onclick="dr_zc_comment(<?php echo $t['id']; ?>)">
                            <span class="ds-ui-icon"></span>
                            支持(<span id="dr_comment_zc_<?php echo $t['id']; ?>"><?php echo $t['support']; ?></span>)
                        </a>
                        <a class="ds-post-report" href="javascript:void(0);" onclick="dr_fd_comment(<?php echo $t['id']; ?>)">
                            <span class="ds-ui-icon"></span>
                            反对(<span id="dr_comment_fd_<?php echo $t['id']; ?>"><?php echo $t['oppose']; ?></span>)
                        </a>
                        <?php if ($member['adminid']) { ?>
                        <a class="ds-post-delete" href="javascript:void(0);" onclick="dr_delete_comment(<?php echo $t['id']; ?>)">
                            <span class="ds-ui-icon"></span>
                            删除
                        </a>
                        <?php } ?>
                        <a href="javascript:void(0);" style="float: right">评分：<?php echo number_format($t['avgsort'], $review['point']); ?>分</a>
                    </div>
                    <div class="ds-replybox ds-replybox2 ds-inline-replybox " id="dr_reply_<?php echo $t['id']; ?>" style="display:none;">
                    </div>
                </div>
            </div>
        </li>
        <?php if ($t['rlist']) { ?>
        <ul class="ds-children">
            <?php if (is_array($t['rlist'])) { $key_r=-1;$count_r=dr_count($t['rlist']);foreach ($t['rlist'] as $r) { $key_r++; ?>
            <li class="ds-post">
                <div class="ds-post-self">
                    <div class="ds-avatar">
                        <a rel="nofollow author" href="javascript:;;" title="">
                            <img src="<?php echo dr_avatar($r['uid']); ?>" >
                        </a>
                    </div>
                    <div class="ds-comment-body">
                        <div class="ds-comment-header">
                            <a class="ds-user-name ds-highlight" data-qqt-account="" href="javascript:;;"
                               rel="nofollow" data-userid="0">
                                <?php echo $r['author']; ?>
                            </a>
                        </div>
                        <p>
                            <?php echo dr_replace_emotion($r['content']); ?>
                        </p>
                        <div class="ds-comment-footer ds-comment-actions">
                            <span class="ds-time">
                            <?php echo dr_fdate($r['inputtime']); ?>
                            </span>
                            <?php if (dr_comment_is_reply($is_reply, $member, $r['uid'])) { ?>
                            <a class="ds-post-reply" href="javascript:void(0);" onclick="dr_reply_show(<?php echo $r['id']; ?>, '<?php echo $r['author']; ?>', <?php echo $t['id']; ?>)">
                                <span class="ds-ui-icon"></span>
                                回复
                            </a>
                            <?php } ?>
                            <a class="ds-post-likes" href="javascript:void(0);" onclick="dr_zc_comment(<?php echo $r['id']; ?>)">
                                <span class="ds-ui-icon"></span>
                                支持(<span id="dr_comment_zc_<?php echo $r['id']; ?>"><?php echo $r['support']; ?></span>)
                            </a>
                            <a class="ds-post-report" href="javascript:void(0);" onclick="dr_fd_comment(<?php echo $r['id']; ?>)">
                                <span class="ds-ui-icon"></span>
                                反对(<span id="dr_comment_fd_<?php echo $r['id']; ?>"><?php echo $r['oppose']; ?></span>)
                            </a>
                            <?php if ($member['adminid']) { ?>
                            <a class="ds-post-delete" href="javascript:void(0);" onclick="dr_delete_comment(<?php echo $r['id']; ?>)">
                                <span class="ds-ui-icon"></span>
                                删除
                            </a>
                            <?php } ?>
                        </div>
                        <div class="ds-replybox ds-replybox2 ds-inline-replybox" id="dr_reply_<?php echo $r['id']; ?>">
                        </div>
                    </div>
                </div>
            </li>
            <?php } } ?>
        </ul>
        <?php }  } } ?>
    </ul>

    <div class="ds-paginator">
        <div class="ds-border"> </div>
        <?php echo $ajax_pages; ?>
    </div>


    <a name="respond"></a>
    <div id="ds-smilies-tooltip" style="width: <?php if (\Phpcmf\Service::IS_PC()) { ?>370<?php } else { ?>200<?php } ?>px;display: none;">
        <div class="ds-smilies-container">
            <ul>
                <?php if (is_array($emotion)) { $key_file=-1;$count_file=dr_count($emotion);foreach ($emotion as $name=>$file) { $key_file++; ?>
                <li>
                    <img src="<?php echo $file; ?>" alt="[<?php echo $name; ?>]" title="[<?php echo $name; ?>]">
                </li>
                <?php } } ?>
            </ul>
        </div>
        <div id="ds-foot5">
            &nbsp;&nbsp;&nbsp;
        </div>
    </div>
</div>