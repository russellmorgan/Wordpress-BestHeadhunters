<?php get_header(); ?>
<div class="container py-5">
  <div class="row">
    <div class="col-lg-8">
      <h3 class="mb-5"><?php the_archive_title(); ?></h3>
      <?php while(have_posts()) { 
        the_post(); ?>
      <section class="pb-2">
          <h5><?php the_title(''); ?></h5>
          <small class="d-none"><?php the_time('F.j.Y'); ?></small>
          <p> <?php the_excerpt() ?></p>
          <p><a href="<?php the_permalink();?>">Read more</a></p>
      </section>
      <hr>
      <?php } 
      echo paginate_links();
      ?>    
    </div>
  </div>
</div>

<?php get_footer(); ?>