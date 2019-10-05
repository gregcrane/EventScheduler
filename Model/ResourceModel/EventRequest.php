<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Exception\CouldNotDeleteException;

/**
 * Resource Model class for the EventRequest Model
 */
class EventRequest extends AbstractDb
{
    /** @var string  */
    const EVENT_TABLE = 'leviathan_event_request';

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init($this::EVENT_TABLE, 'entity_id');
    }

    /**
     * Delete events from the passed in event collection.
     *
     * @param EventRequest\Collection $collection
     * @return void
     * @throws CouldNotDeleteException
     */
    public function deleteByCollection($collection): void
    {
        $query = $collection->getSelect()->deleteFromSelect('main_table');

        try {
            $this->getConnection()->query($query);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__('%1 could not delete events', __CLASS__), $exception);
        }
    }
}
