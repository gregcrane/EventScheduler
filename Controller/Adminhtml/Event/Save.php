<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Controller\Adminhtml\Event;

use LeviathanStudios\Scheduler\Api\EventRequestRepositoryInterface;
use LeviathanStudios\Scheduler\Model\Config\Source\EventStatus;
use LeviathanStudios\Scheduler\Model\EventRequest;
use LeviathanStudios\Scheduler\Model\EventRequestFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Controller responsible for saving an event.
 */
class Save extends Action
{
    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'LeviathanStudios_Scheduler::scheduler';

    /** @var EventRequestRepositoryInterface $eventRepository */
    private $eventRepository;

    /** @var EventRequestFactory $eventFactory */
    private $eventFactory;

    /** @var CustomerRepositoryInterface $customerRepository */
    private $customerRepository;

    /** @var DataPersistorInterface $dataPersistor */
    protected $dataPersistor;

    /**
     * @param Context                         $context
     * @param EventRequestRepositoryInterface $eventRepository
     * @param EventRequestFactory             $eventFactory
     * @param CustomerRepositoryInterface     $customerRepository
     * @param DataPersistorInterface          $dataPersistor
     */
    public function __construct(
        Context $context,
        EventRequestRepositoryInterface $eventRepository,
        EventRequestFactory $eventFactory,
        CustomerRepositoryInterface $customerRepository,
        DataPersistorInterface $dataPersistor
    ) {
        $this->eventRepository    = $eventRepository;
        $this->eventFactory       = $eventFactory;
        $this->customerRepository = $customerRepository;
        $this->dataPersistor      = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save the event data.
     *
     * @return Redirect|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data           = $this->getRequest()->getPostValue();
        if ($data) {
            $data = $this->filterData($data);

            if (!$this->validateTime($data)) {
                $this->messageManager->addErrorMessage(__('Please fix the start/end dates.'));
                return $resultRedirect->setPath('*/*/edit');
            }

            if ($id = $this->getRequest()->getParam('entity_id')) {
                try {
                    /** @var EventRequest $model */
                    $model = $this->eventRepository->getById($id);
                } catch (NoSuchEntityException $e) {
                    $this->messageManager->addErrorMessage(__('This event no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                /** @var EventRequest $model */
                $model = $this->eventFactory->create();
            }

            $model->setData($data);

            try {
                $model = $this->eventRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the event.'));
                $this->dataPersistor->clear('event');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['entity_id' => $model->getEntityId()]);
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $exception) {
                $this->messageManager->addExceptionMessage(
                    $exception,
                    __('Something went wrong while saving the event.')
                );
            }
        }

        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Massage the post data into an acceptable format.
     *
     * @param $postData
     * @return array
     */
    private function filterData($postData): array
    {
        if (empty($postData['entity_id'])) {
            $postData['entity_id'] = null;
        }

        if (empty($postData['customer_id'])) {
            $postData['customer_id'] = $this->getCustomerId($postData);
        }

        /**
         * do some custom work around the class events since these are
         * reoccurring.
         */
        if (key_exists('type', $postData) && $postData['type'] == 'class') {
            $postData['email']     = 'N/A';
            $postData['telephone'] = 'N/A';
            $postData['status']    = EventStatus::CLASS_STATUS;
            $postData['weekday']   = date('l', strtotime($postData['start_time']));
        }

        $postData['date'] = date('d-m-Y', strtotime($postData['start_time']));

        return $postData;
    }

    /**
     * Get the customer ID if there is a match.
     *
     * @param $postData
     * @return int|null
     */
    private function getCustomerId($postData)
    {
        $customerId = null;

        if ($postData['email']) {
            try {
                /** @var CustomerInterface $customer */
                $customer   = $this->customerRepository->get($postData['email']);
                $customerId = $customer->getId();
            } catch (\Exception $e) {
                // do nothing, there was no match.
            }
        }

        return $customerId;
    }

    /**
     * Determine if the start and end times are valid.
     *
     * Runs some validation to make sure the requests are:
     * 1. on the same date
     * 2. end time does no precede start time.
     *
     * @param $postData
     * @return bool
     */
    private function validateTime($postData): bool
    {
        $flag = false;

        if (key_exists('start_time', $postData) && key_exists('end_time', $postData)) {
            $start     = date('d-m-Y', strtotime($postData['start_time']));
            $end       = date('d-m-Y', strtotime($postData['end_time']));
            $startTime = date('Y-m-d H:i:s', strtotime($postData['start_time']));
            $endTime   = date('Y-m-d H:i:s', strtotime($postData['end_time']));
            if ($start == $end && $startTime < $endTime) {
                $flag = true;
            }
        }

        return $flag;
    }
}
