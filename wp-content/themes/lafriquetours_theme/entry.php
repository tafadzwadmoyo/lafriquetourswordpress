<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header>
</header>
<?php get_template_part( 'entry', ( is_archive() || is_search() ? 'summary' : 'content' ) ); ?>
</article>