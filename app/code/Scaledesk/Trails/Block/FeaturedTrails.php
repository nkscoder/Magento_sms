<?php
/**
 * Created by PhpStorm.
 * User: nitesh
 * Date: 30/4/18
 * Time: 2:18 PM
 */

namespace Scaledesk\Trails\Block;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Scaledesk\Trails\Model\ResourceModel\Post\Collection as PostCollection;
use \Scaledesk\Trails\Model\ResourceModel\Post\CollectionFactory as PostCollectionFactory;
use \Scaledesk\Trails\Model\Post;


class FeaturedTrails extends Template
{
    /**
     * CollectionFactory
     * @var null|CollectionFactory
     */
    protected $_postCollectionFactory = null;
    public $sortOrder = 0;
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
    ) {
        $this->_postCollectionFactory = $postCollectionFactory;
        parent::__construct($context, $data);
        $this->sortOrder = $this->getRequest()->getParam('sort');
    }

    /**
     * @return Post[]
     */
    public function getFeaturedTrails()
    {
        /** @var PostCollection $postCollection */


        $postCollection = $this->_postCollectionFactory->create();
        $postCollection->addFieldToSelect('*');
        $postCollection->addFieldToFilter('trails_featured',1);
        $postCollection->load();
        //var_dump($postCollection->getSelect()->__toString());

        return $postCollection->getItems();


    }

    /**
     * For a given post, returns its url
     * @param Post $post
     * @return string
     */
    public function getFeaturedTrailsUrl(
        Post $post
    ) {
        return $this->getUrl().'trails/post/view/id/'. $post->getId();
    }




}