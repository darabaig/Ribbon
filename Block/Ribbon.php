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
namespace Dara\Ribbon\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\ObjectManagerInterface;
  
class Ribbon extends Template
{
    protected $collectionFactory;
    protected $objectManager;
    protected $request;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Dara\Ribbon\Model\ResourceModel\Ribbon\
        CollectionFactory $collectionFactory,
        \Magento\Framework\App\Request\Http $request,
        ObjectManagerInterface $objectManager
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->request = $request;
        $this->objectManager = $objectManager;
                
        parent::__construct($context);
    }

    public function isHomePage()
    {
        if ($this->_request->getFullActionName() == 'cms_index_index') {
            return true;
        }
        return false;
    }
        
    public function getFrontRibbons()
    {      
        $collection = $this->collectionFactory->create()->addFieldToFilter('is_active', 1);
        return $collection;
    }
    
}
