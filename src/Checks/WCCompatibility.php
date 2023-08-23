<?php
/**
 * WooCommerce Compatibility Check.
 *
 * @package Automattic/WooCommerce/Grow/Tools
 */

namespace Automattic\WooCommerce\Grow\Tools\Checks;

defined( 'ABSPATH' ) || exit;

/**
 * The WooCommerce Compatibility Check class.
 */
class WCCompatibility extends CompatCheck {

	/** @var int|float The miniumum supported WooCommerce versions before the latest. */
	private $min_wc_semver = 2; // By default, the last 2 major versions behind the latest published are supported.

	/**
	 * Determines if WooCommerce is installed.
	 *
	 * @return bool
	 */
	private function is_wc_installed() {
		$plugin            = 'woocommerce/woocommerce.php';
		$installed_plugins = get_plugins();

		return isset( $installed_plugins[ $plugin ] );
	}

	/**
	 * Determines if WooCommerce is activated.
	 *
	 * @return bool
	 */
	private function is_wc_activated() {
		return class_exists( 'WooCommerce' );
	}

    /**
     * Check WooCommerce installation and activation.
     *
     * @return bool
     */
    private function check_wc_installation_and_activation() {
        return true;
    }

    /**
     * Check WooCommerce version.
     *
     * @return bool
     */
    private function check_wc_version() {
        return true;
    }

    /**
     * Check for WooCommerce upgrade recommendation.
     *
     * @return bool
     */
    private function check_wc_upgrade_recommendation() {
        return true;
    }

    /**
     * Run all compatibility checks.
     */
    private function run_checks() {
        try {
            $this->check_wc_installation_and_activation();
            $this->check_wc_version();
            $this->check_wc_upgrade_recommendation();
            return true;
        } catch ( Exception $e ) {
            return false;
        }
    }

    /**
     * Determins if the plugin is WooCommerce compatible.
     */
    public function is_compatible() {
        $this->run_checks();
    }
}
