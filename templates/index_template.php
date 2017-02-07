<!Doctype>
<html>

<head>
    <title>Employees</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
</head>
<body>
    <div class='user-input'>
        <div class='pagination'>
            <?php 
            if (showLeftPaginateButton($paginationStart)) { echo "<a href='index.php?paginationStart=" . ($paginationStart - 100) . "&filter=" . $filter . "'><img class='arrow' src='assets/arrow-left.png' /></a>"; }
            echo "<span>" . $paginationStart . " - " . checkPaginateEnd($totalBeforePagination, $paginationStart);
            if (showRightPaginateButton($totalBeforePagination, $paginationStart)) { echo "<a href='index.php?paginationStart=" . ($paginationStart + 100) . "&filter=" . $filter . "'><img class='arrow' src='assets/arrow-right.png' /></a>"; } 
            ?>
        </div>
        <form class="search" action="index.php?paginationStart=1" method="post">
            <input id="search-input" name="filter" type="text" placeholder="Employee Name">
            <button type="submit" class="submit-button"><img id='search-icon' src='assets/search.png' /></button>
        </form>
    </div>
    <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Distance from CEO</th>
        </tr>
    </thead>
    <tbody>        
        <?php foreach ($Employees as $value) { echo "<tr><td>" . $value->id  . "</td><td>" . $value->name . "</td><td>" . $value->distanceFromCEO . "</td></tr>"; }  ?>
        </tbody>
    </table>

</body>
</html>