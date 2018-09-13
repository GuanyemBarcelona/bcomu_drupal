<?php if (!$is_format_ajax && !$is_format_body){ ?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" <?php //print $rdf_namespaces; ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" <?php //print $rdf_namespaces; ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="<?php print $language->language; ?>" xml:lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" <?php //print $rdf_namespaces; ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" xml:lang="<?php print $language->language; ?>" lang="<?php print $language->language; ?>" dir="<?php print $language->dir; ?>" <?php //print $rdf_namespaces; ?>> <!--<![endif]-->
  <head>
    <?php print $head; ?>
    <title><?php print $head_title; ?></title>
    <?php print $styles; ?>
    <!--[if lt IE 9]>
    <script src="<?php print base_path() . path_to_theme(); ?>/node_modules/html5shiv/dist/html5shiv.min.js"></script>
    <![endif]-->
    <?php if (isset($environment) && $environment == 'pro') { ?>
    <?php // Start: Google Analytics code ?>
      <script async src="https://www.googletagmanager.com/gtag/js?id=UA-59488092-1"></script>
      <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-59488092-1', {'anonymize_ip': true});
      </script>
    <?php // End: Google Analytics code ?>
    <?php } ?>
  </head>
  <body class="<?php print $classes; ?>" <?php print $attributes;?>>
    <?php if (!$is_format_oasis){ ?>
    <!--[if lt IE 7]>
      <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
    <?php print $page_top; ?>
    <div id="page-wrapper">
      <?php print $page; ?>
    </div>
    <?php }else{ ?>
      <?php print $page; ?>
    <?php } ?>

    <?php print $scripts; ?>
    <?php print $page_bottom; ?>
  </body>
</html>
<?php } else { ?>
<?php print $page; ?>
<?php }
