<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Pagination</title>
    <style>
        /* Pagination */
        .pagination {
            display: inline-block;
        }

        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
            border: 1px solid #4CAF50;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
        }

        .pagination a:first-child {
            border-top-left-radius: 5px;
            border-bottom-left-radius: 5px;
        }

        .pagination a:last-child {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }

        /* Table */
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
        </tr>
        <?php 
            $data = file_get_contents('person.json'); // put the contents of the file into a variable
            $persons = json_decode($data); // decode the JSON feed

            if (isset($_GET['page'])) {
                $page = intval($_GET['page']);
            } else {
                $page = 1;
            }

            $all = count($persons);
            $show = 3; //Show 5 result per page
            $totalpage = ceil($all / $show); //Total page
            $first = ($page * $show) - $show; // first result

            for ($i=$first; $i < ($first+$show); $i++) {
                echo "<tr>";
                echo "<td>" . $persons[$i]->id . "</td>";
                echo "<td>" . $persons[$i]->name . "</td>";
                echo "<td>" . $persons[$i]->gender . "</td>";
                echo "</tr>";
            }
        ?>
    </table>
    <br />
    <div class="pagination">
    <?php

        if ($totalpage == 0) {
            echo '<a class="active" href="#">1</a>'; 
        } else { 
            $nav_page = '<a class="active" href="#">Page '.$page.' of '.$totalpage.': </a>'; 
            $limit_nav = 5; 
            $start = ($page - $limit_nav <= 0) ? 1 : $page - $limit_nav;
            $end = $page + $limit_nav > $totalpage ? $totalpage : $page + $limit_nav; 

            if ($page + $limit_nav >= $totalpage && $totalpage > $limit_nav * 2){ 
                $start = $totalpage - $limit_nav * 2; 
            } 

            if ($page > 1) { //add prev 
                $nav_page .= '<a href="?page=' . ($page - 1) . '">&laquo;</a>'; 
            } else {
                $nav_page .= '<a href="#">&laquo;</a>'; 
            }

            if ($start != 1) { //show first page 
                $nav_page .= '<a href="?page=1">1</a>'; 
            } 

            if ($start > 2) { //add ... 
                $nav_page .= '<a href="#">...</a>'; 
            } 

            for ($i = $start; $i <= $end; $i++) { 
                if ($page == $i) {
                    $nav_page .= '<a href="#">'.$i.'</a>'; 
                } else {
                    $nav_page .= '<a href="?page=' . $i . '">' . $i . '</a>'; 
                }
            } 

            if ($end + 1 < $totalpage){ //add ... 
                $nav_page .= '<a href="#">...</a>'; 
            }  

            if ($end != $totalpage) { //show last page 
                $nav_page .= '<a href="?page=' . $totalpage . '">' . $totalpage . '</a>'; 
            }

            if ($page + 1 < $totalpage){ //add next 
                $nav_page .= '<a href="?page=' . ($page + 1) . '">&raquo;</a>'; 
            } else {
                $nav_page .= '<a href="#">&raquo;</a>'; 
            }

            echo $nav_page; 
        } 

    ?>
    </div>
</body>
</html>