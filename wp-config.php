<?php
/**
 * Konfigurasi dasar WordPress.
 *
 * Berkas ini berisi konfigurasi-konfigurasi berikut: Pengaturan MySQL, Awalan Tabel,
 * Kunci Rahasia, Bahasa WordPress, dan ABSPATH. Anda dapat menemukan informasi lebih
 * lanjut dengan mengunjungi Halaman Codex {@link http://codex.wordpress.org/Editing_wp-config.php
 * Menyunting wp-config.php}. Anda dapat memperoleh pengaturan MySQL dari web host Anda.
 *
 * Berkas ini digunakan oleh skrip penciptaan wp-config.php selama proses instalasi.
 * Anda tidak perlu menggunakan situs web, Anda dapat langsung menyalin berkas ini ke
 * "wp-config.php" dan mengisi nilai-nilainya.
 *
 * @package WordPress
 */

// ** Pengaturan MySQL - Anda dapat memperoleh informasi ini dari web host Anda ** //
/** Nama basis data untuk WordPress */
define( 'DB_NAME', 'bhatara_db' );

/** Nama pengguna basis data MySQL */
define( 'DB_USER', 'bhatara' );

/** Kata sandi basis data MySQL */
define( 'DB_PASSWORD', 'bhatara2020' );

/** Nama host MySQL */
define( 'DB_HOST', 'localhost' );

/** Set Karakter Basis Data yang digunakan untuk menciptakan tabel basis data. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Jenis Collate Basis Data. Jangan ubah ini jika ragu. */
define('DB_COLLATE', '');

/**#@+
 * Kunci Otentifikasi Unik dan Garam.
 *
 * Ubah baris berikut menjadi frase unik!
 * Anda dapat menciptakan frase-frase ini menggunakan {@link https://api.wordpress.org/secret-key/1.1/salt/ Layanan kunci-rahasia WordPress.org}
 * Anda dapat mengubah baris-baris berikut kapanpun untuk mencabut validasi seluruh cookies. Hal ini akan memaksa seluruh pengguna untuk masuk log ulang.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '.%dIcB7g9xVU^,fa^T+bBwlmXnc,BYgl#^m+iKHX-b`x3y!7SCdQD`,K#!yeE7He' );
define( 'SECURE_AUTH_KEY',  'r3lBzzw9%,b_t8rJf<&mS~cB=nl40Mgz]eM`pA<4BbGv*]OuSrHL2#/+1TRvT>~-' );
define( 'LOGGED_IN_KEY',    '!5%8n YIy2u@;|P_  -6K*S8d,%E %K*?JN0Jm#7Kn*Ut=nL{?ehhMi/Av,-,6a5' );
define( 'NONCE_KEY',        'fSxQn. ]L`I*?Qh&)#pO?;27_5j6)EfNWJT8)=mj-GWyUk4F h[XKP3I7|h3}m]9' );
define( 'AUTH_SALT',        'd4YX,GO+wq)2?JEOWMh^)?B72Dh._M4]z<>KUe!f(&qkgN 6%o0!xf2>cWR Ox*`' );
define( 'SECURE_AUTH_SALT', 'cS6LUkNA}i8DyTUYCJ!e{1E,5N8=ht33h<apJ!SGiM})_.=-Qg1{Pk!~yR9ZI!R1' );
define( 'LOGGED_IN_SALT',   'l;-wL^{E{F}`Jel Zw#BJG*np#@upy:3gI];Va9WIc}} iqjRG:j7;SC3v=Xt`5|' );
define( 'NONCE_SALT',       'DU20MYVeK9rLc8C1Y}bThiBA=52mB64^*<!QqJ9*ESXDDyul<.W9aBHihT/9+5nV' );

/**#@-*/

/**
 * Awalan Tabel Basis Data WordPress.
 *
 * Anda dapat memiliki beberapa instalasi di dalam satu basis data jika Anda memberikan awalan unik
 * kepada masing-masing tabel. Harap hanya masukkan angka, huruf, dan garis bawah!
 */
$table_prefix = 'wp_';

/**
 * Untuk pengembang: Moda pengawakutuan WordPress.
 *
 * Ubah ini menjadi "true" untuk mengaktifkan tampilan peringatan selama pengembangan.
 * Sangat disarankan agar pengembang plugin dan tema menggunakan WP_DEBUG
 * di lingkungan pengembangan mereka.
 */
define('WP_DEBUG', false);

/* Cukup, berhenti menyunting! Selamat ngeblog. */

/** Lokasi absolut direktori WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Menentukan variabel-variabel WordPress berkas-berkas yang disertakan. */
require_once(ABSPATH . 'wp-settings.php');
