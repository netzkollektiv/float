<?php
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/var/www/html/wp-content/plugins/wp-super-cache/' );
$_SERVER['HTTPS'] = 'on';
/**
 * Grundeinstellungen für WordPress
 *
 * Zu diesen Einstellungen gehören:
 *
 * * MySQL-Zugangsdaten,
 * * Tabellenpräfix,
 * * Sicherheitsschlüssel
 * * und ABSPATH.
 *
 * Mehr Informationen zur wp-config.php gibt es auf der
 * {@link https://codex.wordpress.org/Editing_wp-config.php wp-config.php editieren}
 * Seite im Codex. Die Zugangsdaten für die MySQL-Datenbank
 * bekommst du von deinem Webhoster.
 *
 * Diese Datei wird zur Erstellung der wp-config.php verwendet.
 * Du musst aber dafür nicht das Installationsskript verwenden.
 * Stattdessen kannst du auch diese Datei als wp-config.php mit
 * deinen Zugangsdaten für die Datenbank abspeichern.
 *
 * @package WordPress
 */

// ** MySQL-Einstellungen ** //
/**   Diese Zugangsdaten bekommst du von deinem Webhoster. **/

/**
 * Ersetze datenbankname_hier_einfuegen
 * mit dem Namen der Datenbank, die du verwenden möchtest.
 */
define( 'DB_NAME', 'wordpress' );

/**
 * Ersetze benutzername_hier_einfuegen
 * mit deinem MySQL-Datenbank-Benutzernamen.
 */
define( 'DB_USER', 'wordpress' );

/**
 * Ersetze passwort_hier_einfuegen mit deinem MySQL-Passwort.
 */
define( 'DB_PASSWORD', 'wordpress' );

/**
 * Ersetze localhost mit der MySQL-Serveradresse.
 */
define( 'DB_HOST', 'db' );

/**
 * Der Datenbankzeichensatz, der beim Erstellen der
 * Datenbanktabellen verwendet werden soll
 */
define( 'DB_CHARSET', 'utf8mb4' );

/**
 * Der Collate-Type sollte nicht geändert werden.
 */
define('DB_COLLATE', '');

/**#@+
 * Sicherheitsschlüssel
 *
 * Ändere jeden untenstehenden Platzhaltertext in eine beliebige,
 * möglichst einmalig genutzte Zeichenkette.
 * Auf der Seite {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * kannst du dir alle Schlüssel generieren lassen.
 * Du kannst die Schlüssel jederzeit wieder ändern, alle angemeldeten
 * Benutzer müssen sich danach erneut anmelden.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ';-/L`X9)6-ief#m,e=59CugfjI#RgU.@chsklzL>>mw>,HR))w0m|5SL(_ ^5tDM' );
define( 'SECURE_AUTH_KEY',  'Wtz9KyP=.OW^|S?H4fK^l:5b>cGpWCh!~qu?ajtRt,icm#++~D&|3D[yA]9O,`LE' );
define( 'LOGGED_IN_KEY',    '.U#h=t{~>GI9E{U<F_?sb3c5^sR&rB0?Gg!c,U@^jK{MUmhs-ePu/h1Bau4Hpvax' );
define( 'NONCE_KEY',        'e6$4*`#^Ve)q~##gj:/|0[u5VH,NweGlyK;Fi6[d8OEY9a4gJ8WdZ/$ 4WQS.EG6' );
define( 'AUTH_SALT',        'BBUMc#f3[}hI=8 Qr@)UfVhI.T1cL@ayx1$DE6,2Jd3i&zV9 `SZ8s2!BNR36Ik]' );
define( 'SECURE_AUTH_SALT', '~:%8H`s/hgEO=I9{)d|=TeN58CG9o`n+sYR]e!(Q#c%iE<R~d=k1JS(dU,;ht=:6' );
define( 'LOGGED_IN_SALT',   'Cnm!pm6]uY?@P*<Sx?iS/aj5,#>XNq qWsF.!Px0 dZ$e8r&0jN#N`R?W$+(#-Pv' );
define( 'NONCE_SALT',       '(Hn5#WCUkqa2MFW-INxf)b:puqXbs@<FmuT`/A+]:_pd0ry0=k^;1uxm7&7}BHgn' );

/**#@-*/

/**
 * WordPress Datenbanktabellen-Präfix
 *
 * Wenn du verschiedene Präfixe benutzt, kannst du innerhalb einer Datenbank
 * verschiedene WordPress-Installationen betreiben.
 * Bitte verwende nur Zahlen, Buchstaben und Unterstriche!
 */
$table_prefix = 'wp_';

/**
 * Für Entwickler: Der WordPress-Debug-Modus.
 *
 * Setze den Wert auf „true“, um bei der Entwicklung Warnungen und Fehler-Meldungen angezeigt zu bekommen.
 * Plugin- und Theme-Entwicklern wird nachdrücklich empfohlen, WP_DEBUG
 * in ihrer Entwicklungsumgebung zu verwenden.
 *
 * Besuche den Codex, um mehr Informationen über andere Konstanten zu finden,
 * die zum Debuggen genutzt werden können.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Das war’s, Schluss mit dem Bearbeiten! Viel Spaß. */
/* That's all, stop editing! Happy publishing. */

/** Der absolute Pfad zum WordPress-Verzeichnis. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Definiert WordPress-Variablen und fügt Dateien ein.  */
require_once( ABSPATH . 'wp-settings.php' );

define('FS_METHOD', 'direct');
define( 'WC_GZD_ENCRYPTION_KEY', 'd14152b56510b7adc303d80bfb52c7470d0ec725f5c393d31ce766f73605c876' );