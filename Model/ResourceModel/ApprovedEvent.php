<?php
/**
 * @package     LeviathanStudios/Scheduler
 * @version     1.0.0
 * @author      Greg Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class ApprovedEvent
 *
 * @package LeviathanStudios\Scheduler\Model\ResourceModel
 */
class ApprovedEvent extends AbstractDb
{
    const APPROVED_TABLE = 'leviathan_event_approved';

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init($this::APPROVED_TABLE, 'entity_id');
    }
}
