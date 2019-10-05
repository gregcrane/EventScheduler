<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Model\Repository;

use LeviathanStudios\Scheduler\Api\Data\EventRequestInterface;
use LeviathanStudios\Scheduler\Api\Data\EventRequestResultInterface;
use LeviathanStudios\Scheduler\Api\Data\EventRequestResultInterfaceFactory;
use LeviathanStudios\Scheduler\Api\EventRequestRepositoryInterface;
use LeviathanStudios\Scheduler\Model\EventRequest;
use LeviathanStudios\Scheduler\Model\EventRequestFactory;
use LeviathanStudios\Scheduler\Model\ResourceModel\EventRequest as ResourceModel;
use LeviathanStudios\Scheduler\Model\ResourceModel\EventRequest\Collection;
use LeviathanStudios\Scheduler\Model\ResourceModel\EventRequest\CollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Repository class for events.
 */
class EventRequestRepository implements EventRequestRepositoryInterface
{
    /** @var ResourceModel $resourceModel $resourceModel */
    private $resourceModel;

    /** @var EventRequestFactory $eventFactory */
    private $eventFactory;

    /** @var CollectionFactory $collectionFactory */
    private $collectionFactory;

    /** @var EventRequestResultInterfaceFactory $searchResultsFactory */
    private $searchResultsFactory;

    /** @var CollectionProcessorInterface $collectionProcessor */
    private $collectionProcessor;

    /**
     * @param ResourceModel                      $resourceModel
     * @param EventRequestFactory                $eventFactory
     * @param CollectionFactory                  $collectionFactory
     * @param EventRequestResultInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface       $collectionProcessor
     */
    public function __construct(
        ResourceModel $resourceModel,
        EventRequestFactory $eventFactory,
        CollectionFactory $collectionFactory,
        EventRequestResultInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resourceModel        = $resourceModel;
        $this->eventFactory         = $eventFactory;
        $this->collectionFactory    = $collectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor  = $collectionProcessor;
    }

    /**
     * @inheritdoc
     */
    public function save(EventRequestInterface $event): EventRequestRepository
    {
        $model = $this->mapDataIntoModel($event);
        try {
            $this->resourceModel->save($model);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Could not save event'), $exception);
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getById($eventId): EventRequest
    {
        /** @var EventRequest $model */
        $model = $this->eventFactory->create();
        $model = $this->resourceModel->load($model, $eventId);
        if (!$model->getId()) {
            throw new NoSuchEntityException(__('Event with id "%1" does not exist.', $eventId));
        }

        return $model;
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria): EventRequestResultInterface
    {
        /** @var EventRequestResultInterface $searchResults */
        $searchResults = $this->searchResultsFactory->create();

        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);

        $searchResults->setTotalCount($collection->getSize());

        $eventModels = [];
        /** @var EventRequest $eventModel */
        foreach ($collection as $eventModel) {
            $eventModels[] = $eventModel;
        }
        $searchResults->setItems($eventModels);

        return $searchResults;
    }

    /**
     * @inheritdoc
     */
    public function delete(EventRequestInterface $event): bool
    {
        return $this->deleteById($event->getId());
    }

    /**
     * @inheritdoc
     */
    public function deleteById($eventId): bool
    {
        /** @var EventRequest $model */
        $model = $this->eventFactory->create();
        $model->setId($eventId);
        try {
            $this->resourceModel->delete($model);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__('Could not delete event'), $exception);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteMultiple(SearchCriteriaInterface $searchCriteria): bool
    {
        /** @var Collection $collection */
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, $collection);
        try {
            $this->resourceModel->deleteByCollection($collection);
        } catch (\Exception $e) {
            throw new CouldNotDeleteException(__('Could not delete events.'), $e);
        }

        return true;
    }

    /**
     * Convert a EventRequestInterface into a EventRequest model.
     *
     * @param EventRequestInterface $event
     * @return EventRequest
     */
    private function mapDataIntoModel(EventRequestInterface $event): EventRequest
    {
        /** @var EventRequest $model */
        $model = $this->eventFactory->create();
        $model->setData(
            [
                EventRequestInterface::ENTITY_ID   => $event->getId(),
                EventRequestInterface::TYPE        => $event->getType(),
                EventRequestInterface::CUSTOMER_ID => $event->getCustomerId(),
                EventRequestInterface::STATUS      => $event->getStatus(),
                EventRequestInterface::NAME        => $event->getName(),
                EventRequestInterface::EMAIL       => $event->getEmail(),
                EventRequestInterface::TELEPHONE   => $event->getTelephone(),
                EventRequestInterface::START_TIME  => $event->getStartTime(),
                EventRequestInterface::END_TIME    => $event->getEndTime(),
                EventRequestInterface::DATE        => $event->getDate(),
                EventRequestInterface::MESSAGE     => $event->getMessage()
            ]
        );

        return $model;
    }
}
