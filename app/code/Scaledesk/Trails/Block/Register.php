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

class Register  extends Template
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
    public function getPosts()
    {
        /** @var PostCollection $postCollection */
        // var_dump($this->getRequest()->getPost('trails_name'));
        $postCollection = $this->_postCollectionFactory->create();
        $postCollection->addFieldToSelect('*')->load();
        return $postCollection->getItems();
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




    /**
     * For a given post, returns its url
     * @return array $data
     */
    public function getTrailsPosts(
    ) {
       if($_SESSION['data']){
         return $_SESSION['data'];
       }else{
         return null;
       }

    }


    // public function getFormData(){
    //      $data = $this->getData('form_data');

    //      var_dump($data); die();

        // $postCollection = $this->_postCollectionFactory->create();

        // $formData=array("trails_name"=>$post['trails_name'],
        //                 "trails_start_date"=>$post['trails_start_date'],
        //                 "trails_end_date"=>$post['trails_end_date'],
        //                 "trails_vehicle_name"=>$post['trails_vehicle_name'],
        //                 "trails_trip_duration"=>$post['trails_trip_duration'],
        //                 "trails_start_point"=>$post['trails_start_point'],
        //                 "trails_end_point"=>$post['trails_end_point'],
        //                 "trails_describing"=>$post['trails_describing'],
        //               "trails_start_date"=>$post['trails_name']);
        // $postCollection= $formData;
        // $postCollection->load();
        // return $postCollection->getItems();
    // }

}
