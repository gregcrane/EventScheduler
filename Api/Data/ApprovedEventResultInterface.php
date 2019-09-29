<?php
/**
 * @package     LeviathanStudios/Scheduler
 * @version     1.0.0
 * @author      Greg Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface ApprovedEventResultInterface
 *
 * @package LeviathanStudios\Scheduler\Api\Data
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
