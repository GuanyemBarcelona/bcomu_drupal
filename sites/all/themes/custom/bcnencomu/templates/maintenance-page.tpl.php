<!doctype html>
<html>
  <head>
    <title><?php print $head_title; ?></title>
    <?php print $head; ?>
    <?php print $styles; ?>
  </head>
  <body class="<?php print $classes; ?>">

  <?php print $page_top; ?>

  <div id="page">

    <div id="content">
      <div class="logo">
        <img src="<?php print $logo; ?>" alt="<?php print t('Logo'); ?>"/>
      </div>

      <p><?php print $content; ?></p>
    </div>

  </div>

  <?php print $page_bottom; ?>

  <?php print $scripts; ?>
  </body>
</html>
