<?php

if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    $_EXTKEY,                    // Extension Key
    'Configuration/TypoScript',  // Path to setup.txt and constants.txt
    'Brainswarm Vcard'            // Title in the selector box
);

$tmp_fe_users_columns = array(
    'vcard_id' => array(
        'label' => 'VCard ID',
        'exclude' => 1,
        'config' => array (
            'type' => 'input',
            'max' => 255,
            'eval' => 'trim,nospace,lower'
        ),
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $tmp_fe_users_columns, 1);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes (
    'fe_users',
    'vcard_id'
);