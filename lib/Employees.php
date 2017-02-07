<?php

class Employee {

    public $id;
    public $name;
    public $bossId;
    public $distanceFromCEO = NULL;

    public function __construct($id, $name, $bossId) {
        $this->id = $id;
        $this->name = $name;
        $this->bossId = $bossId;
    }

    /**
    *
    * Finds the distance from the CEO for the current employee
    *
    * @param (array) $Employees The array of Employees, optional (int) $id The ID of the current employee, optional (int) $edges The current number of edges from the CEO
    * @return void
    *
    */
    public function findDistanceFromCEO($Employees, $id = NULL, $edges = 0) {
        
        if ($id == NULL) {
            $id = $this->id;
        }

        $Employee = $Employees[$id];

        if ($Employee->id == $Employee->bossId) {
            $this->distanceFromCEO = $edges;
        } else if ($Employee->distanceFromCEO != NULL) {
            $this->distanceFromCEO = $edges + $Employee->distanceFromCEO;
        } else {
            $this->findDistanceFromCEO($Employees, $Employee->bossId, ++$edges);
        }

    }

}

?>