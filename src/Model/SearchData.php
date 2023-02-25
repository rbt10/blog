<?php

namespace App\Model;

use phpDocumentor\Reflection\Types\Integer;

class SearchData
{
    /**
     * @var int
     */
    public $page = 1;
    public String $q = '';
    public  array $categories =[];
}