<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */
namespace Amicode\Weather\Cron;

use Magento\Backend\App\Action\Context;
use Amicode\Weather\Model\UpdateWeatherFeed;

class Weather extends \Magento\Backend\App\Action
{
    /**
     * @var UpdateWeatherFeed
     */
    protected $updateWeatherFeed;
    /**
     * Weather constructor.
     * @param Context $context
     * @param UpdateWeatherFeed $updateWeatherFeed
     */
    public function __construct(
        Context $context,
        UpdateWeatherFeed $updateWeatherFeed
    ) {
        parent::__construct($context);
        $this->updateWeatherFeed = $updateWeatherFeed;
    }

    public function execute()
    {
        $this->updateWeatherFeed->execute();
    }
}
