<?php
/**
 * Dara.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the End-user License Agreement
 *
 * @package     Dara Ribbon v1.x.x
 * @copyright   Copyright (c) 2021 Dara.
 * @license     End-user License Agreement
 * See COPYING.txt for license details.
 */
namespace Dara\Ribbon\Model\ResourceModel\Ribbon;

use Magento\Cms\Api\Data\PageInterface;
use \Dara\Ribbon\Model\ResourceModel\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'ribbon_id';

    /**
     * Load data for preview flag
     *
     * @var bool
     */
    protected $_previewFlag;

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dara\Ribbon\Model\Ribbon', 'Dara\Ribbon\Model\ResourceModel\Ribbon');
        $this->_map['fields']['ribbon_id'] = 'main_table.ribbon_id';
        $this->_map['fields']['store'] = 'store_table.store_id';
    }

    
    public function setFirstStoreFlag($flag = false)
    {
        $this->_previewFlag = $flag;
        return $this;
    }

    /**
     * Add filter by store
     *
     * @param int|array|\Magento\Store\Model\Store $store
     * @param bool $withAdmin
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true)
    {
        if (!$this->getFlag('store_filter_added')) {
            $this->performAddStoreFilter($store, $withAdmin);
        }
        return $this;
    }

    /**
     * Perform operations after collection load
     *
     * @return $this
     */
    protected function _afterLoad()
    {
        $this->_previewFlag = false;

        return parent::_afterLoad();
    }
}
