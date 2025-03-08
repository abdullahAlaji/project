<?php

//تجميع البيانات
$firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

// تجميع الاخطاء
$errors = [
    'firstNameError' => '',
    'lastNameError' => '',
    'emailError' => '',
];

if(isset($_POST['submit'])){
    //تحقق الاسم الاول
    if(empty($firstName)){
        $errors['firstNameError'] = 'يرجى ادخال الاسم الاول';
    }
    //تحقق الاسم الاخير
    if(empty($lastName)){
        $errors['lastNameError'] = 'يرجى ادخال الاسم الاخير';
    }
    //تحقق البريد الالكتروني
    if(empty($email)){
        $errors['emailError'] = 'يرجى ادخال البريد الالكتروني';
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors['emailError'] = ' يرجى ادخال بريد الكتروني صحيح';
        
    } 
    // تحقق لا يوجد اخطاء
    
    if(!array_filter($errors)){
        $firstName = mysqli_real_escape_string($conn,$_POST['firstName']) ;
        $lastName = mysqli_real_escape_string($conn,$_POST['lastName']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);

        $sql = "INSERT INTO users (firstName, lastName, email) VALUES ('$firstName','$lastName','$email')";

        if(mysqli_query($conn, $sql)){
            header('location: ' . $_SERVER['PHP_SELF'] );
        } else{
            echo 'error:' .mysqli_error($conn);
        }
    }

}
