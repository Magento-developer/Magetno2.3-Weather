<?php
/**
 * Copyright © 2019 AmiCode. All rights reserved.
 */
namespace Amicode\Weather\Model\ResourceModel\Weather;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
	protected $_idFieldName = 'entity_id';
	protected $_eventPrefix = 'amicode_weather_collection';
	protected $_eventObject = 'weather_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('Amicode\Weather\Model\Weather', 'Amicode\Weather\Model\ResourceModel\Weather');
	}
}
