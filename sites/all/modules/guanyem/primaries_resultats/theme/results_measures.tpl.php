<article class="node primaries-resultats" data-voting-type="measures">
  <header>
    <h1><?php print t("Priorització de mesures", array(), array('context' => 'Primaries: resultats')); ?></h1>
  </header>
  <div class="content">
    <p class="info"><?php print t("MEASURES_INTRO_TEXT", array(), array('context' => 'Primaries: resultats')); ?></p>
    <?php foreach ($voting['measure_blocks'] as $key1 => $measure_block) { ?>
      <h2><?php print $measure_block['name']; ?></h2>
      <?php if (count($measure_block['answers']) > 0){ ?>
      <section class="voting-options">
        <table border="1" cellpadding="1" cellspacing="1" width="100%">
          <thead>
            <tr>
              <th width="5%">#</th>
              <th width="70%"><?php print t("Title", array(), array('context' => 'Primaries: resultats')); ?></th>
              <th width="15%"><?php print t("Points", array(), array('context' => 'Primaries: resultats')); ?></th>
              <th width="10%"><?php print t("Percentage", array(), array('context' => 'Primaries: resultats')); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($measure_block['answers'] as $key2 => $option) { ?>
            <tr<?php if (($key2+1) > $measure_block['max']){ ?> class="disabled"<?php } ?>>
              <td class="position"><?php print($key2 + 1); ?></td>
              <td class="title"><h2><?php print $option['text']; ?></h2></td>
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
            <dd class="votes"><?php print $measure_block['blank']['total_count']; ?></dd>
            <dt class="percent"><?php print t("Percentage", array(), array('context' => 'Primaries: resultats')); ?>:</dt>
            <dd class="percent"><?php print $measure_block['blank']['percent']; ?></dd>
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