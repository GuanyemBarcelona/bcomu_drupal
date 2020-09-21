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

    <?php print render($content['field_date']); ?>

    <div class="field field-hour-range field-label-inline clearfix">
      <div class="field-items">
        <div class="field-item even">
          <?php print $hour_range; ?>
        </div>
      </div>
    </div>

    <div class="event-district-neighbourhood">
      <?php print render($content['field_district']); ?>
      <?php print render($content['field_neighbourhoods']); ?>
    </div>

    <?php print render($content['field_venue']); ?>

    <?php print render($content['field_geolocation_link']); ?>

    <?php if ($need_enroll){ ?>
      <div class="field field-need-enroll"><?php print t("Cal inscripció"); ?></div>
    <?php } ?>

    <?php print render($content['field_image']); ?>

    <?php print render($content['field_enrollment_url']); ?>

    <?php print render($content['body']); ?>

    <?php if (isset($addtocalendar_button)){ ?>
      <?php print $addtocalendar_button; ?>
    <?php } ?>
  </div>
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->
