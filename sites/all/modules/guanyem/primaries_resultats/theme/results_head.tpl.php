<article class="node primaries-resultats" data-voting-type="head">
  <header>
    <h1><?php print t("Primàries: cap de llista amb equip de govern", array(), array('context' => 'Primaries: resultats')); ?></h1>
  </header>
  <div class="content">
    <?php if (count($voting['answers']) > 0){ ?>
    <section class="voting-options">
    <?php foreach ($voting['answers'] as $key => $option) { ?>
    <?php //kpr($option); ?>
      <div class="voting-option<?php if ($key == 0){ ?> voting-winner<?php } ?>">
        <div class="image">
          <a href="<?php print $option['urls'][0]['url']; ?>"><img src="<?php print $option['urls'][1]['url']; ?>" /></a>
        </div>
        <div class="content">
          <h2><a href="<?php print $option['urls'][0]['url']; ?>"><?php print $option['text']; ?></a></h2>
        </div>
        <dl class="results">
          <dt class="votes"><?php print t("Votes", array(), array('context' => 'Primaries: resultats')); ?>:</dt>
          <dd class="votes"><?php print $option['total_count']; ?></dd>
          <dt class="percent"><?php print t("Percentage", array(), array('context' => 'Primaries: resultats')); ?>:</dt>
          <dd class="percent"><?php print $option['percent']; ?></dd>
        </dl>
      </div>
    <?php } ?>
    </section>
    <section class="blank-option">
      <div class="voting-option">
        <div class="content">
          <h2><?php print t("Blank vote", array(), array('context' => 'Primaries: resultats')); ?></h2>
        </div>
        <dl class="results">
          <dt class="votes"><?php print t("Votes", array(), array('context' => 'Primaries: resultats')); ?>:</dt>
          <dd class="votes"><?php print $voting['blank']['total_count']; ?></dd>
          <dt class="percent"><?php print t("Percentage", array(), array('context' => 'Primaries: resultats')); ?>:</dt>
          <dd class="percent"><?php print $voting['blank']['percent']; ?></dd>
        </dl>
      </div>
    </section>
    <?php }else{ ?>
    <p class="empty"><?php print t("No voting was made on this topic", array(), array('context' => 'Primaries: resultats')); ?></p>
    <?php } ?>
  </div>
</article>