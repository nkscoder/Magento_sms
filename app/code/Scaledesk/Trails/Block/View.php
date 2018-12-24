<?php
/**
 * Created by PhpStorm.
 * User: nitesh
 * Date: 17/4/18
 * Time: 11:43 AM
 */


namespace Scaledesk\Trails\Block;

use \Magento\Framework\Exception\LocalizedException;
use \Magento\Framework\View\Element\Template;
use \Magento\Framework\View\Element\Template\Context;
use \Magento\Framework\Registry;
use \Scaledesk\Trails\Model\Post;
use \Scaledesk\Trails\Model\PostFactory;
use \Scaledesk\Trails\Controller\Post\View as ViewAction;

class View extends Template
{
    /**
     * Core registry
     * @var Registry
     */
    protected $_coreRegistry;

    /**
     * Post
     * @var null|Post
     */
    protected $_post = null;

    /**
     * PostFactory
     * @var null|PostFactory
     */
    protected $_postFactory = null;

    /**
     * Constructor
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PostFactory $postCollectionFactory
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PostFactory $postFactory,
        array $data = []
    ) {
        $this->_postFactory = $postFactory;
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    /**
     * Lazy loads the requested post
     * @return Post
     * @throws LocalizedException
     */
    public function getPost()
    {
         if ($this->_post === null) {
            /** @var Post $post */
            $post = $this->_postFactory->create();
            $post->load($this->_getPostId());

            if (!$post->getId()) {
                throw new LocalizedException(__('Trail not found'));
            }

            $this->_post = $post;
        }
        return $this->_post;

    }

    /**
     * Retrieves the post id from the registry
     * @return int
     */
    protected function _getPostId()
    {
        return (int) $this->_coreRegistry->registry(
            ViewAction::REGISTRY_KEY_POST_ID
        );
    }
    
        public function getSinglePageFeaturedTrails() {


        return $this->getLayout()->createBlock('Scaledesk\Trails\Block\Posts')->getFeaturedTrails();

         


    }
    
     public function getSinglePagePostUrl($post) {


        return   $this->getLayout()->createBlock('Scaledesk\Trails\Block\Posts')->getPostUrl($post);


        
    } 
    
    
      public function getPostTrails()
    {
        if ($this->_post === null) {
            /** @var Post $post */
            $post = $this->_postFactory->create()->getCollection();
            $post->getSelect()->join( array('customer_entity'=> 'customer_entity'), 'customer_entity.entity_id = main_table.entity_id');
            $post->addFieldToFilter('trails_id',$this->_getPostId());
            $post->load();

        }
        return $post->getItems();
    }
}

