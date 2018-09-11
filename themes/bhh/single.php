<?php get_header(); ?>

<?php while(have_posts()) {
    the_post(); ?>

<div class="container py-5">
  <div class="row">
    <div class="col-lg-7">
    <h3 class="mb-4"><?php the_title(); ?></h3>
    <?php the_content(); ?>
    </div>
    <div class="col-lg-4 offset-lg-1">
      <!-- if job post show meta about the job -->
      <div class="card mb-5">
        <div class="card-body">
        Posted on: <?php the_time('n.j.y'); ?><br />
        Category: <?php echo get_the_category_list(','); ?>
        </div>
      </div>

      <h5>More from our blog</h5>
      <ul class="list-group">
      <?php 
        $relatedBlogPosts = new WP_Query(array(
          'posts_per_page' => 3
        ));

        while ($relatedBlogPosts->have_posts()) {
          $relatedBlogPosts->the_post(); ?>

        <li class="list-group-item"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>

        <?php }
        wp_reset_postdata();
        ?>
        <li class="list-group-item"><a href="<?php echo site_url('/archive'); ?>"><strong>All Posts</strong></a></li>
      </ul>
    </div>
  </div>
</div>

  <?php } 
  get_footer();
  ?>