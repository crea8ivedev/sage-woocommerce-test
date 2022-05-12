<!doctype html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
    <?php wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <?php do_action('get_header'); ?>

    <div id="app">
      <?php echo view(app('sage.view'), app('sage.data'))->render(); ?>
    </div>

    <?php do_action('get_footer'); ?>
    <?php wp_footer(); ?>
    <button class="btn-back-top hidden fixed right-5 bottom-5 bg-white text-gray-100 rounded-lg text-center p-2 hover:bg-slate-100 hover:text-blue-100" type="button">
        <svg aria-hidden="true" focusable="false" width="17" height="18" viewBox="0 0 17 18" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.5 9.462L8.538 4.573L3.5 9.462" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
            <path d="M8.5 4.683V16.424" stroke="currentColor" stroke-width="2" stroke-miterlimit="10" stroke-linecap="round"/>
            <path d="M1 1H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
    </button>
  </body>
</html>
