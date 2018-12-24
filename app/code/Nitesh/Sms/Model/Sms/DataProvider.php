<?php
namespace Dac\Recipes\Model\Recipe;
use Dac\Recipes\Model\ResourceModel\Post\CollectionFactory;
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $contactCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $contactCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $contactCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $items = $this->collection->getItems();
        $this->loadedData = array();
        /** @var Customer $customer */
        foreach ($items as $contact) {
            // notre fieldset s'apelle "contact" d'ou ce tableau pour que magento puisse retrouver ses datas :
            $this->loadedData[$contact->getId()]['recipe'] = $contact->getData();


           
            if ($contact->getData()['recipes_image']) {

                $m['recipes_category_name']=explode(',',$contact->getData()['recipes_category_name']);

                $m['recipes_image'][0]['name'] = $contact->getData()['recipes_image'];
                $m['recipes_image'][0]['url'] = $this->getMediaUrl().'recipes/'.$contact->getData()['recipes_image'];

                $m['recipes_banner_image'][0]['name'] = $contact->getData()['recipes_banner_image'];
                $m['recipes_banner_image'][0]['url'] = $this->getMediaUrl().'recipes/'.$contact->getData()['recipes_banner_image'];

                $fullData = $this->loadedData;

                $finaldata=  array_merge($fullData[$contact->getId()]['recipe'], $m);
                $this->loadedData[$contact->getId()]['recipe'] = $finaldata;




            }
        }


        return $this->loadedData;

    }

    public function getMediaUrl()
    {


        $_objectManager = \Magento\Framework\App\ObjectManager::getInstance(); //instance of\Magento\Framework\App\ObjectManager
        $storeManager = $_objectManager->get('Magento\Store\Model\StoreManagerInterface');
        $currentStore = $storeManager->getStore();
        $mediaUrl = $currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        return $mediaUrl;


    }
}