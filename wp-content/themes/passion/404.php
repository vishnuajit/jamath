<?php
/**
 * Template for displaying 404 pages (Not Found).
 *
 * @package	passion
 * @since   1.0
 * @author  RewindCreation
 * @license GPL v3 or later
 * @link    http://www.rewindcreation.com/
 */
	get_header();
?>
<div id="content" class="<?php echo wind_content_class(); ?>" role="main">
	<?php get_template_part( 'content-none' ); ?>
</div>
<?php
	get_sidebar();
	get_footer();
