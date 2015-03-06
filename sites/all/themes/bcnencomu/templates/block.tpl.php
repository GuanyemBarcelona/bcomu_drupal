<?php $tag = $block->subject ? 'section' : 'div'; ?>
<<?php print $tag; ?> id="block-<?php print $block->module .'-'. $block->delta ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print render($title_prefix); ?>
  <?php if ($block->subject): ?>
  <header>
    <h1<?php print $title_attributes; ?>><?php print $block->subject ?></h1>
  </header>
  <?php endif;?>
  <?php print render($title_suffix); ?>
  <div class="content" <?php print $content_attributes; ?>>
    <?php if ($is_navigation) print '<nav>'; ?>
    <?php print $content; ?>
    <?php if ($is_navigation) print '</nav>'; ?>
  </div>
</<?php print $tag; ?>> <!-- /block -->