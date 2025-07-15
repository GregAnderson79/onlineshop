<?php

    // error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // error ref
    // 0 - script, connection failure fallback
    // 1 - validation
    // 2 - user not recognised

    // session
    session_start();

    // get page function
    if (isset($_GET['action'])) {
        $action = htmlspecialchars($_GET["action"]);
    } else {
        $action = null;
    }

    // process form
    if ($action==="login") {

        // was form posted?
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // get form inputs
            $user = htmlspecialchars($_POST["user"]);
            $pwd = htmlspecialchars($_POST["pwd"]);

            include("database.php");

            // Model Login CLASS
            // Uses the Model_Database_Class to connect to the database, runs queries and returns results
            class Model_Login_Class extends Model_Database_Class {
    
                // verify the user logging in
                protected function model_verifyUser($user) {
                    $sql = "SELECT pwd FROM users WHERE user = ?";
                    $statement = $this->connect()->prepare($sql);
            
                    if (!$statement->execute([$user])) {
                        $statement = null;
                        header("location: login.php?error=0");
                        exit();
                    }
            
                    $dbPwd;
                    if ($statement->rowCount() === 1) {
                        $dbPwd = $statement->fetch()["pwd"];
                    } else {
                        $dbPwd = "";
                    }
            
                    $statement = null;
                    return $dbPwd;
                }
            
                // get the login details for the logged in user
                protected function model_getUserDtls($user) {
                    $sql = "SELECT id, username FROM users WHERE user = ?";
                    $statement = $this->connect()->prepare($sql);
            
                    if (!$statement->execute([$user])) {
                        $statement = null;
                        header("location: ../login/?error=0");
                        exit();
                    }
            
                    $userDtls;
                    if ($statement->rowCount() === 1) {
                        $userDtls = $statement->fetch();
                    }
            
                    $statement = null;
                    return $userDtls;
                }
            }

            // Control Login CLASS
            // processes data returned from the database by Model_Login_Class
            class Control_Login_Class extends Model_Login_Class {
                private $user;
                private $pwd;
            
                public function __construct($user, $pwd) {
                    $this->user = $user;
                    $this->pwd = $pwd;
                }
            
                public function control_Login() {
                    $_SESSION["user"] = $this->user;
            
                    // error return
                    if ($this->control_validateEmptyInputs() || $this->control_validateUserLength() || $this->control_validateUserChars() || $this->control_validatePwdChars() === true) {
                        header("location: login.php?error=1"); // validation fail
                        exit();
                    }
            
                    // login result
                    if ($this->control_verifyUser() === true) {
                        $userCookie = "";
                        $userDtls = $this->control_getUserDtls();
                        if ($userDtls) {
                            $_SESSION["logginInAdmin"] = true;
                            $_SESSION["loggedInID"] = $userDtls['id'];
                            $_SESSION["loggedInUserName"] = $userDtls['username'];
                            header("location: menu.php"); // logged in, go to menu
            
                        } else {
                            header("location: login.php?error=0"); // missing user details
                            exit();  
                        }
            
                    } else {
                        header("location: login.php?error=2"); // user not recognised
                        exit();
                    }
                }
            
                // check for empty inputs
                private function control_validateEmptyInputs() {
                    if (empty($this->user) || empty($this->pwd)) {
                        return true;
                    }
                }
            
                // check user length
                private function control_validateUserLength() {
                    if (strlen($this->user) < 8) {
                        return true;
                    }
                }
            
                // check for special characters in user
                private function control_validateUserChars() {
                    if (!preg_match("/^[a-zA-Z0-9]*$/", $this->user)) {
                        return true;
                    }
                }
            
                // password strength
                private function control_validatePwdChars() {
                    $uppercase = preg_match('@[A-Z]@', $this->pwd);
                    $lowercase = preg_match('@[a-z]@', $this->pwd);
                    $number    = preg_match('@[0-9]@', $this->pwd);
                    $specialChars = preg_match('@[^\w]@', $this->pwd);
            
                    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($this->pwd) < 8) {
                        return true;
                    }
                }
            
                // verify passwords
                private function control_verifyUser() {
                    $dbPwd = $this->model_verifyUser($this->user);
                    if (password_verify($this->pwd, $dbPwd)) {
                        return true;
                    }
                }
            
                // get logged in user details for session
                private function control_getUserDtls() {
                    $userDtls = $this->model_getUserDtls($this->user);
                    return $userDtls;
                }
            }

            // instantiate and run
            // Model_Database_Class > Model_Login_Class > Control_Login_Class
            $control_login_object = new Control_Login_Class($user, $pwd);
                $control_login_object->control_login();

        // else...
        // form not posted, redirect    
        } else {
            header("location: login.php");
        }
    }
?>
    <!doctype html>
    <html lang="en">
    <head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1"/>
    <title>Login</title>
    <link href="styles.css" rel="stylesheet">
    <script language="JavaScript" SRC="scripts.js"></script>
    <link rel="manifest" href="login_react/manifest.json"/>
    <script defer="defer" src="login_react/static/js/main.e2961b4b.js"></script>
    <link href="login_react/static/css/main.ffa66613.css" rel="stylesheet">
<?php
        // get session details for persistance
        if (isset($_SESSION["user"])) {
            echo "<script>var sessionUser = '".$_SESSION["user"]."'</script>";
        } else {
            echo "<script>var sessionUser = ''</script>";
        }
?>
    </head>
    <body>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root"></div>
    </body>
    </html>