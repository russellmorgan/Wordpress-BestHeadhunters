<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Barlow|Russo+One" rel="stylesheet">

    <?php wp_head(); ?>
    <title>Best HeadHunters</title>
  </head>
    <body <?php body_class() ?>>

    <div class="d-flex flex-column">
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
      <a class="navbar-brand mr-5" href="<?php echo site_url(); ?>">Best headhunters</a>

      <?php 
      wp_nav_menu(array(
        'theme_location' => 'headerLocation',
        'menu_class' => 'navbar-nav'
      ));
      ?>    

    </nav>