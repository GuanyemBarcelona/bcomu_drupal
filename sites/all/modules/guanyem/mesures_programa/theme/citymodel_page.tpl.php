<article class="node node-mesures-programa" data-page-type="<?php print $slug; ?>">
  <header>
    <h1><?php print t($title, array(), array('context' => 'Mesures Programa')); ?>: <?php print $term_title; ?></h1>
  </header>
  <div class="content">
    <a href="<?php print $back_link['uri']; ?>" data-action="go-back"><i class="fa fa-chevron-circle-left"></i> <?php print $back_link['title']; ?></a>
    
    <section data-subtype="city">
      <header>
        <h2><?php print t("City measures", array(), array('context' => 'Mesures Programa')); ?></h2>
      </header>
      <div class="content">
        <?php print $city_list; ?>
      </div>
    </section>
    
    <section data-subtype="district">
      <header>
        <h2><?php print t("District and neighbourhood measures", array(), array('context' => 'Mesures Programa')); ?></h2>
      </header>
      <div class="content">
        <?php print $district_list; ?>
      </div>
    </section>
  </div>
</article>