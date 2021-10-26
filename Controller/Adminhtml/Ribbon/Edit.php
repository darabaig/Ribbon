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

use Magento\Backend\App\Action;
 
class Edit extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Dara_Ribbon::manage_ribbon';

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;
    protected $model;

    /**
     * @param Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Dara\Ribbon\Model\Ribbon $model,
        \Magento\Framework\Registry $registry
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->_coreRegistry = $registry;
        $this->model = $model;
        parent::__construct($context);
    }

    /**
     * Init actions
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function _initAction()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Dara_Ribbon::ribbons_ribbon')
            ->addBreadcrumb(__('RIBBONS'), __('RIBBONS'))
            ->addBreadcrumb(__('Manage Ribbon'), __('Manage Ribbon'));
        return $resultPage;
    }
        
    public function execute()
    {

        $id = $this->getRequest()->getParam('ribbon_id');
        if ($id) {
            $this->model->load($id);
            if (!$this->model->getId()) {
                $this->messageManager
                ->addError(__('This ribbon no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $this->_coreRegistry->register('ribbons_ribbon', $this->model);

        $resultPage = $this->_initAction();

        $resultPage->addBreadcrumb(
            $id ? __('Edit Ribbon') : __('New Ribbon'),
            $id ? __('Edit Ribbon') : __('New Ribbon')
        );
        
        $resultPage->getConfig()->getTitle()->prepend(__('Ribbon'));
        $resultPage->getConfig()->getTitle()
            ->prepend($this->model->getId() ? $this->model->getRibbonName() : __('New Ribbon'));

        return $resultPage;
    }
}
