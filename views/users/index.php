<?php
/* @var $errors */
/* @var $par */
if (!isset($errors)){
    $errors = '';
}
?>
<h1>Login</h1>
<form method='post'>
    <div class="form-group">
        <label for="login">Login</label>
        <input type="text" class="form-control" id="login" placeholder="Enter a Login" name="login" value="<?php if(isset($par["login"])) echo $par["login"];?>">
        <div class="hidden-error-box error-box" id="login_error"><?php echo $errors['login_error']; ?></div>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" placeholder="Enter a Password" name="password">
        <div class="hidden-error-box error-box" id="password_error"><?php echo $errors['password_error']; ?></div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
