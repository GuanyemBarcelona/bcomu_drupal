<?php $tag = ($view_mode != 'full')? 'div' : 'article'; ?>
<<?php print $tag; ?> id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?>">
  <?php if ($view_mode == 'teaser' || $view_mode == 'highlighted') { ?>
  <?php /* ----------------- TEASER DISPLAY ----------------- */ ?>
      <div class="content">
        <?php if (isset($category)){ ?>
        <?php print $category; ?>
        <?php } ?>

        <a href="<?php print $node_url; ?>">
            <?php if (isset($teaser_image)){ ?>
                <div class="image">
                    <?php print $teaser_image; ?>
                </div>
            <?php } ?>

            <h2><?php print $title; ?></h2>

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
    <?php if (isset($hashtag)){ ?>
    <p class="hashtag"><?php print $hashtag; ?></p>
    <?php } ?>

    <h1><?php print $title; ?></h1>

    <aside class="info">
        <?php if (isset($category)){ ?>
            <?php print $category; ?>
        <?php } ?>

        <time datetime="<?php print $date['machine']; ?>"><?php print $date['human']; ?></time>

        <?php if (isset($share_links)){ ?>
            <?php print $share_links; ?>
        <?php } ?>
    </aside>

    <?php if (isset($lead)){ ?>
    <h2 class="lead"><?php print $lead; ?></h2>
    <?php } ?>
  </header>
  <div class="content">
    <?php /*if (isset($image_gallery)){ ?>
      <?php print $image_gallery; ?>
    <?php }*/ ?>

    <div class="body">
      <?php if (isset($node_body_html)) { ?>
      <?php print $node_body_html; ?>
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