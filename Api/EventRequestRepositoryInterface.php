<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Api;

/**
 * Service contract for adding, removing, and retrieving events.
 *
 * @api
 */
interface EventRequestRepositoryInterface
{
    /**
     * Get an event by ID.
     *
     * @param int $id
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * Return a list of events matching search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestResultInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Save an event.
     *
     * @param \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface $request
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\LeviathanStudios\Scheduler\Api\Data\EventRequestInterface $request);

    /**
     * Delete an event.
     *
     * @param \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface $request
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function delete(\LeviathanStudios\Scheduler\Api\Data\EventRequestInterface $request);

    /**
     * Delete multiple events matching search criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return bool
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteMultiple(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete an event by ID.
     *
     * @param int $eventId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\CouldNotDeleteException
     */
    public function deleteById($eventId);
}
