<?php

$EM_CONF[$_EXTKEY] = array(
    'title' => 'Brainswarm VCard',
    'description' => '',
    'category' => '3rdparty',
    'version' => '0.1.0',
    'state' => 'beta',
    'clearcacheonload' => 1,
    'author' => 'David Sporer',
    'author_email' => 'david.sporer@brainswarm.de',
    'author_company' => 'Brainswarm Sporer und Meyer GbR',
    'constraints' => array(
        'depends' => array(
            'typo3' => '6.2.12-7.99.99',
            'femanager' => '1.0.0-2.99.99'
        )
    ),
);