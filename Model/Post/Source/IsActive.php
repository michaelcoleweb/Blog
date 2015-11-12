<?php

namespace Mc\Blog\Model\Post\Source;

class IsActive implements \Magento\Framework\Data\OptionSourceInterface
{
    /** @var  \Mc\Blog\Model\Post */
    protected $post;

    public function __construct(\Mc\Blog\Model\Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get options for post status
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options[] = ['value' => '', 'label' => ''];
        $availableOptions = $this->post->getAvailableStatuses();
        foreach ($availableOptions as $value => $label) {
            $options[] = [
                'value' => $value,
                'label' => $label
            ];
        }

        return $options;
    }
}