<?php
/**
 * Created by PhpStorm.
 * User: nitesh
 * Date: 16/12/18
 * Time: 4:17 PM
 */


namespace Nitesh\Sms\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
use \Nitesh\Sms\Api\Data\PostInterface;

/**
 * Class File
 * @package Nitesh\Post\Model
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Post extends AbstractModel implements PostInterface, IdentityInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'nitesh_sms';

    /**
     * Post Initialization
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Nitesh\Sms\Model\ResourceModel\Post');
    }


//    get Function  for all field

    /**
     * Return identities
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getId(){
        return $this->getData(self::SMS_ID);
    }
    public function getRecipesTitle(){
        return $this->getData(self::RECIPES_TITLE);
    }
    public function getRecipesShortDescription(){
        return $this->getData(self::RECIPES_SHORT_DESCRIPTION);
    }
    public function getRecipesPreparationTime(){
        return $this->getData(self::RECIPES_PREPARATION_TIME);
    }
    public function getRecipesIngredients(){
        return $this->getData(self::RECIPES_INGREDIENTS);
    }
    public function getRecipesMethods(){
        return $this->getData(self::RECIPES_METHODS);
    }
    public function getRecipesImage(){
        return $this->getData(self::RECIPES_IMAGE);
    }
    public function getRecipesYoutube(){
        return $this->getData(self::RECIPES_YOUTUBE);
    }
    public function getRecipesOtherRecipes(){
        return $this->getData(self::RECIPES_OTHER_RECIPES);
    }
    public function getRecipesProductUsed(){
        return $this->getData(self::RECIPES_PRODUCT_USED);
    }
    public function getRecipesDownloadRecipes(){
        return $this->getData(self::RECIPES_DOWNLOAD_RECIPES);
    }
    public function getRecipesTagLine(){
        return $this->getData(self::RECIPES_TAG_LINE);
    }

    public function getRecipesBannerImage(){
        return $this->getData(self::RECIPES_BANNER_IMAGE);
    }
    public function getRecipesIsUserRecipes(){
        return $this->getData(self::RECIPES_IS_USER_RECIPES);
    }
    public function getRecipesUserName(){
        return $this->getData(self::RECIPES_USER_NAME);
    }

    public function getRecipesUserLocation()
    {
        return $this->getData(self::RECIPES_USER_LOCATION);
    }


    public function getCategoryId()
    {
        return $this->getData(self::RECIPES_CATEGORY_ID);
    }
    public function getCategoryName()
    {
        return $this->getData(self::RECIPES_CATEGORY_NAME);
    }
    public function getCategoryRecipesMappingId(){
        return $this->getData(self::RECIPES_CATEGORY_RECIPES_MAPPING_ID);
    }


    public function getRecipesStatus(){
    return $this->getData(self::RECIPES_STATUS);
    }

    public function getRecipesCreatedAt(){
        return $this->getData(self::RECIPES_CREATED_AT);
    }


    public function getRecipesSlug(){
        return $this->getData(self::RECIPES_SLUG);
    }

//    Set Function  for all field


    public function setCategoryId($categoryId)
    {
        return $this->getData(self::RECIPES_CATEGORY_ID,$categoryId);
    }
    public function setCategoryName($categoryName)
    {
        return $this->getData(self::RECIPES_CATEGORY_NAME,$categoryName);
    }
    public function setCategoryRecipesMappingId($categoryRecipesMappingId)
    {
        return $this->getData(self::RECIPES_CATEGORY_RECIPES_MAPPING_ID,$categoryRecipesMappingId);
    }



    public function setRecipesStatus($status){
        return $this->getData(self::RECIPES_STATUS,$status);

    }
    public function setRecipesCreatedAt($createAt){
        return $this->getData(self::RECIPES_CREATED_AT,$createAt);

    }
    public function setRecipesUserLocation($userLocation)
    {
        return $this->getData(self::RECIPES_USER_LOCATION,$userLocation);
    }


    public function setId($id){
        return $this->getData(self::RECIPES_ID,$id);
    }
    public function setRecipesTitle($title)
    {
        return $this->getData(self::RECIPES_TITLE,$title);
    }
    public function setRecipesShortDescription($shortDescription)
    {
        return $this->getData(self::RECIPES_SHORT_DESCRIPTION,$shortDescription);
    }
    public function setRecipesPreparationTime($preparationTime)
    {
        return $this->getData(self::RECIPES_PREPARATION_TIME,$preparationTime);
    }
    public function setRecipesIngredients($ingredients){
        return $this->getData(self::RECIPES_INGREDIENTS,$ingredients);
    }
    public function setRecipesMethods($methods){
        return $this->getData(self::RECIPES_METHODS,$methods);
    }
    public function setRecipesImage($image){
        return $this->getData(self::RECIPES_IMAGE,$image);
    }
    public function setRecipesYoutube($youtube){
        return $this->getData(self::RECIPES_YOUTUBE,$youtube);
    }
    public function setRecipesOtherRecipes($otherRecipes){
        return $this->getData(self::RECIPES_OTHER_RECIPES,$otherRecipes);
    }
    public function setRecipesProductUsed($productUsed){
        return $this->getData(self::RECIPES_PRODUCT_USED,$productUsed);
    }
    public function setRecipesDownloadRecipes($downloadRecipes){
        return $this->getData(self::RECIPES_DOWNLOAD_RECIPES,$downloadRecipes);
    }
    public function setRecipesTagLine($tagLine){
        return $this->getData(self::RECIPES_TAG_LINE,$tagLine);
    }

    public function setRecipesBannerImage($bannerImage){
        return $this->getData(self::RECIPES_BANNER_IMAGE,$bannerImage);
    }
    public function setRecipesIsUserRecipes($isUserRecipes){
        return $this->getData(self::RECIPES_IS_USER_RECIPES,$isUserRecipes);
    }
    public function setRecipesUserName($userName){
        return $this->getData(self::RECIPES_USER_NAME,$userName);
    }


    public function setRecipesSlug($recipesSlug){
        return $this->getData(self::RECIPES_SLUG,$recipesSlug);
    }

}