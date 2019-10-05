<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Data model representing a search result of events.
 *
 * @api
 */
interface EventRequestResultInterface extends SearchResultsInterface
{
    /**
     * Get event list.
     *
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface[]
     */
    public function getItems();

    /**
     * Set event list.
     *
     * @param \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
