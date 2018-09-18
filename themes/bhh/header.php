<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <?php wp_head(); ?>
    <title>Best HeadHunters</title>
  </head>

    <body <?php body_class() ?>>
    <nav class="navbar navbar-expand-xl navbar-dark bg-dark">
      <a class="navbar-brand" href="#">Best headhunters</a>
      <ul class="navbar-nav">
      <?php 
      wp_nav_menu(array(
        'theme_location' => 'headerLocation'
      ));
      ?>    
    </ul>
    </nav>