<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */
namespace Amicode\Weather\Logger;

class Handler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * Logging level.
     *
     * @var int
     */
    public $loggerType = Logger::INFO;

    /**
     * File name.
     *
     * @var string
     */
    public $fileName = '/var/log/amicode_weather.log';
}
