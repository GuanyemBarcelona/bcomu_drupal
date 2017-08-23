<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
  <?php if ($view_mode == 'teaser' || $view_mode == 'highlighted') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
  <?php // there is no teaser ?>
  <?php } else if ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <header>
    <?php if (isset($share_links)){ ?>
      <?php print $share_links; ?>
    <?php } ?>
    <?php if (isset($title)) { ?>
    <h1><?php print $title; ?></h1>
    <?php } ?>
    <?php print $back_link; ?>
  </header>
  <div class="content">
    <?php 
      hide($content['comments']);
      hide($content['links']);
      hide($content['field_grup_email']);
      hide($content['field_grup_web']);
      hide($content['field_grup_facebook']);
      hide($content['field_grup_twitter']);
      print render($content);
     ?>

    <aside class="extra-links">
      <?php print render($content['field_grup_email']); ?>
      <?php if (isset($web_link)){ ?>
      <div class="field field-name-field-grup-web">
        <div class="field-item">
          <?php print $web_link; ?>
        </div>
      </div>
      <?php } ?>
      <?php if (isset($facebook_link)){ ?>
      <div class="field field-name-field-grup-facebook">
        <div class="field-item">
          <?php print $facebook_link; ?>
        </div>
      </div>
      <?php } ?>
      <?php if (isset($twitter_link)){ ?>
      <div class="field field-name-field-grup-twitter">
        <div class="field-item">
          <?php print $twitter_link; ?>
        </div>
      </div>
      <?php } ?>
    </aside>
  </div>
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->