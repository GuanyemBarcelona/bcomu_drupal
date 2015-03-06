<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
  <?php if ($view_mode == 'teaser' || $view_mode == 'slider' || $view_mode == 'highlighted') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
  <?php if (isset($teaser_image)){ ?>
  <div class="image">
    <?php if (!$hide_button){ ?>
    <?php print $teaser_image; ?>
    <a href="<?php print $link_uri; ?>" title="<?php print t("Read more"); ?>" data-action="read-more"<?php if ($external_link){ ?> rel="external"<?php } ?>><?php print t("Read more"); ?></a>
    <?php }else{ ?>
    <a href="<?php print $link_uri; ?>"<?php if ($external_link){ ?> rel="external"<?php } ?>>
      <?php print $teaser_image; ?>
    </a>
    <?php } ?>
  </div>
  <?php } ?>
  <?php } else if ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <?php // There is no full ?>
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->