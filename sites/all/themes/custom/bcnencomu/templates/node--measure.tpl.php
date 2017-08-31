<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>"<?php if (isset($youtube_uri)){ ?> data-youtube-uri="<?php print $youtube_uri; ?>"<?php } ?>>
  <?php if ($view_mode == 'teaser' || $view_mode == 'highlighted') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
  
  <?php } else if ($view_mode == 'slider') { ?>
  <?php /* ----------------- SLIDER DISPLAY ----------------- */ ?>
  
  <?php } else if ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <header>
    <h1><?php print $title; ?></h1>

    <aside class="info">
      <?php if (isset($share_links)){ ?>
        <?php print $share_links; ?>
      <?php } ?>
    </aside>
  </header>
  <div class="content">
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