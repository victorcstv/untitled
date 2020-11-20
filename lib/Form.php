<?php

    class Form{

        static function formSubject($action){
            $text = "";

            if($action == "Visualizar"){
                $text = "Visualização";
            } else if($action == "Novo"){
                $text = "Novo";
            } else if($action == "Alterar"){
                $text = "Alterar";
            } else if($action == "Excluir"){
                $text = "Excluir";
            }

            return $text;
        }

        static function formAction($action){
            $text = "";

            if($action == "Novo"){
                $text = "Insert";
            } else if($action == "Alterar"){
                $text = "Update";
            } else if($action == "Excluir"){
                $text = "Delete";
            }

            return $text;
        }

        static function setValue($value, $default = ""){
            global $data;

            isset($data[$value]) ? $dados[$value] : $default;
        }
    }

?>