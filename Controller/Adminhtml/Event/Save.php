<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Controller\Adminhtml\Event;

use LeviathanStudios\Scheduler\Api\EventRequestRepositoryInterface;
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
 * Save controller class used to save the event data.
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

            if ($id = $this->getRequest()->getParam('entity_id')) {
                try {
                    $model = $this->eventRepository->getById($id);
                } catch (NoSuchEntityException $e) {
                    $this->messageManager->addErrorMessage(__('This event no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            } else {
                $model = $this->eventFactory->create();
            }

            $model->setData($data);

            try {
                $this->eventRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the event.'));
                $this->dataPersistor->clear('event');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getEntityId()]);
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
     * @return mixed
     */
    private function filterData($postData)
    {
        if (empty($data['entity_id'])) {
            $postData['entity_id'] = null;
        }

        if (empty($data['customer_id'])) {
            $postData['customer_id'] = $this->getCustomerId($data);
        }

        return $postData;
    }

    /**
     * Get the customer ID if there is a match.
     *
     * @param $data
     * @return int|null
     */
    private function getCustomerId($data)
    {
        $customerId = null;

        if ($data['email']) {
            try {
                /** @var CustomerInterface $customer */
                $customer   = $this->customerRepository->get($data['email']);
                $customerId = $customer->getId();
            } catch (\Exception $e) {
                // do nothing, there was no match.
            }
        }

        return $customerId;
    }
}