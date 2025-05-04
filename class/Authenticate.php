<?php

namespace App;

class Authenticate
{
    public function isAuth()
    {
        return isset($_SESSION['userID']);
    }

    public function redirectIfNotAuth()
    {
        if (!$this->isAuth())
            header('location: SignIn.php');
    }

    public function redirectIfAuth()
    {
        if ($this->isAuth())
            header('location: index.php');
    }

    // lojain
    public function signUp()
    {

        if (isset($_POST['signUpBtn'])) {
            $username = $_POST['username'];
            $email = $_POST['email']; //
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
            if ($password != $confirmPassword)
                \App\Alert::PrintMessage("Confirm Password not matched", 'Danger');
            else {
                $myDatabaseObj = new \App\DB();
                $insertStatement = "INSERT INTO `user` VALUES(NULL,?,?,?)"; // Sql injection
                $queryObj = $myDatabaseObj->Connection->prepare($insertStatement);
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $queryObj->bind_param('sss', $username, $email, $hashedPassword);
                $queryStatus = $queryObj->execute();
                if ($queryStatus)
                    header('location: SignIn.php?doneSignUp=1');
                else
                    Alert::PrintMessage("Failed to create your account", 'Danger');
            }
        }
    }

    // lama
    public function signIn()
    {
        if (isset($_POST['logInBtn'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            $myDBObject = new DB();
            $selectStatement = 'SELECT * FROM `user` WHERE email = ?';
            $queryStmtObject = $myDBObject->Connection->prepare($selectStatement);
            $queryStmtObject->bind_param('s', $email);
            $queryStatus = $queryStmtObject->execute();
            if (!$queryStatus)
                Alert::PrintMessage('Something went wrong', 'Danger');
            else {
                $resultObject = $queryStmtObject->get_result();
                if ($resultObject->num_rows == 1) {
                    $rowArr = $resultObject->fetch_assoc();
                    if (password_verify($password, $rowArr["password"])) {
                        $_SESSION['userID'] = $rowArr["id"];
                        $_SESSION['userName'] = $rowArr["name"];
                        Alert::PrintMessage("Welcome Back, " . $rowArr['name'], 'Normal');
                    } else {
                        Alert::PrintMessage('Wrong password', 'Danger');
                    }
                } else {
                    Alert::PrintMessage('Email is not valid', 'Danger');
                }
            }
        }
    }
    
    // ahmed
    public function logOut()
    {
        if (isset($_GET['logout'])) {
            session_unset();
            session_destroy();
            header("location: SignIn.php");
        }
    }
}