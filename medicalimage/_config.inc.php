<?php

/* main configuration file for script */
define("_CONFIG_SITE_HOST_URL", "image.radmed.co.id");  /* site url host without the http:// and no trailing forward slash - i.e. www.mydomain.com or links.mydomain.com */
define("_CONFIG_SITE_FULL_URL", "image.radmed.co.id");  /* full site url without the http:// and no trailing forward slash - i.e. www.mydomain.com/links or the same as the _CONFIG_SITE_HOST_URL */

/* database connection details */
define("_CONFIG_DB_HOST", "127.0.0.1");  /* database host name */
define("_CONFIG_DB_NAME", "medicalimage");    /* database name */
define("_CONFIG_DB_USER", "root");    /* database username */
define("_CONFIG_DB_PASS", "Disana4misbah@k");    /* database password */

/* set these to the main site host if you're using direct web server uploads/downloads to remote servers */
define("_CONFIG_CORE_SITE_HOST_URL", "image.radmed.co.id");  /* site url host without the http:// and no trailing forward slash - i.e. www.mydomain.com or links.mydomain.com */
define("_CONFIG_CORE_SITE_FULL_URL", "image.radmed.co.id");  /* full site url without the http:// and no trailing forward slash - i.e. www.mydomain.com/links or the same as the _CONFIG_SITE_HOST_URL */

/* show database degug information on fail */
define("_CONFIG_DEBUG", false);    /* this will display debug information when something fails in the DB - leave this as true if you're not sure */

/* which protcol to use, default is http */
define("_CONFIG_SITE_PROTOCOL", "https");

/* key used for encoding data within the site */
define("_CONFIG_UNIQUE_ENCRYPTION_KEY", "xbSH65ckigjlTp6tgNnwgEUn4V4Nvtk1QV1ASHkBDDi31FXqJTwdBN7v7EOVHcgpABRNjqDjqQDZdqv0TDaLAvZZOU6pxmSqKtyjsrxBfFt2FZxwJi7CIpILbRf5FE5R");

/* toggle demo mode */
define("_CONFIG_DEMO_MODE", false);    /* always leave this as false */

define("_SECRET_KEY", 'disana4misbah');    /* secret key untuk enkripsi password */
