<?php
/* @var $task */
/* @var $errors */
$checked = $task['done'] != 0 ? 'checked' : '';
?>
<h1>Update task</h1>
<form method='post' action='#'>
    <div class="form-group">
        <label for="user_name">User name</label>
        <input type="text" class="form-control" id="user_name" placeholder="Enter a User name" name="user_name" value="<?php if (isset($task["user_name"])) echo $task["user_name"];?>">
        <div class="hidden-error-box error-box" id="user_error"><?php echo $errors['user_name_error']; ?></div>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter a Email address" name="email" value="<?php if (isset($task["email"])) echo $task["email"];?>">
        <div class="hidden-error-box error-box" id="email_error"><?php echo $errors['email_error']; ?></div>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" placeholder="Enter a description" name="description" value="<?php if (isset($task["description"])) echo $task["description"];?>">
        <div class="hidden-error-box error-box" id="description_error"><?php echo $errors['description_error']; ?></div>
    </div>
    <div class="form-group">
        <label for="done">Done</label>
        <input type="checkbox" class="form-control" value="1" id="done"  name="done" <?php echo $checked;?>>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
