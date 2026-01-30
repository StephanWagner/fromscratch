<?php

function fromscratch_should_show_installer(): bool
{
  if (get_option('fromscratch_installed')) {
    return false;
  }

  if (get_option('fromscratch_install_skipped')) {
    return false;
  }

  return true;
}

add_action('admin_menu', function () {
  if (!fromscratch_should_show_installer()) {
    return;
  }

  add_theme_page(
    fs_t('INSTALL_MENU_TITLE'),
    fs_t('INSTALL_MENU_TITLE'),
    'manage_options',
    'fromscratch-install',
    'fromscratch_render_installer'
  );
});

add_action('admin_notices', function () {
  if (!fromscratch_should_show_installer()) {
    return;
  }

  $screen = get_current_screen();
  if ($screen && $screen->id === 'appearance_page_fromscratch-install') {
    return;
  }

  echo '<div class="notice notice-warning">';
  echo '<p><strong>' . fs_t('INSTALL_NOTICE_TITLE') . '</strong></p>';
  echo '<p>' . fs_t('INSTALL_NOTICE_DESCRIPTION') . '</p>';
  echo '<p>';
  echo '<a href="' . esc_url(admin_url('themes.php?page=fromscratch-install')) . '" class="button button-primary">' . fs_t('INSTALL_NOTICE_BUTTON_GO_TO_INSTALLER') . '</a> ';
  echo '<a href="' . esc_url(wp_nonce_url(
    admin_url('themes.php?page=fromscratch-install&fromscratch_skip=1'),
    'fromscratch_skip'
  )) . '" class="button">' . fs_t('INSTALL_NOTICE_BUTTON_SKIP_SETUP') . '</a>';
  echo '</p>';
  echo '</div>';
});


