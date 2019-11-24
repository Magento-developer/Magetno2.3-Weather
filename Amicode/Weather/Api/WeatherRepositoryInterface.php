<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */

namespace Amicode\Weather\Api;

use Amicode\Weather\Api\Data\WeatherInterface;

interface WeatherRepositoryInterface
{
    /**
     * Retrieve weather
     *
     * @param int $id
     *
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function get($id);

    /**
     * Save Weather
     *
     * @param \Amicode\Weather\Api\Data\WeatherInterface $model
     *
     * @return \Amicode\Weather\Api\Data\WeatherInterface
     * @throws \Exception
     */
    public function save(WeatherInterface $model);

    /**
     * Delete weather
     *
     * @param \Amicode\Weather\Api\Data\WeatherInterface $model
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function delete (WeatherInterface $model);

    /**
     * Delete weather by ID.
     *
     * @param int $id
     *
     * @return bool
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\StateException
     */
    public function deleteById($id);

}