<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
  <?php if ($view_mode == 'teaser' || $view_mode == 'highlighted') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
  <?php // No teaser ?>
  <?php } else if ($view_mode == 'slider') { ?>
  <?php /* ----------------- SLIDER DISPLAY ----------------- */ ?>
  <?php // No slider ?>
  <?php } else if ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <header>
    <?php if (isset($share_links)){ ?>
      <?php print $share_links; ?>
    <?php } ?>
    <?php if (isset($title)) { ?>
    <h1><?php print $title; ?></h1>
    <?php } ?>
  </header>
  <div class="content">
    <div class="body">
      <?php if (isset($node_body_html)) { ?>
      <?php print $node_body_html; ?>
      <?php } ?>
    </div>

    <?php if (isset($candidacies_list)){ ?>
      <?php print $candidacies_list; ?>
    <?php } ?>
  </div>
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->