function fromscratch_render_installer()
{
  if (!current_user_can('manage_options')) {
    return;
  }

?>
  <div class="wrap">
    <h1><?= fs_t('INSTALL_TITLE') ?></h1>

    <p>
      <?= fs_t('INSTALL_DESCRIPTION') ?>
    </p>

    <form method="post">
      <?php wp_nonce_field('fromscratch_install'); ?>

      <table class="form-table" role="presentation">

        <!-- Theme name and description -->

        <tr>
          <th scope="row">
            <label>
              <?= fs_t('INSTALL_THEME_NAME_TITLE') ?>
            </label>
          </th>
          <td>
            <input type="text" name="theme[name]" value="<?= fs_t('INSTALL_THEME_NAME_FORM_TITLE') ?>" class="regular-text">
          </td>
        </tr>
          <th scope="row">
            <label>
              <?= fs_t('INSTALL_THEME_SLUG_TITLE') ?>
            </label>
          </th>
          <td>
            <input type="text" name="theme[slug]" value="<?= fs_t('INSTALL_THEME_SLUG_FORM_SLUG') ?>" class="regular-text">
          </td>
        </tr>
        <tr>
          <th scope="row">
            <label>
              <?= fs_t('INSTALL_THEME_DESCRIPTION_TITLE') ?>
            </label>
          </th>
          <td>
            <input type="text" name="theme[description]" value="<?= fs_t('INSTALL_THEME_DESCRIPTION_FORM_DESCRIPTION') ?>" class="regular-text">
          </td>
        </tr>

        <!-- Media sizes -->
        <tr>
          <th scope="row">
            <label>
              <input type="checkbox" name="install[media]" checked>
              <?= fs_t('INSTALL_MEDIA_SIZES_TITLE') ?>
            </label>
          </th>
          <td>
            <input type="number" name="media[medium]" value="600" class="small-text"> px
            <input type="number" name="media[large]" value="1200" class="small-text"> px
            <input type="number" name="media[full]" value="2400" class="small-text"> px
            <p class="description">
              <?= fs_t('INSTALL_MEDIA_SIZES_DESCRIPTION') ?>
            </p>
          </td>
        </tr>

        <!-- Permalinks -->
        <tr>
          <th scope="row">
            <label>
              <input type="checkbox" name="install[permalinks]" checked>
              <?= fs_t('INSTALL_PERMALINKS_TITLE') ?>
            </label>
          </th>
          <td>
            <p class="description">
              <?= fs_t('INSTALL_PERMALINKS_DESCRIPTION') ?>
            </p>
          </td>
        </tr>

        <!-- Pages -->
        <tr>
          <th scope="row">
            <label>
              <input type="checkbox" name="install[pages]" checked>
              <?= fs_t('INSTALL_PAGES_TITLE') ?>
            </label>
          </th>
          <td>

            <table class="widefat striped" style="max-width: 600px">
              <thead>
                <tr>
                  <td><b><?= fs_t('INSTALL_PAGES_TABLE_HEADING_PAGE') ?></b></td>
                  <td><b><?= fs_t('INSTALL_PAGES_TABLE_HEADING_TITLE') ?></b></td>
                  <td><b><?= fs_t('INSTALL_PAGES_TABLE_HEADING_SLUG') ?></b></td>
                </tr>
              </thead>
              <tbody>

                <tr>
                  <td><strong><?= fs_t('INSTALL_PAGES_HOMEPAGE_TITLE') ?></strong></td>
                  <td>
                    <input
                      type="text"
                      name="pages[homepage][title]"
                      value="<?= fs_t('INSTALL_PAGES_HOMEPAGE_FORM_TITLE') ?>"
                      class="regular-text" style="width: 180px">
                  </td>
                  <td>
                    <input
                      type="text"
                      name="pages[homepage][slug]"
                      value="<?= fs_t('INSTALL_PAGES_HOMEPAGE_FORM_SLUG') ?>"
                      class="regular-text" style="width: 180px">
                  </td>
                </tr>

                <tr>
                  <td><strong><?= fs_t('INSTALL_PAGES_CONTACT_TITLE') ?></strong></td>
                  <td>
                    <input
                      type="text"
                      name="pages[contact][title]"
                      value="<?= fs_t('INSTALL_PAGES_CONTACT_FORM_TITLE') ?>"
                      class="regular-text" style="width: 180px">
                  </td>
                  <td>
                    <input
                      type="text"
                      name="pages[contact][slug]"
                      value="<?= fs_t('INSTALL_PAGES_CONTACT_FORM_SLUG') ?>"
                      class="regular-text" style="width: 180px">
                  </td>
                </tr>

                <tr>
                  <td><strong><?= fs_t('INSTALL_PAGES_IMPRINT_TITLE') ?></strong></td>
                  <td>
                    <input
                      type="text"
                      name="pages[imprint][title]"
                      value="<?= fs_t('INSTALL_PAGES_IMPRINT_FORM_TITLE') ?>"
                      class="regular-text" style="width: 180px">
                  </td>
                  <td>
                    <input
                      type="text"
                      name="pages[imprint][slug]"
                      value="<?= fs_t('INSTALL_PAGES_IMPRINT_FORM_SLUG') ?>"
                      class="regular-text" style="width: 180px">
                  </td>
                </tr>

                <tr>
                  <td><strong><?= fs_t('INSTALL_PAGES_PRIVACY_TITLE') ?></strong></td>
                  <td>
                    <input
                      type="text"
                      name="pages[privacy][title]"
                      value="<?= fs_t('INSTALL_PAGES_PRIVACY_FORM_TITLE') ?>"
                      class="regular-text" style="width: 180px">
                  </td>
                  <td>
                    <input
                      type="text"
                      name="pages[privacy][slug]"
                      value="<?= fs_t('INSTALL_PAGES_PRIVACY_FORM_SLUG') ?>"
                      class="regular-text" style="width: 180px">
                  </td>
                </tr>

              </tbody>
            </table>

            <p class="description">
              <?= fs_t('INSTALL_PAGES_DESCRIPTION') ?>
            </p>

          </td>
        </tr>



        <!-- Menus -->
        <tr>
          <th scope="row">
            <label>
              <input type="checkbox" name="install[menus]" checked>
              <?= fs_t('INSTALL_MENUS_TITLE') ?>
            </label>
          </th>
          <td>
            <?= fs_t('INSTALL_MENUS_DESCRIPTION') ?>
          </td>
        </tr>

      </table>

      <p>
        <button class="button button-primary" name="fromscratch_run_install">
          <?= fs_t('INSTALL_RUN_SETUP_BUTTON') ?>
        </button>

        <a
          href="<?php echo esc_url(
                  wp_nonce_url(
                    admin_url('themes.php?page=fromscratch-install&fromscratch_skip=1'),
                    'fromscratch_skip'
                  )
                ); ?>"
          class="button">
          <?= fs_t('INSTALL_SKIP_SETUP_BUTTON') ?>
        </a>
      </p>
    </form>
  </div>
<?php
}

/**
 * Skip FromScratch installation
 */
add_action('admin_init', function () {

  // Debug
  // update_option('fromscratch_install_skipped', false);

  if (
    isset($_GET['fromscratch_skip']) &&
    $_GET['fromscratch_skip'] === '1' &&
    check_admin_referer('fromscratch_skip')
  ) {
    update_option('fromscratch_install_skipped', true);

    wp_safe_redirect(
      admin_url('themes.php')
    );
    exit;
  }
});

/**
 * Run FromScratch installation
 */

if (isset($_POST['fromscratch_run_install'])) {
  check_admin_referer('fromscratch_install');

  fromscratch_run_install();

  echo '<div class="notice notice-success"><p>FromScratch installation completed.</p></div>';
}

