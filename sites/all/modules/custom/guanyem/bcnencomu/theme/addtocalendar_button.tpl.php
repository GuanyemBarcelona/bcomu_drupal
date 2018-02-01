<a data-action="add-to-calendar-open" data-fancybox data-src="#addtocalendar-popup-<?php print $data['id'] ?>" href="javascript:;">
  <?php print t("Add to Calendar"); ?>
</a>
<div style="display: none;" class="add-to-calendar-popup" id="addtocalendar-popup-<?php print $data['id'] ?>">
  <h2><?php print t("Add this event to your Calendar"); ?></h2>
  <?php foreach ($data['services'] as $service) { ?>
    <a href="<?php print $service['uri']; ?>" target="_blank" data-action="add-to-calendar" data-type="<?php print $service['slug']; ?>"><?php print $service['name']; ?></a>
  <?php } ?>
</div>