<nav class="node-navigation">
  <ul>
    <?php foreach ($links as $key => $link) { ?>
    <li data-dir="<?php print $key; ?>"><?php print $link; ?></li>
    <?php } ?>
  </ul>
</nav>