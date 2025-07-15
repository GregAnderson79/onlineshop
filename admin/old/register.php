<?php

    // error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // error ref
    // 0 - script, connection failure fallback
    // 1 - validation
    // 2 - existing user found

    // session
    session_start();

    // get page function
    if (isset($_GET['action'])) {
        $action = htmlspecialchars($_GET["action"]);
    } else {
        $action = null;
    }

    // process form
    if ($action==="register") {

        // was form posted?
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // get form inputs
            $userName = htmlspecialchars($_POST["userName"]);
            $email = htmlspecialchars($_POST["email"]);
            $user = htmlspecialchars($_POST["user"]);
            $pwd = htmlspecialchars($_POST["pwd"]);
            $repeatPwd = htmlspecialchars($_POST["repeatPwd"]);
    
            include("database.php");

            // Model Register CLASS
            // Uses the Model_Database_Class to connect to the database, runs queries and returns results
            class Model_Register_Class extends Model_Database_Class {
    
                // check db for existing users
                protected function model_existingUsers($user, $email) {
                    $sql = "SELECT * FROM users WHERE user = ? OR email = ?";
                    $statement = $this->connect()->prepare($sql);
            
                    if (!$statement->execute([$user, $email])) {
                        $statement = null;
                        header("location: register.php?error=0");
                        exit();
                    } else {
                        return $statement->rowCount();
                        $statement = null;
                    }
                }
            
                // add new registrant to db
                protected function model_addUser($userName, $email, $user, $pwd) {
                    $options = ['cost' => 12];
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT, $options);
            
                    $sql = "INSERT INTO users (username, email, user, pwd) VALUES (?, ?, ?, ?);";
                    $statement = $this->connect()->prepare($sql);
            
                    if (!$statement->execute([$userName, $email, $user, $hashedPwd])) {
                        $statement = null;
                        header("location: register.php?error=0");
                        exit();
                    } else {
                        return true;
                        $statement = null;
                    }
                }
            }

            // Control Register CLASS
            // processes data returned from the database by Model_Register_Class
            class Control_Register_Class extends Model_Register_Class {
                private $userName;
                private $email;
                private $user;
                private $pwd;
                private $repeatPwd;
            
                public function __construct($userName, $email, $user, $pwd, $repeatPwd) {
                    $this->userName = $userName;
                    $this->email = $email;
                    $this->user = $user;
                    $this->pwd = $pwd;
                    $this->repeatPwd = $repeatPwd;
                }
            
                public function control_register_method() {
                    $_SESSION["userName"] = $this->userName;
                    $_SESSION["email"] = $this->email;
                    $_SESSION["user"] = $this->user;
            
                    // error return
                    if (
                        $this->control_validateEmptyInputs() || 
                        $this->control_validateUserNameChars() ||
                        $this->control_validateEmail() ||
                        $this->control_validateUserLength() || 
                        $this->control_validateUserChars() ||
                        $this->control_validatePwdChars() ||
                        $this->control_validatePwdMatch()
                    ) {
                        header("location: register.php?error=1"); // validation fail
                        exit();
                    }
            
                    // existing user?
                    if ($this->control_validateExistingUsers()) {
                        header("location: register.php?error=2");
                        exit();
                    }
            
                    // register
                    if ($this->control_addUser() === true) {
                        header("location: register.php?action=complete");
                    } else {
                        header("location: register.php?error=0");
                        exit();
                    }
                }
            
                // check for empty inputs
                private function control_validateEmptyInputs() {
                    if (empty($this->userName) || empty($this->email) || empty($this->user) || empty($this->pwd) || empty($this->repeatPwd)) {
                        return true;
                    }
                }
            
                // check user length
                private function control_validateUserLength() {
                    if (strlen($this->user) < 8) {
                        return true;
                    }
                }
            
                // name, only allow uppercase, lower case, spaces
                private function control_validateUserNameChars() {
                    if (!preg_match("/^[a-zA-Z\s]*$/", $this->userName)) {
                        return true;
                    }
                }
            
                // check for special characters in user
                private function control_validateUserChars() {
                    if (!preg_match("/^[a-zA-Z0-9]*$/", $this->user)) {
                        return true;
                    }
                }
            
                // check email
                private function control_validateEmail() {
                    if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
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
            
                // check matching passwords
                private function control_validatePwdMatch() {
                    if ($this->pwd !== $this->repeatPwd) {
                        return true;
                    }
                }
            
                // check for model validation of passwords
                private function control_validateExistingUsers() {
                    $rowCount = $this->model_existingUsers($this->user, $this->email);
                    if ($rowCount > 0) {
                        return true;
                    }
                }
            
                // complete registration
                private function control_addUser() {
                    $result = $this->model_addUser($this->userName, $this->email, $this->user, $this->pwd);
                    return $result;
                }
            }
    
            // instantiate and run
            // Model_Database_Class > Model_Register_Class > Control_Register_Class
            $control_register_object = new Control_Register_Class($userName, $email, $user, $pwd, $repeatPwd);
                $control_register_object->control_register_method();

        // else...
        // form not posted, redirect        
        } else {
            header("location: register.php");
        }

    }

    // COMPLETE
    if ($action==="complete") {
?>
        <!doctype html>
        <html lang="en">
        <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <title>Register</title>
        <link href="styles.css" rel="stylesheet">
        <script language="JavaScript" SRC="scripts.js"></script>
        <script language="JavaScript">
            document.addEventListener("DOMContentLoaded",function() {
                RUN_SUCCESS_ICON();
            });
        </script>
        </head>
        <body>
        <div class="holder">
            <div class="pnl1">
                <div class="pnl_layout">
                    <div class="pnl_ttl">Register Admin</div>
                    <div class="pnl_icon">
                        <div class="icon_success">
                            <div class="icon_success_tick"><span>&#10004;</span></div>
                            <div class="icon_ring icon_ring_left"><div class="icon_ring_fill"></div></div>
                            <div class="icon_ring icon_ring_right"><div class="icon_ring_fill"></div></div>
                        </div>
                        <div class="pnl_msg_green">Registration Complete</div>
                    </div>
                    <div class="pnl_nav1">
                        <p>Next step...</p>
                        <a href="login.php">Login now</a>
                    </div>
                </div>
            </div>
        </div>
        </body>
        </html>
<?php

    // FORM
    } else {
?>
        <!doctype html>
        <html lang="en">
        <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width,initial-scale=1"/>
        <title>Register</title>
        <link href="styles.css" rel="stylesheet">
        <script language="JavaScript" SRC="scripts.js"></script>
        <link rel="manifest" href="register_react/manifest.json"/>
        <script defer="defer" src="register_react/static/js/main.2726da62.js"></script>
        <link href="register_react/static/css/main.1b0fe4d7.css" rel="stylesheet">
<?php
        // get session details for persistance
        if (isset($_SESSION["userName"])) {
            echo "<script>var sessionUserName = '".$_SESSION["userName"]."'</script>";
        } else {
            echo "<script>var sessionUserName = ''</script>";
        }
        
        if (isset($_SESSION["email"])) {
            echo "<script>var sessionEmail = '".$_SESSION["email"]."'</script>";
        } else {
            echo "<script>var sessionEmail = ''</script>";
        }
        
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
<?php
    }
?>

