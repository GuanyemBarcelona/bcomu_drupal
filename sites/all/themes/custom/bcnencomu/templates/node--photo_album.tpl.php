<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
  <?php if ($view_mode == 'teaser' || $view_mode == 'highlighted') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
  <?php if (isset($teaser_image)){ ?>
  <div class="image">
    <a href="<?php print $node_url; ?>"><?php print $teaser_image; ?></a>
  </div>
  <?php } ?>
  <div class="content">
    <h2><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php if (isset($node_body_summary_html)){ ?>
    <div class="summary">
      <p><?php print $node_body_summary_html; ?></p>
      <a href="<?php print $node_url; ?>" title="<?php print t("Read more"); ?>" data-action="read-more"><?php print t("Read more"); ?></a>
    </div>
    <?php } ?>
  </div>
  <?php } else if ($view_mode == 'slider') { ?>
  <?php /* ----------------- SLIDER DISPLAY ----------------- */ ?>
  <?php if (isset($teaser_image)){ ?>
  <div class="image">
  <?php print $teaser_image; ?>
  </div>
  <?php } ?>
  <div class="content">
    <h2><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php if (isset($node_body_summary_html)){ ?>
    <div class="summary">
      <p><?php print $node_body_summary_html; ?></p>
      <a href="<?php print $node_url; ?>" title="<?php print t("Read more"); ?>" data-action="read-more"><?php print t("Read more"); ?></a>
    </div>
    <?php } ?>
  </div>
  <?php } else if ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
   <header>
    <h1><?php print $title; ?></h1>
  </header>
  <div class="content">
    <?php if (isset($image_gallery)){ ?>
      <?php print $image_gallery; ?>
    <?php } ?>

    <div class="body">
      <?php if (isset($node_body_html)) { ?>
      <?php print $node_body_html; ?>
      <?php } ?>
    </div>
  </div>
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->