<?php
namespace Dac\Recipes\Model\ResourceModel\Post;

use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Remittance File Collection Constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Dac\Recipes\Model\Post', 'Dac\Recipes\Model\ResourceModel\Post');
    }
}