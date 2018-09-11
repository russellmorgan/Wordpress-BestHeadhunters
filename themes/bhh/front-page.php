<?php get_header(); ?>

    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4 text-light">Best Headhunters</h1>
        <p class="lead">Best Headhunters, a nationwide professional Executive Search Firm, helps organizations recruit the best executive star talent in the market.</p>
      </div>
    </div>   

    <!-- intro section -->
    <section class="container mb-5">
        <div class="row">
          <div class="col-lg-3"><img src="<?php echo get_theme_file_uri('images/headshot.png') ?>"></div>
          <div class="col-lg-6"><h2>About Best Headhunters</h2><p>Lorem ipsum</p></div>
          <div class="col-lg-3">
            <div class="card">
              <div class="card-body border-primary bg-primary text-light">
              Best Headhunters, a nationwide professional Executive Search Firm, helps organizations recruit the best executive talent in all industries.
              </div>
            </div>
          </div>
        </div>
    </section>

    <!-- featured jobs -->
    <section class="container-fluid bg-light mb-5 py-5">
      <div class="container">
        <div class="row"><div class="col"><h2>Featured Jobs</h2></div></div>
        <div class="row">
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
        <div class="col-lg-6">
          <h4>Now is the Time to Hire Excellent Candidates</h4>
          <p>If your company is in the process of laying off people, now is the time to also think of hiring excellent candidates. For every group of people your company lays off a new highly regarded job should be created when talent is available. Wait and you will regret it!</p>
          <p><a href="#">More from our blog</a></p>
        </div>
      </div>
    </section>
    
    <?php get_footer(); ?>