<?php

namespace Mc\Blog\Model\Resource;

/**
 * Post resource
 *
 * @package Mc\Blog\Model\Resource
 */
class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
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
        $this->_init('mc_blog_post', 'post_id');
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
        if (!$this->isValidPostUrlKey($object)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('The post URL key contains capital letters or disallowed symbols.')
            );
        }

        if ($this->isNumericPostUrlKey($object)) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('The post URL key cannot be made of only numbers.')
            );
        }

        if ($object->isObjectNew() && !$object->hasCreationTime()) {
            $object->setCreationTime($this->_date->gmtDate());
        }

        /** @TODO: add in logged in admin id */

        $object->setUpdateTime($this->_date->gmtDate());

        return parent::_beforeSave($object);
    }

    /**
     * Load an object using 'url_key' field if there's no field specified and value is not numeric
     *
     * @param \Magento\Framework\Model\AbstractModel    $object
     * @param mixed                                     $value
     * @param string                                    $field
     *
     * @return $this
     */
    public function load(\Magento\Framework\Model\AbstractModel $object, $value, $field = null)
    {
        if (!is_numeric($value) && is_null($field)) {
            $field = 'url_key';
        }

        return parent::load($object, $value, $field);
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

        $select->joinLeft(
            ['admin_user' => $this->getTable('admin_user')],
            $this->getMainTable() . '.admin_id = admin_user.user_id',
            ['username']
        )->where(
            $this->getMainTable() . '.is_active = ?',
            1
        )->limit(
            1
        );

        return $select;
    }

    /**
     * Retrieve load select with filter by url_key and activity
     *
     * @param string    $url_key
     * @param int       $isActive
     *
     * @return \Magento\Framework\DB\Select
     */
    protected function _getLoadByUrlKeySelect($url_key, $isActive = null)
    {
        $select = $this->_getReadAdapter()->select()->from(
            ['bp' => $this->getMainTable()]
        )->where(
            'bp.url_key = ?',
            $url_key
        );

        if (!is_null($isActive)) {
            $select->where('bp.is_active = ?', $isActive);
        }

        return $select;
    }

    /**
     *  Check whether post url key is numeric
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     *
     * @return bool
     */
    protected function isNumericPostUrlKey(\Magento\Framework\Model\AbstractModel $object)
    {
        return preg_match('/^[0-9]+$/', $object->getData('url_key'));
    }

    /**
     *  Check whether post url key is valid
     *
     * @param \Magento\Framework\Model\AbstractModel $object
     *
     * @return bool
     */
    protected function isValidPostUrlKey(\Magento\Framework\Model\AbstractModel $object)
    {
        return preg_match('/^[a-z0-9][a-z0-9_\/-]+(\.[a-z0-9_-]+)?$/', $object->getData('url_key'));
    }

    /**
     * Check if post url key exists
     *
     * return post id if post exists
     *
     * @param string $url_key
     *
     * @return int
     */
    public function checkUrlKey($url_key)
    {
        $select = $this->_getLoadByUrlKeySelect($url_key, 1);
        $select->reset(\Zend_Db_Select::COLUMNS)->columns('bp.post_id')->limit(1);

        return $this->_getReadAdapter()->fetchOne($select);
    }
}
