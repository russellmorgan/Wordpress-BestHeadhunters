<?php get_header();

  while(have_posts()) {
    the_post(); 
?>

<div class="container py-5 flex-grow-1">
  <div class="row">
    <div class="col-lg-8">
      <h3><?php the_title(); ?></h3>
      <div>
        <?php the_content(); ?>
      </div>
    </div>
  </div>
</div>

<?php } 
get_footer(); 
?>