<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php if (isset($youtube_uri)){ ?> data-youtube-uri="<?php print $youtube_uri; ?>"<?php } ?>>
  <?php if ($view_mode == 'teaser' || $view_mode == 'highlighted') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
  <div class="image">
    <a href="<?php print $node_url; ?>">
      <i class="icon icon-play"></i>
      <?php if (isset($teaser_image)){ ?>
      <?php print $teaser_image; ?>
      <?php } ?>
    </a>
  </div>
  <div class="content">
    <h2><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php if (isset($node_body_summary_html)){ ?>
    <div class="summary">
      <p><?php print $node_body_summary_html; ?></p>
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
    <div class="summary">
      <?php if (isset($node_body_summary_html)){ ?>
      <p><?php print $node_body_summary_html; ?></p>
      <?php } ?>
      <a href="<?php print $node_url; ?>" title="<?php print t("Play video"); ?>" data-action="read-more"><?php print t("Play video"); ?></a>
    </div>
  </div>
  <?php } elseif ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <div class="content">
    <div class="video" id="video-<?php print $node->nid; ?>">
      <?php if (isset($video_html)) { ?>
      <?php print $video_html; ?>
      <?php } ?>
    </div>

    <div class="body">
      <?php if (isset($node_body_html)) { ?>
      <?php print $node_body_html; ?>
      <?php } ?>
    </div>
  </div><!-- /.content -->
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->