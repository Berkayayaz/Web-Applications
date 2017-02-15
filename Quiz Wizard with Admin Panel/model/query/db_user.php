<?php

    function get_all_users() {
        global $db;
        $query = 'SELECT * FROM `user` ORDER BY userId';
        $statement = $db->prepare($query);

        $statement->execute();
        $users = $statement->fetchAll();
        $statement->closeCursor();

        return $users;
    }

    function get_user_by_email($user_email) {
        global $db;
        $query_user = 'SELECT * FROM `user` WHERE email = :user_email';
        $statement = $db->prepare($query_user);
        $statement->bindValue(':user_email', $user_email);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    }

    function get_user_by_userid($user_id) {
        global $db;
        $query = 'SELECT * FROM user WHERE userId = :user_id';
        $statement = $db->prepare($query);
        $statement->bindValue(":user_id", $user_id);
        $statement->execute();
        $user = $statement->fetch();
        $statement->closeCursor();
        return $user;
    }

    function delete_tests_of_user($user_id) {
        global $db;
        $query = 'DELETE FROM test WHERE userId = :user_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function delete_user($user_id) {
        global $db;
        $query = 'DELETE FROM user WHERE userID = :user_id';
        $statement = $db->prepare($query);
        $statement->bindValue(':user_id', $user_id);
        $statement->execute();
        $statement->closeCursor();
    }

    function add_user($firstName, $lastName, $gender, $email, $phone, $address, $password, $isAdmin) {
        global $db;
        $query = 'INSERT INTO user (firstName,lastName,gender,email,address, password, isAdmin) '
            . 'VALUES (:firstName, :lastName, :gender, :email, :address, :password, :isAdmin)';
        $statement = $db->prepare($query);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':gender', $gender);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':address', $address);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':isAdmin', $isAdmin);
        $statement->execute();
        $statement->closeCursor();
    }

    function update_user($user_id, $firstName, $lastName, $gender, $email, $phone, $address, $password) {
        global $db;
        $update_user = 'UPDATE `user` SET firstName = :first_name, lastName = :last_name, '
            . 'gender = :gender, email = :email, phone = :phone, address = :address, '
            . 'password = :password WHERE userId = :userId';
        $statement2 = $db->prepare($update_user);
        $statement2->bindValue(':first_name', $firstName);
        $statement2->bindValue(':last_name', $lastName);
        $statement2->bindValue(':gender', $gender);
        $statement2->bindValue(':email', $email);
        $statement2->bindValue(':phone', $phone);
        $statement2->bindValue(':password', $password);
        $statement2->bindValue(':address', $address);
        $statement2->bindValue(':userId', $user_id);
        $statement2->execute();
    }

?>