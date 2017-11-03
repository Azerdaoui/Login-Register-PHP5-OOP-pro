<?php
    require_once 'core/init.php';

    //var_dump(Token::check(Inputs::get('token')));

        if(Inputs::exists()){

                if(Token::check(Inputs::get('token'))){

                echo 'I have been run';
                $validate = new Validation();
                $validation = $validate->check($_POST,array(
                        'username'       => array(
                            'required' => true,
                            'min'      => 2,
                            'max'      => 20,
                            'unique'   => 'users'
                        ),
                        'password'       => array(
                            'required' => true,
                            'min'      => 6
                        ),
                        'password_again' => array(
                            'required' => true,
                            'matches'  => 'password'
                        ),
                        'name'           => array(
                            'required' => true,
                            'min'      => 2,
                            'max'      => 20
                        )
                    )
                );

                if($validate->passed()){
                    //register
                    echo "passed";
                }else{
                    //output

                    foreach($validate->errors() as $error){
                        echo $error . "<br>";
                    }
                }
           }

        }



?>
<form action="" method="post">
        <div class="field">
            <label for="username">Username</label>
            <input type="text" id="username" value="<?php echo escape(Inputs::get('username')); ?>" name="username" autocomplete="off"/>

        </div>

        <div class="field">
            <label for="password">
                Choose a Password!
            </label>
            <input type="password" name="password" value="<?php echo escape(Inputs::get('password')); ?>" id="password">
        </div>

        <div class="field">
            <label for="password_again">
                Enter yout Password again!
            </label>
            <input type="password" name="password_again" value="<?php echo escape(Inputs::get('password_again')); ?>" id="password_again">
        </div>

        <div class="field">
            <label for="password_again">
                 your name
            </label>
            <input type="text" name="name" value="<?php echo escape(Inputs::get('name')); ?>" id="password_again">
        </div>
        <input type="hidden" name="token" value="<?php  echo Token::generate(); ?>">
        <input type="submit" value="Register" name="submit">

    </form>