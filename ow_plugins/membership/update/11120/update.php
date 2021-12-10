<?php

/**
 * Copyright (c) 2016, Skalfa LLC
 * All rights reserved.
 *
 * ATTENTION: This commercial software is intended for use with Oxwall Free Community Software http://www.oxwall.com/
 * and is licensed under Oxwall Store Commercial License.
 *
 * Full text of this license can be found at http://developers.oxwall.com/store/oscl
 */

$sqls = [
    'ALTER TABLE `' . OW_DB_PREFIX . 'membership_plan` ADD `customId` VARCHAR(128) NULL AFTER `recurring`;',
];

foreach ($sqls as $sql)
{
    try
    {
        Updater::getDbo()->query($sql);
    }
    catch (Exception $exception)
    {
        $logger = Updater::getLogger();
        $logger->addEntry($exception->getMessage(), 'membership.update.error');
        $logger->addEntry($sql);
    }
}

Updater::getLanguageService()->importPrefixFromDir(__DIR__ . DS . 'langs', true);
