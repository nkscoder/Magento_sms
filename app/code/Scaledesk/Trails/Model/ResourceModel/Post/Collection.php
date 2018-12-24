<?php
namespace Scaledesk\Trails\Model\ResourceModel\Post;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Remittance File Collection Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Scaledesk\Trails\Model\Post', 'Scaledesk\Trails\Model\ResourceModel\Post');
    }
}