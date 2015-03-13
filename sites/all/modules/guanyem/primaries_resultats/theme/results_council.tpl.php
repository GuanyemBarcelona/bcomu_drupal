<article class="node primaries-resultats" data-voting-type="council">
  <header>
    <h1><?php print t("Primàries: Consellers i conselleres de districte", array(), array('context' => 'Primaries: resultats')); ?></h1>
  </header>
  <div class="content">
    <div data-results-type="map">
      <button class="toggle-view" data-action="see-list"><i class="fa fa-list"></i> <?php print t("List", array(), array('context' => 'Primaries: resultats')); ?></button>
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
    <div data-results-type="list">
      <button class="toggle-view" data-action="see-map"><i class="fa fa-map-marker"></i> <?php print t("Map", array(), array('context' => 'Primaries: resultats')); ?></button>
      <?php foreach ($voting['neighbourhoods'] as $key1 => $neighbourhood) { ?>
      <h2><?php print $neighbourhood['name']; ?></h2>
      <?php if (count($neighbourhood['answers']) > 0){ ?>
      <section class="voting-options">
        <table border="1" cellpadding="1" cellspacing="1" width="100%">
          <thead>
            <tr>
              <th width="5%">#</th>
              <th width="55%"><?php print t("Name", array(), array('context' => 'Primaries: resultats')); ?></th>
              <th width="15%"><?php print t("Picture", array(), array('context' => 'Primaries: resultats')); ?></th>
              <th width="15%"><?php print t("Number of votes", array(), array('context' => 'Primaries: resultats')); ?></th>
              <th width="10%"><?php print t("Percentage", array(), array('context' => 'Primaries: resultats')); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($neighbourhood['answers'] as $key2 => $option) { ?>
            <?php //kpr($option); ?>
            <tr>
              <td class="position"><?php print($key2 + 1); ?></td>
              <td class="title"><h2><a href="<?php print $option['urls'][0]['url']; ?>"><?php print $option['text']; ?></a></h2></td>
              <td class="image">
                <a href="<?php print $option['urls'][0]['url']; ?>"><img src="<?php print $option['urls'][1]['url']; ?>" /></a>
              </td>
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
            <dd class="votes"><?php print $neighbourhood['blank']['total_count']; ?></dd>
            <dt class="percent"><?php print t("Percentage", array(), array('context' => 'Primaries: resultats')); ?>:</dt>
            <dd class="percent"><?php print $neighbourhood['blank']['percent']; ?></dd>
          </dl>
        </div>
      </section>
      <?php }else{ ?>
      <p class="empty"><?php print t("No voting was made on this topic", array(), array('context' => 'Primaries: resultats')); ?></p>
      <?php } ?>
      <?php } ?>
    </div>
  </div>
</article>