<?php
defined( 'ABSPATH' ) || exit;

class yhsshu_Image {
 
	public static function yhsshu_resize( $attach_id = null, $img_url = null, $width = '', $height = '', $crop = false ) {
        // this is an attachment, so we have the ID
        $image_src = array();
        if ( $attach_id ) {
            $image_src = wp_get_attachment_image_src( $attach_id, 'full' );
            $actual_file_path = get_attached_file( $attach_id );
            // this is not an attachment, let's use the image url
        } elseif ( $img_url ) {
            $file_path = wp_parse_url( $img_url );
            $actual_file_path = rtrim( ABSPATH, '/' ) . $file_path['path'];
            $orig_size = getimagesize( $actual_file_path );
            $image_src[0] = $img_url;
            $image_src[1] = $orig_size[0];
            $image_src[2] = $orig_size[1];
        }
        if ( ! empty( $actual_file_path ) ) {
            $file_info = pathinfo( $actual_file_path );
            $extension = '.' . $file_info['extension'];

            // the image path without the extension
            $no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];

            $cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

            // checking if the file size is larger than the target size
            // if it is smaller or the same size, stop right here and return
            if ( $image_src[1] > $width || $image_src[2] > $height ) {

                // the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
                if ( file_exists( $cropped_img_path ) ) {
                    $cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
                    $vt_image = array(
                        'url' => $cropped_img_url,
                        'width' => $width,
                        'height' => $height,
                    );

                    return $vt_image;
                }

                if ( ! $crop ) {
                    // calculate the size proportionaly
                    $proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
                    $resized_img_path = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;

                    // checking if the file already exists
                    if ( file_exists( $resized_img_path ) ) {
                        $resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

                        $vt_image = array(
                            'url' => $resized_img_url,
                            'width' => $proportional_size[0],
                            'height' => $proportional_size[1],
                        );

                        return $vt_image;
                    }
                }

                // no cache files - let's finally resize it
                $img_editor = wp_get_image_editor( $actual_file_path );

                if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
                    return array(
                        'url' => '',
                        'width' => '',
                        'height' => '',
                    );
                }

                $new_img_path = $img_editor->generate_filename();

                if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
                    return array(
                        'url' => '',
                        'width' => '',
                        'height' => '',
                    );
                }
                if ( ! is_string( $new_img_path ) ) {
                    return array(
                        'url' => '',
                        'width' => '',
                        'height' => '',
                    );
                }

                $new_img_size = getimagesize( $new_img_path );
                $new_img = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

                // resized output
                $vt_image = array(
                    'url' => $new_img,
                    'width' => $new_img_size[0],
                    'height' => $new_img_size[1],
                );

