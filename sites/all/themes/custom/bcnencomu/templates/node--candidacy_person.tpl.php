<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php if (isset($youtube_uri)){ ?> data-youtube-uri="<?php print $youtube_uri; ?>"<?php } ?>>
  <?php if ($view_mode == 'teaser' || $view_mode == 'highlighted') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
  <?php if (isset($photo)){ ?>
  <div class="image">
    <a href="<?php print $node_url; ?>"><?php print $photo; ?></a>
  </div>
  <?php } ?>
  <div class="content">
    <h2><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  </div>
  <?php } else if ($view_mode == 'slider') { ?>
  <?php /* ----------------- SLIDER DISPLAY ----------------- */ ?>
  
  <?php } else if ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <header>
    <h1><?php print $title; ?></h1>
  </header>
  <?php if (isset($list_uri)){ ?>
  <a href="<?php print $list_uri; ?>" data-action="go-back"><?php print t("Back to the candidacy list"); ?></a>
  <?php } ?>
  <div class="content">
    <?php if (isset($youtube_uri) || isset($video_html)) { ?>
    <div class="video" id="video-<?php print $node->nid; ?>">
      <?php if (isset($video_html)) { ?>
      <?php print $video_html; ?>
      <?php } ?>
    </div>
    <?php } ?>
    
    <?php 
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
     ?>
  </div>
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->
<?php if (isset($content['comments'])){ ?>
<?php print render($content['comments']); ?>
<?php } 