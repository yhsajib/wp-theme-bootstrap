<?php
if (!class_exists('yhsshu_Comment')) {
     
    class yhsshu_Comment
    {
        private $show_phone = '0';
        private $show_subject = '0';
        private $show_rating = '0';
        function __construct(){
            add_filter( 'yhsshu_comment_extra_control', [$this,'comment_extra_control'] );
            add_action( 'edit_comment', [$this,'comment_edit_metafields'] );
            add_action( 'comment_post', [$this,'comment_save_comment_meta'] );
            add_filter( 'preprocess_comment', [$this,'comment_rating_require_rating'] );
        }
        

        public function comment_extra_control ( $comment ) {
 
            $phone = get_comment_meta( $comment->comment_ID, 'phone', true );
            wp_nonce_field( 'yhsshu_comment_update', 'yhsshu_comment_update', false );
 
            ob_start();
            if($this->show_phone == '1'): ?>
            <p>
                <label for="phone"><?php esc_html_e( 'Phone','yhsshu' ); ?></label>
                <input type="text" name="phone" value="<?php echo esc_attr( $phone ); ?>" class="widefat" />
            </p>
            <?php 
            endif;

            
            if($this->show_subject == '1'): 
                $subject = get_comment_meta( $comment->comment_ID, 'subject', true );
            ?>
            <p>
                <label for="subject"><?php esc_html_e( 'Subject','yhsshu' ); ?></label>
                <input type="text" name="subject" value="<?php echo esc_attr( $subject ); ?>" class="widefat" />
            </p>
            <?php 
            endif;

            
            if($this->show_rating == '1' && !class_exists('Woocommerce')): ?>
            <p>
                <label for="rating"><?php esc_html_e( 'Rating: ','yhsshu' ); ?></label>
                    <span class="commentratingbox">
                    <?php for( $i=1; $i <= 5; $i++ ) {
                        echo '<span class="commentrating"><input type="radio" name="rating" id="rating" value="'. $i .'"';
                        if ( $rating == $i ) echo ' checked="checked"';
                        echo ' />'. $i .' </span>';
                        }
                    ?>
            </p>
            <?php
            endif;
            return ob_get_contents();
        }

        public function comment_edit_metafields( $comment_id ) {
            if( ! isset( $_POST['yhsshu_comment_update'] ) || ! wp_verify_nonce( sanitize_text_field($_POST['yhsshu_comment_update']), 'yhsshu_comment_update' ) ) return;
         
            if ( ( isset( $_POST['phone'] ) ) && ( $_POST['phone'] != '') ) :
                $phone = sanitize_text_field($_POST['phone']);
                update_comment_meta( $comment_id, 'phone', $phone );
            else :
                delete_comment_meta( $comment_id, 'phone');
            endif;
         
            if ( ( isset( $_POST['subject'] ) ) && ( $_POST['subject'] != '') ):
                $subject = sanitize_text_field($_POST['subject']);
                update_comment_meta( $comment_id, 'subject', $subject );
            else :
                delete_comment_meta( $comment_id, 'subject');
            endif;
         
            if ( ( isset( $_POST['rating'] ) ) && ( $_POST['rating'] != '') ):
                $rating = sanitize_text_field($_POST['rating']);
                update_comment_meta( $comment_id, 'rating', $rating );
            else :
                delete_comment_meta( $comment_id, 'rating');
            endif;
         
        }

        public function comment_rating_fields ($args =[]) {
            $args = wp_parse_args($args, [
                'echo'  => true,
                'class' => ''
            ]);
            
            $rating = '';
            if($this->show_rating == '1' && is_singular('post')){
                $rating .= '<div class="yhsshu-comment-form-rating yhsshu-comment-form-fields-wrap '.esc_attr($args['class']).'">';
                    $rating .= '<div  class="comment-form-field">'. esc_html__('Your Rating','yhsshu').'<span class="required">*</span></div>';
                    $rating .= '<div class="comment-form-field comments-rating">';
                        $rating .= '<span class="rating-container d-flex gx-12 stars">';
                            for ( $i = 5; $i >= 1; $i-- ) :
                                $rating .= '<input type="radio" id="rating-'.$i.'" class="star-'.$i.'" name="rating" value="'.$i.'" />
                                            <label for="rating-'.$i.'"><span class="d-none">'.$i.'</span></label>';
                            endfor;
                            //$rating .= '<input type="radio" id="rating-0" class="star-cb-clear star-0" name="rating" value="0" /><label for="rating-0"><span class="d-none">0</span></label>';
                        $rating .= '</span>
                    </div>
                </div>';
            }
            if($args['echo']){
                printf('%s', $rating);
            } else {
                return $rating;
            }
        }

        function wc_comment_rating_fields($args =[]){
            $args = wp_parse_args($args, [
                'echo' => true,
                'class' => ''
            ]);
            $rating = '';
            if(!function_exists('wc_review_ratings_enabled')) return;
            if (wc_review_ratings_enabled() && is_singular('product') ) {
                $rating .= '<div class="yhsshu-comment-form-rating yhsshu-comment-form-fields-wrap '.esc_attr($args['class']).'">';
                    $rating .= '<div class="comment-form-field">' . esc_html__( 'Your rating of this product', 'yhsshu' ) . ( wc_review_ratings_required() ? '&nbsp;<span class="required">*</span>' : '' ) . '</div>';
                    $rating .= '<div class="comment-form-field comments-rating">';
                        $rating .= '<select name="rating" id="rating" required>
                            <option value="">' . esc_html__( 'Rate&hellip;', 'yhsshu' ) . '</option>
                            <option value="5">' . esc_html__( 'Perfect', 'yhsshu' ) . '</option>
                            <option value="4">' . esc_html__( 'Good', 'yhsshu' ) . '</option>
                            <option value="3">' . esc_html__( 'Average', 'yhsshu' ) . '</option>
                            <option value="2">' . esc_html__( 'Not that bad', 'yhsshu' ) . '</option>
                            <option value="1">' . esc_html__( 'Very poor', 'yhsshu' ) . '</option>
                        </select>';
                    $rating .= '</div>';
                $rating .= '</div>';
            }
            if($args['echo']){
                printf('%s', $rating);
            } else {
                return $rating;
            }
        }

        public function comment_save_comment_meta( $comment_id ) {
            // phone
            if ( ( isset( $_POST['phone'] ) ) && ( sanitize_text_field($_POST['phone']) != '') )
                $phone = sanitize_text_field( sanitize_text_field($_POST['phone']));
            // rating
            if ( ( isset( $_POST['rating'] ) ) && ( '' !== sanitize_text_field($_POST['rating']) ) )
                $rating = intval( sanitize_text_field( $_POST['rating']) );
            // subject
            if ( ( isset( $_POST['subject'] ) ) && ( '' !== sanitize_text_field($_POST['subject']) ) )
                $subject = sanitize_text_field($_POST['subject']);

            add_comment_meta( $comment_id, 'phone', $phone );
            add_comment_meta( $comment_id, 'rating', $rating );
            add_comment_meta( $comment_id, 'subject', $subject );
        }

        public function comment_rating_require_rating( $commentdata ) {
            if($this->show_rating !== '1') return $commentdata;

            if ( ! is_admin() && ( ! isset( $_POST['rating'] ) || 0 === intval( sanitize_text_field($_POST['rating']) ) ) )
            wp_die( esc_html__( 'Error: You did not add a rating. Hit the Back button on your Web browser and resubmit your comment with a rating.','yhsshu' ) );
            return $commentdata;
        }

        public function comment_list( $comment, $args, $depth ) {
            if ( 'div' === $args['style'] ) {
                $tag       = 'div';
                $add_below = 'comment';
            } else {
                $tag       = 'li';
                $add_below = 'div-comment';
            }
            ?>
            <<?php echo ''.$tag ?> <?php comment_class( ['comment', empty( $args['has_children'] ) ? '' : 'parent' ]) ?> id="comment-<?php comment_ID() ?>">
            <?php if ( 'div' != $args['style'] ) : ?>
                <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
                <?php endif; ?>
                    <div class="comment-inner">
                        <div class="inner-top row gx-20 align-items-center">
                            <?php if ($args['avatar_size'] != 0) : ?>
                                <div class="comment-avatar col-auto empty-none"><?php
                                    echo get_avatar($comment, '68');
                                    ?></div>
                            <?php endif; ?>
                            <div class="comment-content col">
                                <div class="row g-10 align-items-center justify-content-between">
                                    <div class="col-auto">
                                        <div class="yhsshu-heading comment-title"><?php printf( '%s', get_comment_author_link() ); ?></div>
                                        <div class="comment-date empty-none"><?php echo get_comment_date().' at '.get_comment_time() ?></div>
                                    </div>
                                    <div class="col-auto">
                                        <?php
                                        comment_reply_link( array_merge( $args, array(
                                            'add_below' => $add_below,
                                            'depth'     => $depth,
                                            'max_depth' => $args['max_depth'],
                                            'reply_text' => esc_html__('Reply', 'yhsshu')
                                        ) ) );
                                        ?>
                                    </div>
                                </div>
                                <div class="comment-meta">
                                    <div class="comment-rating empty-none"><?php
                                        /**
                                         * The woocommerce_review_before_comment_meta hook.
                                         *
                                         * @hooked woocommerce_review_display_rating - 10
                                         */
                                        if(is_singular('product')){
                                            do_action( 'woocommerce_review_before_comment_meta', $comment );
                                        }
                                        ?></div>
                                    <div class="empty-none"><?php
                                        /**
                                         * The woocommerce_review_meta hook.
                                         *
                                         * @hooked woocommerce_review_display_meta - 10
                                         */
                                        if(is_singular('product')){
                                            do_action( 'woocommerce_review_meta', $comment );
                                        }
                                        ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="before-comment-text empty-none"><?php
                            if(is_singular('product')){ do_action( 'woocommerce_review_before_comment_text', $comment ); }
                            ?></div>
                            <div class="comment-text empty-none"><?php
                                comment_text();
                                /**
                                 * The woocommerce_review_comment_text hook
                                 *
                                 * @hooked woocommerce_review_display_comment_text - 10
                                 */
                                if(is_singular('product')){
                                    do_action( 'woocommerce_review_comment_text', $comment );
                                }
                                ?></div>
                            <div class="after-comment-text empty-none"><?php
                            if(is_singular('product')){ do_action( 'woocommerce_review_after_comment_text', $comment ); }
                        ?></div>
                    </div>
                <?php if ( 'div' != $args['style'] ) : ?>
                </div>
            <?php endif;
        }
    
        

        public function comment_form_args($args = []){
            $args = wp_parse_args($args, []);
            $commenter = [
                'comment_author' => '',
                'comment_author_email' => '',
                'comment_subject' => ''
            ];

            $button_style = yhsshu()->get_theme_opt('post_comments_button', 'default');

            $yhsshu_comment_fields = array(
                'id_form'              => 'commentform',
                'title_reply'          => esc_attr__( 'Post A Comment', 'yhsshu'),
                'title_reply_to'       => esc_attr__( 'Post A Comment To ', 'yhsshu') . '%s',
                'cancel_reply_link'    => esc_attr__( 'Cancel Reply', 'yhsshu'),
                'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
                'title_reply_after'    => '</h4>',
                'id_submit'            => 'submit',
                'class_submit'         => 'btn ' . esc_attr($button_style),
                'label_submit'         =>  esc_attr__( 'Post Comment', 'yhsshu'),
                'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" /><span>%4$s</span></button>',
                'comment_notes_before' => '<label>'.esc_html__( 'Your email address will not be published. Required fields are marked *', 'yhsshu' ).'</label>',
                'comment_field'        =>  '',
            );

            $yhsshu_fields = [];
            $yhsshu_fields['open'] = '';
            if($this->show_rating == '1'){
                if(!is_user_logged_in()){
                    $yhsshu_fields['open'] .= $this->comment_rating_fields([
                        'echo' => false,
                        'class' => 'mb-20'
                    ]);
                    $yhsshu_fields['open'] .= $this->wc_comment_rating_fields([
                        'echo' => false,
                        'class' => 'mb-20'
                    ]);
                }
            }
            
            //open
            //$yhsshu_fields['open'] .= '<div class="yhsshu-comment-form-fields-wrap row">';
            // author
            $yhsshu_fields['author'] = '<div class="comment-form-field comment-form-author col-lg-6 col-md-6 col-sm-12">'.
                '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                '" size="30" required placeholder="'.esc_attr__('Name*', 'yhsshu').'"/></div>';

            // email 
            $yhsshu_fields['email'] = '<div class="comment-form-field comment-form-email col-lg-6 col-md-6 col-sm-12">'.
                '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30" required placeholder="'.esc_attr__('Email*', 'yhsshu').'"/></div>';

            //phone
            if($this->show_phone == '1'){
                $yhsshu_fields['phone'] = '<div class="comment-form-field comment-form-phone col-lg-12 col-md-12 col-sm-12">'.
                '<input id="phone" name="phone" type="text" size="30" placeholder="'.esc_attr__('Phone', 'yhsshu').'"/></div>';
            }
            
            // subject   
            if($this->show_subject == '1'){
                $yhsshu_fields['subject'] = '<div class="comment-form-field comment-form-subject col-lg-4 col-md-4 col-sm-12">'.
                    '<input id="subject" name="subject" type="text" value="' . $commenter['comment_subject'] .
                '" size="30" placeholder="'.esc_attr__('Subject', 'yhsshu').'"/></div>';
            } 
           // $yhsshu_fields['close'] = '</div>';

            if ( has_action( 'set_comment_cookies', 'wp_set_comment_cookies' ) && get_option( 'show_comments_cookies_opt_in' ) ) {
                $consent = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
                $yhsshu_fields['cookies'] = sprintf(
                    '<p class="comment-form-cookies-consent">%s %s</p>',
                    sprintf(
                        '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"%s />',
                        $consent
                    ),
                    sprintf(
                        '<label for="wp-comment-cookies-consent">%s</label>',
                        esc_html__( 'Save my details in this browser for the next time I comment.', 'yhsshu' )
                    )
                );
            }

            $fields =  apply_filters( 'comment_form_default_fields', $yhsshu_fields);
           

            // Comment Field Message
            $yhsshu_comment_fields['comment_field'] = '';
                if($this->show_rating == '1'){
                if(is_user_logged_in()){
                    $yhsshu_comment_fields['comment_field'] .= $this->comment_rating_fields([
                        'echo' => false,
                        'class' => 'mt-20'
                    ]);
                    $yhsshu_comment_fields['comment_field'] .= $this->wc_comment_rating_fields([
                        'echo' => false,
                        'class' => 'mt-20'
                    ]);
                }
            }
            $yhsshu_comment_fields['comment_field'] .= '<div class="yhsshu-comment-form-fields-wrap yhsshu-comment-form-fields-message row"><div class="comment-form-field comment-form-comment col-12"><textarea id="comment-msg" name="comment" cols="45" rows="8" required placeholder="'.esc_attr__('Write comment...', 'yhsshu').'" aria-required="true">' .'</textarea></div></div>';
            $yhsshu_comment_fields['fields'] = $fields;
            return $yhsshu_comment_fields;
        }


        function comment_product_form_args($args = []){
            $args = wp_parse_args($args, []);

            $commenter = [
                'comment_author' => '',
                'comment_author_email' => '',
                'comment_subject' => ''
            ];

            $button_style = yhsshu()->get_theme_opt('post_comments_button', 'btn-outline');
            $yhsshu_comment_fields = array(
                'id_form'              => 'commentform',
                'title_reply'          => esc_attr__( 'Leave a Review', 'yhsshu'),
                'title_reply_to'       => esc_attr__( 'Leave a Review To ', 'yhsshu') . '%s',
                'cancel_reply_link'    => esc_attr__( 'Cancel Reply', 'yhsshu'),
                'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
                'title_reply_after'    => '</h4>',
                'id_submit'            => 'submit',
                'class_submit'         => 'btn yhsshu-btn ' . $button_style,
                'label_submit'         =>  esc_attr__( 'Post Comment', 'yhsshu'),
                'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" /><span>%4$s</span></button>',
                'comment_notes_before' => '',
                'comment_field'        =>  '',
            );

            $yhsshu_fields = [];
            $yhsshu_fields['open'] = '';

            if(!is_user_logged_in()){
                $yhsshu_fields['open'] .= $this->comment_rating_fields([
                    'echo' => false,
                    'class' => 'mb-20'
                ]);
                $yhsshu_fields['open'] .= $this->wc_comment_rating_fields([
                    'echo' => false,
                    'class' => 'mb-20'
                ]);
            }

            //open
            $yhsshu_fields['open'] .= '<div class="yhsshu-comment-form-fields-wrap row gx-12">';
            // author
            $yhsshu_fields['author'] = '<div class="comment-form-field comment-form-author col-lg-4 col-md-4 col-sm-12">'.
                '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                '" size="30" placeholder="'.esc_attr__('Name*', 'yhsshu').'"/></div>';

            // email
            $yhsshu_fields['email'] = '<div class="comment-form-field comment-form-email col-lg-4 col-md-4 col-sm-12">'.
                '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                '" size="30" placeholder="'.esc_attr__('Email*', 'yhsshu').'"/></div>';

            $yhsshu_fields['phone'] = '<div class="comment-form-field comment-form-phone col-lg-4 col-md-4 col-sm-12">'.
                '<input id="phone" name="phone" type="text" size="30" placeholder="'.esc_attr__('Mobile*', 'yhsshu').'"/></div>';

            $yhsshu_fields['close'] = '</div>';


            $fields =  apply_filters( 'comment_form_default_fields', $yhsshu_fields);
            $yhsshu_comment_fields['fields'] = $fields;



            // Comment Field Message
            $yhsshu_comment_fields['comment_field'] = '';

            if(is_user_logged_in()){
                $yhsshu_comment_fields['comment_field'] .= $this->comment_rating_fields([
                    'echo' => false,
                    'class' => 'mt-20'
                ]);
                $yhsshu_comment_fields['comment_field'] .= $this->wc_comment_rating_fields([
                    'echo' => false,
                    'class' => 'mt-20'
                ]);
            }

            $yhsshu_comment_fields['comment_field'] .= '<div class="yhsshu-comment-form-fields-wrap yhsshu-comment-form-fields-message row"><div class="comment-form-field comment-form-comment col-12"><textarea id="comment-msg" name="comment" cols="45" rows="8" placeholder="'.esc_attr__('Write your review...', 'yhsshu').'" aria-required="true">' .'</textarea></div></div>';


            return $yhsshu_comment_fields;

        }
 
    }
}
 
 