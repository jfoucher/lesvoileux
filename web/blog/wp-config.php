<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/Editing_wp-config.php Modifier
 * wp-config.php} (en anglais). C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'voileux_blog');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'z0bilam0uche');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données.
 * N'y touchez que si vous savez ce que vous faites.
 */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Z~N<zk%|:(Sfi*1b:Ge(0VwN*~[}jZ@{b9+?w[|9,r#B[?PfHS:oqsn]plJ9JYUo');
define('SECURE_AUTH_KEY',  '{G8P`rgj+S?K<w!(XtdktD]^e&JwCQL?>N}u~WR)FqRjX6-0F<99z-Cp&#_S0+~1');
define('LOGGED_IN_KEY',    'q7gk1V9g,=nKx~|SS >lwF<B^@_ktLOv<er+~#|WqU=9Jm/3hgUp9a5uk2Y9*-z}');
define('NONCE_KEY',        '(C[Q]3i5u0,fJjT_.m;&IO7U$rjEl:Umi`Ff9<z~AQ`I)H9ObHFILZcd~kW|uh.H');
define('AUTH_SALT',        'o816E3vjMU}dkb.js<6&Lq#|lg0GedK0`f);W/DgJ+lX<4_QUZZ.zBPm}!~d``_e');
define('SECURE_AUTH_SALT', 'by|:rL&0^QUiPb9g2i!z||7R^P?AuG*vd2@4FXke{lh!T$I;kQ.U+uk,EMcn>S|,');
define('LOGGED_IN_SALT',   '-`g]X5*oHPDlr(?BbIw$K)5]$HOL&bb3pwIz-nvFbP*E-){[sE_AP&h$LiBl!{-&');
define('NONCE_SALT',       's-;Cd{}0<.%A&a|)OdFenl],zU#o?c.jRV0o3#D~-Mk|7To7+j7/Cp3FB7zl>a`U');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'voileux_';

/**
 * Langue de localisation de WordPress, par défaut en Anglais.
 *
 * Modifiez cette valeur pour localiser WordPress. Un fichier MO correspondant
 * au langage choisi doit être installé dans le dossier wp-content/languages.
 * Par exemple, pour mettre en place une traduction française, mettez le fichier
 * fr_FR.mo dans wp-content/languages, et réglez l'option ci-dessous à "fr_FR".
 */
define('WPLANG', 'fr_FR');

/**
 * Pour les développeurs : le mode deboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 */
define('WP_DEBUG', false);

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');