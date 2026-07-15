<?php

define('THEMEROOT', get_stylesheet_directory_uri());

require_once get_stylesheet_directory() . '/src/Autoloader.php';
\Theme\Autoloader::register();

\Theme\Config\ACFBlocks::init();
\Theme\Config\Plugins\ACFPro\ACFPro::init();
\Theme\Config\GoogleReviews::init();
\Theme\Config\RestAPI::init();
use Theme\Config\Lockdown;
Lockdown::init();

class Theme_Setup
{
    public array $assets_map;
    private ?bool $viteHMRAvailable = null;

    public function __construct()
    {
        $this->assets_map = $this->getAssetsMap();

        add_action('after_setup_theme', [$this, 'themeSupports']);

        add_filter('init', [$this, 'registerNavMenus']);

        add_filter('wp_enqueue_scripts', [$this, 'enqueueStyles']);
        add_filter('wp_enqueue_scripts', [$this, 'enqueueScripts']);

        add_action('enqueue_block_editor_assets', [$this, 'enqueueBlockEditorAssets']);

        add_action('login_enqueue_scripts', [$this, 'enqueueLoginStyles']);
        add_filter('login_headerurl', [$this, 'customLoginLogoUrl']);

        add_filter('excerpt_length', [$this, 'excerptLength'], 999);
        add_filter('excerpt_more', [$this, 'excerptMore'], 999);

        add_action('login_body_class', [$this, 'addEnvironmentClass']);
        add_filter('body_class', [$this, 'addEnvironmentClass']);
    }

    private function getAssetsMap()
    {
        $assets_map_path = get_stylesheet_directory() . '/dist/.vite/manifest.json';

        if (file_exists($assets_map_path)) {
            return json_decode(file_get_contents($assets_map_path), true);
        }

        return [];
    }

    public function themeSupports()
    {
        add_theme_support('html5', ['gallery', 'caption']);
        add_theme_support('post-thumbnails');
    }

    public function registerNavMenus()
    {
        register_nav_menu('primary-menu', 'Primary Menu');
        register_nav_menu('footer-menu', 'Footer Menu — Information');
        register_nav_menu('footer-menu-pickups', 'Footer Menu — Popular Pick Ups');
        register_nav_menu('footer-menu-destinations', 'Footer Menu — Popular Destinations');
    }

    public function enqueueScripts()
    {
        if (!$this->isViteHMRAvailable()) {
            if (array_key_exists('assets/index.js', $this->assets_map)) {
                wp_enqueue_script(
                    'theme-script',
                    get_stylesheet_directory_uri() . '/dist/' . $this->assets_map['assets/index.js']["file"],
                    [],
                    null,
                    []
                );
                $this->loadJSScriptAsESModule('theme-script');
            }
        } else {
            $theme_path = parse_url(get_stylesheet_directory_uri(), PHP_URL_PATH);

            wp_enqueue_script(
                'vite-client',
                $this->getViteDevServerAddress() . $theme_path . '/dist/@vite/client',
                [],
                null,
                []
            );
            $this->loadJSScriptAsESModule('vite-client');

            wp_enqueue_script(
                'vite-script',
                $this->getViteDevServerAddress() . $theme_path . '/dist/assets/index.js',
                [],
                null,
                []
            );
            $this->loadJSScriptAsESModule('vite-script');
        }
    }

    public function enqueueStyles()
    {
        // Remove WordPress block/global styles — this theme manages all its own CSS
        wp_dequeue_style('wp-block-library');
        wp_dequeue_style('wp-block-library-theme');
        wp_dequeue_style('global-styles');
        wp_dequeue_style('classic-theme-styles');

        if (!$this->isViteHMRAvailable()) {
            if (
                array_key_exists('assets/index.js', $this->assets_map) &&
                array_key_exists('css', $this->assets_map['assets/index.js'])
            ) {
                foreach ($this->assets_map['assets/index.js']["css"] as $style_path) {
                    wp_enqueue_style(
                        'theme-styles',
                        get_stylesheet_directory_uri() . '/dist/' . $style_path,
                        [],
                        false,
                        'all'
                    );
                }
            }
        } else {
            // Request the compiled stylesheet directly (rather than relying on
            // Vite's JS-injected <style> tag) so it arrives as a real blocking
            // <link>, matching production and avoiding a flash-of-unstyled-content
            // layout shift while still hot-reloading through Vite's dev server.
            $theme_path = parse_url(get_stylesheet_directory_uri(), PHP_URL_PATH);

            wp_enqueue_style(
                'theme-styles',
                $this->getViteDevServerAddress() . $theme_path . '/dist/assets/styles/styles.scss?direct',
                [],
                null,
                'all'
            );
        }
    }

    public function enqueueBlockEditorAssets()
    {
        // Load compiled theme CSS inside the block editor so ACF blocks render correctly
        if (!$this->isViteHMRAvailable()) {
            if (
                array_key_exists('assets/index.js', $this->assets_map) &&
                array_key_exists('css', $this->assets_map['assets/index.js'])
            ) {
                foreach ($this->assets_map['assets/index.js']["css"] as $style_path) {
                    wp_enqueue_style(
                        'theme-editor-styles',
                        get_stylesheet_directory_uri() . '/dist/' . $style_path,
                        [],
                        false,
                        'all'
                    );
                }
            }
        } else {
            $theme_path = parse_url(get_stylesheet_directory_uri(), PHP_URL_PATH);

            wp_enqueue_style(
                'theme-editor-styles',
                $this->getViteDevServerAddress() . $theme_path . '/dist/assets/styles/styles.scss?direct',
                [],
                null,
                'all'
            );
        }
    }

