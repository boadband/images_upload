<!-- ดึงฐานข้อมูลมาใช้-->
<?php
include('dbconnect.php');
session_start();

?>
<!-- ดึงฐานข้อมูลมาใช้-->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>images Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <form action="upload.php" method="POST" enctype="multipart/form-data">
                    <div class="text-center justify-content-center align-items-center p-4 border-2 border-dashed rounded-3">
                        <h6 class="my-2">Select image file to upload</h6>
                        <input type="file" name="file" class="form-control streched-link" accept="image/">
                        <p class="small mb-0 mt-2"><b>Note:</b> Only JPG, JPEG, PNG & GIF files are allowed to upload</p>
                    </div>
                    <div class="d-sm-flex justify-content-end mt-2">
                        <input type="submit" name="submit" value="Upload" class="btn btn-sm btn-primary mb-3">
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <?php  if (!empty($_SESSION['statusMsg'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php 
                        echo $_SESSION['statusMsg']; 
                        unset($_SESSION['statusMsg']);
                    ?>
                </div>
            <?php } ?>
        </div>
<div class="row g-2">
          <!-- ส่วนการแสดงผล-->
            <?php 
            // ใช้คำสั่ง query = ตัวแปรเชื่อมฐานข้อมูล
            // แสดงผลใช้คำสั่ง SELECT * แสดงข้อมูลใน ตาราง images โดยเรียงจากไฟล์ล่าสุดที่อัพ DESC
                $query = $conn->query("SELECT * FROM images ORDER BY uploaded_on DESC");?>

            <!-- ใช้คำสั่ง while เพื่อวนข้อมูลมาแสดงผล แบบ อาร์เร
                $row = $query->fetch(PDO::FETCH_ASSOC จำนวนเเถวตามข้อมูลในฐานข้อมูล
             -->
           <?php while ($row = $query->fetch(PDO::FETCH_ASSOC))  { ?>
                <?php    $imageURL = 'uploads/' . $row['file_name']; ?>
                <!-- ส่วนการแสดงผล กำหนด ความกว่าง ยาว รูปภาพ-->
                <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="card shadow h-100">
                    <img src="<?php echo $imageURL ?>" alt="" width="100%" class="card-img">
                </div>
            </div>
            <?php } ?>
            
            <!-- ส่วนการแสดงผล-->

            <!-- มีปัญหา เพราะ ครูใช้ฐานข้อมูลแบบ PDO เเต่ ตัวอย่างใช้แบบ mysqli-->
                <!-- if ($query-> PDO >1) {
                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        $imageURL = 'uploads/'.$row['file_name'];
                    ?>
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="card shadow h-100">
                            <img src="<?php echo $imageURL ?>" alt="" width="100%" class="card-img">
                        </div>
                    </div>
                <?php 
                    ?>
                <p>No image found...</p>
            <?php  ?> -->
        </div>
    </div>
</body>

</html>