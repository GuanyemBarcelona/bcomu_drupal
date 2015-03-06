<?php if (!$is_format_ajax && !$is_format_oasis): ?>
<?php if ($content): ?>
  <div class="<?php print $classes; ?>">
  	<?php if (isset($footer_logo_uri)): ?>
  	<a href="<?php print $front_page; ?>" class="logo" title="<?php print t('Home'); ?>">
      <img src="<?php print $footer_logo_uri; ?>" alt="<?php print t('Home'); ?>"/>
    </a>
    <?php endif; ?>
    <?php print $content; ?>
  </div>
<?php endif; ?>
<?php else: ?>
<?php print $content; ?>
<?php endif;