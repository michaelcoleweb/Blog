<?php

namespace Mc\Blog\Model\Resource\Comment;

/**
 * Class Collection for comments
 *
 * @package Mc\Blog\Model\Resource\Post
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Mc\Blog\Model\Comment', 'Mc\Blog\Model\Resource\Comment');
    }
}
