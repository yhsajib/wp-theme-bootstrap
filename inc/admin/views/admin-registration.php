<?php
	$dev_mode = apply_filters( 'yhsshu_set_dev_mode', (defined('DEV_MODE') && DEV_MODE)) ;
	 
	$license = trim( get_option( yhsshu()->get_slug() . '_purchase_code' ) );

	$active = get_option( yhsshu()->get_slug() . '_purchase_code_status', false ) === 'valid';
	if( $dev_mode === true) $active = true;

	$register = new Ysshu_Register;
  
?>
<?php if ($active): ?> 
	<div class="yhsshu-dsb-box-head"> 
		<div class="yhsshu-dsb-confirmation success">
			<h6><?php echo esc_html__( 'Thanks for the verification!', 'yhsshu' ) ?></h6>
			<p><?php echo esc_html__( 'You can now enjoy and build great websites.', 'yhsshu' ) ?></p>
		</div> 

		<div class="yhsshu-dsb-deactive">
			<form method="POST" action="<?php echo admin_url( 'admin.php?page=yhsshu' )?>">
				<input type="hidden" name="action" value="removekey"/>
				<button class="btn button" type="submit"><?php esc_html_e( 'Remove Purchase Code', 'yhsshu' ) ?></button>
			</form>
		</div> 
	</div> 
<?php else: ?>
	<?php $register->messages(); ?>
	  
<?php endif; ?>
 