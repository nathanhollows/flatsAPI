<?php

namespace App\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Message;
use Phalcon\Validation;

class Flats extends Model 
{
    // UUID
    public $id;
    public $price;
    public $bedrooms;
    public $bathrooms;
    public $parking;
    public $heroText;
    public $description;
    public $agent;
    public $image;
    public $url;
    public $type;
    public $dateAdded;
    public $dateAvailable;
    public $dateRemoved;
    public $pets;
    public $address;
    public $latitude;
    public $longtitude;
}

?>
