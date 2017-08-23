<div class="image-gallery<?php if (!isset($images) || count($images) == 0) echo ' empty'; ?>">
<?php if (isset($images)){ ?>
  <?php if (!$thumbs){ ?>
  <div class="image-list">
  <?php }else{ ?>
  <div class="full-image"></div>
  <div class="thumb-list">
  <?php } ?>
  <?php foreach ($images as $key => $image) { ?>
    <?php if (isset($image['full_html'])){ ?>
    <div class="full-image">
      <figure>
        <?php print $image['full_html']; ?>
        <?php if (isset($image['caption'])){ ?>
        <figcaption>
          <?php print $image['caption']; ?>
        </figcaption>
        <?php } ?>
      </figure>
    </div>
    <?php }else{ ?>
    <div class="thumb image">
      <?php print $image['thumb_html']; ?>
      <?php if (isset($image['caption'])){ ?>
      <div class="thumb-caption">
        <?php print $image['caption']; ?>
      </div>
      <?php } ?>
    </div>
    <?php } ?>
  <?php } ?>
  </div>
<?php } ?>
</div>