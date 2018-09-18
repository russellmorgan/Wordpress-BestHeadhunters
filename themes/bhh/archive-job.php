<?php get_header(); ?>
<div class="container py-5 flex-grow-1">
  <div class="row">
    <div class="col-lg-8">
      <h3 class="mb-5">Jobs</h3>
      <?php while(have_posts()) { 
        the_post(); ?>
      <section class="pb-2">
          <h5><?php the_title(''); ?></h5>
          <p> <?php the_excerpt() ?></p>
          <p><a href="<?php the_permalink();?>">Read more</a></p>
      </section>

      <?php } 
      echo paginate_links();
      ?>    
    </div>
  </div>
</div>

<?php get_footer(); ?>