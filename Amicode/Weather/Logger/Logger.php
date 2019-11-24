<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */
namespace Amicode\Weather\Logger;

class Logger extends \Monolog\Logger
{
    /**
     * Adds a log record.
     *
     * @param  int     $level   The logging level
     * @param  string  $message The log message
     * @param  array   $context The log context
     * @return boolean
     */
    public function addRecord($level, $message, array $context = array())
    {
        if (!is_string($message)) $message = json_encode($message);
        parent::addRecord($level, $message, $context);
    }
}
