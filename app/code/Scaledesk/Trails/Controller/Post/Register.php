<?php
/**
 * Created by PhpStorm.
 * User: nitesh
 * Date: 17/4/18
 * Time: 8:07 PM
 */

namespace Scaledesk\Trails\Controller\Post;
use \Magento\Framework\App\Action\Action;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\View\Result\Page;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\Exception\LocalizedException;
use \Magento\Framework\Registry;
use \Magento\Framework\Controller\ResultFactory;


class Register extends Action
{
    const REGISTRY_KEY_POST_ID = 'scaledesk_trails_trails_id';

    /**
     * Core registry
     * @var Registry
     *
     */
    protected $customerSession;


    protected $_coreRegistry;

    /**
     * @var PageFactory
     */
    protected $_resultPageFactory;

    /**
     * @param Context $context
     * @param Registry $coreRegistry
     * @param PageFactory $resultPageFactory
     *
     * @codeCoverageIgnore
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory





    ) {
        parent::__construct(
            $context
        );
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;



    }

    /**
     * Saves the blog id to the register and renders the page
     * @return Page
     * @throws LocalizedException
     */

    public function execute()
    {
      // $lastUrl = $this->_getRefererUrl();
      // var_dump($lastUrl);die();

         $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
         $resultRedirect->setUrl($this->_redirect->getRefererUrl());
          var_dump($this->_redirect->getRefererUrl('trails')); die();

        if($_SESSION['data']){}else{$_SESSION['data']='null';}

        $om = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $om->get('Magento\Customer\Model\Session');
        $customerData = $customerSession->getCustomer()->getData();
     if (isset($customerData['entity_id'])) {

       if($this->getRequest()->getPostValue()){
           try {
               $post = $this->getRequest()->getPostValue();
               $bgImage = $this->getRequest()->getFiles('trails_url');
               $error=array();
               $extension=array("jpeg","jpg","png","gif");
               $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

               $directory = $objectManager->get('\Magento\Framework\Filesystem\DirectoryList');

                $rootPath  =  $directory->getRoot();

                $_SESSION['data'] = $post;

               define("UPLOADS", $rootPath."/pub/media/trails/");
               if (!file_exists(UPLOADS)) {
                   mkdir(UPLOADS, 0777);

               }

               $loop = 0;
               $file_name_new='';

               // Preprocess the array
               $preProcessedArr = array();
               foreach($_FILES['trails_url'] as $key=>$tmp) {
                   // find the length inside (number of files)
                   $i = count($tmp);
                   for($j = 0; $j < $i; $j++) {
                       $preProcessedArr[$j][$key] = $tmp[$j];
                   }
               }

               $img_list = null;
               foreach($preProcessedArr as $file){

                   $filename = $file['name'];
                   $filetmp = $file['tmp_name'];
                   $file_ext = explode('.',$filename);
                   $file_ext = strtolower(end($file_ext));

                   $tmp_name = md5("trails_" . rand(10000,99999). $filename) . "." . $file_ext;

                   $file_destination = UPLOADS .$tmp_name;

                   if(!$img_list==null){
                        $img_list.=','.$tmp_name;
                   }else{
                        $img_list.=$tmp_name;

                   }


                   move_uploaded_file($filetmp, $file_destination);


               }


               $resource = $this->_objectManager->create('\Magento\Framework\App\ResourceConnection');
               $connection = $resource->getConnection(\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION);


               setlocale(LC_ALL, "en_US.UTF8");
               $url_string=preg_replace("/[^a-z0-9]/i"," ", ltrim(rtrim(strtolower($post['trails_name']))));
               $url_string = preg_replace("/\s+/", " ", $url_string);
               $newurl_string=str_replace(" ","-",$url_string);
               $values = $connection->fetchAll('SELECT `trails_slug` FROM `scaledesk_trails` WHERE trails_slug ="'.$newurl_string.'"');
               if(!empty($values[0]['trails_slug'])){
                   $this->messageManager->addError(__('Trail name already exists! please type another trail name.'));
                   $this->_redirect('trails/post/register');

                   return;

               }else {

            //   $blockInstance = $this->_objectManager->get('Scaledesk\Trails\Block\Register');
            //   $blockInstance->getFormData($post);




               $model = $this->_objectManager->create('Scaledesk\Trails\Model\Post');
               $model->setData('trails_name', $post['trails_name']);
               $model->setData('trails_start_date', $post['trails_start_date']);
               $model->setData('trails_end_date', $post['trails_end_date']);
               $model->setData('trails_trip_duration', $post['trails_trip_duration']);
               $model->setData('trails_start_point', $post['trails_start_point']);
               $model->setData('trails_end_point', $post['trails_end_point']);
               $model->setData('trails_vehicle_name', $post['trails_vehicle_name']);
               $model->setData('trails_describing', $post['trails_describing']);
               $model->setData('trails_url', $img_list);
               $model->setData('entity_id', $customerSession->getCustomer()->getId());
               $model->setData('trails_slug', $newurl_string);

               $id =$model->save() ;
               $connection->query('INSERT INTO `url_rewrite`( `entity_type`, `request_path`,`entity_id`,`target_path`,`store_id`) VALUES ("custom","trail/'.$newurl_string. '","0","trails/post/view/id/'.$id->getId().'","1")');





               $this->messageManager->addSuccess(__('Trails has beem saved successfully.'));
               $_SESSION['data']='null';
               $this->_redirect('trails/post/register');

               return;
               }
               }
               catch (\Exception $e) {

                $this->messageManager->addError(__('Something went wrong while saving trails.'.$e));
                }
               $this->_redirect('trails/post/register');


       }
       else {
           $this->_coreRegistry->register(self::REGISTRY_KEY_POST_ID, (int)$this->_request->getParam('id'));
           $resultPage = $this->_resultPageFactory->create();
           return $resultPage;
       }
    }

     else{


           $this->_redirect('/');


       }

}
}
