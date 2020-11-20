<?php

    class User {
        
        function createSuperUser($connect){
            $resource = $connect->dbSelect("SELECT COUNT(*) AS total FROM users");
            $result = $connect->dbSearchData($resource);

            if($result->total == 0){
                $newUser = $connect->dbInsert(
                    "INSERT INTO users
                    (name, username, password, level)
                    VALUES(?, ?, ?, ?)",
                    array(
                        "Administrador",
                        "admin",
                        password_hash("admin", PASSWORD_DEFAULT),
                        1
                    )
                );

                if($newUser > 0){
                    return true;
                } else {
                    echo "Falha ao incluir o super usuário!";
                    exit;
                }
            }

            return true;
        }

        function findUsername($connect, $username){
            $resource = $connect->dbSelect(
                "SELECT * FROM users WHERE username = ?",
                array($username)
            );

            return $connect->$dbSearchData($resource);
        }

        function searchUserID($connect, $id){
            $resource = $connect->dbSelect(
                "SELECT * FROM users WHERE id = ?",
                array($id)
            );

            if($connect->dbRowCount($modelResource) == 0){
                return array();
            } else {
                $result = $connect->dbSearchAllArray($modelResource);
                return $result[0];
            }
        }

        function list($connect){
            $modelResource = $connect->dbSelect(
                "SELECT * FROM users ORDER BY username"
            );

            if($connect->dbRowCount($modelResource) == 0){
                return array();
            } else {
                return $connect->dbSearchAllData($modelResource);
            }
        }

        function showLevel($level){
            return ($level == 1 ? "Administrador" : "Usuário");
        }

        function create($connect, $data){
            $resource = $connect->dbInsert(
                "INSERT INTO users
                (name, username, password, level)
                VALUES (?, ?, ?, ?)",
                $data                
            );

            $resource > 0 ? true : false;
        }

        function update($connect, $data){
            $resource = $connect->dbUpdate(
                "UPDATE users
                SET name = ?, username = ?, password = ?, level = ?
                WHERE id = ?",
                $data
            );

            $resource > 0 ? true : false;
        }

        function delete($connect, $id){
            $resource = $connect->dbDelete(
                "DELETE FROM users WHERE id = ?",
                array($id)
            );

            $resource > 0 ? true : false;
        }
    }

?>