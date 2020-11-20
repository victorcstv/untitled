<?php
    require_once '../models/User.php';

    $model = new User();
    $action = "";

    if($action == "loginn"){
        if (!$model->createSuperUser($connect)){
            header("Location: " . SITE_URL . "login" );
            exit;
        }

        $arUser = $model->searchLogin($connect, trim($_POST["Login"]));

        if($arUser){
            if(!password_verify(trim($_POST["Password"]), $arUser->Password)){
                $_SESSION["msgError"] = "Senha inválida!";
                header("Location: " . SITE_URL . "login");
                exit;
            }

            $_SESSION["id"] = $arUser->id;
            $_SESSION["username"] = $arUser->username;
            $_SESSION["password"] = $arUser->password;
            $_SESSION["level"] = $arUser->level;

            header("Location: " . SITE_URL . "login");
            exit;
        } else {
            $_SESSION["msgError"] = "Usuário não encontrado!";
            header("Location: " . SITE_URL . "login");
            exit;
        }
    }
?>