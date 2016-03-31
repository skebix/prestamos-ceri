<?php
/**
 * Created by PhpStorm.
 * User: skebix
 * Date: 03/03/2016
 * Time: 11:38 AM
 */
?>

<html>
    <head>
        <title><?php echo $title;?></title>
    </head>
    <body>
        <h1><?php echo $heading;?></h1>
        <h3>My Todo List</h3>
        <ul>
            <?php foreach ($todo_list as $item):?>
                <li><?php echo $item;?></li>
            <?php endforeach;?>
        </ul>
    </body>
</html>
