<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
  <?php if ($view_mode == 'teaser' || $view_mode == 'highlighted') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
      <div class="content">
        <a href="<?php print $node_url; ?>"<?php if($is_external){ ?> rel="external"<?php } ?>>
            <?php if (isset($category)){ ?>
                <?php print render($category); ?>
            <?php } ?>

            <h2><?php print $title; ?></h2>

            <?php if (isset($teaser_image)){ ?>
              <div class="image">
                <?php print $teaser_image; ?>
              </div>
            <?php } ?>

            <?php if (isset($node_body_summary_html)){ ?>
            <div class="summary">
              <p><?php print $node_body_summary_html; ?></p>
            </div>
            <?php } ?>
        </a>
      </div>
  <?php } else if ($view_mode == 'slider') { ?>
  <?php /* ----------------- SLIDER DISPLAY ----------------- */ ?>
  <?php if (isset($teaser_image)){ ?>
  <div class="image">
  <?php print $teaser_image; ?>
  </div>
  <?php } ?>
  <div class="content">
    <?php if (isset($hashtag)){ ?>
    <p class="hashtag"><?php print $hashtag; ?></p>
    <?php } ?>
    <h2><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
    <?php if (isset($node_body_summary_html)){ ?>
    <div class="summary">
      <p><?php print $node_body_summary_html; ?></p>
      <a href="<?php print $node_url; ?>" title="<?php print t("Read more"); ?>" data-action="read-more"><?php print t("Read more"); ?></a>
    </div>
    <?php } ?>
  </div>
  <?php } else if ($view_mode == 'full') { ?>
  <?php /* ----------------- FULL DISPLAY ----------------- */ ?>
  <header>
    <?php if (!$is_opinion) { ?>
      <time datetime="<?php print $date['machine']; ?>"><?php print $date['human']; ?></time>
    <?php } else { ?>
      <?php print render($content['field_opinion_publish_date']); ?>
    <?php } ?>

    <?php if (isset($hashtag)){ ?>
    <p class="hashtag"><?php print $hashtag; ?></p>
    <?php } ?>

    <h1><?php print $title; ?></h1>

    <aside class="info">
        <div class="categories">
            <?php if (isset($category)){ ?>
              <?php print render($category); ?>
            <?php } ?>

            <?php print render($content['field_fight']); ?>

            <?php print render($content['field_eix_tematic']); ?>
        </div>

        <?php if (isset($share_links)){ ?>
          <?php print $share_links; ?>
        <?php } ?>
    </aside>

    <?php if (isset($lead)){ ?>
    <h2 class="lead"><?php print $lead; ?></h2>
    <?php } ?>
  </header>
  <div class="content">
    <?php if (isset($image_gallery)){ ?>
      <?php print $image_gallery; ?>
    <?php } ?>

    <div class="body">
      <?php if ($is_opinion) { ?>
        <?php print render($content['field_authors']); ?>
      <?php } ?>

      <?php if (isset($node_body_html)) { ?>
        <div class="field-body">
          <?php print $node_body_html; ?>
        </div>
      <?php } ?>
    </div>

    <aside class="bottom-info">
        <?php if (isset($tags)){ ?>
          <?php print $tags; ?>
        <?php } ?>

        <?php if (isset($share_links)){ ?>
          <?php print $share_links; ?>
        <?php } ?>
    </aside>

    <?php if (isset($node_nav)){ ?>
      <?php print $node_nav; ?>
    <?php } ?>
  </div>
  <?php } ?>
</<?php print $tag; ?>> <!-- /node-->
<?php if (isset($content['comments'])){ ?>
<?php print render($content['comments']); ?>
<?php } 