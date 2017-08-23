<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
  <?php if ($view_mode == 'teaser' || $view_mode == 'slider') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
  <?php if (isset($teaser_image)){ ?>
  <div class="image">
    <?php if (empty($content['field_link'])){ ?>
    <?php print $teaser_image; ?> <?php // if does not have a link, print just the image ?>
    <?php }else{ ?>               <?php // else ?>
    <?php if (!$hide_button){ ?>  <?php //   if we must show a button, print the image and the button ?>
    <?php print $teaser_image; ?> 
    <?php print render($content['field_link']); ?>
    <?php }else{ ?>               <?php //   else, print a linked image ?>
    <a href="<?php print $content['field_link']['#items'][0]['display_url']; ?>"<?php if ($external_link){ ?> rel="external"<?php } ?>>
      <?php print $teaser_image; ?>
    </a>
    <?php } ?>
    <?php } ?>
  </div>
  <?php } ?>
  <?php } else if ($view_mode == 'highlighted') { ?>
  <h2><?php print $title; ?></h2>
  <div class="summary">
    <?php if (isset($node_body_html)) { ?>
    <?php print $node_body_html; ?>
    <?php } ?>
  </div>
  <?php print render($content['field_link']); ?>
  <?php if (isset($teaser_image)){ ?>
  <div class="image"><?php print $teaser_image; ?></div>
  <?php } ?>
  <?php } else if ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <?php // There is no full ?>
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->