<?php
/**
 * @package     LeviathanStudios/Scheduler
 * @version     1.0.0
 * @author      Greg Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use LeviathanStudios\Scheduler\Api\Data\EventRequestInterface;

/**
 * Interface EventRequestRepositoryInterface
 *
 * @package LeviathanStudios\Scheduler\Api
 */
interface EventRequestRepositoryInterface
{
    /**
     * @param int $id
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface $request
     * @return \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface
     */
    public function save(EventRequestInterface $request);

    /**
     * @param \LeviathanStudios\Scheduler\Api\Data\EventRequestInterface $request
     * @return void
     */
    public function delete(EventRequestInterface $request);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \LeviathanStudios\Scheduler\Api\Data\EstimateSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
