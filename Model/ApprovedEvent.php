<?php
/**
 * @package     LeviathanStudios/Scheduler
 * @version     1.0.0
 * @author      Greg Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Model;

class ApprovedEvent
{
    const CACHE_TAG = 'leviathanstudios_approved_event';
    protected $_cacheTag = 'leviathanstudios_approved_event';
    protected $_eventPrefix = 'leviathanstudios_approved_event';

    /**
     * Model construct that should be used for object initialization
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init('LeviathanStudios\Scheduler\Model\ResourceModel\ApprovedEvent');
    }
}