function fromscratch_run_install()
{

  // --- 1. Media sizes ----------------------------------------

  update_option('medium_size_w', 600);
  update_option('large_size_w', 1200);
  update_option('big_image_size_threshold', 2400);

  // --- 2. Permalinks -----------------------------------------

  //   global $wp_rewrite;

  //   if ($wp_rewrite->permalink_structure !== '/%postname%/') {
  //     $wp_rewrite->set_permalink_structure('/%postname%/');
  //     flush_rewrite_rules();
  //   }

  //   // --- 3. Required pages -------------------------------------

  //   $pages = [
  //     'imprint' => 'Imprint',
  //     'privacy' => 'Privacy',
  //     'contact' => 'Contact',
  //   ];

  //   $page_ids = [];

  //   foreach ($pages as $slug => $title) {
  //     $page_ids[$slug] = fromscratch_ensure_page($slug, $title);
  //   }

  //   // --- 4. Home page ------------------------------------------

  //   $home_id = fromscratch_ensure_page('home', 'Home');

  //   if (
  //     $home_id &&
  //     !get_post_meta($home_id, '_fromscratch_home_initialized', true)
  //   ) {

  //     $content = <<<HTML
  // <!-- wp:heading -->
  // <h1>Welcome to FromScratch</h1>
  // <!-- /wp:heading -->

  // <!-- wp:paragraph -->
  // <p>This page was created by the FromScratch installer and contains example blocks.</p>
  // <!-- /wp:paragraph -->

  // <!-- wp:columns -->
  // <div class="wp-block-columns">
  //   <!-- wp:column -->
  //   <div class="wp-block-column">
  //     <!-- wp:paragraph -->
  //     <p>Column one</p>
  //     <!-- /wp:paragraph -->
  //   </div>
  //   <!-- /wp:column -->

  //   <!-- wp:column -->
  //   <div class="wp-block-column">
  //     <!-- wp:paragraph -->
  //     <p>Column two</p>
  //     <!-- /wp:paragraph -->
  //   </div>
  //   <!-- /wp:column -->
  // </div>
  // <!-- /wp:columns -->
  // HTML;

  //     wp_update_post([
  //       'ID'           => $home_id,
  //       'post_content' => $content,
  //     ]);

  //     update_post_meta($home_id, '_fromscratch_home_initialized', 1);
  //   }

  //   // Set static front page if not set yet
  //   if (get_option('show_on_front') !== 'page') {
  //     update_option('show_on_front', 'page');
  //     update_option('page_on_front', $home_id);
  //   }

  //   // --- 5. Menus ----------------------------------------------

  //   $menu_name = 'Main Menu';
  //   $menu = wp_get_nav_menu_object($menu_name);

  //   if (!$menu) {
  //     $menu_id = wp_create_nav_menu($menu_name);
  //   } else {
  //     $menu_id = $menu->term_id;
  //   }

  //   // Assign menu to primary location if available
  //   $locations = get_theme_mod('nav_menu_locations', []);
  //   if (isset($locations['primary']) === false) {
  //     $locations['primary'] = $menu_id;
  //     set_theme_mod('nav_menu_locations', $locations);
  //   }

  //   // Add menu items (Home + Contact) if missing
  //   fromscratch_ensure_menu_item($menu_id, $home_id);
  //   fromscratch_ensure_menu_item($menu_id, $page_ids['contact'] ?? null);

  //   // --- 6. Mark as installed ----------------------------------

  //   update_option('fromscratch_installed', true);
  //   delete_option('fromscratch_install_skipped');
}

/**
 * Ensure a page exists by slug
 */
// function fromscratch_ensure_page(string $slug, string $title): int
// {
//   $page = get_page_by_path($slug);

//   if ($page) {
//     return (int) $page->ID;
//   }

//   return (int) wp_insert_post([
//     'post_type'   => 'page',
//     'post_status' => 'publish',
//     'post_title'  => $title,
//     'post_name'   => $slug,
//   ]);
// }

/**
 * Ensure a menu item exists for a page
 */
// function fromscratch_ensure_menu_item(int $menu_id, ?int $page_id): void
// {
//   if (!$page_id) {
//     return;
//   }

//   $items = wp_get_nav_menu_items($menu_id);

//   if ($items) {
//     foreach ($items as $item) {
//       if ((int) $item->object_id === $page_id) {
//         return; // already exists
//       }
//     }
//   }

//   wp_update_nav_menu_item($menu_id, 0, [
//     'menu-item-object-id' => $page_id,
//     'menu-item-object'    => 'page',
//     'menu-item-type'      => 'post_type',
//     'menu-item-status'    => 'publish',
//   ]);
// }
