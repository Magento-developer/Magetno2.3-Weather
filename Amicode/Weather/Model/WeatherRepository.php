<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */
namespace Amicode\Weather\Model;

use Amicode\Weather\Api\WeatherRepositoryInterface;
use Amicode\Weather\Api\Data\WeatherInterface;
use Amicode\Weather\Model\ResourceModel\Weather as ResourceModel;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\StateException;


class WeatherRepository implements WeatherRepositoryInterface
{
    /**
     * @var \Amicode\Weather\Model\ResourceModel\Weather
     */
    private $resourceModel;

    /**
     * @var \Amicode\Weather\Model\WeatherFactory
     */
    private $modelFactory;

    /**
     * @var Weather[]
     */
    private $instances = [];

    /**
     * WeatherRepository constructor.
     * @param ResourceModel $resourceModel
     */
    public function __construct(
        ResourceModel $resourceModel,
        WeatherFactory $modelFactory
    ) {
        $this->resourceModel = $resourceModel;
        $this->modelFactory = $modelFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function get($id)
    {
        if (!isset($this->instances[$id])) {
            $model = $this->modelFactory->create();

            $model->load($id);

            if (!$model->getId()) {
                throw NoSuchEntityException::singleField('entity_id', $id);
            }
            $this->instances[$id] = $model;
        }
        return $this->instances[$id];
    }

    /**
     * {@inheritdoc}
     */
    public function save(WeatherInterface $model)
    {
        try {
            $existingModel = $this->get($model->getId());
        } catch (NoSuchEntityException $e) {
            $existingModel = null;
        }

        if ($existingModel !== null) {
            foreach ($existingModel->getData() as $key => $value) {
                if (!$model->hasData($key)) {
                    $model->setData($key, $value);
                }
            }
        }

        $this->resourceModel->save($model);
        unset($this->instances[$model->getId()]);

        return $this->get($model->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function delete(WeatherInterface $model)
    {
        $name = $model->getName();
        try {
            unset($this->instances[$model->getId()]);
            $this->resourceModel->delete($model);
        } catch (\Exception $e) {
            throw new StateException(
                __('Unable to remove store %1', $name)
            );
        }
        unset($this->instances[$model->getId()]);

        return true;
    }
    
    /**
     * {@inheritdoc}
     */
    public function deleteById($id)
    {
        $model = $this->get($id);
        return $this->delete($model);
    }
}
