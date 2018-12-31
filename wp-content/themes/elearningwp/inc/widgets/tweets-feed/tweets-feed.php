<?php

class Tweets_Feed_Widget extends Thim_Widget {
	function __construct() {
		parent::__construct(
			'tweets-feed',
			__( 'Thim: Tweets Feed', 'elearningwp' ),
			array(
				'description'   => __( 'List Tweets Feed', 'elearningwp' ),
				'help'          => '',
				'panels_groups' => array( 'thim_widget_group' ),
				'panels_icon' => 'dashicons dashicons-welcome-learn-more thim_widgets_twitter'
			),
			array(),
			array(
				'title'               => array(
					'type'    => 'text',
					'label'   => __( 'Heading Text', 'elearningwp' ),
					'default' => __( "Latest Tweets", "elearningwp" )
				),
				'consumer_key'        => array(
					'type'    => 'text',
					'label'   => __( 'Consumer Key', 'elearningwp' ),
					'default' => __( "8MLtU0vPrqY5ID5f9R5w", "elearningwp" )
				),
				'consumer_secret'     => array(
					'type'    => 'text',
					'label'   => __( 'Consumer Secret', 'elearningwp' ),
					'default' => __( "H7wIO5OUFgbNlq5h8pzXOhyubR7awP9VCO37b2JU1A", "elearningwp" )
				),
				'access_token'        => array(
					'type'    => 'text',
					'label'   => __( 'Access Token', 'elearningwp' ),
					'default' => __( "624443553-wJTdW8WTORDnggzV9C0mUFJ1nbv4kCZgxy5JKlYu", "elearningwp" )
				),
				'access_token_secret' => array(
					'type'    => 'text',
					'label'   => __( 'Access Token Secret', 'elearningwp' ),
					'default' => __( "dsLFF01Hn3a3YcDt0DjCofoxxABkoyJkhLSa302S3fzJj", "elearningwp" )
				),
				'twitter_id'          => array(
					'type'    => 'text',
					'label'   => __( 'Twitter Name', 'elearningwp' ),
					'default' => __( "themeforest", "elearningwp" )
				),
				'count'               => array(
					'type'    => 'number',
					'label'   => __( 'Number of Tweets', 'elearningwp' ),
					'default' => __( "4", "elearningwp" )
				),

			),
			THIM_DIR . 'inc/widgets/tweets-feed/'
		);
	}

	/**
	 * Initialize the CTA widget
	 */

	function get_template_name( $instance ) {
		return 'base';
	}

	function get_style_name( $instance ) {
		return false;
	}

}

function thim_tweets_feed_register_widget() {
	register_widget( 'Tweets_Feed_Widget' );
}

add_action( 'widgets_init', 'thim_tweets_feed_register_widget' );