    public function enqueueLoginStyles()
    {
        if (
            array_key_exists('assets/login.js', $this->assets_map) &&
            array_key_exists('css', $this->assets_map['assets/login.js'])
        ) {
            foreach ($this->assets_map['assets/login.js']["css"] as $style_path) {
                wp_enqueue_style(
                    'login-styles',
                    get_stylesheet_directory_uri() . '/dist/' . $style_path,
                    [],
                    false,
                    'all'
                );
            }
        }
    }

    public function customLoginLogoUrl()
    {
        return site_url();
    }

    public function excerptLength()
    {
        return 20;
    }

    public function excerptMore()
    {
        return '&hellip;';
    }

    public function addEnvironmentClass($classes = '')
    {
        $environment = wp_get_environment_type();

        if ($environment !== 'production') {
            $classes[] = 'env-' . $environment;
        }

        return $classes;
    }

    public function loadJSScriptAsESModule($script_handle)
    {
        add_filter(
            'script_loader_tag',
            function ($tag, $handle, $src) use ($script_handle) {
                if ($script_handle === $handle) {
                    return sprintf(
                        '<script type="module" src="%s"></script>',
                        esc_url($src)
                    );
                }
                return $tag;
            },
            10,
            3
        );
    }

    public function getViteDevServerAddress()
    {
        if (defined('VITE_DEV_SERVER_URL')) {
            return VITE_DEV_SERVER_URL;
        }

        return '';
    }

    public function isViteHMRAvailable()
    {
        if ($this->viteHMRAvailable === null) {
            $this->viteHMRAvailable = $this->checkViteHMRAvailable();
        }

        return $this->viteHMRAvailable;
    }

    /**
     * Beyond checking that we're in local dev, also confirms the Vite dev
     * server is actually reachable — so if `npm run dev` isn't running,
     * the theme silently falls back to the built /dist assets instead of
     * emitting <script> tags that 404 against a dead dev server.
     */
    private function checkViteHMRAvailable(): bool
    {
        $address = $this->getViteDevServerAddress();

        if (empty($address) || !defined('WP_ENVIRONMENT_TYPE') || WP_ENVIRONMENT_TYPE !== 'local') {
            return false;
        }

        $parts = parse_url($address);
        $host = $parts['host'] ?? '127.0.0.1';
        $port = $parts['port'] ?? (($parts['scheme'] ?? 'http') === 'https' ? 443 : 80);

        $connection = @fsockopen($host, $port, $errno, $errstr, 0.2);

        if (!$connection) {
            return false;
        }

        fclose($connection);

        return true;
    }
}

new Theme_Setup();


// ─── TinyMCE: enable text colour picker in all wysiwyg fields ──────────────

add_filter('mce_buttons_2', function (array $buttons): array {
    $buttons[] = 'forecolor';
    return $buttons;
});

// Make the colour palette match the GHT brand colours
add_filter('tiny_mce_before_init', function (array $settings): array {
    $settings['textcolor_map'] = json_encode([
        '000000', 'Black',
        '1b161c', 'GHT Dark',
        '009bb2', 'GHT Teal',
        'e6af2a', 'GHT Gold',
        '464749', 'GHT Charcoal',
        '888888', 'Grey',
        'ffffff', 'White',
    ]);
    $settings['textcolor_cols'] = '7';
    $settings['textcolor_rows'] = '1';
    return $settings;
});


// ─── FAQ CPT & Topic taxonomy ──────────────────────────────────────────────
//
// Question = post title, Answer = native post content (WYSIWYG) — no ACF
// fields needed on the FAQ post itself. Grouped by faq_topic so the Support
// Panel block can render its topic tabs, and so the FAQ Panel block can
// offer a "select FAQs" picker scoped to real content.

add_action('init', 'ght_register_post_types');

function ght_register_post_types()
{
    register_post_type('faq', [
        'labels' => [
            'name'          => __('FAQs'),
            'singular_name' => __('FAQ'),
            'menu_name'     => __('FAQs'),
            'add_new'       => __('Add New FAQ'),
            'add_new_item'  => __('Add New FAQ'),
            'edit_item'     => __('Edit FAQ'),
            'all_items'     => __('All FAQs'),
            'not_found'     => __('No FAQs found.'),
        ],
        'menu_icon'    => 'dashicons-editor-help',
        'public'       => true,
        'has_archive'  => false,
        'supports'     => ['title', 'editor', 'page-attributes'],
        'show_in_rest' => true,
    ]);

    register_taxonomy('faq_topic', 'faq', [
        'labels' => [
            'name'         => 'FAQ Topic',
            'add_new_item' => 'Add New Topic',
        ],
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_tagcloud'     => false,
        'hierarchical'      => true,
        'show_in_rest'      => true,
    ]);
}

// ─── Categories dropdown helper (used by the Booking Panel block) ─────────

function ght_get_categories_dropdown(string $taxonomy, array $args = [], string $all_label = 'Select', int $selected_id = 0): string
{
    $terms = get_terms($taxonomy, array_merge(['hide_empty' => false], $args));

    $html  = '<select id="' . esc_attr($taxonomy) . '" name="' . esc_attr($taxonomy) . '" class="search-form__select" data-taxonomy="' . esc_attr($taxonomy) . '">';
    $html .= '<option value="0"' . ($selected_id === 0 ? ' selected="selected"' : '') . '>' . esc_html($all_label) . '</option>';

    if (!is_wp_error($terms)) {
        foreach ($terms as $term) {
            $selected = $selected_id === (int) $term->term_id ? ' selected="selected"' : '';
            $html .= '<option value="' . esc_attr($term->term_id) . '"' . $selected . '>' . esc_html($term->name) . '</option>';
        }
    }

    $html .= '</select>';

    return $html;
}
