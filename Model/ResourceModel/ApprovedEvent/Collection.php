<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Model\ResourceModel\ApprovedEvent;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 *
 * @package LeviathanStudios\Scheduler\Model\ResourceModel\ApprovedEvent
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
    protected function _construct()
    {
        $this->_init(
            'LeviathanStudios\Scheduler\Model\ApprovedEvent',
            'LeviathanStudios\Scheduler\Model\ResourceModel\ApprovedEvent'
        );
    }
}
