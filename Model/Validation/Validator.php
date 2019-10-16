<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Model\Validation;

use LeviathanStudios\Scheduler\Api\Data\EventRequestResultInterface;
use LeviathanStudios\Scheduler\Api\EventRequestRepositoryInterface;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\FilterGroupBuilder;
use Magento\Framework\Api\SearchCriteriaBuilder;

/**
 * Event time slot validation class.
 *
 * Validator class tasked with determining if there are prior events scheduled in
 * the requested time slot. This checks both normal sessions and class sessions.
 */
class Validator
{
    /** @var EventRequestRepositoryInterface $eventRepository */
    private $eventRepository;

    /** @var SearchCriteriaBuilder $searchCriteriaBuilder */
    private $searchCriteriaBuilder;

    /** @var FilterBuilder $filterBuilder */
    private $filterBuilder;

    /** @var FilterGroupBuilder $filterGroupBuilder */
    private $filterGroupBuilder;

    /**
     * @param EventRequestRepositoryInterface $eventRepository
     * @param SearchCriteriaBuilder           $searchCriteriaBuilder
     * @param FilterBuilder                   $filterBuilder
     * @param FilterGroupBuilder              $filterGroupBuilder
     */
    public function __construct(
        EventRequestRepositoryInterface $eventRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        FilterBuilder $filterBuilder,
        FilterGroupBuilder $filterGroupBuilder
    ) {
        $this->eventRepository       = $eventRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->filterBuilder         = $filterBuilder;
        $this->filterGroupBuilder    = $filterGroupBuilder;
    }

    /**
     * Run date amd time slot validation on the event request.
     *
     * @param $dateData
     * @return array
     */
    public function validateDate($dateData): array
    {
        $errorMessages = [];
        $isValid       = true;
        $weekday       = date('l', strtotime($dateData['start_time_stamp']));
        $classGroup    = $this->buildClassCollection($weekday, $dateData['start_time'], $dateData['end_time']);
        $dateGroup     = $this->buildDateCollection(
            $dateData['date'], $dateData['start_time'], $dateData['end_time'], $dateData['entity_id']
        );

        foreach ($classGroup->getItems() as $event) {
            $errorMessages[] = __('There is a class scheduled at that time, please pick another date');
            $isValid         = false;
        }

        foreach ($dateGroup->getItems() as $event) {
            $errorMessages[] = __('There is a appointment scheduled at that time, please pick another date');
            $isValid         = false;
        }

        return [
            'messages' => $errorMessages,
            'result'   => $isValid
        ];
    }

    /**
     * Return the class collection.
     *
     * Build out the filters and groups for the class collection.
     *
     * @param $weekday
     * @param $startTime
     * @param $endTime
     * @return EventRequestResultInterface
     */
    private function buildClassCollection($weekday, $startTime, $endTime): EventRequestResultInterface
    {
        $searchCriteria = $this->searchCriteriaBuilder->setFilterGroups(
            [
                $this->filterGroupBuilder->addFilter(
                    $this->filterBuilder->setField('weekday')
                                        ->setValue($weekday)
                                        ->setConditionType('eq')
                                        ->create()
                )->create(),
                $this->filterGroupBuilder->addFilter(
                    $this->filterBuilder->setField('type')
                                        ->setValue('class')
                                        ->setConditionType('eq')
                                        ->create()
                )->create(),
                $this->filterGroupBuilder->addFilter(
                    $this->filterBuilder->setField('start_time')
                                        ->setValue($startTime)
                                        ->setConditionType('gteq')
                                        ->create()
                )->create(),
                $this->filterGroupBuilder->addFilter(
                    $this->filterBuilder->setField('end_time')
                                        ->setValue($endTime)
                                        ->setConditionType('lteq')
                                        ->create()
                )->create()
            ]
        )->create();

        return $this->eventRepository->getList($searchCriteria);
    }

    /**
     * Return the date collection.
     *
     * @param      $date
     * @param      $startTime
     * @param      $endTime
     * @param null $id
     * @return EventRequestResultInterface
     */
    private function buildDateCollection($date, $startTime, $endTime, $id = null): EventRequestResultInterface
    {
        if ($id) {
            $searchCriteria = $this->searchCriteriaBuilder->setFilterGroups(
                [
                    $this->filterGroupBuilder->addFilter(
                        $this->filterBuilder->setField('date')
                                            ->setValue($date)
                                            ->setConditionType('eq')
                                            ->create()
                    )->create(),
                    $this->filterGroupBuilder->addFilter(
                        $this->filterBuilder->setField('start_time')
                                            ->setValue($startTime)
                                            ->setConditionType('gteq')
                                            ->create()
                    )->create(),
                    $this->filterGroupBuilder->addFilter(
                        $this->filterBuilder->setField('end_time')
                                            ->setValue($endTime)
                                            ->setConditionType('lteq')
                                            ->create()
                    )->create(),
                    $this->filterGroupBuilder->addFilter(
                        $this->filterBuilder->setField('type')
                                            ->setValue('class')
                                            ->setConditionType('neq')
                                            ->create()
                    )->create(),
                    $this->filterGroupBuilder->addFilter(
                        $this->filterBuilder->setField('status')
                                            ->setValue(2)
                                            ->setConditionType('eq')
                                            ->create()
                    )->create(),
                    $this->filterGroupBuilder->addFilter(
                        $this->filterBuilder->setField('entity_id')
                                            ->setValue($id)
                                            ->setConditionType('neq')
                                            ->create()
                    )->create()
                ]
            )->create();
        } else {
            $searchCriteria = $this->searchCriteriaBuilder->setFilterGroups(
                [
                    $this->filterGroupBuilder->addFilter(
                        $this->filterBuilder->setField('date')
                                            ->setValue($date)
                                            ->setConditionType('eq')
                                            ->create()
                    )->create(),
                    $this->filterGroupBuilder->addFilter(
                        $this->filterBuilder->setField('start_time')
                                            ->setValue($startTime)
                                            ->setConditionType('gteq')
                                            ->create()
                    )->create(),
                    $this->filterGroupBuilder->addFilter(
                        $this->filterBuilder->setField('end_time')
                                            ->setValue($endTime)
                                            ->setConditionType('lteq')
                                            ->create()
                    )->create(),
                    $this->filterGroupBuilder->addFilter(
                        $this->filterBuilder->setField('type')
                                            ->setValue('class')
                                            ->setConditionType('neq')
                                            ->create()
                    )->create(),
                    $this->filterGroupBuilder->addFilter(
                        $this->filterBuilder->setField('status')
                                            ->setValue(2)
                                            ->setConditionType('eq')
                                            ->create()
                    )->create()
                ]
            )->create();
        }

        return $this->eventRepository->getList($searchCriteria);
    }
}
