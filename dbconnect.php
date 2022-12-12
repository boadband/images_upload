<?php
$dsn = 'mysql:host=localhost;dbname=images_upload';
$name = 'root';
$password = '';


$conn = new PDO($dsn, $name, $password);
 /*
 ส่วนตรวจจับ errors มีก็ดี
 try{
     *****ถ้าใส่ส่วนตรวจจับให้เอาบรรทัดที่ 7 มาใส่ที่นี่******
      echo('connection successful')
 } catch (PDOException $e) {
     echo $e->$getMessage();

 }
 */
?>