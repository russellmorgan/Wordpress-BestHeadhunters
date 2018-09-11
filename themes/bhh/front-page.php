<?php get_header(); ?>

    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4 text-white">Best Headhunters</h1>
        <p class="lead text-light">Best Headhunters, a nationwide professional Executive Search Firm, helps organizations recruit the best executive star talent in the market.</p>
      </div>
    </div>   

    <!-- intro section -->
    <section class="container mb-5">
        <div class="row">
          <div class="col-lg-3"><img src="<?php echo get_theme_file_uri('images/headshot.png') ?>"></div>
          <div class="col-lg-6"><h2>About Best Headhunters</h2><p>Lorem ipsum</p></div>
          <div class="col-lg-3">
            <div class="card">
              <div class="card-body border-primary bg-primary text-white">
              Best Headhunters, a nationwide professional Executive Search Firm, helps organizations recruit the best executive talent in all industries.
              </div>
            </div>
          </div>
        </div>
    </section>

    <!-- featured jobs -->
    <section class="container-fluid bg-light mb-5 py-5">
      <div class="container">
        <div class="row"><div class="col"><h2>Our Jobs</h2></div></div>
        <div class="row mt-3">



          <div class="col-lg-3">
            <div class="card">
              <div class="card-body">
                <h4>Featured job title</h4>
                Job content but short version...
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card">
              <div class="card-body">
                <h4>Featured job title</h4>
                Job content but short version...
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card">
              <div class="card-body">
                <h4>Featured job title</h4>
                Job content but short version...
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="card">
              <div class="card-body">
                <h4>Featured job title</h4>
                Job content but short version...
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Featured blog post -->
    <section class="container mb-5">
      <div class="row"><div class="col"><h2>From the blog</h2></div></div>
      <div class="row">
      <?php 
        $featured_post = new WP_Query(array(
          'posts_per_page' => 1
        ));

        while ($featured_post->have_posts()) {
          $featured_post->the_post(); ?>

        <div class="col-lg-6">
          <h4><?php the_title(); ?></h4>
          <p><?php the_excerpt(); ?></p>
          <p><a href="<?php the_permalink();?>">Read More</a></p>
        </div>

        <?php }
        wp_reset_postdata();
        ?>

      </div>
    </section>
    
    <?php get_footer(); ?>