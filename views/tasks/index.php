<?php
/* @var $tasks */
/* @var $search */
/* @var $tasks_count */

$tasks_count = intval($tasks_count['tasks_count']);
$total_records_per_page = 3;
if (isset($_GET['page_no']) && $_GET['page_no']!="") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
$offset = ($page_no-1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$total_no_of_pages = ceil($tasks_count / $total_records_per_page);
$second_last = $total_no_of_pages - 1;
?>
<h1>Tasks</h1>
<div class="row col-md-12 centered">
    <form action="" method="post">
        <table class="table table-striped custab">
            <thead>
            <a href="/tasks/create/" class="btn btn-primary btn-xs pull-right"><b>+</b> Add new task</a>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Email</th>
                <th>Description</th>
                <th style="width: 160px;">Done</th>
                <th style="width: 165px;" class="text-center">Action</th>
            </tr>
            <tr>
                <th></th>
                <th><input class="form-control" type="text" name="search_user_name" value="<?php if (isset($search["search_user_name"])) echo $search["search_user_name"];?>"></th>
                <th><input class="form-control" type="text" name="search_email" value="<?php if (isset($search["search_email"])) echo $search["search_email"];?>"></th>
                <th></th>
                <th>
                    <select name="search_done" class="form-control">
                        <option value=""></option>
                        <option value="1" <?php if (isset($search["search_done"]) && $search["search_done"] == 1) echo 'selected';?>>Done</option>
                        <option value="0" <?php if (isset($search["search_done"]) && $search["search_done"] == 0) echo 'selected';?>>Not Done</option>
                    </select></th>
                <th class="text-center"><button type="submit" class="btn btn-primary btn-xs pull-right">Search</button></th>
            </tr>
            </thead>
            <?php
            foreach ($tasks as $task)
            {
                $done = intval($task['done']) == 1 ? '<img class="checked" src="/images/check_tick.png">' : '';

                echo '<tr>';
                echo "<td>" . $task['id'] . "</td>";
                echo "<td>" . $task['user_name'] . "</td>";
                echo "<td>" . $task['email'] . "</td>";
                echo "<td>" . $task['description'] . "</td>";
                echo "<td>" . $done . "</td>";
                if (isset($_SESSION['is_logged']) && $_SESSION['is_logged'] == true){
                    echo "<td class='text-center'><a class='btn btn-info btn-xs' href='/tasks/update/" . $task["id"] . "' ><span class='glyphicon glyphicon-edit'></span> Edit</a> <a href='/tasks/delete/" . $task["id"] . "' class='btn btn-danger btn-xs'><span class='glyphicon glyphicon-remove'></span> Delete</a></td>";
                }else{
                    echo "<td></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </form>
    <div class="paging" style='padding: 10px 20px 0px; border-top: dotted 1px #CCC;'>
        <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
    </div>
    <ul class="pagination">
        <?php if($page_no > 1){
            echo "<li><a href='?page_no=1'>First Page</a></li>";
        } ?>

        <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>
            <a <?php if($page_no > 1){
                echo "href='?page_no=$previous_page'";
            } ?>>Previous</a>
        </li>

        <?php
            if ($total_no_of_pages <= 10){
                for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                    if ($counter == $page_no) {
                        echo "<li class='active'><a>$counter</a></li>";
                    }else{
                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                    }
                }
            }elseif ($total_no_of_pages > 10){
                if($page_no <= 4) {
                    for ($counter = 1; $counter < 8; $counter++){
                        if ($counter == $page_no) {
                            echo "<li class='active'><a>$counter</a></li>";
                        }else{
                            echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                        }
                    }
                    echo "<li><a>...</a></li>";
                    echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                    echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                }
            }else {
                echo "<li><a href='?page_no=1'>1</a></li>";
                echo "<li><a href='?page_no=2'>2</a></li>";
                echo "<li><a>...</a></li>";
                for (
                    $counter = $total_no_of_pages - 6;
                    $counter <= $total_no_of_pages;
                    $counter++
                ) {
                    if ($counter == $page_no) {
                        echo "<li class='active'><a>$counter</a></li>";
                    }else{
                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                    }
                }
            }
        ?>

        <li <?php if($page_no >= $total_no_of_pages){
            echo "class='disabled'";
        } ?>>
            <a <?php if($page_no < $total_no_of_pages) {
                echo "href='?page_no=$next_page'";
            } ?>>Next</a>
        </li>

        <?php if($page_no < $total_no_of_pages){
            echo "<li><a href='?page_no=$total_no_of_pages'>Last &rsaquo;&rsaquo;</a></li>";
        } ?>
    </ul>
</div>
