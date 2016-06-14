<?php
namespace SR\DeliveryDate\Model\Config\Source;


class Disabled implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var \Magento\Framework\Locale\ListsInterface
     */
    protected $localeLists;

    /**
     * @param \Magento\Framework\Locale\ListsInterface $localeLists
     */
    public function __construct(\Magento\Framework\Locale\ListsInterface $localeLists)
    {
        $this->localeLists = $localeLists;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = $this->localeLists->getOptionWeekdays();
        array_unshift($options, [
            'label' => __('No Day'),
            'value' => -1
        ]);
        return $options;
    }
}