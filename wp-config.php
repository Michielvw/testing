<?php
# Database Configuration
define( 'DB_NAME', 'snapshot_fonterragame' );
define( 'DB_USER', 'fonterragame' );
define( 'DB_PASSWORD', 'A8KFgNjwZZRIQI9hwLkH' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         'r`|&.2iW0kcr?u.-74 T_(J=r4XZVQ&h.X|zQ&N$NP*?80@n[m{T?B+*Y`he3W)3');
define('SECURE_AUTH_KEY',  '0u]Dv$d[;>OpA$Z+0e vr%Qo?a`?ks5:mf+3]gyL+v_$8m9b(]w+mAO~sOp+q@7&');
define('LOGGED_IN_KEY',    'F+?fP9D3v!p,b$h{Wuwi{v$VWT@KxF(U0IOzx_}0p:Nrz=2488#`%*8q|e8T3/2+');
define('NONCE_KEY',        'FVE(?U+9sINdeEn?r7aHd0%SBHU]c<yfpO$,kmKb[hp*S_c,.WM+$t~kzs.RQYk*');
define('AUTH_SALT',        'zjFadv7cC>S%]A[_()72Qy-4xlUr*/)rO%B?T;|^y)d)H3C_#CtgIXT3?XZ4w5:*');
define('SECURE_AUTH_SALT', '7#uY(:wlrDyBwF/1l#@1.)76c-3+8n^t`Dmk]9fSryf,B,-iC-<J$_U~.}A*p9y(');
define('LOGGED_IN_SALT',   'yk~muC~86Bk+++~qd|`t>fL,J_G?e{pyiJO^)MbB$$Cr~.h~vBy3i7 EU^lqKn-k');
define('NONCE_SALT',       'uZL1DE:VF|>njoDFWSVb3blz=hF~ZHZf?-|5DlGU!olZQpml8ZN#pHCfZ-]OGxPb');

define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );
# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'fonterragame' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '159efb0cfe5ae6e8303c215a42fb719f24212d7d' );

define( 'WPE_CLUSTER_ID', '30279' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'fonterragame.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'pod-30279', );

$wpe_special_ips=array ( 0 => '162.13.190.222', );

$wpe_ec_servers=array ( );

$wpe_largefs=array ( );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( 'default' =>  array ( 0 => 'unix:///tmp/memcached.sock', ), );

define( 'WP_SITEURL', 'http://fonterragame.staging.wpengine.com' );

define( 'WP_HOME', 'http://fonterragame.staging.wpengine.com' );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
