<?php

namespace Advanced_Sidebar_Menu\Widget;

use Advanced_Sidebar_Menu\Menus\Menu_Abstract;

/**
 * Creates a Widget of parent Child Categories
 *
 * @author  OnPoint Plugins
 * @since   7.0.0
 *
 * @package Advanced Sidebar Menu
 */
class Category extends Widget_Abstract {
	const NAME = 'advanced_sidebar_menu_category';

	const TITLE                    = Menu_Abstract::TITLE;
	const INCLUDE_PARENT           = Menu_Abstract::INCLUDE_PARENT;
	const INCLUDE_CHILDLESS_PARENT = Menu_Abstract::INCLUDE_CHILDLESS_PARENT;
	const ORDER_BY                 = Menu_Abstract::ORDER_BY;
	const EXCLUDE                  = Menu_Abstract::EXCLUDE;
	const DISPLAY_ALL              = Menu_Abstract::DISPLAY_ALL;
	const LEVELS                   = Menu_Abstract::LEVELS;

	const DISPLAY_ON_SINGLE     = \Advanced_Sidebar_Menu\Menus\Category::DISPLAY_ON_SINGLE;
	const EACH_CATEGORY_DISPLAY = \Advanced_Sidebar_Menu\Menus\Category::EACH_CATEGORY_DISPLAY;

	/**
	 * Default widget values.
	 *
	 * @var array
	 */
	protected static $defaults = [
		self::TITLE                    => '',
		self::INCLUDE_PARENT           => false,
		self::INCLUDE_CHILDLESS_PARENT => false,
		self::DISPLAY_ON_SINGLE        => false,
		self::EACH_CATEGORY_DISPLAY    => 'widget',
		self::EXCLUDE                  => '',
		self::DISPLAY_ALL              => false,
		self::LEVELS                   => 1,
	];


	/**
	 * Register the widget.
	 */
	public function __construct() {
		$widget_ops = [
			'classname'   => 'advanced-sidebar-menu advanced-sidebar-category',
			'description' => __( 'Creates a menu of all the categories using the child/parent relationship', 'advanced-sidebar-menu' ),
		];
		$control_ops = [
			'width' => wp_is_mobile() ? false : 620,
		];

		parent::__construct( self::NAME, __( 'Advanced Sidebar Categories Menu', 'advanced-sidebar-menu' ), $widget_ops, $control_ops );

		$this->hook();
	}


	/**
	 * Add the sections to the widget via actions.
	 *
	 * @notice Anything using the column actions must use the $widget class passed
	 *         via do_action instead of $this
	 *
	 * @return void
	 */
	protected function hook() {
		static $hooked;
		if ( null !== $hooked ) {
			return;
		}
		$hooked = true;

		add_action( 'advanced-sidebar-menu/widget/category/left-column', [ $this, 'box_display' ], 5, 2 );
		add_action( 'advanced-sidebar-menu/widget/category/left-column', [ $this, 'box_display_on_single_posts' ], 15, 2 );
		add_action( 'advanced-sidebar-menu/widget/category/left-column', [ $this, 'box_exclude' ], 20, 2 );
	}


	/**
	 * Display options.
	 *
	 * @param array           $instance - Widget settings.
	 * @param Widget_Abstract $widget   - Registered widget arguments.
	 *
	 * @return void
	 */
	public function box_display( array $instance, $widget ) {
		?>
		<div class="advanced-sidebar-menu-column-box">
			<p>
				<?php $widget->checkbox( self::INCLUDE_PARENT ); ?>
				<label>
					<?php esc_html_e( 'Display the highest level parent category', 'advanced-sidebar-menu' ); ?>
				</label>
			</p>
			<p>
				<?php $widget->checkbox( self::INCLUDE_CHILDLESS_PARENT ); ?>
				<label>
					<?php esc_html_e( 'Display menu when there is only the parent category', 'advanced-sidebar-menu' ); ?>
				</label>
			</p>
			<p>
				<?php $widget->checkbox( self::DISPLAY_ALL, self::LEVELS ); ?>
				<label>
					<?php esc_html_e( 'Always display child categories', 'advanced-sidebar-menu' ); ?>
				</label>
			</p>
			<div <?php $widget->hide_element( self::DISPLAY_ALL, self::LEVELS ); ?>>
				<p>
					<label for="<?php echo esc_attr( $widget->get_field_id( self::LEVELS ) ); ?>">
						<?php esc_html_e( 'Levels of child categories to display', 'advanced-sidebar-menu' ); ?>:
					</label>
					<select
						id="<?php echo esc_attr( $widget->get_field_id( self::LEVELS ) ); ?>"
						name="<?php echo esc_attr( $widget->get_field_name( self::LEVELS ) ); ?>">
						<?php
						for ( $i = 1; $i < 6; $i ++ ) {
							?>
							<option
								value="<?php echo esc_attr( $i ); ?>" <?php selected( $i, (int) $instance[ self::LEVELS ] ); ?>>
								<?php echo esc_html( $i ); ?>
							</option>

							<?php
						}
						?>
					</select>
				</p>
			</div>

			<?php do_action( 'advanced-sidebar-menu/widget/category/display-box', $instance, $widget ); ?>

		</div>
		<?php
	}


