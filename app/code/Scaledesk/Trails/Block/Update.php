<?php
/**
 * Created by PhpStorm.
 * User: nitesh
 * Date: 17/4/18
 * Time: 7:31 PM
 */

namespace Scaledesk\Trails\Block;


use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Scaledesk\Trails\Model\ResourceModel\Post\Collection as PostCollection;
use \Scaledesk\Trails\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use \Scaledesk\Trails\Model\Post;

class Update  extends Template
{
    /**
     * CollectionFactory
     * @var null|CollectionFactory
     */
    protected $_postCollectionFactory = null;

    /**
     * Constructor
     *
     * @param Context $context
     * @param PostCollectionFactory $postCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        PostCollectionFactory $postCollectionFactory,
        array $data = []
    )
    {
        $this->_postCollectionFactory = $postCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return Post[]
     */
    public function getTrails()
    {
        /** @var PostCollection $postCollection */
        $postCollection = $this->_postCollectionFactory->create();
        $postCollection->addFieldToSelect('*');
        $postCollection->addFieldToFilter('trails_id',$this->getRequest()->getParam('id'));
         $postCollection->load();
        return $postCollection->getItems();
//            $trailsId=;

//        $om = \Magento\Framework\App\ObjectManager::getInstance();
//        $customerSession = $om->get('Magento\Customer\Model\Session');
//        $customerData = $customerSession->getCustomer()->getData();
//
//        var_dump($trailsId); die();
    }

    /**
     * For a given post, returns its url
     * @param Post $post
     * @return string
     */
    public function getPostUrl(
        Register $post
    ) {
        return '/trails/post/view/id/' . $post->getId();
    }

}