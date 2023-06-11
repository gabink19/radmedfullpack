ALTER TABLE `download_token` ADD `process_ppd` int(1) NOT NULL DEFAULT '1';

INSERT INTO `site_config` (`label`, `config_key`, `config_value`, `config_description`, `availableValues`, `config_type`, `config_group`, `display_order`) VALUES ('Script Version Number', 'script_version_number', '2.0', 'System value. The current script version number.', '', 'integer', 'System', '0');
INSERT INTO `site_config` (`label`, `config_key`, `config_value`, `config_description`, `availableValues`, `config_type`, `config_group`, `display_order`) VALUES ('Admin Approve Registration', 'admin_approve_registrations', 'no', 'Whether admin should manually approve all account registrations.', '[\"yes\",\"no\"]', 'select', 'Site Options', '31');
ALTER TABLE `users` CHANGE `status` `status` enum('active','pending','disabled','suspended','awaiting approval') COLLATE 'utf8_unicode_ci' NOT NULL DEFAULT 'active' AFTER `lastloginip`;

ALTER TABLE `file_folder` ADD UNIQUE `urlHash` (`urlHash`);
UPDATE file_folder SET urlHash = MD5(CONCAT(NOW(), RAND(), UUID())) WHERE urlHash IS NULL;

UPDATE `site_config` SET `availableValues` = '[\"recaptcha\",\"solvemedia\",\"cryptoloot\"]' WHERE `config_key` = 'captcha_type';
INSERT INTO `site_config` (`label`, `config_key`, `config_value`, `config_description`, `availableValues`, `config_type`, `config_group`) VALUES ('Cryptoloot Public Key', 'captcha_cryptoloot_public_key', '', 'Public site key for cryptoloot captcha, if enabled. Register at https://crypto-loot.com', '', 'string', 'Captcha');
INSERT INTO `site_config` (`label`, `config_key`, `config_value`, `config_description`, `availableValues`, `config_type`, `config_group`) VALUES ('Cryptoloot Private Key', 'captcha_cryptoloot_private_key', '', 'Private site key for cryptoloot captcha, if enabled. Register at http://crypto-loot.com', '', 'string', 'Captcha');

UPDATE `site_config` SET display_order = 40 WHERE config_key = 'captcha_cryptoloot_public_key';
UPDATE `site_config` SET display_order = 45 WHERE config_key = 'captcha_cryptoloot_private_key';

INSERT INTO `file_server_container` (`id`, `label`, `entrypoint`, `expected_config_json`, `is_enabled`) VALUES (NULL,	'Backblaze B2',	'flysystem_backblaze_b2',	'{\"account_id\":{\"label\":\"Master Key Id\",\"type\":\"text\",\"default\":\"\"},\"application_key\":{\"label\":\"Master Application Key (Master Only Supported)\",\"type\":\"text\",\"default\":\"\"},\"bucket\":{\"label\":\"Bucket Name\",\"type\":\"text\",\"default\":\"\"}}',	1);

ALTER TABLE `banned_ips` RENAME TO `banned_ip`;

UPDATE language_content SET content = REPLACE(content, '.[[[PAGE_EXTENSION]]]', '') WHERE content LIKE '%.[[[PAGE_EXTENSION]]]%';
UPDATE language_key SET defaultContent = REPLACE(defaultContent, '.[[[PAGE_EXTENSION]]]', '') WHERE defaultContent LIKE '%.[[[PAGE_EXTENSION]]]%';
UPDATE language_content SET content = REPLACE(content, '.[[[SITE_CONFIG_PAGE_EXTENSION]]]', '') WHERE content LIKE '%.[[[SITE_CONFIG_PAGE_EXTENSION]]]%';
UPDATE language_key SET defaultContent = REPLACE(defaultContent, '.[[[SITE_CONFIG_PAGE_EXTENSION]]]', '') WHERE defaultContent LIKE '%.[[[SITE_CONFIG_PAGE_EXTENSION]]]%';

DELETE FROM site_config WHERE config_key = 'page_extension';

INSERT INTO `site_config` (`label`, `config_key`, `config_value`, `config_description`, `availableValues`, `config_type`, `config_group`, `display_order`) VALUES ('Enable Application Cache', 'enable_application_cache', 'yes', 'Whether to activate application cache or not. This will cache the Twig templates and url routes to improve performance.', '["yes","no"]', 'select', 'Site Options', 6);

UPDATE download_page SET download_page = REPLACE(download_page, '_download_page_captcha.inc.php', 'captcha.html');
UPDATE download_page SET download_page = REPLACE(download_page, '_download_page_compare_all.inc.php', 'compare_all.html');
UPDATE download_page SET download_page = REPLACE(download_page, '_download_page_compare_timed.inc.php', 'compare_timed.html');
UPDATE download_page SET download_page = REPLACE(download_page, '_download_page_file_info.inc.php', 'file_info.html');
UPDATE download_page SET download_page = REPLACE(download_page, '_download_page_timed.inc.php', 'timed.html');

