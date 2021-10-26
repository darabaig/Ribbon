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

namespace Dara\Ribbon\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class PageCheck implements OptionSourceInterface
{
    public function toOptionArray()
	{
	    return [
	        ['value' => 'cms_index_index', 'label' => __('Home Page')],
	        ['value' => 'ap', 'label' => __('All Pages')]
	    ];
	}

}
