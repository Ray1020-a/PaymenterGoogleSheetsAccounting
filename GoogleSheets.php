<?php

namespace App\Extensions\Events\GoogleSheets;

use App\Classes\Extensions\Event;


class GoogleSheets extends Event
{
    public function getMetadata()
    {
        return [
            'display_name' => 'GoogleSheetsAccounting',
            'version' => '1.0.0',
            'author' => 'MineCloud',
            'website' => 'https://mcloudtw.com/',
        ];
    }

    public function getConfig()
    {
        return [
            [
                'name' => 'script_id',
                'type' => 'text',
                'friendlyName' => 'Google表單Script ID',
                'required' => true,
            ],
        ];
    }
}
