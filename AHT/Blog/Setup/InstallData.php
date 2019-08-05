<?php
 
namespace AHT\Blog\Setup;
 
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
 
class InstallData implements InstallDataInterface
{
    /**
     * EAV setup factory
     *
     * @var \Magento\Eav\Setup\EavSetupFactory
     */
    private $eavSetupFactory;
 
    /**
     * Constructor
     *
     * @param EavSetupFactory $eavSetupFactory
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory,
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
    }
 
    /**
     * {@inheritdoc}
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
 
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
       
        /**
         * Insert/Create a simple text attribute
         */
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'chapagain_attribute_text_1',
            [
                'type' => 'text',
                'backend' => '',
                'frontend' => '',
                'label' => 'My Custom Text',
                'input' => 'text',
                'class' => '',
                'source' => '',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE, // can also use \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_STORE, // scope of the attribute (global, store, website)
                'visible' => true,
                'required' => true,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => ''
            ]
        );
 
        /**
         * Insert/Create a seletbox attribute with custom options
         */
        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'chapagain_attribute_select_1',
            [
                'type' => 'int', // data type to be saved in database table
                'backend' => '',
                'frontend' => '',
                'label' => 'My Custom Selectbox',
                'input' => 'select', // form element type displayed in the form
                'class' => '',
                'source' => 'Chapagain\ProductAttribute\Model\Config\Source\MyCustomOptions',
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE, // can also use \Magento\Catalog\Model\ResourceModel\Eav\Attribute::SCOPE_STORE, // scope of the attribute (global, store, website)
                'visible' => true,
                'required' => true,
                'user_defined' => false,
                'default' => '',
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => true,
                'unique' => false,
                'apply_to' => ''
            ]
        );
 
        $setup->endSetup();
    }
}