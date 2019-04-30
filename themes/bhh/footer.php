<footer class="bg-dark py-4">
      <div  class="container">
      <div class="row">
        <div class="col-md-2 text-light">
          <strong>BestHeadhunters</strong><br>
          <small class="text-white-50">We help you find the stars!</small>
        </div>
        <div class="col-md offset-md-1">
        <?php 
          wp_nav_menu(array(
            'theme_location' => 'footerLocation',
            'menu_class' => 'navbar-nav'
          ));
        ?> 
        </div>
      </div>
      </div>
    </footer>
    </div>
    <?php wp_footer(); ?>
  </body>
</html>