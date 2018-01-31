<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
  <?php if ($view_mode == 'teaser') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
  <?php // No teaser ?>
  <?php } else if ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <?php if (isset($title)){ ?>
  <header>
    <h1<?php print $title_attributes; ?>><?php print $title; ?></h1>
  </header>
  <?php } ?>
  <div class="content">
    <?php if (isset($content['field_image'])){ ?>
      <div class="image">
        <?php print render($content['field_image']); ?>
      </div>
    <?php } ?>

    <div class="content-fields">
      <?php print render($content['field_date']); ?>

      <div class="field field-hour-range field-label-inline clearfix">
        <div class="field-label"><?php print t("Hour"); ?>:&nbsp;</div>
        <div class="field-items">
          <div class="field-item even">
            <?php print $hour_range; ?>
          </div>
        </div>
      </div>

      <?php print render($content); ?>
    </div>
  </div>
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->