<?php
/**
 * @copyright   Copyright © Leviathan Studios, Licensed under MIT
 * @author      Grey Crane <gmc31886@gmail.com>
 */
declare(strict_types=1);

namespace LeviathanStudios\Scheduler\Controller\Adminhtml\Event;

use LeviathanStudios\Scheduler\Api\EventRequestRepositoryInterface;
use LeviathanStudios\Scheduler\Model\EventRequest;
use LeviathanStudios\Scheduler\Model\EventRequestFactory;
use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface as FrameworkResponse;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\PageFactory;

/**
 * Edit controller class used for setting up a blank or populated admin form.
 */
class Edit extends Action implements HttpGetActionInterface
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

    /** @var EventRequestFactory $eventFactory */
    private $eventFactory;

    /**
     * @param Action\Context                  $context
     * @param PageFactory                     $resultPageFactory
     * @param JsonFactory                     $resultJsonFactory
     * @param EventRequestRepositoryInterface $eventRepository
     * @param EventRequestFactory             $eventFactory
     */
    public function __construct(
        Action\Context $context,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        EventRequestRepositoryInterface $eventRepository,
        EventRequestFactory $eventFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        $this->eventRepository   = $eventRepository;
        $this->eventFactory      = $eventFactory;
    }

    /**
     * Load the event edit form page.
     *
     * @return Page|Redirect|FrameworkResponse|ResultInterface
     */
    public function execute()
    {
        if ($id = $this->getRequest()->getParam('entity_id')) {
            try {
                /** @var EventRequest $model */
                $model = $this->eventRepository->getById($id);
                if (!$model->getId()) {
                    $this->messageManager->addErrorMessage(__('This event no longer exists.'));
                    /** @var Redirect $resultRedirect */
                    $resultRedirect = $this->resultRedirectFactory->create();
                    return $resultRedirect->setPath('*/*/');
                }
            } catch (NoSuchEntityException $exception) {
                $this->messageManager->addErrorMessage(__('This event no longer exists.'));
                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        /** @var Page $resultPage */
        $resultPage      = $this->resultPageFactory->create();
        $resultPageTitle = $id ? __('Edit Event') : __('New Event');
        $resultPage->setActiveMenu('LeviathanStudios_Scheduler::container');
        $resultPage->getConfig()->getTitle()->prepend($resultPageTitle);
        $resultPage->addBreadcrumb(__('Manage Events'), __('Manage Events'));

        return $resultPage;
    }
}
