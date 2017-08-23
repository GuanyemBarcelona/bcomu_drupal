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
    <?php /*<h2><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2> */ ?>
    <div class="summary">
      <?php /*if (isset($node_body_summary_html)){ ?>
      <p><?php print $node_body_summary_html; ?></p>
      <?php }*/ ?>
      <?php if (isset($youtube_uri)){ ?>
      <a href="<?php print $youtube_uri; ?>" title="<?php print t("Play video"); ?>" data-action="play"><i class="icon"></i> <span><?php print t("Play video"); ?></span></a>
      <?php } ?>
    </div>
  </div>
  <?php } elseif ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <div class="content">
    <?php if (isset($youtube_uri) || isset($video_html)) { ?>
    <div class="video" id="video-<?php print $node->nid; ?>">
      <?php if (isset($video_html)) { ?>
      <?php print $video_html; ?>
      <?php } ?>
    </div>
    <?php } ?>

    <div class="body">
      <?php if (isset($node_body_html)) { ?>
      <?php print $node_body_html; ?>
      <?php } ?>
    </div>
  </div><!-- /.content -->
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->