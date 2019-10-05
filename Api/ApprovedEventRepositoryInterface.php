<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use LeviathanStudios\Scheduler\Api\Data\ApprovedEventInterface;

/**
 * Service contract for adding, removing, and retrieving approved events.
 *
 * @api
 */
interface ApprovedEventRepositoryInterface
{
    /**
     * @param int $id
     * @return \LeviathanStudios\RequestContact\Api\Data\EstimateInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \LeviathanStudios\Scheduler\Api\Data\ApprovedEventInterface $event
     * @return \LeviathanStudios\Scheduler\Api\Data\ApprovedEventInterface
     */
    public function save(ApprovedEventInterface $event);

    /**
     * @param \LeviathanStudios\Scheduler\Api\Data\ApprovedEventInterface $event
     * @return void
     */
    public function delete(ApprovedEventInterface $event);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \LeviathanStudios\Scheduler\Api\Data\ApprovedEventResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
