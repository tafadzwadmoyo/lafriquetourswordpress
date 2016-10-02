<?php get_header(); ?>
<section id="content" class="top-border" role="main">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part( 'entry' ); ?>
<?php endwhile; endif; ?>
<footer class="footer">
</footer>
</section>
<?php get_footer(); ?>