<?php

// Requirements
require "lib/Connect.php";
require "lib/Utils.php";
require "lib/Employees.php";

$paginationStart = getQueryString("paginationStart", 1);
$filter = trim(getQueryString("filter", ""));

if (!ctype_digit($paginationStart)) {
    $paginationStart = 1;
}

$Employees = getEmployees($conn);
setEmployeesDistanceFromCEO($Employees);

if ($filter != "" && ctype_alpha(preg_replace('/\s+/','',$filter))) {
    $Employees = filterResults($Employees, $filter);
}

$totalBeforePagination = count($Employees);

$Employees = paginate($Employees, $paginationStart);

include("templates/index_template.php");

?>