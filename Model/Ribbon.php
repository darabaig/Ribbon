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
namespace Dara\Ribbon\Model;

class Ribbon extends \Magento\Framework\Model\AbstractModel
{
        const STATUS_ENABLED = 1;
        const STATUS_DISABLED = 0;
    protected $_logger;
    protected function _construct()
    {
        $this->_init('Dara\Ribbon\Model\ResourceModel\Ribbon');
    }
    public function getAvailableStatuses()
    {
        $availableOptions = ['0' => 'Disable',
                           '1' => 'Enable'];
        return $availableOptions;
    }
}
