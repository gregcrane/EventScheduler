<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface ApprovedEventResultInterface
 */
interface ApprovedEventResultInterface extends SearchResultsInterface
{
    /**
     * Get event list.
     *
     * @return \LeviathanStudios\Scheduler\Api\Data\ApprovedEventInterface[]
     */
    public function getItems();

    /**
     * Set event list.
     *
     * @param \LeviathanStudios\Scheduler\Api\Data\ApprovedEventInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