	/**
	 * Display categories on single post settings.
	 *
	 * @param array           $instance - Widget settings.
	 * @param Widget_Abstract $widget   - Registered widget arguments.
	 *
	 * @return void
	 */
	public function box_display_on_single_posts( array $instance, $widget ) {
		?>
		<div class="advanced-sidebar-menu-column-box">
			<p>

				<?php $widget->checkbox( self::DISPLAY_ON_SINGLE, self::EACH_CATEGORY_DISPLAY ); ?>
				<label>
					<?php esc_html_e( 'Display categories on single posts', 'advanced-sidebar-menu' ); ?>
				</label>
			</p>

			<div <?php $widget->hide_element( self::DISPLAY_ON_SINGLE, self::EACH_CATEGORY_DISPLAY ); ?>>
				<p>
					<label for="<?php echo esc_attr( $widget->get_field_id( self::EACH_CATEGORY_DISPLAY ) ); ?>">
						<?php esc_html_e( "Display each single post's category", 'advanced-sidebar-menu' ); ?>:
					</label>
					<select
						id="<?php echo esc_attr( $widget->get_field_id( self::EACH_CATEGORY_DISPLAY ) ); ?>"
						name="<?php echo esc_attr( $widget->get_field_name( self::EACH_CATEGORY_DISPLAY ) ); ?>">
						<option
							value="widget" <?php selected( 'widget', $instance[ self::EACH_CATEGORY_DISPLAY ] ); ?>>
							<?php esc_html_e( 'In a new widget', 'advanced-sidebar-menu' ); ?>
						</option>
						<option value="list" <?php selected( 'list', $instance[ self::EACH_CATEGORY_DISPLAY ] ); ?>>
							<?php esc_html_e( 'In another list in the same widget', 'advanced-sidebar-menu' ); ?>
						</option>
					</select>
				</p>
			</div>

			<?php do_action( 'advanced-sidebar-menu/widget/category/singles-box', $instance, $widget ); ?>

		</div>
		<?php
	}


	/**
	 * Categories to exclude settings.
	 *
	 * @param array           $instance - Widget settings.
	 * @param Widget_Abstract $widget   - Registered widget arguments.
	 *
	 * @return void
	 */
	public function box_exclude( array $instance, $widget ) {
		?>
		<div class="advanced-sidebar-menu-column-box">
			<p>
				<label for="<?php echo esc_attr( $widget->get_field_id( self::EXCLUDE ) ); ?>">
					<?php esc_html_e( 'Categories to exclude (ids), comma separated', 'advanced-sidebar-menu' ); ?>:
				</label>
				<input
					id="<?php echo esc_attr( $widget->get_field_id( self::EXCLUDE ) ); ?>"
					name="<?php echo esc_attr( $widget->get_field_name( self::EXCLUDE ) ); ?>"
					type="text"
					class="widefat"
					value="<?php echo esc_attr( $instance[ self::EXCLUDE ] ); ?>" />
			</p>

			<?php
			do_action( 'advanced-sidebar-menu/widget/category/exclude-box', $instance, $widget );
			?>
		</div>
		<?php
	}


	/**
	 * Widget form.
	 *
	 * @param array $instance - Widget settings.
	 *
	 * @since 7.2.1
	 *
	 * @return void
	 */
	public function form( $instance ) {
		$instance = $this->set_instance( $instance, self::$defaults );
		do_action( 'advanced-sidebar-menu/widget/category/before-form', $instance, $this );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( self::TITLE ) ); ?>">
				<?php esc_html_e( 'Title', 'advanced-sidebar-menu' ); ?>:
			</label>
			<input
				id="<?php echo esc_attr( $this->get_field_id( self::TITLE ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( self::TITLE ) ); ?>"
				class="widefat"
				type="text"
				value="<?php echo esc_attr( $instance[ self::TITLE ] ); ?>" />
		</p>

		<div class="advanced-sidebar-menu-column">
			<?php do_action( 'advanced-sidebar-menu/widget/category/left-column', $instance, $this ); ?>
		</div>

		<div class="advanced-sidebar-menu-column advanced-sidebar-menu-column-right">
			<?php do_action( 'advanced-sidebar-menu/widget/category/right-column', $instance, $this ); ?>
		</div>
		<div class="advanced-sidebar-menu-full-width"><!-- clear --></div>

		<?php
		do_action( 'advanced-sidebar-menu/widget/category/after-form', $instance, $this );
	}


	/**
	 * Save the widget settings.
	 *
	 * @param array $new_instance - New widget settings.
	 * @param array $old_instance - Old widget settings.
	 *
	 * @return array|mixed
	 */
	public function update( $new_instance, $old_instance ) {
		$new_instance['exclude'] = wp_strip_all_tags( $new_instance['exclude'] );

		return apply_filters( 'advanced-sidebar-menu/widget/category/update', $new_instance, $old_instance );
	}


	/**
	 * Widget Output
	 *
	 * @param array $args     - Widget registration args.
	 * @param array $instance - Widget settings.
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {
		$instance = $this->set_instance( $instance, self::$defaults );
		$menu = \Advanced_Sidebar_Menu\Menus\Category::factory( $instance, $args );

		do_action( 'advanced-sidebar-menu/widget/before-render', $menu, $this );

		$menu->render();

		do_action( 'advanced-sidebar-menu/widget/after-render', $menu, $this );
	}

}
