<footer class="bg-dark py-5">
      <div  class="container">
      <div class="row">
        <div class="col-lg-2 text-light">BestHeadhunters</div>
        <div class="col-lg">
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