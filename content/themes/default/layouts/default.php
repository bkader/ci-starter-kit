<?php defined('BASEPATH') OR exit('No direct script access allowed'); theme_header(); ?>
<div class="container">
	<?php echo print_flash_alert(); ?>
	<div class="row">
		<?php echo @$content."\n"; ?>
		<?php theme_partial('sidebar'); ?>
	</div><!--/.row-->
</div><!-- /.container -->
<?php theme_footer(); ?>