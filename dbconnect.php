<?php
/*
    ส่วนเชื่อมฐานข้อมูล
    dsn ใช้เชื่อมฐานข้อมูล mysql:host=localhost; dbname=ชื่อฐานข้อมูล'
    $name = 'root';
    $password = '';
 */
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