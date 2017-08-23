<div id="page" class="<?php print $classes; ?>"<?php print $attributes; ?>>

	<header role="banner">
    <div class="inner">
    <?php if ($logo): $title_tag = ($is_front)? 'h1' : 'h2'; ?>
    <<?php print $title_tag ?> id="site-logo">
      <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home">
        <img src="<?php print $logo; ?>" alt="<?php print t('Logo'); ?>"/>
      </a>
    </<?php print $title_tag ?>>
    <?php endif; ?>
    <?php if ($page['header']): ?>
      <div id="header-region">
        <?php print render($page['header']); ?>
      </div>
    <?php endif; ?>
    </div>
  </header> <!-- /header -->

	<div id="main" role="main">
    <div class="inner">
      <div id="content">
        <div id="content-inner" class="inner column center">
        	<?php if (isset($error)): ?>
        		<div class="messages status error-page">
        			<h2><?php print $error['info']; ?></h2>
        			<?php print render($page['content']) ?>
        			<?php /*<a href="<?php print $front_page; ?>"><?php print t("Go back to frontpage"); ?></a> */ ?>
        		</div>
        	<?php endif; ?>
        </div>
      </div>
    </div>
	</div>

</div> <!-- /page -->