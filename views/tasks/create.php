<?php
/* @var $errors */
/* @var $par */
?>
<h1>Create task</h1>
<form method='post'>
    <div class="form-group">
        <label for="user_name">User name</label>
        <input type="text" class="form-control" id="user_name" placeholder="Enter a User name" name="user_name" value="<?php if (isset($par["user_name"])) echo $par["user_name"];?>">
        <div class="hidden-error-box error-box" id="user_error"><?php echo $errors['user_name_error']; ?></div>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" placeholder="Enter a Email address" name="email" value="<?php if (isset($par["email"])) echo $par["email"];?>">
        <div class="hidden-error-box error-box" id="email_error"><?php echo $errors['email_error']; ?></div>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input type="text" class="form-control" id="description" placeholder="Enter a description" name="description" value="<?php if (isset($par["description"])) echo $par["description"];?>">
        <div class="hidden-error-box error-box" id="description_error"><?php echo $errors['description_error']; ?></div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
