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


class Update extends Action
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


        $om = \Magento\Framework\App\ObjectManager::getInstance();
        $customerSession = $om->get('Magento\Customer\Model\Session');
        $customerData = $customerSession->getCustomer()->getData();

//        if (isset($customerData['entity_id'])) {

            if($this->getRequest()->getPostValue()){
                try {


                    $objectManager = \Magento\Framework\App\ObjectManager::getInstance(); // Instance of object manager
                    $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
                    $connection = $resource->getConnection();
                    $tableName = $resource->getTableName('scaledesk_trails');


                    $post = $this->getRequest()->getPostValue();
                    $bgImage = $this->getRequest()->getFiles('trails_url');
                    $error=array();
                    $extension=array("jpeg","jpg","png","gif");
                    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();

                    $directory = $objectManager->get('\Magento\Framework\Filesystem\DirectoryList');

                    $rootPath  =  $directory->getRoot();


                    define("UPLOADS", $rootPath."/pub/media/trails/");
                    

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
                    
                    $test = ((count($_FILES['trails_url']['name']) == 1) &&
                              $_FILES['trails_url']['name'][0] == "");
                    
                    if(!$test) {
                    foreach($preProcessedArr as $file){

                        // var_dump($file); die();
                        $filename = $file['name'];
                        $filetmp = $file['tmp_name'];
                        $file_ext = explode('.',$filename);
                        $file_ext = strtolower(end($file_ext));

                        $tmp_name = md5("trails_" . rand(10000,99999). $filename) . "." . $file_ext;

                        //$file_name_new = uniqid('',true) .'.'. $file_ext;
                        $file_destination = UPLOADS .$tmp_name;

                        if(!$img_list==null){
                            $img_list.=','.$tmp_name;
                        }else{
                            $img_list=$tmp_name;
                        }


                        move_uploaded_file($filetmp, $file_destination);


                    }
                        
                    }
                   
               $resource = $this->_objectManager->create('\Magento\Framework\App\ResourceConnection');
               $connection = $resource->getConnection(\Magento\Framework\App\ResourceConnection::DEFAULT_CONNECTION);


               setlocale(LC_ALL, "en_US.UTF8");
            
              
              $values = $connection->fetchAll('SELECT * FROM `scaledesk_trails` WHERE trails_id ="'.$this->getRequest()->getParam('id').'"');
              
               
               $img_list_old= explode(',', $values[0]['trails_url']);
               
                if (!empty ($post['trails_url_old'])) {
                    $trails_url_old = explode(',', $post['trails_url_old']);
                    $img_list_old = array_diff($img_list_old, $trails_url_old);
                }
                
                if ($img_list == null) {
                    $img_list = $img_list_old;
                } else {
                    $img_list = explode(',', $img_list);
                    $img_list = array_merge($img_list_old, $img_list);
                }
                $img_list = implode(',', $img_list);
                    
          
                  
                 
                
             

                    $sql ='UPDATE `' . $tableName . '` SET
                        `trails_name` = "'.$post['trails_name'].'",
                        `trails_start_date` = "'.$post['trails_start_date'].'",
                        `trails_end_date` = "'.$post['trails_end_date'].'",
                        `trails_trip_duration` = "'.$post['trails_trip_duration'].'",
                        `trails_start_point` = "'.$post['trails_start_point'].'",
                        `trails_end_point` = "'.$post['trails_end_point'].'",
                        `trails_vehicle_name` = "'.$post['trails_vehicle_name'].'",
                         `trails_describing` = "'.$post['trails_describing'].'",
                         `trails_url` = "'.$img_list.'"
                          WHERE `trails_id` = '.$this->getRequest()->getParam('id');

                    $connection->query($sql);
                    
                    
                     
                     $id = $this->getRequest()->getParam('id');
                     


                

                    $this->messageManager->addSuccess(__('Trails has been updated successfully.'));

                    $this->_redirect('trails/post/users');

                    return;
                
                    
                }
                catch (\Exception $e) {

                    $this->messageManager->addError(__('Something went wrong while updating trails.'));
                }
                $this->_redirect('trails/post/users');


            }
            else {


                $this->_coreRegistry->register(self::REGISTRY_KEY_POST_ID, (int)$this->_request->getParam('id'));
                $resultPage = $this->_resultPageFactory->create();
                return $resultPage;
            }
//        }
//
//        else{
//
//
//            $this->_redirect('/');
//
//
//        }

    }
}