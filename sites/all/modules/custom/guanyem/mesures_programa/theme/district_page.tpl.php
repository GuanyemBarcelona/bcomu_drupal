<article class="node node-mesures-programa" data-page-type="<?php print $slug; ?>">
  <header>
    <h1><?php print t($title, array(), array('context' => 'Mesures Programa')); ?>: <?php print $district_title; ?></h1>
  </header>
  <div class="content">
    <a href="<?php print $back_link['uri']; ?>" data-action="go-back"><i class="fa fa-chevron-circle-left"></i> <?php print $back_link['title']; ?></a>
    
    <?php print $measure_list; ?>
  </div>
</article>