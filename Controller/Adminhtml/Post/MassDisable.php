<?php

namespace Mc\Blog\Controller\Adminhtml\Post;

use Mc\Blog\Controller\Adminhtml\AbstractMassStatus;

/**
 * Class MassDisable
 */
class MassDisable extends AbstractMassStatus
{
    /**
     * Field id
     */
    const ID_FIELD = 'post_id';

    /**
     * Resource collection
     *
     * @var string
     */
    protected $collection = 'Mc\Blog\Model\Resource\Post\Collection';

    /**
     * Post model
     *
     * @var string
     */
    protected $model = 'Mc\Blog\Model\Post';

    /**
     * Post disable status
     *
     * @var boolean
     */
    protected $status = false;
}
