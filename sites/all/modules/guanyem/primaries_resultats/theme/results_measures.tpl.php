<article class="node primaries-resultats" data-voting-type="measures">
  <header>
    <h1><?php print t("Primàries: Priorització de mesures", array(), array('context' => 'Primaries: resultats')); ?></h1>
  </header>
  <div class="content">
    <?php if (count($voting['answers']) > 0){ ?>
    <section class="voting-options">
      <table border="1" cellpadding="1" cellspacing="1" width="100%">
        <thead>
          <tr>
            <th width="5%">#</th>
            <th width="70%"><?php print t("Title", array(), array('context' => 'Primaries: resultats')); ?></th>
            <th width="15%"><?php print t("Number of votes", array(), array('context' => 'Primaries: resultats')); ?></th>
            <th width="10%"><?php print t("Percentage", array(), array('context' => 'Primaries: resultats')); ?></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($voting['answers'] as $key2 => $option) { ?>
          <?php //kpr($option); ?>
          <tr>
            <td><?php print($key2 + 1); ?></td>
            <td><h2><?php print $option['text']; ?></h2></td>
            <td><?php print $option['total_count']; ?></td>
            <td><?php print $option['percent']; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </section>
    <section class="blank-option">
      <div class="voting-option">
        <div class="image">
          
        </div>
        <div class="content">
          <h2><?php print t("Blank vote", array(), array('context' => 'Primaries: resultats')); ?></h2>
        </div>
        <dl class="results">
          <dt class="votes"><?php print t("Votes", array(), array('context' => 'Primaries: resultats')); ?>:</dt>
          <dd class="votes"><?php print $voting['blank']['total_count']; ?></dd>
          <dt class="percent"><?php print t("Percent", array(), array('context' => 'Primaries: resultats')); ?>:</dt>
          <dd class="percent"><?php print $voting['blank']['percent']; ?></dd>
        </dl>
      </div>
    </section>
    <?php }else{ ?>
    <p class="empty"><?php print t("No voting was made on this topic", array(), array('context' => 'Primaries: resultats')); ?></p>
    <?php } ?>
  </div>
</article>