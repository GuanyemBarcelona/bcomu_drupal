<article class="node primaries-resultats equip-consellers-resultats" data-type="map">
  <header>
    <h1><?php print t("DISTRICT_TEAMS_TITLE", array(), array('context' => 'Equips Consellers: resultats')); ?></h1>
  </header>
  <div class="content">
    <div data-results-type="map">
      <div class="map">
        <section class="voting-winners">
          <?php foreach ($voting['neighbourhoods'] as $key => $neighbourhood) { ?>
          <?php $option = $neighbourhood['answers'][0]; ?>
          <div class="voting-option voting-winner" data-neighbourhood-id="<?php print $key; ?>">
            <div class="image">
              <a href="<?php print $neighbourhood['detail_uri']; ?>"><img src="<?php print $option['urls'][1]['url']; ?>" /></a>
            </div>
            <aside class="info">
              <h2><a href="<?php print $neighbourhood['detail_uri']; ?>"><?php print $neighbourhood['name']; ?></a></h2>
              <h3><?php print $option['text']; ?></h3>
              <?php if ($neighbourhood['message']){ ?>
              <p class="message"><?php print $neighbourhood['message']; ?></p>
              <?php } ?>
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