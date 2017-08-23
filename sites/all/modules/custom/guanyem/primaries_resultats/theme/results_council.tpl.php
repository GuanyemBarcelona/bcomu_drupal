<article class="node primaries-resultats" data-voting-type="council">
  <header>
    <h1><?php print t("Conselleres i consellers", array(), array('context' => 'Primaries: resultats')); ?></h1>
  </header>
  <div class="content">
    <div data-results-type="map">
      <div class="map">
        <section class="voting-winners">
          <?php foreach ($voting['neighbourhoods'] as $key => $neighbourhood) { ?>
          <?php $option = $neighbourhood['answers'][0]; ?>
          <div class="voting-option voting-winner" data-neighbourhood-id="<?php print $key; ?>">
            <div class="image">
              <a href="<?php print $option['urls'][0]['url']; ?>"><img src="<?php print $option['urls'][1]['url']; ?>" /></a>
            </div>
            <aside class="info">
              <h3><?php print $neighbourhood['name']; ?></h3>
              <h2><a href="<?php print $option['urls'][0]['url']; ?>"><?php print $option['text']; ?></a></h2>
              <dl class="results">
                <dt class="votes"><?php print t("Votes", array(), array('context' => 'Primaries: resultats')); ?>:</dt>
                <dd class="votes"><?php print $option['total_count']; ?></dd>
                <dt class="percent"><?php print t("Percentage", array(), array('context' => 'Primaries: resultats')); ?>:</dt>
                <dd class="percent"><?php print $option['percent']; ?></dd>
              </dl>
            </aside>
          </div>
          <?php } ?>
        </section>

        <?php if (isset($voting['map'])){ ?>
        <?php print $voting['map']; ?>
        <?php } ?>
      </div>
    </div>
    
  </div>
</article>