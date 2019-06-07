<?php
namespace SR\DeliveryDate\Model\Config\Source;

use Magento\Framework\Locale\ListsInterface;
use Magento\Framework\Data\OptionSourceInterface;

class Disabled implements OptionSourceInterface
{
    /**
     * @var ListsInterface
     */
    protected $localeLists;

    /**
     * Disabled constructor.
     *
     * @param ListsInterface $localeLists
     */
    public function __construct(ListsInterface $localeLists)
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