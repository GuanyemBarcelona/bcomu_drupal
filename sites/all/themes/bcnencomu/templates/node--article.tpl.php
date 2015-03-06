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
    <?php if (isset($lead)){ ?>
    <h2 class="lead"><?php print $lead; ?></h2>
    <?php } ?>
  </header>
  <div class="content">
    <aside class="info">
      <?php if (isset($author_name)){ ?>
      <p class="name author"><?php print $author_name; ?></p>
      <?php } ?>
      <time datetime="<?php print $date['machine']; ?>"><?php print $date['human']; ?></time>
      <?php if (isset($tags)){ ?>
      <?php print $tags; ?>
      <?php } ?>
      <?php if (isset($category)){ ?>
      <?php print $category; ?>
      <?php } ?>
    </aside>

    <?php if (isset($share_links)){ ?>
      <?php print $share_links; ?>
    <?php } ?>

    <?php /*if (isset($image_gallery)){ ?>
      <?php print $image_gallery; ?>
    <?php }*/ ?>

    <div class="body">
      <?php if (isset($node_body_html)) { ?>
      <?php print $node_body_html; ?>
      <?php } ?>
    </div>

    <?php if (isset($node_nav)){ ?>
    <?php print $node_nav; ?>
    <?php } ?>
  </div>
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->
<?php if (isset($content['comments'])){ ?>
<?php print render($content['comments']); ?>
<?php } 