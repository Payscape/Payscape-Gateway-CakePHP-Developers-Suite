<!DOCTYPE html>
<html lang="en">
<head>
  <?php echo $this->Html->charset(); ?>
  <title><?php echo $title_for_layout; ?></title>
  <!--  meta info -->
  <?php
    echo $this->Html->meta(array("name"=>"viewport",
      "content"=>"width=device-width,  initial-scale=1.0"));
    echo $this->Html->meta(array("name"=>"description",
      "content"=>"this is the description"));
    echo $this->Html->meta(array("name"=>"author",
      "content"=>"TheHappyDeveloper.com - @happyDeveloper"))
  ?>

  <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
  <!--[if lt IE 9]>
  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

  <!-- styles -->
  <?php
    echo $this->Html->css('bootstrap');
    echo $this->Html->css('bootstrap-responsive');
    echo $this->Html->css('docs');
    echo $this->Html->css('prettify');
  ?>
  <!-- icons -->
  <?php
    echo  $this->Html->meta('icon',$this->webroot.'img/favicon.ico');
    echo $this->Html->meta(array('rel' => 'apple-touch-icon',
      'href'=>$this->webroot.'img/apple-touch-icon.png'));
    echo $this->Html->meta(array('rel' => 'apple-touch-icon',
      'href'=>$this->webroot.'img/apple-touch-icon.png',  'sizes'=>'72x72'));
    echo $this->Html->meta(array('rel' => 'apple-touch-icon',
      'href'=>$this->webroot.'img/apple-touch-icon.png',  'sizes'=>'114x114'));
  ?>
  <!-- page specific scripts -->

</head>

<body data-spy="scroll" data-target=".subnav" data-offset="50">
  <div id="container">
  <!-- Navbar ============================================= -->
  <div class="navbar navbar-fixed-top">
    <div class="navbar-inner">
      <div class="container">
        <a class="btn btn-navbar" data-toggle="collapse"
          data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="./index.html">Bootstrap</a>
        <div class="nav-collapse">
          <ul class="nav">
            <li class="active">
              <a href="<?php echo $this->webroot;?>">Home</a>
            </li>
            <li class="">
              <a href="./base-css.html">Base CSS</a>
            </li>
            <li class="">
              <a href="./components.html">Components</a>
            </li>
            <li class="">
              <a href="./javascript.html">Javascript plugins</a>
            </li>
            <li class="">
              <a href="./less.html">Using LESS</a>
            </li>
            <li class="divider-vertical"></li>
            <li class="">
              <a href="./download.html">Customize</a>
            </li>
            <li class="">
              <a href="./examples.html">Examples</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div id="row">
    <?php echo $this->Session->flash(); ?>
    <?php echo $content_for_layout; ?>
  </div>
  </div>
  <?php echo $this->element('sql_dump'); ?>
  
      <?php echo $scripts_for_layout; ?>
</body>
</html>