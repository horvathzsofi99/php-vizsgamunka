<?php

require './database.php';

function checkUser(string $email, string $password){
    $sql = 'SELECT * FROM user WHERE email = "' . $email . '" AND jelszo = "' . $password . '"';
    $result = mysqli_query(dbConnect(), $sql);
   
    if(mysqli_num_rows($result) === 1){
        return true;
    }
    else{
        return false;
    }
}

function getUser(string $email, string $password){
    $sql = 'SELECT * FROM user WHERE email = "' . $email . '" AND jelszo = "' . $password . '"';
    $result = mysqli_query(dbConnect(), $sql);
    
    if(mysqli_num_rows($result) === 1){
        return $result->fetch_assoc();
    }
    else{
        return null;
    }
}

function loginUser(){
    if(isset($_POST['login'])){
        $email = $_POST['login']['email'];
        $password = $_POST['login']['password'];
        $hashpassword = hash('sha512', $password);
        if(checkUser($email, $hashpassword)){
            $user = getUser($email, $hashpassword);
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['password'] = $user['jelszo'];
                $_SESSION['birthDate'] = $user['szuletesi_datum'];
                $_SESSION['picture'] = $user['kep_url'];
                $_SESSION['name'] = $user['nev'];
                header("Refresh:0");
                header('Location: admin_movies.php');
            }
            else{
                print("<div class=\"alert alert-warning position-fixed bottom-0 mb-0 w-100\" role=\"alert\">
                        Nem megfelelő e-mail formátum!
                    </div>");
            }
        }
        else{
            print("<div class=\"alert alert-warning position-fixed bottom-0 mb-0 w-100\" role=\"alert\">
                    A felhasználó nem létezik!
                </div>");
        }
    }
}


function signupUser(){
    if(isset($_POST['signup'])){
        $email = $_POST['signup']['email'];
        $password1 = $_POST['signup']['password1'];
        $password2 = $_POST['signup']['password2'];
        $hashpassword1 = hash('sha512', $password1);
        $hashpassword2 = hash('sha512', $password2);
        $name = filter_var($_POST['signup']['name'], FILTER_SANITIZE_SPECIAL_CHARS);
        $birthDate = $_POST['signup']['birthdate'];
        $pic = $_POST['exampleRadios'];
        
        if(!checkUser($email, $hashpassword1)){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                if($hashpassword1 == $hashpassword2){
                    $data['email'] = $email;
                    $data['jelszo'] = $hashpassword1;
                    $data['szuletesi_datum'] = $birthDate;
                    $data['nev'] = $name;
                    $data['kep_url'] = $pic;
                    $conn = dbConnect();
                    $id = dbInsert($conn, 'user', $data);
                    header('Location: login.php'); 
                }
                else{
                    print("<div class=\"alert alert-warning position-fixed bottom-0 mb-0 w-100\" role=\"alert\">
                            A megadott jelszavak nem egyeznek meg.
                        </div>");
                }
            }
            else{
                print("<div class=\"alert alert-warning position-fixed bottom-0 mb-0 w-100\" role=\"alert\">
                        Nem megfelelő e-mail formátum!
                    </div>");
            }
        }
        else{
            print("<div class=\"alert alert-warning position-fixed bottom-0 mb-0 w-100\" role=\"alert\">
                    Ez a felhasználó már létezik.
                </div>");
        }
    }
}

function dbInsert($conn, string $tableName, array $data){
    $sqlText = "INSERT INTO $tableName ";
    $sqlFields = '(';
    $sqlValues ='(';
    foreach ($data as $key => $value) {
        $sqlFields .= $key.',';
        $sqlValues .= "'".$value."',";
    }
    $sqlFields = substr($sqlFields, 0, strlen($sqlFields)-1);
    $sqlValues = substr($sqlValues, 0, strlen($sqlValues)-1);
    $sqlFields .= ')';
    $sqlValues .= ')';
    
    $sqlText .= $sqlFields.' VALUES '.$sqlValues;
    
    $result = mysqli_query($conn, $sqlText);
    if($result){
        return mysqli_insert_id($conn);
    }
    return false;
}

function dbUpdateById($conn, string $tableName, array $data, int $id){
    $sqlText = "UPDATE $tableName SET ";
    $sqlFields = '';
    $sqlValues = '';
    foreach ($data as $key => $value) {
        $sqlValues .= $key." = '".$value."',";
    }
    $sqlValues = substr($sqlValues, 0, strlen($sqlValues)-1);
    
    $sqlText .= $sqlValues." WHERE id = ".$id;
    
    $result = mysqli_query($conn, $sqlText);
}

function dbDeleteById(int $id){
    $sqlText = "UPDATE film SET torolve=\"igen\" WHERE id=$id";
    $result = mysqli_query(dbConnect(), $sqlText);
}



