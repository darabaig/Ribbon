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
namespace Dara\Ribbon\Controller\Adminhtml\Ribbon;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    /**
     * Check the permission to run it
     *
     * @return bool
     */
    protected function _isAllowed()
    {
       
        return $this->_authorization
                    ->isAllowed('Dara_Ribbon::manage_ribbon');
    }
    /**
     * Index action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Dara_Ribbon::ribbon');
        $resultPage->addBreadcrumb(__('Ribbon'), __('Ribbon'));
        $resultPage->addBreadcrumb(__('Manage Ribbon'), __('Manage Ribbon'));
        $resultPage->getConfig()->getTitle()->prepend(__('Manage Ribbon'));
        return $resultPage;
    }
}
