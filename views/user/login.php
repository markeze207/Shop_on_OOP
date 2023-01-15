<?php include ROOT . '/views/layouts/header.php'; ?>

<section id="form">
    <!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form">
                    <!--login form-->
                    <?php if(isset($errorsLogin) && is_array($errorsLogin)) : ?>

                        <?php foreach($errorsLogin as $error) : ?>
                            <li> <?=$error?></li>
                        <?php endforeach; ?>

                    <?php endif; ?>
                    <h2>Login to your account</h2>
                    <form action="" method="POST">
                        <input type="email" name="email" placeholder="Email Address" />
                        <input type="password" name="password" placeholder="Password" />
                        <span>
                            <input type="checkbox" class="checkbox">
                            Keep me signed in
                        </span>
                        <button type="submit" name="submitLogin" class="btn btn-default">Login</button>
                    </form>
                </div>
                <!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form">
                    <!--sign up form-->
                    <?php if($resultRegistration) : ?>
                        <p>Вы зарегистрированы</p>
                    <?php else : ?>
                    <?php if(isset($errorsRegistration) && is_array($errorsRegistration)) : ?>
                           
                                <?php foreach($errorsRegistration as $error) : ?>
                                    <li> <?=$error?></li>
                                <?php endforeach; ?>
                            
                    <?php endif; ?>
                    <h2>New User Signup!</h2>
                    <form action="" method="POST">
                        <input type="text" name="name" value="<?=$name?>" placeholder="Name" />
                        <input type="email" name="email" value="<?=$email?>" placeholder="Email Address" />
                        <input type="password" name="password" value="<?=$password?>" placeholder="Password" />
                        <button type="submit" name="submitRegistration" class="btn btn-default">Signup</button>
                    </form>
                </div>
                <!--/sign up form-->
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<!--/form-->

<?php include ROOT . '/views/layouts/footer.php'; ?>