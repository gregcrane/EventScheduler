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
 * Class EventRequest
 *
 * @package LeviathanStudios\Scheduler\Model\ResourceModel
 */
class EventRequest extends AbstractDb
{
    const EVENT_TABLE = 'leviathan_event_request';

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init($this::EVENT_TABLE, 'entity_id');
    }
}
