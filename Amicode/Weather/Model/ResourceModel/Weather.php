<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */

namespace Amicode\Weather\Model\ResourceModel;

use Amicode\Weather\Logger\Logger as LoggerWeather;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;


class Weather extends AbstractDb
{
    const API_WEATHER_IMAGE_PATH = 'http://openweathermap.org/img/wn/';
    /**
     * @var Filesystem
     */
    private $_filesystem;

    /**
     * @var Filesystem\Directory\WriteInterface
     */
    private $_media;

    /**
     * @var File
     */
    private $_file;

    /**
     * Weather constructor.
     * @param Context $context
     * @param LoggerWeather $logger
     * @param Filesystem $filesystem
     * @param File $file
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(
        Context $context,
        LoggerWeather $logger,
        Filesystem $filesystem,
        File $file
    )
    {
        $this->_logger = $logger;
        $this->_filesystem = $filesystem;
        $this->_file = $file;
        $this->_media = $this->_filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);

        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('amicode_weather', 'entity_id');
    }

    protected function _afterSave(AbstractModel $object)
    {
        if ($object->getWeatherIcon()) {
            $fileNames = [
                $object->getWeatherIcon() . '@2x.png',
                $object->getWeatherIcon() . '.png',
            ];
            $mediaRootDir = $this->_media->getAbsolutePath();
            foreach ($fileNames as $fileName) {
                if (!$this->_file->isExists($mediaRootDir . 'weatherfeed/icons/' . $fileName)) {
                    try {
                        $fileContent = @file_get_contents(SELF::API_WEATHER_IMAGE_PATH . $fileName);
                        $this->_media->writeFile($mediaRootDir. 'weatherfeed/icons/' . $fileName, $fileContent);
                    } catch (\Exception $e) {
                        $result['message'] = $e->getMessage();
                        $this->_logger->critical($e->getMessage());
                    }
                }
            }
        }
        return parent::_afterSave($object);
    }
}
