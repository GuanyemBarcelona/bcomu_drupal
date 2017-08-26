<?php if (!$is_format_ajax && !$is_format_oasis): ?>
<div id="page" class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <header role="banner">
    <div class="inner">
      <?php if ($page['header_top']): ?>
      <?php print render($page['header_top']); ?>
      <?php endif; ?>

      <?php if (isset($logo)){ $title_tag = ($is_front)? 'h1' : 'h2'; ?>
      <<?php print $title_tag ?> id="site-logo">
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
          <img src="<?php print $logo; ?>" alt="<?php print t('Logo'); ?>"/>
        </a>
      </<?php print $title_tag ?>>
      <?php } ?>

      <?php if ($page['header']): ?>
        <?php print render($page['header']); ?>
      <?php endif; ?>

      <?php if ($site_slogan){ ?>
      <div class="slogan-container">
        <p class="slogan"><?php print $site_slogan; ?></p>
      </div>
      <?php } ?>
    </div>
  </header> <!-- /header -->
  <div id="main" role="main">
    <div class="inner">
      <?php if ($page['highlighted']): ?>
      <div id="highlighted">
        <?php print render($page['highlighted']) ?>
      </div> <!-- /#highlighted -->
      <?php endif; ?>
      <div id="content">
        <div id="content-inner" class="inner column center">
          <?php if ($page['content_top']): ?>
          <div id="content-top">
            <?php print render($page['content_top']) ?>
          </div> <!-- /#content-top -->
          <?php endif; ?>
          <?php if ($breadcrumb || ($title && $must_show_title) || $messages || $page['help'] || ($tabs['#primary'] && user_access('access site in maintenance mode')) || $action_links){ ?>
          <div id="content-header">
            <?php print $breadcrumb; ?>
            <?php if ($title && $must_show_title): ?>
            <h1 class="title"><?php print $title; ?></h1>
            <?php endif; ?>
            <?php print $messages; ?>
            <?php print render($page['help']); ?>
            <?php if ($tabs['#primary'] && user_access('access site in maintenance mode')): ?>
            <div class="tabs"><?php print render($tabs); ?></div>
            <?php endif; ?>
            <?php if ($action_links): ?>
            <div class="action-links"><ul><?php print render($action_links); ?></ul></div>
            <?php endif; ?>
          </div> <!-- /#content-header -->
          <?php } ?>
          <div id="content-area">
            <?php print render($page['content']) ?>
          </div> <!-- /#content-area -->
          <?php //print $feed_icons; ?>
          <?php if ($page['content_bottom']): ?>
          <div id="content-bottom">
            <?php print render($page['content_bottom']) ?>
          </div> <!-- /#content-bottom -->
          <?php endif; ?>
        </div> <!-- /content-inner -->
        <?php if ($page['sidebar_first']): ?>
          <aside id="sidebar-first" class="column sidebar first">
            <div id="sidebar-first-inner" class="inner">
              <?php print render($page['sidebar_first']); ?>
            </div>
          </aside> <!-- /sidebar-first -->
        <?php endif; ?>
      </div> <!-- /content -->
    </div>
  </div> <!-- /main -->
  <?php if ($page['footer_top'] || $page['footer']): ?>
  <footer role="contentinfo">
    <?php if ($page['footer_top']): ?>
    <?php print render($page['footer_top']); ?>
    <?php endif; ?>
    <?php if ($page['footer']): ?>
    <?php print render($page['footer']); ?>
    <?php endif; ?>
  </footer> <!-- /footer -->
  <?php endif; ?>
</div> <!-- /page -->
<?php else: ?>
  <?php print render($page['content']) ?>
<?php endif;
