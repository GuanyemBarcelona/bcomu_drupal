<div class="social-network-list">
    <ul>
        <?php foreach ($list as $item){ ?>
            <li>
                <a href="<?php print $item['url']; ?>" title="<?php print $item['name']; ?>" data-icon data-social-network="<?php print $item['machine_name']; ?>" rel="<?php print $item['rel']; ?>"><span class="label"><?php print $item['name']; ?></span></a>
            </li>
        <?php } ?>
    </ul>
</div>
