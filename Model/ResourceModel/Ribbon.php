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

namespace Dara\Ribbon\Model\ResourceModel;

use Magento\Framework\DB\Select;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Store\Model\Store;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\Stdlib\DateTime;

class Ribbon extends AbstractDb
{
    /**
     * Store model
     *
     * @var null|Store
     */
    protected $_store = null;
    /**
     * Store manager
     *
     * @var StoreManagerInterface
     */
    protected $_storeManager;
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var MetadataPool
     */
    protected $metadataPool;

    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        DateTime $dateTime,
        EntityManager $entityManager,
        MetadataPool $metadataPool,
        $connectionName = null
    ) {
        parent::__construct($context, $connectionName);
        $this->_storeManager = $storeManager;
        
        $this->entityManager = $entityManager;
        $this->metadataPool = $metadataPool;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('dara_ribbons', 'ribbon_id');
    }
    protected function _beforeSave(AbstractModel $object)
    {

        if (!$this->getIsUniqueRibbonToStores($object)) {
            throw new LocalizedException(
                __('A ribbon is already active in this given time span, please consider selecting an alternate date.')
            );
        }
        return $this;
    }


    public function getIsUniqueRibbonToStores(AbstractModel $object)
    {

        $select = $this->getConnection()->select()
        ->from(['cb' => $this->getTable('dara_ribbons')])
        ->where('cb.ribbon_end_date > ?', $object->getData('ribbon_start_date'))
        ->where('cb.ribbon_id NOT IN (?)', $object->getData('ribbon_id'));
        if ($this->getConnection()->fetchRow($select)) {
            return false;
        }

        return true;
    }

    protected function _afterSave(AbstractModel $product)
    {
        return parent::_afterSave($product);
    }
    
    public function setStore($store)
    {
        $this->_store = $store;
        return $this;
    }

    /**
     * Retrieve store model
     *
     * @return Store
     */
    public function getStore()
    {
        return $this->_storeManager->getStore($this->_store);
    }
}
