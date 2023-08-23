<?php
/**
 * The Compatibility Checker parent.
 *
 * @package Automattic/WooCommerce/Grow/Tools
 */

namespace Automattic\WooCommerce\Grow\Tools\Checks;

defined( 'ABSPATH' ) || exit;

/**
 * The CompatCheck class.
 */
abstract class CompatCheck {

	/** @var array Array of admin notices. */
	protected $notices = array();

    /** @var array Array of CompatCheck instances. */
    private static $instances = array();

    /**
     * Get the instance of the CompatCheck object.
     *
     * @return CompatCheck
     */
    public static function instance() {
        $class = get_called_class();
        if ( ! isset( self::$instances[ $class ] ) ) {
			self::$instances[ $class ] = new $class();
		}

        return self::$instances[ $class ];
    }

	/**
	 * Adds an admin notice to be displayed.
	 *
	 * @param string $slug    The slug for the notice.
	 * @param string $class   The CSS class for the notice.
	 * @param string $message The notice message.
	 */
	protected function add_admin_notice( $slug, $class, $message ) {
		$this->notices[ $slug ] = array(
			'class'   => $class,
			'message' => $message,
		);
	}

	/**
	 * Compares major version.
	 *
	 * @param string $left     First version number.
	 * @param string $right    Second version number.
	 * @param string $operator An optional operator. The possible operators are: <, lt, <=, le, >, gt, >=, ge, ==, =, eq, !=, <>, ne respectively.
	 *
	 * @return int|bool
	 */
	protected function compare_major_version( $left, $right, $operator = null ) {
		$pattern = '/^(\d+\.\d+).*/';
		$replace = '$1.0';

		$left  = preg_replace( $pattern, $replace, $left );
		$right = preg_replace( $pattern, $replace, $right );

		return version_compare( $left, $right, $operator );
	}
}
