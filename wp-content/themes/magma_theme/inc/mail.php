<?php

require($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');

// send mail admin
$sendto = get_bloginfo("admin_email");

if(isset($_POST['contactName'])) {

        $name = $_POST['contactName'];
        $tel = $_POST['contactTel'];
        $email = $_POST['contactEmail'];
        $mess = $_POST['contactMess'];

        $subject  = "Magma Stone - контактна форма";

        $headers  = "From: " . "Magma Stone <no-reply@magmastones.ru>" . "\r\n";
        $headers .= "Reply-To: " . "Magma Stone <no-reply@magmastones.ru>" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html;charset=utf-8 \r\n";

        $msg  = "<html><body style='font-family:Arial,sans-serif;'>";

         $msg .= "<p> Имя: <strong>".$name."</strong></p>\r\n";
         $msg .= "<p> Телефон: <strong>".$tel."</strong></p>\r\n";
         $msg .= "<p> Email: <strong>".$email."</strong></p>\r\n";
         $msg .= "<p> Комментарий: <strong>".$mess."</strong></p>\r\n";
         
        $msg .= "</body></html>";

        if( mail($sendto, $subject, $msg, $headers) ) {
                echo 'Ваше сообщение успешно отправлено.<br /> Мы обязательно ответим Вам.';
        } else {
                echo 'Сообщение не было отправлено.';
        }
}



if(isset($_POST['popupName'])) {

        $name = $_POST['popupName'];
        $tel = $_POST['popupTel'];
        $email = $_POST['popupEmail'];
        $mess = $_POST['popupMess'];


        // send mail admin
        $sendto = get_bloginfo("admin_email");
        $subject  = "Magma Stone - заказ звонка";

        $headers  = "From: " . "Magma Stone <no-reply@magmastones.ru>" . "\r\n";
        $headers .= "Reply-To: " . "Magma Stone <no-reply@magmastones.ru>" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html;charset=utf-8 \r\n";

        $msg  = "<html><body style='font-family:Arial,sans-serif;'>";

         $msg .= "<p> Имя: <strong>".$name."</strong></p>\r\n";
         $msg .= "<p> Телефон: <strong>".$tel."</strong></p>\r\n";
         $msg .= "<p> Email: <strong>".$email."</strong></p>\r\n";
         $msg .= "<p> Комментарий: <strong>".$mess."</strong></p>\r\n";
         
        $msg .= "</body></html>";

        if( mail($sendto, $subject, $msg, $headers) ) {
                echo 'Ваше сообщение успешно отправлено.<br /> Мы обязательно ответим Вам.';
        } else {
                echo 'Сообщение не было отправлено.';
        }
}



if(isset($_POST['orderName'])) {

        $name = $_POST['orderName'];
        $tel = $_POST['orderTel'];
        $email = $_POST['orderEmail'];
        $mess = $_POST['orderMess'];
        $order = $_POST['orderTitle'];


        // send mail admin
        $sendto = get_bloginfo("admin_email");
        $subject  = "Magma Stone - новый заказ";

        $headers  = "From: " . "Magma Stone <no-reply@magmastones.ru>" . "\r\n";
        $headers .= "Reply-To: " . "Magma Stone <no-reply@magmastones.ru>" . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html;charset=utf-8 \r\n";

        $msg  = "<html><body style='font-family:Arial,sans-serif;'>";

         $msg .= "<p> Вам поступил новый заказ на: <strong>".$order."</strong></p>\r\n\r\n";
         $msg .= "<p><i> Контакты заказчика:</i></p>\r\n";
         $msg .= "<p> Имя: <span style='font-weight: bold;text-decoration:underline;'>".$name."</span></p>\r\n";
         $msg .= "<p> Телефон: <span style='font-weight: bold;text-decoration:underline;'>".$tel."</span></p>\r\n";
         $msg .= "<p> Email: <span style='font-weight: bold;text-decoration:underline;'>".$email."</span></p>\r\n";
         if( $mess != '' ){
            $msg .= "<p> Комментарий: <strong>".$mess."</strong></p>\r\n";
         }
         
        $msg .= "</body></html>";

        if( mail($sendto, $subject, $msg, $headers) ) {
                echo 'Ваш заказ успешно отправлен.';
        } else {
                echo 'Сообщение не было отправлено.';
        }
}

?>