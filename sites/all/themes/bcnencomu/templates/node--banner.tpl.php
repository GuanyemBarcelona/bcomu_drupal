<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
  <?php if ($view_mode == 'teaser' || $view_mode == 'slider' || $view_mode == 'highlighted') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
  <?php if (isset($teaser_image)){ ?>
  <div class="image">
    <?php if (!isset($link_uri)){ ?>
    <?php print $teaser_image; ?> <?php // if does not have a link, print just the image ?>
    <?php }else{ ?>               <?php // else ?>
    <?php if (!$hide_button){ ?>  <?php //   if we must show a button, print the image and the button ?>
    <?php print $teaser_image; ?> 
    <a href="<?php print $link_uri; ?>" title="<?php print t("Read more"); ?>" data-action="read-more"<?php if ($external_link){ ?> rel="external"<?php } ?>><?php print t("Read more"); ?></a>
    <?php }else{ ?>               <?php //   else, print a linked image ?>
    <a href="<?php print $link_uri; ?>"<?php if ($external_link){ ?> rel="external"<?php } ?>>
      <?php print $teaser_image; ?>
    </a>
    <?php } ?>
    <?php } ?>
  </div>
  <?php } ?>
  <?php } else if ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <?php // There is no full ?>
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->