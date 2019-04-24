<?php

namespace Repin\CustomerStatus\Controller\Account;

use Magento\Framework\App\Action\Context;
use Magento\Customer\Api\CustomerRepositoryInterface as CustomerRepository;
use Magento\Framework\Data\Form\FormKey\Validator;
use Magento\Customer\Model\Session;
use Magento\Store\Model\StoreManagerInterface;

class SaveStatus extends \Magento\Customer\Controller\AbstractAccount
{

    /**
     * @var \Magento\Framework\Data\Form\FormKey\Validator
     */
    protected $formKeyValidator;


    /**
     * @var CustomerRepository
     */
    protected $customerRepository;

    /**
     * Customer session
     *
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;


    public function __construct(
        Context $context,
        CustomerRepository $customerRepository,
        Validator $formKeyValidator,
        StoreManagerInterface $storeManager,
        Session $customerSession
    ) {
        $this->customerRepository = $customerRepository;
        $this->formKeyValidator = $formKeyValidator;
        $this->customerSession = $customerSession;
        $this->storeManager = $storeManager;
        parent::__construct($context);
    }

    public function execute()
    {
        if (!$this->formKeyValidator->validate($this->getRequest())) {
            return $this->_redirect('customer/account/status');
        }

        $customerId = $this->customerSession->getCustomerId();
        if ($customerId === null) {
            $this->messageManager->addError(__('Something went wrong while saving your subscription.'));
        } else {
            try {
                $customer = $this->customerRepository->getById($customerId);
                $storeId = $this->storeManager->getStore()->getId();
                $customer->setStoreId($storeId);
                $status = $this->getRequest()->getParam('customer_status');
                if ($status) {
                    $customer->setCustomAttribute('customer_status', $status);
                    $this->customerRepository->save($customer);
                }
            } catch (\Exception $e) {
                $this->messageManager->addError(__('Something went wrong while saving your subscription.'));
            }
        }
        $this->_redirect('customer/account/status');

    }
}