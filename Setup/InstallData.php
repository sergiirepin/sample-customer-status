<?php

namespace Repin\CustomerStatus\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Customer\Model\Customer;
use Magento\Customer\Setup\CustomerSetupFactory;

class InstallData implements InstallDataInterface
{
    const ATTRIBUTE_CODE = 'customer_status';


    protected $customerSetupFactory;

    public function __construct(CustomerSetupFactory $customerSetupFactory)
    {
        $this->customerSetupFactory = $customerSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $customerSetup = $this->customerSetupFactory->create();
        $customerSetup->addAttribute(
            Customer::ENTITY,
            self::ATTRIBUTE_CODE,
            [
                'type' => 'varchar',
                'label' => 'Customer Status',
                'input' => 'text',
                'required' => false,
                'visible' => true,
                'user_defined' => false,
                'position' => 100,
                'system' => 0,
            ]
        );

        $attribute = $customerSetup->getEavConfig()->getAttribute(Customer::ENTITY, self::ATTRIBUTE_CODE);

        $attribute->setData(
            'used_in_forms',
            ['adminhtml_customer']
        );
        $attribute->save();

        $setup->endSetup();
    }
}
