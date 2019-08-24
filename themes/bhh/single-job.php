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
      $min_salary = get_field('min_salary');
      $max_salary = get_field('max_salary');
      $street_address = get_field('street_address');
      $postal_code = get_field('postal_code');
      $job_type = get_field('job_type');
      $content = get_the_content();
      $job_expiration = get_field('job_expiration');
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
  "description" : "<?php echo wp_filter_nohtml_kses( $content ); ?>",
  "identifier": {
    "@type": "PropertyValue",
    "name": "Best Headhunters",
    "value": "<?php the_id(); ?>"
  },
  "datePosted" : "<?php the_time('Y-m-d'); ?>",
  "validThrough" : "<?php echo job_expiration ?>",
  "employmentType" : "<?php echo job_type ?>",
  "hiringOrganization" : {
    "@type" : "Organization",
    "name" : "Best Headhunters",
    "sameAs" : "https://www.bestheadhunters.com"
  },
  "jobLocation" : {
    "@type" : "Place",
    "address" : {
      "@type" : "PostalAddress",
      "streetAddress": "<?php echo $street_address ?>",
      "addressLocality" : "<?php echo $job_city ?>",
      "addressRegion" : "<?php echo $job_state ?>",
      "postalCode": "<?php echo postal_code ?>",
      "addressCountry": "US"
    }
  },
  "baseSalary": {
  "@type": "MonetaryAmount",
  "currency": "USD",
  "value": {
    "@type": "QuantitativeValue",
    "minValue": "<?php echo $min_salary ?>",
    "maxValue": "<?php echo $max_salary ?>",
    "unitText": "YEAR"
    }
  }
}
</script>


  <?php } 
  get_footer();
  ?>