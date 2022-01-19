<?php
/**
 * Plugin Name: TaxonomyEngine
 * Plugin URI: https://github.com/j-norwood-young/taxonomy-engine
 * Description: Categorise your WordPress content with the assistance of machine learning and crowdsourcing
 * Author: Daily Maverick, Jason Norwood-Young
 * Author URI: https://dailymaverick.co.za
 * Version: 0.1.0
 * License: GPLv3
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * WC requires at least: 5.8.0
 * Tested up to: 5.8.2
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once( plugin_dir_path( __FILE__ ) . 'taxonomyengine_constants.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/db/taxonomyengine-db.php' );

function taxonomy_engine_admin_init() {
    if (!is_admin()) {
        return;
    }
    $taxonomyengine_globals = [];
    require_once(plugin_dir_path( __FILE__ ) . 'includes/admin/taxonomyengine-scripts.php' );
    require_once(plugin_basename('includes/admin/taxonomyengine-admin.php' ) );
    $taxonomyengine_admin = new TaxonomyEngineAdmin($taxonomyengine_globals);
}
add_action( 'init', 'taxonomy_engine_admin_init' );

function taxonomy_engine_frontend_init() {
    require_once( plugin_dir_path( __FILE__ ) . 'includes/frontend/taxonomyengine-frontend-reviewer.php' );
    $taxonomyengine_frontend_reviewer = new TaxonomyEngineFrontendReviewer();
}
add_action( 'init', 'taxonomy_engine_frontend_init', 3 );

function taxonomy_engine_api_init() {
    $taxonomyengine_globals = [];
    require_once(plugin_basename('includes/api/taxonomyengine-api.php' ) );
    new TaxonomyEngineAPI($taxonomyengine_globals);
}
add_action( 'init', 'taxonomy_engine_api_init');

function taxonomy_engine_navigation_init() {
    $taxonomyengine_globals = [];
    require_once(plugin_basename('includes/navigation/taxonomyengine-navigation.php' ) );
    new TaxonomyEngineNavigation($taxonomyengine_globals);
}
add_action( 'init', 'taxonomy_engine_navigation_init');

function taxonomy_engine_common_init() {
    require_once( plugin_dir_path( __FILE__ ) . 'includes/taxonomyengine-setup.php' );
    new TaxonomyEngineSetup( $taxonomyengine_globals );
}
add_action( 'init', 'taxonomy_engine_common_init', 2 );

function taxonomy_engine_automl_init() {
    $taxonomyengine_globals = [];
    require_once(plugin_basename('includes/automl/taxonomyengine-automl.php' ) );
    new TaxonomyEngineAutoML($taxonomyengine_globals);
}
add_action( 'init', 'taxonomy_engine_automl_init');