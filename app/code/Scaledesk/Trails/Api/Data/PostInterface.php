<?php

namespace Scaledesk\Trails\Api\Data;

interface PostInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const TRAILS_ID               = 'trails_id';
    const TRAILS_NAME                 = 'trails_name';
    const TRAILS_START_DATE               = 'trails_start_date';
    const TRAILS_END_DATE            = 'trails_end_date';
    const TRAILS_TRIP_DURATION            = 'trails_trip_duration';
    const TRAILS_START_POINT            = 'trails_start_point';
    const TRAILS_END_POINT            = 'trails_end_point';
    const TRAILS_VEHICLE_NAME            = 'trails_vehicle_name';
    const TRAILS_DESCRIBING            = 'trails_describing';
    const TRAILS_URL            = 'trails_url';
    const CREATED_AT            = 'created_at';
    const ENTITY_ID            = 'entity_id';
    const FIRST_NAME           ='firstname';
    const MIDDLE_NAME          ='middlename';
    const LAST_NAME            ='lastname';
    const COUSTOMER_PROFILE_IMAGE= 'customer_profile_image';
    const TRAILS_FEATURED      ='trails_featured';
    const TRAILS_SLUG      ='trails_slug';
    const COUSTOMER_DESCRIPTION='customer_description';
    const TRAILS_POPULAR      ="trails_popular";





    /**#@-*/
    public function getCoustomerDescription();
    public function getEntityId();
    public function getFirstName();
    public function getMiddleName();
    public function getLastName();
    public function getCoustomerProfileImage();
    public function getTrailsFeatured();

    public function getTrailsName();

    public function getId();

    public function getTrailsStartDate();

    public function getTrailsEndDate();

    public function getTrailsTripDuration();
    public function getTrailsStartPoint();
    public function getTrailsEndPoint();
    public function getTrailsVehicleName();
    public function getTrailsDescribing();
    public function getTrailsUrl();
    public function getTrailsCreateAt();
    public function getTrailsSlug();
    public function getTrailsPopular();


    public function setCoustomerDescription($coustomerDecription);

    public function setEntityId($entityId);
    public function setFirstName($firstName);
    public function setMiddleName($middleName);
    public function setLastName($lastName);
    public function setCoustomerProfileImage($coustomerProfileImage);
    public function setTrailsFeatured($featured);
    public function setTrailsSlug($slug);
    public function setTrailsPopular($popular);


    public function setTrailsName($name);
    public function setId($id);
    public function setTrailsStartDate($startDate);
    public function setTrailsEndDate($endDate);
    public function setTrailsTripDuration($tripDuration);
    public function setTrailsStartPoint($startPoint);
    public function setTrailsEndPoint($endPoint);
    public function setTrailsVehicleName($vehicleName);
    public function setTrailsDescribing($describing);
    public function setTrailsUrl($url);
    public function setTrailsCreateAt($createAt);



}