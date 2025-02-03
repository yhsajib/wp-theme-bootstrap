<?php
if (!class_exists('yhsshu_Blog')) {
    class yhsshu_Blog
    {
        public function get_post_feature()
        {
            if (!has_post_thumbnail()) return;
            $post_feature_image_type = yhsshu()->get_theme_opt('post_feature_image_type', 'cropped');

            if ($post_feature_image_type == 'full') {
                $thumbnail_size = 'full';
            } else {
                $thumbnail_size = yhsshu_configs('custom_sizes')['size-post-single'];
            }
            the_post_thumbnail($thumbnail_size);
        }

        public function get_archive_meta($post_id = 0)
        {
            $archive_category = yhsshu()->get_theme_opt('archive_category', true);
            $post_comments_on = yhsshu()->get_theme_opt('post_comments_on', true);
            $archive_author = yhsshu()->get_theme_opt('archive_author', true);
            $archive_date = yhsshu()->get_theme_opt( 'archive_date', true );
            
            if ($archive_author || $archive_category || $post_comments_on) : ?>
                <div class="post-metas">
                    <div class="meta-inner d-flex align-items-center">
                        <?php if ($archive_author) : ?>
                            <span class="post-author col-auto d-flex"><span><?php echo esc_html__('Written by', 'yhsshu'); ?> <?php the_author_posts_link(); ?></span></span>
                        <?php endif; ?>
                        <?php if ($archive_category && has_category('', $post_id)) : ?>
                            <span class="post-category col-auto d-flex">
                                <span>
                                    <?php the_terms($post_id, 'category', '', ', ', ''); ?>
                                </span>
                            </span>
                        <?php endif; ?>
                        <?php if ($archive_date) : ?>
                            <div class="post-date">
                                <?php echo get_the_date($post_id); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        }

        public function get_archive_meta_luxury($post_id = 0)
        {
            $archive_category = yhsshu()->get_theme_opt('archive_category', true);
            $post_comments_on = yhsshu()->get_theme_opt('post_comments_on', true);
            $archive_author = yhsshu()->get_theme_opt('archive_author', true);
            $archive_date = yhsshu()->get_theme_opt('archive_date', true );
            $archive_tag = yhsshu()->get_theme_opt('archive_tag', false );

            if ($archive_author || $archive_category || $post_comments_on) : ?>
                <div class="post-metas">
                    <div class="meta-inner d-flex align-items-center">
                        <div class="author-date-wrapper d-flex">
                            <?php if ($archive_author) : ?>
                                <span class="post-author col-auto d-flex">
                                    <span><?php echo esc_html__('Written by', 'yhsshu'); ?> <?php the_author_posts_link(); ?></span>
                                </span>
                            <?php endif; ?>
                            <?php if ($archive_date && $archive_author) : ?>
                                <span><?php echo '&nbsp;-&nbsp;'; ?></span>
                            <?php endif ?>
                            <?php if ($archive_date) : ?>
                                <span class="post-date">
                                    <?php echo get_the_date($post_id) . esc_html(' at ', 'yhsshu') . get_the_time($post_id); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <?php if ($archive_category && has_category('', $post_id)) : ?>
                            <span class="post-category col-auto d-flex">
                                <span>
                                    <?php the_terms($post_id, 'category', '', ', ', ''); ?>
                                </span>
                            </span>
                        <?php endif; ?>
                        <?php
                        $posttags = get_the_tags($post_id);
                        if ($archive_tag && $posttags) : ?>
                            <span class="post-tags">
                                <span class="label"><?php echo esc_html('Tags: ', 'yhsshu'); ?></span>
                                <?php if ($posttags) {
                                    $last_key = array_key_last($posttags);
                                    foreach ($posttags as $key => $tag) {
                                        echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                        if ($key != $last_key) {
                                            echo ', ';
                                        }
                                    }
                                }; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        }

        public function get_archive_metas_pizza($post_id = 0)
        {
            $post_author_on = yhsshu()->get_theme_opt('post_author_on', true);
            $post_date_on = yhsshu()->get_theme_opt('post_date_on', true);
            $post_comments_on = yhsshu()->get_theme_opt('post_comments_on', true);
            $post_categories_on = yhsshu()->get_theme_opt('post_categories_on', true);
            $post_tags_on = yhsshu()->get_theme_opt('post_tag', false);
            
            if ($post_author_on || $post_date_on || $post_categories_on || $post_comments_on) : ?>
                <div class="post-metas">
                    <div class="meta-inner d-flex">
                        <?php if ($post_date_on) : ?>
                            <div class="post-date d-flex align-items-center">
                                <i class="yhsshui yhsshui-calendar-minus"></i>
                                <span><?php echo get_the_date($post_id); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_author_on) : ?>
                            <div class="post-author d-flex align-items-center">
                                <i class="yhsshui yhsshui-user"></i>
                                <span><?php echo esc_html__('By', 'yhsshu'); ?> <?php the_author_posts_link(); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_categories_on && has_category()) : ?>
                            <div class="post-category d-flex align-items-center">
                                <i class="yhsshui yhsshui-folder1"></i>
                                <span><?php the_terms($post_id, 'category', '', ', '); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php
                        $posttags = get_the_tags($post_id);
                        if ($post_tags_on && $posttags) : ?>
                            <div class="post-tags d-flex align-items-center">
                                <i class="yhsshui yhsshui-tag1"></i>
                                <?php if ($posttags) {
                                    $last_key = array_key_last($posttags);
                                    foreach ($posttags as $key => $tag) {
                                        echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                        if ($key != $last_key) {
                                            echo ', ';
                                        }
                                    }
                                }; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        }

        public function get_archive_metas_fastfood($post_id = 0)
        {
            $post_author_on = yhsshu()->get_theme_opt('post_author_on', true);
            $post_date_on = yhsshu()->get_theme_opt('post_date_on', true);
            $post_comments_on = yhsshu()->get_theme_opt('post_comments_on', true);
            $post_categories_on = yhsshu()->get_theme_opt('post_categories_on', true);
            $post_tags_on = yhsshu()->get_theme_opt('post_tag', false);
            
            if ($post_author_on || $post_date_on || $post_categories_on || $post_comments_on) : ?>
                <div class="post-metas">
                    <div class="meta-inner d-flex">
                        <?php if ($post_date_on) : ?>
                            <div class="post-date d-flex align-items-center">
                                <i class="yhsshui yhsshui-calendar-days"></i>
                                <span><?php echo get_the_date($post_id); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php
                        $posttags = get_the_tags($post_id);
                        if ($post_tags_on && $posttags) : ?>
                            <div class="post-tags d-flex align-items-center">
                                <i class="yhsshui yhsshui-tag1"></i>
                                <?php if ($posttags) {
                                    $last_key = array_key_last($posttags);
                                    foreach ($posttags as $key => $tag) {
                                        echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                        if ($key != $last_key) {
                                            echo ', ';
                                        }
                                    }
                                }; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_categories_on && has_category()) : ?>
                            <div class="post-category d-flex align-items-center">
                                <i class="yhsshui yhsshui-folder1"></i>
                                <span><?php the_terms($post_id, 'category', '', ', '); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_author_on) : ?>
                            <div class="post-author d-flex align-items-center">
                                <i class="yhsshui yhsshui-user"></i>
                                <span><?php echo esc_html__('By', 'yhsshu'); ?> <?php the_author_posts_link(); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        }

        public function get_excerpt($length = 25)
        {
            $yhsshu_the_excerpt = get_the_excerpt();
            if (!empty($yhsshu_the_excerpt)) {
                echo esc_html(wp_trim_words($yhsshu_the_excerpt, $length));
            } else {
                echo wp_kses_post($this->get_excerpt_more($length));
            }
        }

        public function get_excerpt_more($length = 25, $post = null)
        {
            $post = get_post($post);

            if (empty($post) || 0 >= $length) {
                return '';
            }

            if (post_password_required($post)) {
                return esc_html__('Post password required.', 'yhsshu');
            }

            $content = apply_filters('the_content', strip_shortcodes($post->post_content));
            $content = str_replace(']]>', ']]&gt;', $content);

            $excerpt_more = apply_filters('yhsshu_excerpt_more', '&hellip;');
            $excerpt      = wp_trim_words($content, $length, $excerpt_more);
            return $excerpt;
        }

        public function get_post_metas()
        {
            $post_author_on = yhsshu()->get_theme_opt('post_author_on', true);
            $post_date_on = yhsshu()->get_theme_opt('post_date_on', true);
            $post_comments_on = yhsshu()->get_theme_opt('post_comments_on', true);
            $post_categories_on = yhsshu()->get_theme_opt('post_categories_on', true);
            $post_tags_on = yhsshu()->get_theme_opt('post_tag', false);
            
            if ($post_author_on || $post_date_on || $post_categories_on || $post_comments_on) : ?>
                <div class="post-metas">
                    <div class="meta-inner d-flex align-items-center">
                        <?php if ($post_author_on) : ?>
                            <span class="post-author d-flex align-items-center">
                                <span><?php echo esc_html__('Written By', 'yhsshu'); ?>&nbsp;<?php the_author_posts_link(); ?></span>
                            </span>
                        <?php endif; ?>
                        <?php if ($post_date_on) : ?>
                            <span class="post-date d-flex align-items-center">
                                <span>
                                    <?php echo get_the_date('', get_the_ID()); ?>
                                </span>
                            </span>
                        <?php endif; ?>
                        <?php if ($post_categories_on && has_category()) : ?>
                            <span class="post-category d-flex align-items-center">
                                <span><?php the_terms(get_the_ID(), 'category', '', ', '); ?></span>
                            </span>
                        <?php endif; ?>
                        <?php
                        $posttags = get_the_tags(get_the_ID());
                        if ($post_tags_on && $posttags) : ?>
                            <span class="post-tags">
                                <span class="label"><?php echo esc_html('Tags: ', 'yhsshu'); ?></span>
                                <?php if ($posttags) {
                                    $last_key = array_key_last($posttags);
                                    foreach ($posttags as $key => $tag) {
                                        echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                        if ($key != $last_key) {
                                            echo ', ';
                                        }
                                    }
                                }; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        }

        public function get_post_metas_luxury()
        {
            $post_author_on = yhsshu()->get_theme_opt('post_author_on', true);
            $post_date_on = yhsshu()->get_theme_opt('post_date_on', true);
            $post_comments_on = yhsshu()->get_theme_opt('post_comments_on', true);
            $post_categories_on = yhsshu()->get_theme_opt('post_categories_on', true);
            $post_tags_on = yhsshu()->get_theme_opt('post_tag', false);
            
            if ($post_author_on || $post_date_on || $post_categories_on || $post_comments_on) : ?>
                <div class="post-metas">
                    <div class="meta-inner d-flex align-items-center">
                        <div class="author-date-wrapper d-flex">
                            <?php if ($post_author_on) : ?>
                                <span class="post-author col-auto d-flex">
                                    <span><?php echo esc_html__('Written by', 'yhsshu'); ?> <?php the_author_posts_link(); ?></span>
                                </span>
                            <?php endif; ?>
                            <?php if ($post_date_on && $post_author_on) : ?>
                                <span><?php echo '&nbsp;-&nbsp;'; ?></span>
                            <?php endif ?>
                            <?php if ($post_date_on) : ?>
                                <span class="post-date">
                                    <?php echo get_the_date() . esc_html(' at ', 'yhsshu') . get_the_time(); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <?php if ($post_categories_on && has_category()) : ?>
                            <span class="post-category d-flex align-items-center">
                                <span><?php the_terms(get_the_ID(), 'category', '', ', '); ?></span>
                            </span>
                        <?php endif; ?>
                        <?php
                        $posttags = get_the_tags(get_the_ID());
                        if ($post_tags_on && $posttags) : ?>
                            <span class="post-tags">
                                <span class="label"><?php echo esc_html('Tags: ', 'yhsshu'); ?></span>
                                <?php if ($posttags) {
                                    $last_key = array_key_last($posttags);
                                    foreach ($posttags as $key => $tag) {
                                        echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                        if ($key != $last_key) {
                                            echo ', ';
                                        }
                                    }
                                }; ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        }

        public function get_post_metas_pizza()
        {
            $post_author_on = yhsshu()->get_theme_opt('post_author_on', true);
            $post_date_on = yhsshu()->get_theme_opt('post_date_on', true);
            $post_comments_on = yhsshu()->get_theme_opt('post_comments_on', true);
            $post_categories_on = yhsshu()->get_theme_opt('post_categories_on', true);
            $post_tags_on = yhsshu()->get_theme_opt('post_tag', false);
            
            if ($post_author_on || $post_date_on || $post_categories_on || $post_comments_on) : ?>
                <div class="post-metas">
                    <div class="meta-inner d-flex">
                        <?php if ($post_date_on) : ?>
                            <div class="post-date d-flex align-items-center">
                                <i class="yhsshui yhsshui-calendar-minus"></i>
                                <span><?php echo get_the_date(); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_author_on) : ?>
                            <div class="post-author d-flex align-items-center">
                                <i class="yhsshui yhsshui-user"></i>
                                <span><?php echo esc_html__('By', 'yhsshu'); ?> <?php the_author_posts_link(); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_categories_on && has_category()) : ?>
                            <div class="post-category d-flex align-items-center">
                                <i class="yhsshui yhsshui-folder1"></i>
                                <span><?php the_terms(get_the_ID(), 'category', '', ', '); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php
                        $posttags = get_the_tags(get_the_ID());
                        if ($post_tags_on && $posttags) : ?>
                            <div class="post-tags d-flex align-items-center">
                                <i class="yhsshui yhsshui-tag1"></i>
                                <?php if ($posttags) {
                                    $last_key = array_key_last($posttags);
                                    foreach ($posttags as $key => $tag) {
                                        echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                        if ($key != $last_key) {
                                            echo ', ';
                                        }
                                    }
                                }; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        }

        public function get_post_metas_fastfood()
        {
            $post_author_on = yhsshu()->get_theme_opt('post_author_on', true);
            $post_date_on = yhsshu()->get_theme_opt('post_date_on', true);
            $post_comments_on = yhsshu()->get_theme_opt('post_comments_on', true);
            $post_categories_on = yhsshu()->get_theme_opt('post_categories_on', true);
            $post_tags_on = yhsshu()->get_theme_opt('post_tag', false);
            
            if ($post_author_on || $post_date_on || $post_categories_on || $post_comments_on) : ?>
                <div class="post-metas hover-underline">
                    <div class="meta-inner d-flex">
                        <?php if ($post_date_on) : ?>
                            <div class="post-date d-flex align-items-center">
                                <i class="yhsshui yhsshui-calendar-days"></i>
                                <span><?php echo get_the_date(); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php
                        $posttags = get_the_tags(get_the_ID());
                        if ($post_tags_on && $posttags) : ?>
                            <div class="post-tags d-flex align-items-center">
                                <i class="yhsshui yhsshui-tag1"></i>
                                <?php
                                $last_key = array_key_last($posttags);
                                foreach ($posttags as $key => $tag) {
                                    echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                    if ($key != $last_key) {
                                        echo ', ';
                                    }
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_categories_on && has_category()) : ?>
                            <div class="post-category d-flex align-items-center">
                                <i class="yhsshui yhsshui-folder1"></i>
                                <span><?php the_terms(get_the_ID(), 'category', '', ', '); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_author_on) : ?>
                            <div class="post-author d-flex align-items-center">
                                <i class="yhsshui yhsshui-user"></i>
                                <span><?php echo esc_html__('By', 'yhsshu'); ?> <?php the_author_posts_link(); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        }

        public function get_post_metas_coffee()
        {
            $post_author_on = yhsshu()->get_theme_opt('post_author_on', true);
            $post_date_on = yhsshu()->get_theme_opt('post_date_on', true);
            $post_comments_on = yhsshu()->get_theme_opt('post_comments_on', true);
            $post_categories_on = yhsshu()->get_theme_opt('post_categories_on', true);
            $post_tags_on = yhsshu()->get_theme_opt('post_tag', false);
            
            if ($post_author_on || $post_date_on || $post_categories_on || $post_comments_on) : ?>
                <div class="post-metas hover-underline">
                    <div class="meta-inner d-flex justify-content-center">
                        <?php if ($post_author_on) : ?>
                            <div class="post-author d-flex align-items-center">
                                <i class="yhsshui yhsshui-user"></i>
                                <span><?php echo esc_html__('By', 'yhsshu'); ?> <?php the_author_posts_link(); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php
                        $posttags = get_the_tags(get_the_ID());
                        if ($post_tags_on && $posttags) : ?>
                            <div class="post-tags d-flex align-items-center">
                                <i class="yhsshui yhsshui-tag1"></i>
                                <?php
                                $last_key = array_key_last($posttags);
                                foreach ($posttags as $key => $tag) {
                                    echo '<a href="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</a>';
                                    if ($key != $last_key) {
                                        echo ', ';
                                    }
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_categories_on && has_category()) : ?>
                            <div class="post-category d-flex align-items-center">
                                <i class="yhsshui yhsshui-folder1"></i>
                                <span><?php the_terms(get_the_ID(), 'category', '', ', '); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_date_on) : ?>
                            <div class="post-date d-flex align-items-center">
                                <i class="yhsshui yhsshui-calendar3"></i>
                                <span><?php echo get_the_date(); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        }
        public function get_post_metas_creams()
        {
            $post_author_on = yhsshu()->get_theme_opt('post_author_on', true);
            $post_date_on = yhsshu()->get_theme_opt('post_date_on', true);
            $post_comments_on = yhsshu()->get_theme_opt('post_comments_on', true);
            $post_categories_on = yhsshu()->get_theme_opt('post_categories_on', true);

            if ($post_author_on || $post_date_on || $post_categories_on || $post_comments_on) : ?>
                <div class="post-metas hover-underline">
                    <div class="meta-inner d-flex">
                        <?php if ($post_author_on) : ?>
                            <div class="post-author d-flex align-items-center">
                                <span><?php echo esc_html__('By', 'yhsshu'); ?> <?php the_author_posts_link(); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_categories_on && has_category()) : ?>
                            <div class="post-category d-flex align-items-center">
                                <i class="yhsshui yhsshui-ice-cream"></i>
                                <span><?php the_terms(get_the_ID(), 'category', '', ', '); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_date_on) : ?>
                            <div class="post-date d-flex align-items-center">
                                <i class="yhsshui yhsshui-ice-cream"></i>
                                <span><?php echo get_the_date('j, M Y'); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        }
        public function get_post_metas_sushi()
        {
            $post_author_on = yhsshu()->get_theme_opt('post_author_on', true);
            $post_date_on = yhsshu()->get_theme_opt('post_date_on', true);
            $post_comments_on = yhsshu()->get_theme_opt('post_comments_on', true);
            $post_categories_on = yhsshu()->get_theme_opt('post_categories_on', true);
            $post_tags_on = yhsshu()->get_theme_opt('post_tag', false);

            if ($post_author_on || $post_date_on || $post_categories_on || $post_comments_on) : ?>
                <div class="post-metas hover-underline">
                    <div class="meta-inner d-flex">
                        <?php if ($post_author_on) : ?>
                            <div class="post-author d-flex align-items-center">
                                <i class="yhsshui yhsshui-user"></i>
                                <span><?php echo esc_html__('By', 'yhsshu'); ?> <?php the_author_posts_link(); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_categories_on && has_category()) : ?>
                            <div class="post-category d-flex align-items-center">
                                <i class="yhsshui yhsshui-tag1"></i>
                                <span><?php the_terms(get_the_ID(), 'category', '', ', '); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if ($post_date_on) : ?>
                            <div class="post-date d-flex align-items-center">
                                <i class="yhsshui yhsshui-calendar3"></i>
                                <span><?php echo get_the_date('j M, Y'); ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif;
        }
        public function get_post_tags()
        {
            $post_tag = yhsshu()->get_theme_opt('post_tag', true);
            if ($post_tag != '1') return;
            $tags_list = get_the_tag_list('<span class="label">' . esc_attr__('Tags:', 'yhsshu') . '</span>', ' ');
            if ($tags_list) {
                echo '<div class="post-tags d-flex">';
                printf('%2$s', '', $tags_list);
                echo '</div>';
            }
        }

        public function get_post_share($post_id = 0)
        {
            $post_social_share = yhsshu()->get_theme_opt('post_social_share', false);
            $share_icons = yhsshu()->get_theme_opt('post_social_share_icon', []);
            $count = get_post_meta($post_id, 'post_share_count', true);
            $count_number = $count ? ' ' . yhsshu_convert_post_count($count) : '';
            if ($post_social_share != '1') return;
            $post = get_post($post_id);
            ?>
            <div class="post-shares d-flex align-items-center">
                <span class="label"><?php echo esc_html__('Share', 'yhsshu') . $count_number .':'; ?></span>
                <div class="social-share">
                    <div class="d-flex">
                        <?php if (in_array('facebook', $share_icons)) : ?>
                            <div class="social-item">
                                <a class="yhsshu-icon icon-facebook yhsshui-facebook-f" title="<?php echo esc_attr__('Facebook', 'yhsshu'); ?>" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_the_permalink($post_id)); ?>"></a>
                            </div>
                        <?php endif; ?>
                        <?php if (in_array('twitter', $share_icons)) : ?>
                            <div class="social-item">
                                <a class="yhsshu-icon icon-twitter yhsshui-twitter" title="<?php echo esc_attr__('Twitter', 'yhsshu'); ?>" target="_blank" href="https://twitter.com/intent/tweet?original_referer=<?php echo urldecode(home_url('/')); ?>&url=<?php echo urlencode(get_the_permalink($post_id)); ?>&text=<?php the_title(); ?>%20"></a>
                            </div>
                        <?php endif; ?>
                        <?php if (in_array('linkedin', $share_icons)) : ?>
                            <div class="social-item">
                                <a class="yhsshu-icon icon-linkedin yhsshui-linkedin-in" title="<?php echo esc_attr__('Linkedin', 'yhsshu'); ?>" target="_blank" href="https://www.linkedin.com/cws/share?url=<?php echo urlencode(get_the_permalink($post_id)); ?>"></a>
                            </div>
                        <?php endif; ?>
                        <?php if (in_array('pinterest', $share_icons)) : ?>
                            <div class="social-item">
                                <a class="yhsshu-icon icon-pinterest yhsshui-pinterest-p" title="<?php echo esc_attr__('Pinterest', 'yhsshu'); ?>" target="_blank" href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode(get_the_post_thumbnail_url($post_id, 'full')); ?>&media=&description=<?php echo urlencode(the_title_attribute(array('echo' => false, 'post' => $post))); ?>"></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        }

        public function get_post_nav()
        {
            $post_navigation = yhsshu()->get_theme_opt('post_navigation', false);
            if ($post_navigation != '1') return;
            global $post;

            $previous = (is_attachment()) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
            $next     = get_adjacent_post(false, '', false);

            if (!$next && !$previous)
                return;
        ?>
            <?php
            $next_post = get_next_post();
            $previous_post = get_previous_post();
            if (empty($previous_post) && empty($next_post)) return;
            ?>
            <div class="single-next-prev-nav row gx-0 justify-content-between align-items-center">
                <?php if (!empty($previous_post)) :
                    $prev_img_id = get_post_thumbnail_id($previous_post->ID);
                    $prev_img_url = wp_get_attachment_image_src($prev_img_id, 'thumbnail');

                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $prev_img_id,
                        'thumb_size' => '108x108',
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                ?>
                    <div class="nav-next-prev prev col relative text-start">
                        <div class="nav-inner">
                            <?php if ($thumbnail) : ?>
                                <div class="col-auto">
                                    <div class="col-auto nav-img"><?php echo wp_kses_post( $thumbnail ) ?></div>
                                </div>
                            <?php endif; ?>
                            <div class="col">
                                <?php previous_post_link('%link', ''); ?>
                                <div class="nav-label-wrap d-flex align-items-center">
                                    <span class="nav-label"><?php echo esc_html__('Previous', 'yhsshu'); ?></span>
                                </div>
                                <div class="nav-title-wrap d-flex align-items-center d-none d-sm-flex">
                                    <div class="nav-title"><?php echo get_the_title($previous_post->ID); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="grid-archive">
                    <a href="<?php echo get_post_type_archive_link('post'); ?>">
                        <div class="nav-archive-button">
                            <div class="archive-btn-square square-1"></div>
                            <div class="archive-btn-square square-2"></div>
                            <div class="archive-btn-square square-3"></div>
                            <div class="archive-btn-square square-4"></div>
                        </div>
                    </a>
                </div>
                <?php if (!empty($next_post)) :
                    $next_img_id = get_post_thumbnail_id($next_post->ID);
                    $next_img_url = wp_get_attachment_image_src($next_img_id, 'thumbnail');

                    $img = yhsshu_get_image_by_size(array(
                        'attach_id'  => $next_img_id,
                        'thumb_size' => '108x108',
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                ?>
                    <div class="nav-next-prev next col relative text-end">
                        <div class="nav-inner">
                            <div class="col">
                                <?php next_post_link('%link', ''); ?>
                                <div class="nav-label-wrap d-flex align-items-center justify-content-end">
                                    <span class="nav-label"><?php echo esc_html__('Next', 'yhsshu'); ?></span>
                                </div>
                                <div class="nav-title-wrap d-flex align-items-center d-none d-sm-flex">
                                    <span class="nav-title"><?php echo get_the_title($next_post->ID); ?></span>
                                </div>
                            </div>
                            <?php if ($thumbnail) : ?>
                                <div class="col-auto">
                                    <div class="col-auto nav-img"><?php echo wp_kses_post( $thumbnail ) ?></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            <?php
        }

        public function get_related_post()
        {
            $post_related_on = yhsshu()->get_theme_opt('post_related_on', false);

            if ($post_related_on) {
                global $post;
                $current_id = $post->ID;
                $posttags = get_the_category($post->ID);
                if (empty($posttags)) return;

                $tags = array();

                foreach ($posttags as $tag) {

                    $tags[] = $tag->term_id;
                }
                $post_number = '6';
                $query_similar = new WP_Query(array('posts_per_page' => $post_number, 'post_type' => 'post', 'post_status' => 'publish', 'category__in' => $tags));
                if (count($query_similar->posts) > 1) {
                    wp_enqueue_script('swiper');
                    wp_enqueue_script('yhsshu-swiper');
                    $opts = [
                        'slide_direction'               => 'horizontal',
                        'slide_percolumn'               => '1',
                        'slide_mode'                    => 'slide',
                        'slides_to_show'                => 3,
                        'slides_to_show_lg'             => 3,
                        'slides_to_show_md'             => 2,
                        'slides_to_show_sm'             => 2,
                        'slides_to_show_xs'             => 1,
                        'slides_to_scroll'              => 1,
                        'slides_gutter'                 => 30,
                        'arrow'                         => false,
                        'dots'                          => true,
                        'dots_style'                    => 'bullets'
                    ];
                    $data_settings = wp_json_encode($opts);
                    $dir           = is_rtl() ? 'rtl' : 'ltr';
            ?>
                    <div class="yhsshu-related-post">
                        <h3 class="widget-title"><?php echo esc_html__('Related Posts', 'yhsshu'); ?></h3>
                        <div class="class" data-settings="<?php echo esc_attr($data_settings) ?>" data-rtl="<?php echo esc_attr($dir) ?>">
                            <div class="yhsshu-related-post-inner yhsshu-swiper-wrapper swiper-wrapper">
                                <?php foreach ($query_similar->posts as $post) :
                                    $thumbnail_url = '';
                                    if (has_post_thumbnail(get_the_ID()) && wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), false)) :
                                        $thumbnail_url = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'yhsshu-blog-small', false);
                                    endif;
                                    if ($post->ID !== $current_id) : ?>
                                        <div class="yhsshu-swiper-slide swiper-slide grid-item">
                                            <div class="grid-item-inner">
                                                <?php if (has_post_thumbnail()) { ?>
                                                    <div class="item-featured">
                                                        <a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($thumbnail_url[0]); ?>" /></a>
                                                    </div>
                                                <?php } ?>
                                                <h3 class="item-title">
                                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                                </h3>
                                            </div>
                                        </div>
                                <?php endif;
                                endforeach; ?>
                            </div>
                        </div>
                    </div>
<?php }
            }

            wp_reset_postdata();
        }
    }
}
