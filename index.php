<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Pagination</title>
    <style>
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
    </style>
</head>

<body>
    <a class="prev" href="?page=<?php echo ($current_page - 1) ?>">Prev</a>
    <?php if ($current_page > 2) : ?>
        <a href="?page=1">1</a>
    <?php endif ?>
    <?php if ($current_page > 3) : ?>
        <span class="dots">...</span>
    <?php endif ?>
    <?php if ($current_page - 1 > 0) : ?>
        <a href="?page=<?php echo $current_page - 1 ?>"><?php echo $current_page - 1 ?></a>
    <?php endif ?>
    <span class="current"><?php echo $current_page ?></span>
    <?php if ($current_page + 1 < $max_num_pages) : ?>
        <a href="?page=<?php echo $current_page + 1 ?>"><?php echo $current_page + 1 ?></a>
    <?php endif ?>
    <?php if ($current_page < $max_num_pages) : ?>
        <?php if ($current_page < $max_num_pages - 2) : ?>
            <span class="dots">...</span>
        <?php endif ?>
        <a href="?page=<?php echo $max_num_pages ?>"><?php echo $max_num_pages ?></a>
        <a class="next" href="?page=<?php echo ($current_page + 1) ?>">Next</a>
    <?php endif ?>

    <div class="pagination">
    <a href="#">&laquo;</a>
    <a href="#">1</a>
    <a class="active" href="#">2</a>
    <a href="#">3</a>
    <a href="#">4</a>
    <a href="#">5</a>
    <a href="#">6</a>
    <a href="#">&raquo;</a>
    </div>

    <?php 
        $data = file_get_contents('person.json'); // put the contents of the file into a variable
        $persons = json_decode($data); // decode the JSON feed

        foreach ($persons as $person) {
            echo $person->name . '<br>';
        }
    ?>
</body>
</html>