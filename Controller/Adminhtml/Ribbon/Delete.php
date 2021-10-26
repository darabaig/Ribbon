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

class Delete extends \Magento\Backend\App\Action
{
    
    const ADMIN_RESOURCE = 'Dara_Ribbon::ribbon_delete';
    
    protected $model;
    public function __construct(
        Action\Context $context,
        \Dara\Ribbon\Model\Ribbon $model
    ) {
        $this->model = $model;
        parent::__construct($context);
    }
    public function execute()
    {
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('ribbon_id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            $title = "";
            try {
                $this->model->load($id);
                $title = $this->model->getTitle();
                $this->model->delete();
                // display success message
                $this->messageManager->addSuccess(__('The ribbon has been deleted.'));
                // go to grid
                $this->_eventManager->dispatch(
                    'adminhtml_ribbonpage_on_delete',
                    ['title' => $title, 'status' => 'success']
                );
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->_ribbonManager->dispatch(
                    'adminhtml_ribbonpage_on_delete',
                    ['title' => $title, 'status' => 'fail']
                );
                // display error message
                $this->messageManager->addError($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['ribbon_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addError(__('We can\'t find a ribbon to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