ALTER TABLE `site_config` CHANGE `config_description` `config_description` text COLLATE 'utf8_general_ci' NOT NULL AFTER `config_value`;
INSERT INTO `site_config` (`label`, `config_key`, `config_value`, `config_description`, `availableValues`, `config_type`, `config_group`, `display_order`) VALUES ('User Session Type', 'user_session_type', 'Database Sessions', 'Login session type. If you are using any "Direct" file servers, that must be "Database Sessions", using "Local Sessions" will break cross server support. If you enable a "Direct" file server, this is automatically changed to "Database Sessions". After changing you will need to re-login.', '["Local Sessions", "Database Sessions"]', 'select', 'Site Options', 59);
UPDATE `site_config` SET `config_value` = (SELECT IF(COUNT(id) > 0, 'Database Sessions', 'Local Sessions') FROM file_server WHERE serverType = 'direct') WHERE `config_key` = 'user_session_type';

CREATE TABLE `file_folder_share_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `file_folder_share_id` int(11) NOT NULL,
  `file_id` int(11) NULL,
  `folder_id` int(11) NULL,
  `date_created` datetime NOT NULL
) ENGINE='InnoDB' COLLATE 'utf8_bin';

ALTER TABLE `file_folder_share_item`
ADD INDEX `file_folder_share_id` (`file_folder_share_id`),
ADD INDEX `file_id` (`file_id`),
ADD INDEX `folder_id` (`folder_id`);

INSERT INTO `file_folder_share_item` (`file_folder_share_id`, `folder_id`, `date_created`) (SELECT `id`, `folder_id`, `date_created` FROM `file_folder_share`);
ALTER TABLE `file_folder_share` DROP `folder_id`;
ALTER TABLE `file_folder_share` ADD `is_global` int(1) NOT NULL DEFAULT '0' AFTER `shared_with_user_id`;

ALTER TABLE `file_folder_share` CHANGE `access_key` `access_key` varchar(128) COLLATE 'latin1_swedish_ci' NOT NULL AFTER `id`;
ALTER TABLE `file_folder_share` ADD INDEX `is_global` (`is_global`);

INSERT INTO `site_config` (`label`, `config_key`, `config_value`, `config_description`, `availableValues`, `config_type`, `config_group`, `display_order`) VALUES ('Support Legacy Folder Urls', 'support_legacy_folder_urls', 'Disabled', 'Whether to support legacy public folder urls or not. In the recent code these are made using a unique 32 character length hash, whereas older urls used the shorter folder id.', '["Enabled", "Disabled"]', 'select', 'File Manager', 99);

ALTER TABLE `file_folder` ADD `addedUserId` int(11) NULL AFTER `userId`;
UPDATE `file_folder` SET `addedUserId` = `userId`;

INSERT INTO `site_config` (`label`, `config_key`, `config_value`, `config_description`, `availableValues`, `config_type`, `config_group`, `display_order`) VALUES ('Lock Download Tokens To IP', 'lock_download_tokens_to_ip', 'Disabled', 'Whether to lock downloads to the original requesting IP address for additional leech protection. Note: This will cause the document viewer to stop working if you are using this functionality.', '["Enabled", "Disabled"]', 'select', 'File Downloads', 99);

UPDATE `plugin` SET is_installed = 1 WHERE folder_name = 'fileimport';

UPDATE `site_config` SET `config_value` = '32' WHERE `config_key` = 'password_policy_max_length' AND `config_value` = '8';

INSERT INTO `site_config` (`label`, `config_key`, `config_value`, `config_description`, `availableValues`, `config_type`, `config_group`, `display_order`) VALUES ('Username min length', 'username_min_length', '6', 'The minimum character length for a username.', '', 'string', 'Security', 40);
INSERT INTO `site_config` (`label`, `config_key`, `config_value`, `config_description`, `availableValues`, `config_type`, `config_group`, `display_order`) VALUES ('Username max length', 'username_max_length', '20', 'The maximum character length for a username.', '', 'string', 'Security', 41);

INSERT INTO `theme` (`id`, `theme_name`, `folder_name`, `theme_description`, `author_name`, `author_website`, `is_installed`, `date_installed`, `theme_settings`) VALUES
(5, 'Evolution Theme', 'evolution', 'Bootstrap uCloud theme included with v2.0+', 'MFScripts', 'https://mfscripts.com', 1, NOW(), '{\"thumbnail_type\":\"square\",\"site_skin\":\"default.css\",\"css_code\":\"\"}');
DELETE FROM `theme` WHERE folder_name = 'cloudable';
UPDATE `site_config` SET config_value = 'evolution' WHERE config_key = 'site_theme';

DROP TABLE IF EXISTS `banned_files`;
CREATE TABLE `banned_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fileHash` varchar(32) CHARACTER SET latin1 NOT NULL,
  `fileSize` bigint(15) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fileHash` (`fileHash`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

