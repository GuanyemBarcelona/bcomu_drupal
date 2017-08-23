<?php if (!$is_format_ajax && !$is_format_body){ ?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" <?php //print $rdf_namespaces; ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" <?php //print $rdf_namespaces; ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" <?php //print $rdf_namespaces; ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" <?php //print $rdf_namespaces; ?>> <!--<![endif]-->
  <head>
    <?php print $head; ?>
    <title><?php print $head_title; ?></title>
    <link href="//fonts.googleapis.com/css?family=Roboto:400,300,100,400italic,500,500italic,700,700italic&subset=latin,latin-ext" rel="stylesheet">
    <?php print $styles; ?>
    <!--[if lt IE 9]>
    <script src="<?php print base_path() . path_to_theme(); ?>/node_modules/html5shiv/dist/html5shiv.min.js"></script>
    <![endif]-->
    <?php if (isset($environment) && $environment == 'pro') { ?>
    <?php // Start: Google Analytics code ?>
    <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-59488092-1', 'auto');
    ga('send', 'pageview');
    </script>
    <?php // End: Google Analytics code ?>
    <?php } ?>
  </head>
  <body class="<?php print $classes; ?>" <?php print $attributes;?>>
    <?php if (!$is_format_oasis){ ?>
    <!--[if lt IE 7]>
      <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
    <div id="skip">
      <a href="#block-system-main-menu"><?php print t('Jump to Navigation'); ?></a>
    </div>
    <?php print $page_top; ?>
    <div id="page-wrapper">
      <?php print $page; ?>
    </div>
    <?php }else{ ?>
      <?php print $page; ?>
    <?php } ?>

    <?php print $page_bottom; ?>
    <?php print $scripts; ?>
  </body>
</html>
<?php } else { ?>
<?php print $page; ?>
<?php }
