<?php get_header(); ?>

    <div class="jumbotron jumbotron-fluid d-flex flex-column justify-content-center">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
          <h1 class="text-white bg-primary p-2">Best Headhunters</h1>
          <p class="lead text-light bg-secondary p-2">Best Headhunters, a nationwide professional Executive Search Firm, helps organizations recruit the best executive star talent in the market.</p>
          </div>
        </div>
      </div>
    </div>   

    <!-- intro section -->
    <section class="container mb-5">
        <div class="row">
          <div class="col-lg-2"><img class="rounded-circle" src="<?php echo get_theme_file_uri('images/headshot.png') ?>"></div>
          <div class="col-lg-6"><h2>About Best Headhunters</h2>
          <P>Best Headhunters, a nationwide professional Executive Search Firm, helps organizations recruit the best executive star talent in the market. Our Executive Recruiters are skilled in the assessment of the executive employment market and provide you with the most qualified candidates for your difficult-to-fill positions. Best Headhunters recruiters will conduct your executive search locally or nationwide. Our headhunters perform executive searches as well as mid-level management searches in all industries on a contingency fee basis.</p>
<p>Please be advised that Best Headhunters recruiters do not conduct job searches for job seekers. We work for the Employer who pays all costs involved. If you see a position for which you are qualified, you may submit your resume to Best Headhunters for that position enabling our clients to contact you directly.</p>
          </div>
          <div class="col-lg-4">
            <div class="card">
              <div class="card-body border-primary bg-primary text-white">
              <strong>Best Headhunters, a nationwide professional Executive Search Firm, helps organizations recruit the best executive talent in all industries.</strong>
              </div>
            </div>
          </div>
        </div>
    </section>

    <!-- featured jobs -->
    <section class="container-fluid bg-light mb-5 py-5">
      <div class="container">
        <div class="row"><div class="col"><h2>Featured Jobs</h2></div></div>
        <div class="row mt-3">
    
        <?php 
        $homepage_jobs = new WP_Query(array(
          'posts_per_page' => 3,
          'post_type' => 'job',
          'order' => 'ASC'
        ));

        while($homepage_jobs->have_posts()) {
          $homepage_jobs->the_post(); ?>

          <div class="col-lg-4">
            <div class="card">
              <div class="card-body">
                <h4><a class="primary-link" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <?php the_excerpt(); ?>
              </div>
            </div>
          </div>
        
        <?php
        }
        ?>

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