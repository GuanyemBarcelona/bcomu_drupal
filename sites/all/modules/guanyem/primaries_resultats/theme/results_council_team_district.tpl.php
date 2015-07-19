<article class="node primaries-resultats equip-consellers-resultats" data-type="detail">
  <header>
    <h1><?php print t("CONSELLERS_EQUIP_TITOL", array(), array('context' => 'Equips Consellers: resultats')); ?>: <?php print $voting['district_name']; ?></h1>
  </header>
  <div class="content">
    <a data-action="go-back" href="<?php print $voting['map_uri']; ?>"><i class="fa fa-chevron-circle-left"></i> <?php print t("Back to the map", array(), array('context' => 'Primaries: resultats')); ?></a>
    <div class="info">
      <p><?php print t("RESULTS_DISCLAIMER", array(), array('context' => 'Equips Consellers: resultats')); ?></p>
    </div>
    <?php foreach ($voting['subvotings'] as $key2 => $neighbourhood_voting) { ?>
      <?php if (count($neighbourhood_voting['answers']) > 0){ ?>
      <?php if ($key2 == 'substitutes'){ ?>
      <h2><?php print t("Substitutes", array(), array('context' => 'Equips Consellers: resultats')); ?></h2>
      <?php } ?>
      <section class="voting-options" data-type="<?php print $key2; ?>">
        <table border="1" cellpadding="1" cellspacing="1" width="100%">
          <thead>
            <tr>
              <th width="5%">#</th>
              <th width="10%"></th>
              <th width="30%"><?php print t("Name", array(), array('context' => 'Equips Consellers: resultats')); ?></th>
              <th width="30%"><?php print t("Team", array(), array('context' => 'Equips Consellers: resultats')); ?></th>
              <th width="15%"><?php print t("Points", array(), array('context' => 'Primaries: resultats')); ?></th>
              <th width="10%"><?php print t("Percentage", array(), array('context' => 'Primaries: resultats')); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($neighbourhood_voting['answers'] as $key3 => $option) { ?>
            <tr<?php if ($key3 > $neighbourhood_voting['max']){ ?> class="disabled"<?php } ?>>
              <td class="position"><?php print($key3 + 1); ?></td>
              <td class="portrait"><a href="<?php print $option['link']; ?>" rel="external"><img src="<?php print $option['image_uri']; ?>" alt=""></a></td>
              <td class="name"><h2><a href="<?php print $option['link']; ?>" rel="external"><?php print $option['text']; ?></a></h2></td>
              <td class="team"><?php print $option['category']; ?></td>
              <td class="count"><?php print $option['total_count']; ?></td>
              <td class="percent"><?php print $option['percent']; ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </section>
      <section class="blank-option">
        <div class="voting-option">
          <div class="content">
            <h2><?php print t("Blank votes", array(), array('context' => 'Primaries: resultats')); ?></h2>
          </div>
          <dl class="results">
            <dt class="votes"><?php print t("Votes", array(), array('context' => 'Primaries: resultats')); ?>:</dt>
            <dd class="votes"><?php print $neighbourhood_voting['blank']['total_count']; ?></dd>
            <dt class="percent"><?php print t("Percentage", array(), array('context' => 'Primaries: resultats')); ?>:</dt>
            <dd class="percent"><?php print $neighbourhood_voting['blank']['percent']; ?></dd>
          </dl>
        </div>
      </section>
      <?php }else{ ?>
      <p class="empty"><?php print t("No voting was made on this topic", array(), array('context' => 'Primaries: resultats')); ?></p>
      <?php } ?>
    <?php } ?>
    <section class="general">
      <p class="total-votes"><?php print t("Total votes", array(), array('context' => 'Primaries: resultats')); ?>: <span class="votes"><?php print $voting['total_votes']; ?></span></p>
      <a data-action="verify-voting" href="<?php print $voting['verify_uri']; ?>" rel="external"><?php print t("Verify the results of this voting", array(), array('context' => 'Primaries: resultats')); ?></a>
    </section>
  </div>
</article>