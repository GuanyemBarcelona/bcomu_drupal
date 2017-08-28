<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
  <?php if ($view_mode == 'teaser' || $view_mode == 'highlighted') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
  <?php // there is no teaser ?>
  <?php } else if ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <header>
    <?php if (isset($title)) { ?>
    <h1><?php print $title; ?></h1>
    <?php } ?>
  </header>
  <div class="content">
    <?php 
      hide($content['comments']);
      hide($content['links']);
      print render($content);
     ?>
  </div>
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->