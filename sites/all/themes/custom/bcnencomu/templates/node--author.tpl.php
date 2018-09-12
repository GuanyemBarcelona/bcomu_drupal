<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
  <?php if ($view_mode == 'teaser' || $view_mode == 'highlighted') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
      <div class="content">
        <a href="<?php print $node_url; ?>">
          <?php print render($content['field_image']); ?>

          <h2><?php print $title; ?></h2>

          <?php print render($content['body']); ?>
        </a>
      </div>
  <?php } else if ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <div class="content">
    <div class="column-left">
      <?php print render($content['field_image']); ?>

      <h1><?php print $title; ?></h1>

      <?php print render($content['body']); ?>
    </div>

    <div class="column-right">
      <?php print $author_posts; ?>
    </div>
  </div>
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->
