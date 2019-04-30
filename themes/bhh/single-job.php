<?php get_header(); ?>

<?php while(have_posts()) {
    the_post(); ?>

<div class="container py-5">
  <div class="row">
    <div class="col-lg-7 mb-4">
    <h3 class="mb-4"><?php the_title(); ?></h3>
    <p><strong>
    <?php 
      $job_city = get_field('city_location');
      $job_state = get_field('state_location');
      echo $job_city .', '. $job_state
    ?>
    </strong></p>
    <?php the_content(); ?>
    <hr>
    <p>
      <?php 
      $job_keywords = get_field('job_keywords');
      echo $job_keywords 
      ?>
    </p>
    </div>
    <div class="col-lg-4 offset-lg-1">
      <!-- if job post show meta about the job -->
      <div class="card mb-5">
        <div class="card-body">
        Job posted on: <?php the_time('F.j.Y'); ?><br />
        <a href="<?php echo get_post_type_archive_link('job'); ?>">View all jobs</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- google job search data -->
<script type="application/ld+json"> {
  "@context" : "http://schema.org/",
  "@type" : "JobPosting",
  "title" : "<?php the_title(); ?>",
  "description" : "<?php the_content(); ?>",
  "identifier": {
    "@type": "PropertyValue",
    "name": "Best Headhunters",
    "value": "<?php the_id(); ?>"
  },
  "datePosted" : "<?php the_time('Y-m-d'); ?>",
  "hiringOrganization" : {
    "@type" : "Organization",
    "name" : "Best Headhunters",
    "sameAs" : "https://www.bestheadhunters.com"
  },
  "jobLocation" : {
    "@type" : "Place",
    "address" : {
      "@type" : "PostalAddress",
      "addressLocality" : "<?php echo $job_city ?>",
      "addressRegion" : "<?php echo $job_state ?>",
      "addressCountry": "US"
    }
  }
}
</script>


  <?php } 
  get_footer();
  ?>