                return $vt_image;
            }

            // default output - without resizing
            $vt_image = array(
                'url' => $image_src[0],
                'width' => $image_src[1],
                'height' => $image_src[2],
            );

            return $vt_image;
        }

        return false;
    }
	public static function yhsshu_image_by_size( $params = array() ) {
        $params = array_merge( array(
			'post_id'    => null,
			'attach_id'  => null,
			'thumb_size' => 'thumbnail',
			'class'      => '',
			'alt'        => '',
			'data-src'   => false,
			'return'     => '',
			'echo'       => '',
        ), $params );

        if ( ! $params['thumb_size'] ) {
            $params['thumb_size'] = 'thumbnail';
        }

        if ( ! $params['attach_id'] && ! $params['post_id'] ) {
            return false;
        }

        $post_id = $params['post_id'];

        $attach_id = $post_id ? get_post_thumbnail_id( $post_id ) : $params['attach_id'];
        $attach_id = apply_filters( 'yhsshu_object_id', $attach_id );
        $thumb_size = $params['thumb_size'];
        $thumb_class = ( isset( $params['class'] ) && '' !== $params['class'] ) ? $params['class'] . ' ' : '';

        global $_wp_additional_image_sizes;
        $thumbnail = '';

        $sizes = array(
            'thumbnail',
            'thumb',
            'medium',
            'medium_large',
            'large',
            'full',
        );
        if ( is_string( $thumb_size ) && ( ( ! empty( $_wp_additional_image_sizes[ $thumb_size ] ) && is_array( $_wp_additional_image_sizes[ $thumb_size ] ) ) || in_array( $thumb_size, $sizes, true ) ) ) {
            $attributes = array( 'class' => $thumb_class . 'attachment-' . $thumb_size );
            $thumbnail = wp_get_attachment_image( $attach_id, $thumb_size, false, $attributes );
            $thumbnail_url = wp_get_attachment_image_url($attach_id, $thumb_size, false);
        } elseif ( $attach_id ) {
            if ( is_string( $thumb_size ) ) {
                preg_match_all( '/\d+/', $thumb_size, $thumb_matches );
                if ( isset( $thumb_matches[0] ) ) {
                    $thumb_size = array();
                    $count = count( $thumb_matches[0] );
                    if ( $count > 1 ) {
                        $thumb_size[] = $thumb_matches[0][0]; // width
                        $thumb_size[] = $thumb_matches[0][1]; // height
                    } elseif ( 1 === $count ) {
                        $thumb_size[] = $thumb_matches[0][0]; // width
                        $thumb_size[] = $thumb_matches[0][0]; // height
                    } else {
                        $thumb_size = false;
                    }
                }
            }

            if ( is_array( $thumb_size ) ) {
                // Resize image to custom size
                $p_img = self::yhsshu_resize( $attach_id, null, $thumb_size[0], $thumb_size[1], true );
                $alt = trim( wp_strip_all_tags( get_post_meta( $attach_id, '_wp_attachment_image_alt', true ) ) );
                $attachment = get_post( $attach_id );
                if ( ! empty( $attachment ) ) {
                    $title = trim( wp_strip_all_tags( $attachment->post_title ) );

                    if ( empty( $alt ) ) {
                        $alt = trim( wp_strip_all_tags( $attachment->post_excerpt ) ); // If not, Use the Caption
                    }
                    if ( empty( $alt ) ) {
                        $alt = $title;
                    }
                    if ( !empty( $params['alt'] ) ) {
						$alt = $params['alt'];
					}

                    if ( $p_img ) {
                    	$attributes = [
							'src'    => $p_img['url'],
							'width'  => $p_img['width'],
							'height' => $p_img['height'],
							'alt'    => $alt,
							//'title'  => $title,
							 
						];

						if ( $params['data-src'] )
							$attributes['data-src'] = $p_img['url'];

						$attributes['class'] = $thumb_class;
 
                        $atts = array();
                        foreach ($attributes as $name => $value) {
                            $atts[] = $name . '="' . esc_attr($value) . '"';
                        }
                        $attributes = implode(' ', $atts);

                        $thumbnail = '<img ' . $attributes . ' />';
                    }
                }
            }
            $thumbnail_url = !empty( $p_img['url'] ) ? $p_img['url'] : '';
        }

 		if(!empty($params['echo'])){
 			if($params['echo'] == 'url')
 				echo esc_url($thumbnail_url);
 			else
 				echo wp_kses_post($thumbnail );
 		}else{
	 		if($params['return'] == 'image'){
	 			return $thumbnail;
	 		}elseif($params['return'] == 'url'){
	 			return $thumbnail_url;
	 		}else{
	 			return ['thumbnail' => $thumbnail, 'url' => $thumbnail_url];
	 		}
 		}
         
    }
	public static function get_attachment_info( $attachment_id ) {
		$attachment     = get_post( $attachment_id );
		$attachment_url = wp_get_attachment_url( $attachment_id );

		if ( $attachment === null ) {
			return false;
		}

		$alt = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );

		if ( '' === $alt ) {
			$alt = $attachment->post_title;
		}

		return array(
			'alt'         => $alt,
			'caption'     => $attachment->post_excerpt,
			'description' => $attachment->post_content,
			'href'        => get_permalink( $attachment->ID ),
			'src'         => $attachment_url,
			'title'       => $attachment->post_title,
		);
	} 
  
}
