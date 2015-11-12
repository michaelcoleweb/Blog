<?php

namespace Mc\Blog\Model\Resource;

/**
 * Comment resource
 *
 * @package Mc\Blog\Model\Resource
 */
class Comment extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * @var \Magento\Framework\Stdlib\DateTime
     */
    protected $dateTime;

    /**
     * Construct
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Framework\Stdlib\DateTime\DateTime       $date
     * @param string|null                                       $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        \Magento\Framework\Stdlib\DateTime $dateTime,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
        $this->_date = $date;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mc_blog_comment', 'comment_id');
    }

    /**
     * Process post data before saving
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     *
     * @return $this
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        /*if (!$this->isValidPostUrlKey($object)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('The post URL key contains capital letters or disallowed symbols.')
            );
        }

        if ($this->isNumericPostUrlKey($object)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('The post URL key cannot be made of only numbers.')
            );
        }*/

        if ($object->isObjectNew() && !$object->hasCreationTime()) {
            $object->setCreationTime($this->_date->gmtDate());
        }

        /** @TODO: add in logged in admin id */

        $object->setCreationTime($this->_date->gmtDate());

        return parent::_beforeSave($object);
    }


    /**
     * Retrieve select object for load object data
     *
     * Also join on admin_user to get admin username
     *
     * @param string                $field
     * @param mixed                 $value
     * @param \Mc\Blog\Model\Post   $object
     *
     * @return \Zend_Db_Select
     */
    protected function _getLoadSelect($field, $value, $object)
    {
        $select = parent::_getLoadSelect($field, $value, $object);

        /*$select->joinLeft(
            ['admin_user' => $this->getTable('admin_user')],
            $this->getMainTable() . '.admin_id = admin_user.user_id',
            ['username']
        )->where(
            $this->getMainTable() . '.is_active = ?',
            1
        )->limit(
            1
        );*/

        return $select;
    }

}
