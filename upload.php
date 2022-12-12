<?php 
// เช็ตค่าเริ่มต้น
session_start();
// ดึงไฟล์เชื่อมฐานข้อมูลมาใช้
include 'dbconnect.php';

// ที่เก็บไฟล์ก่อนอัพโหลด
$targetDir = "uploads/";

// เมื่อมีการกดอัพโหลดมา (ชนิด input ที่ชื่อ submit )
if (isset($_POST['submit'])) {
  // จะมีการตรวจว่า ส่งมาจริงไหมด้วย !empty  ถ้ามีไฟล์ ให้ทำการเก็บค่าไฟล์ กับชื่อ ด้วยคำสั่ง $_FILES["file"]["name"] 
    if (!empty($_FILES["file"]["name"])) {
        //โดยแทนค่า $fileName ด้วยชื่อเดิมของไฟล์ที่จะอัพ

        $fileName = basename($_FILES["file"]["name"]);

        /*ค่า $targetFilePath คือที่อยู่ไฟล์ที่เราเตรียมจะอัพ 
        $targetFilePath = $targetDir . $fileName ="uploads/...ชื่อไฟล์"*/
        $targetFilePath = $targetDir . $fileName;

        //เก็บ นามสกุลไฟล์ 
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // เลือกประเภทไฟล์ที่จะสามารถอัพ ***ตอนนี้ติดปัญหาไฟล์ บางไฟล์ใหญ่เกิน ไม่ก็ปัญหาไราักอย่าง แต่อัพ ได้อยู่*****
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

        //เชฺ็คเงื่อนไขว่า ประเภทไฟล์ถูกไหม
        if (in_array($fileType, $allowTypes)) {
            //ถ้า ถูก จะนำไฟล์ไปเก็บใน floder uploads เพื่อเตรียมอัพ
            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {

                 //เป็นการอัพขึ้นเชิฟ ด้วยคำสั่ง SQL
                /*
                    $insert = $conn->query("INSERT INTO images(file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
                    หมายถึง
                    สร้างตัวแปร insert โดยให้ conn(ชื่อตัวแปรที่เราเชื่อมฐานข้อมูล) ทำการเพิ่ม  query
                    INSERT INTO images ทำการเพิ่มข้อมูลในตาราง images
                    ใน file_name และ uploaded_on  ด้วยค่า $fileName และ เวลา NOW()                                                
                    
ู                */
                $insert = $conn->query("INSERT INTO images(file_name, uploaded_on) VALUES ('".$fileName."', NOW())");
                
                //ตรวจสอบว่ามีการอัพหรือไม่ ถ้าอัพแสดงอะไร ไม่รับแสดงอะไร
                if ($insert) {
                    $_SESSION['statusMsg'] = "The file <b>" . $fileName . "</b> has been uploaded successfully.";
                   
                   //ตั้งหน้าหลัก
                    header("location: index.php");
                } else {
                    $_SESSION['statusMsg'] = "File upload failed, please try again.";
                    header("location: index.php");
                }
            } else {
                $_SESSION['statusMsg'] = "Sorry, there was an error uploading your file.";
                header("location: index.php");
            }
        } else {
            $_SESSION['statusMsg'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed to upload.";
            header("location: index.php");
        }
    } else {
        $_SESSION['statusMsg'] = "Please select a file to upload.";
        header("location: index.php");
    }
}