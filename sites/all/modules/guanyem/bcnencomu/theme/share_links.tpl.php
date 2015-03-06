<div class="share-links">
  <ul>
    <?php foreach ($list as $key => $item) { ?>
    <li><a href="<?php print $item['share_url']; ?><?php print $current_url; ?>" data-social-network="<?php print $item['machine_name']; ?>" title="<?php print $item['description']; ?>"><i class="fa <?php print $item['fa_name']; ?>"></i> <span class="label"><?php print $item['label']; ?></span> <span class="count"></span></a></li>
    <?php } ?>
  </ul>
</div>