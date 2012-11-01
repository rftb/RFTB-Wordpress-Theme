<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'pub_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'food_item',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Item Details',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'food_item' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Price',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}price",
			// Field description (optional)
			'desc'  => "Price, include the '$'",
			'type'  => 'text',
			// Default value (optional)
			'std'   => '$',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
		),

		// SELECT BOX
		array(
			'name'     => 'Menu',
			'id'       => "{$prefix}menu",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'starters' => 'Starters'
			, 'soups-salads' => 'Soups & Salads'
			, 'burgers-sandwiches' => 'Burgers & Sandwiches'
			, 'signature-dishes' => 'Signature Dishes'
			, 'soups_salads' => 'Salads'
			, 'desserts' => 'Desserts'
			, 'half-pints' => 'Half Pints'
			),
			// Select multiple values, optional. Default is false.
			'multiple' => false,
		),
		// TEXTAREA
		array(
			'name' => 'Description',
			'desc' => '',
			'id'   => "{$prefix}description",
			'type' => 'textarea',
			'cols' => '20',
			'rows' => '3',
		),
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}password" => array(
				'required'  => true,
				'minlength' => 7,
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}password" => array(
				'required'  => 'Password is required',
				'minlength' => 'Password must be at least 7 characters',
			),
		)
	)
);




$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'drink_item',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Item Details',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'drink_item' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Price',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}price",
			// Field description (optional)
			'desc'  => "Price, include the '$'",
			'type'  => 'text',
			// Default value (optional)
			'std'   => '$',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
		),

		// SELECT BOX
		array(
			'name'     => 'Menu',
			'id'       => "{$prefix}menu",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
			'default' => '-'
			, 'ales' => 'Ales'
			, 'combinations' => 'Combinations'
			, 'lagers' => 'Lagers'
			, 'draughts' => 'Draughts'
			),
			// Select multiple values, optional. Default is false.
			'multiple' => false,
		),
		// TEXTAREA
		array(
			'name' => 'Description',
			'desc' => '',
			'id'   => "{$prefix}description",
			'type' => 'textarea',
			'cols' => '20',
			'rows' => '3',
		),
	),
	'validation' => array(
		'rules' => array(
			"{$prefix}password" => array(
				'required'  => true,
				'minlength' => 7,
			),
		),
		// optional override of default jquery.validate messages
		'messages' => array(
			"{$prefix}password" => array(
				'required'  => 'Password is required',
				'minlength' => 'Password must be at least 7 characters',
			),
		)
	)
);





/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function pub_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'pub_register_meta_boxes' );