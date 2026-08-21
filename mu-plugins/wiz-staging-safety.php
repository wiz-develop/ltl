<?php
/**
 * Plugin Name: WIZ Staging Safety
 * Description: Applies indexing and mail-delivery safeguards to the LTL staging site.
 * Version: 1.0.0
 */

defined( 'ABSPATH' ) || exit;

$wiz_staging_host = strtolower( (string) preg_replace( '/:\d+$/', '', $_SERVER['HTTP_HOST'] ?? '' ) );
if ( 'ltl.wiz-services.com' !== $wiz_staging_host ) {
	return;
}

add_filter( 'pre_option_blog_public', '__return_zero' );

add_filter(
	'wp_robots',
	static function ( $robots ) {
		$robots['noindex']   = true;
		$robots['nofollow']  = true;
		$robots['noarchive'] = true;

		return $robots;
	}
);

add_action(
	'send_headers',
	static function () {
		header( 'X-Robots-Tag: noindex, nofollow, noarchive', true );
	}
);

function wiz_ltl_staging_mail_from() {
	return 'wordpress@ltl.wiz-services.com';
}

add_filter( 'wp_mail_from', 'wiz_ltl_staging_mail_from', PHP_INT_MAX );
add_filter(
	'wp_mail_from_name',
	static function () {
		return 'LTL test site';
	},
	PHP_INT_MAX
);

add_action(
	'phpmailer_init',
	static function ( $phpmailer ) {
		$from              = wiz_ltl_staging_mail_from();
		$phpmailer->From   = $from;
		$phpmailer->Sender = $from;
	},
	PHP_INT_MAX
);

add_filter(
	'wpcf7_mail_components',
	static function ( $components, $contact_form, $mail ) {
		$components['sender'] = sprintf( 'LTL test site <%s>', wiz_ltl_staging_mail_from() );

		if ( ! is_object( $mail ) || 'mail' !== $mail->name() || ! class_exists( 'WPCF7_Submission' ) ) {
			return $components;
		}

		$submission = WPCF7_Submission::get_instance();
		$data       = $submission ? $submission->get_posted_data() : array();
		$email      = sanitize_email( (string) ( $data['your-email'] ?? '' ) );
		$name       = sanitize_text_field( (string) ( $data['your-name'] ?? '' ) );

		if ( $email ) {
			$reply_to = $name ? sprintf( 'Reply-To: %s <%s>', $name, $email ) : sprintf( 'Reply-To: %s', $email );
			$headers  = trim( (string) ( $components['additional_headers'] ?? '' ) );
			$components['additional_headers'] = $headers ? $headers . "\n" . $reply_to : $reply_to;
		}

		return $components;
	},
	20,
	3
);

function wiz_ltl_staging_mail_log( $status, $mail_data, $error = '' ) {
	$recipients = $mail_data['to'] ?? array();
	if ( is_string( $recipients ) ) {
		$recipients = preg_split( '/\s*,\s*/', $recipients, -1, PREG_SPLIT_NO_EMPTY );
	}

	$domains = array();
	foreach ( (array) $recipients as $recipient ) {
		$parts = explode( '@', (string) $recipient, 2 );
		if ( isset( $parts[1] ) ) {
			$domains[] = strtolower( $parts[1] );
		}
	}

	$log   = get_option( 'wiz_staging_mail_log', array() );
	$log   = is_array( $log ) ? $log : array();
	$log[] = array(
		'time_utc'          => gmdate( DATE_ATOM ),
		'status'            => $status,
		'recipient_count'   => count( (array) $recipients ),
		'recipient_domains' => array_values( array_unique( $domains ) ),
		'subject_hash'      => hash( 'sha256', (string) ( $mail_data['subject'] ?? '' ) ),
		'error'             => sanitize_text_field( (string) $error ),
	);

	update_option( 'wiz_staging_mail_log', array_slice( $log, -20 ), false );
}

add_action(
	'wp_mail_succeeded',
	static function ( $mail_data ) {
		wiz_ltl_staging_mail_log( 'accepted_by_local_mailer', (array) $mail_data );
	}
);

add_action(
	'wp_mail_failed',
	static function ( $error ) {
		$mail_data = $error instanceof WP_Error ? $error->get_error_data( 'wp_mail_failed' ) : array();
		$message   = $error instanceof WP_Error ? $error->get_error_message() : 'Unknown mail error';
		wiz_ltl_staging_mail_log( 'failed', is_array( $mail_data ) ? $mail_data : array(), $message );
	}
);
