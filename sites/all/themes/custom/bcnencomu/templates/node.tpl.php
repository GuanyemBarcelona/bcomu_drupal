<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
  <?php if ($view_mode == 'teaser') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
  <header>
    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
  </header>
  <div class="content">
    <?php 
      // We hide the comments and links now so that we can render them later.
      hide($content['comments']);
      hide($content['links']);
      print render($content);
     ?>
  </div>
  <?php } else if ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <?php if (isset($title)){ ?>
  <header>
    <h1<?php print $title_attributes; ?>><?php print $title; ?></h1>
  </header>
  <?php } ?>
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
<?php print render($content['comments']); ?>