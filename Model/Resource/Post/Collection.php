<?php

namespace Mc\Blog\Model\Resource\Post;

/**
 * Class Collection for posts
 *
 * @package Mc\Blog\Model\Resource\Post
 */
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Mc\Blog\Model\Post', 'Mc\Blog\Model\Resource\Post');
    }
}