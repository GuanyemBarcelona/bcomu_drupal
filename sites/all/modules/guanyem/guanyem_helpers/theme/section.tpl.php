<section id="<?php print $block_id; ?>" class="<?php print $class; ?>">
	<?php if (isset($title) && $title != ''){ ?>
	<header>
    <h1><?php print $title; ?></h1>
  </header>
  <?php } ?>
  <div class="content">
    <?php print $content; ?>
  </div>
</section>