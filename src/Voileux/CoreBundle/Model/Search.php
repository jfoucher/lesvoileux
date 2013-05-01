<?php
/**
 * Search.php
 *
 * Created By: jonathan
 * Date: 5/1/13
 * Time: 10:25 PM
 */

namespace Voileux\CoreBundle\Model;


class Search {

    protected $location;
    protected $dateFrom;
    protected $dateTo;

    protected $email;
    protected $persons;


    public function setDateFrom($dateFrom)
    {
        $this->dateFrom = $dateFrom;
    }

    public function getDateFrom()
    {
        return $this->dateFrom;
    }

    public function setDateTo($dateTo)
    {
        $this->dateTo = $dateTo;
    }

    public function getDateTo()
    {
        return $this->dateTo;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setLocation($location)
    {
        $this->location = $location;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function setPersons($persons)
    {
        $this->persons = $persons;
    }

    public function getPersons()
    {
        return $this->persons;
    }

}