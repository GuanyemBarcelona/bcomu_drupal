<div class="social-network-list">
  <ul>
  <?php foreach ($list as $item){ ?>
    <li>
    	<a href="<?php print $item['url']; ?>" title="<?php print $item['name']; ?>" data-social-network="<?php print $item['machine_name']; ?>" rel="external"><i class="fa <?php print $item['fa_name']; ?>"></i> <span><?php print $item['name']; ?></span></a>
    </li>
  <?php } ?>
  </ul>
</div>