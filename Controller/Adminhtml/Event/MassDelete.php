<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Controller\Adminhtml\Event;

use LeviathanStudios\Scheduler\Api\EventRequestRepositoryInterface;
use LeviathanStudios\Scheduler\Model\EventRequest;
use LeviathanStudios\Scheduler\Model\ResourceModel\EventRequest\Collection;
use LeviathanStudios\Scheduler\Model\ResourceModel\EventRequest\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Result\PageFactory;
use Magento\Ui\Component\MassAction\Filter;

/**
 * Controller class responsible for the mass delete action.
 */
class MassDelete extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'LeviathanStudios_Scheduler::scheduler';

    /** @var JsonFactory $resultJsonFactory */
    private $resultJsonFactory;

    /** @var PageFactory $resultPageFactory */
    private $resultPageFactory;

    /** @var EventRequestRepositoryInterface $eventRepository */
    private $eventRepository;

    /**@var Filter $filter */
    private $filter;

    /** @var CollectionFactory $collectionFactory */
    private $collectionFactory;

    /**
     * @param Action\Context                  $context
     * @param PageFactory                     $resultPageFactory
     * @param JsonFactory                     $resultJsonFactory
     * @param Filter                          $filter
     * @param EventRequestRepositoryInterface $eventRepository
     * @param CollectionFactory               $collectionFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        Filter $filter,
        EventRequestRepositoryInterface $eventRepository,
        CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->eventRepository   = $eventRepository;
        $this->filter            = $filter;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Delete selected event grid entities.
     *
     * @return Redirect|ResponseInterface|ResultInterface
     * @throws LocalizedException
     */
    public function execute()
    {
        /** @var Collection $collection */
        $collection     = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();

        try {
            /** @var EventRequest $event */
            foreach ($collection->getItems() as $event) {
                $this->eventRepository->deleteById($event->getId());
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Error in deletion process'));
        }

        $this->messageManager->addSuccessMessage(__('A total of %1 record(s) have been deleted.', $collectionSize));

        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
