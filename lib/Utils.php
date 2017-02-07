<?php

/**
 *
 * Gets employees from the database
 *
 * @param (object) $conn The connection to the database
 * @return (array) $rows An array of all employees in the database
 *
 */
function getEmployees($conn) {

    $result = $conn->query("SELECT * FROM employees");

    if (!$result) {
        die("Failed to SELECT query Employees: " . mysqli_connect_error());
    }

    // output data of each row
    while($row = $result->fetch_assoc()) {
        $rows[$row["id"]] = new Employee($row["id"], $row["name"], $row["bossId"]);
    }

    mysqli_close($conn);
    
    return $rows;
}

/**
 *
 * Runs through the array of employees and sets their distance from the CEO
 *
 * @param (array) $Employees Array of employees
 * @return void
 *
 */
function setEmployeesDistanceFromCEO($Employees) {
    
    foreach ($Employees as $value) {
        $value->findDistanceFromCEO($Employees);
    }

}

/**
 *
 * Paginates the array of employees from a set pagination starting point
 *
 * @param (array) $Employees array of employees, (int) $paginationStart Pagination starting point
 * @return (array) New array of employees from pagination start to pagination end
 *
 */
function paginate($Employees, $paginationStart) {

    $array = [];
    $counter = 1;

    if (!ctype_digit($paginationStart)) {
        $paginationStart = 1;
    }

    foreach ($Employees as $value) {
        
        if ($counter >= $paginationStart && $counter <= $paginationStart + 99) {
            $array[] = $value;
        }
        $counter++;
    }
    
    return $array;
}

/**
 *
 * Filters the Employees by name based off a given filter value, searches to see if each employee contains the filter string
 *
 * @param (array) $Employees array of employees, (string) $filter The desired string to check in each employee name
 * @return (array) New array of employees that contained the filter string
 *
 */
function filterResults($Employees, $filter) {

    $array = [];

    foreach ($Employees as $value) {
        if (strpos($value->name, $filter) !== false) {
            $array[$value->id] = $value;
        }
    }
    
    return $array;

}

/**
 *
 * Checks for a certain query string value
 *
 * @param (string) $queryStringName The query string to search for, (any) $default The default value to return if the query value doesn't exist'
 * @return (string or default value type) Returns either the string or the default value set
 *
 */
function getQueryString($queryStringName, $default) {

    if (isset($_GET[$queryStringName])) {
        return $_GET[$queryStringName];
    } else if (isset($_POST[$queryStringName])) {
        return $_POST[$queryStringName];
    } else {
        return $default;
    }

}

/**
 *
 * Figures out whether or not to show the left pagination button
 *
 * @param (int) $paginationStart The starting value of the pagination
 * @return (bool) Whether or not to show the button
 *
 */
function showLeftPaginateButton($paginationStart) {

    if ($paginationStart > 1) {
        return true;
    }

    return false;
}

/**
 *
 * Figures out whether or not to show the right pagination button
 *
 * @param (int) $totalBeforePagination The total number of values before the array was paginated to figure out if there are more, (int) $paginationStart The starting value of the pagination
 * @return (bool) Whether or not to show the button
 *
 */
function showRightPaginateButton($totalBeforePagination, $paginateStart) {

    if ($totalBeforePagination > $paginateStart + 99) {
        return true;
    }

    return false;

}

/**
 *
 * Figures out the value for the end of the current page of pagination
 *
 * @param (int) $totalBeforePagination The total number of values before the array was paginated to figure out if there are more, (int) $paginationStart The starting value of the pagination
 * @return (bool) Whether or not to show the page
 *
 */
function checkPaginateEnd($totalBeforePagination, $paginationStart) {

    if ($totalBeforePagination >= $paginationStart + 99) {
        return $paginationStart + 99;
    }

    return $totalBeforePagination;
}

?>