<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
  <?php if ($view_mode == 'teaser') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
  <?php // we are using views for this ?>
  <?php } else if ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <?php if (isset($title)){ ?>
  <header>
    <h1<?php print $title_attributes; ?>><?php print $title; ?></h1>
  </header>
  <?php } ?>
  <div class="content">
    <?php
      hide($content['comments']);
      hide($content['links']);
      print render($content);
     ?>

    <?php if (isset($link_to_equip_bcomu)){ ?>
        <?php print $link_to_equip_bcomu ?>
    <?php } ?>
  </div>
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->