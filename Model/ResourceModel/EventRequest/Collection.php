<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Model\ResourceModel\EventRequest;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 *
 * @package LeviathanStudios\Scheduler\Model\ResourceModel\EventRequest
 */
class Collection extends AbstractCollection
{
    /**
     * @var string $_idFieldName
     */
    protected $_idFieldName = 'entity_id';

    /**
     * @inheritdoc
     */
    protected function _construct(): void
    {
        $this->_init(
            'LeviathanStudios\Scheduler\Model\EventRequest',
            'LeviathanStudios\Scheduler\Model\ResourceModel\EventRequest'
        );
    }
}
