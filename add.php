<?php
    if(!isset($_COOKIE["login"])){
        header("location: login.php");
    }
    $flight_number='';
    $flight_numberErr='';
    $imageName ='';
    $imageErr='';
    $total_passengers='';
    $total_passengersErr="";
    $description='';
    $descriptionErr='';
    $airline_id='';

    require_once './connectDB.php';
    $query = 'SELECT * FROM db_plane1.airlines';
    $state = $db->prepare($query);
    $state->execute();
    $listAir= $state->fetchAll(PDO::FETCH_ASSOC);
    $option='';
    if($listAir){
        foreach($listAir as $key=>$item){
            $option.='<option value="'.$item['airline_id'].'">'.$item['airline_name'].'</option>';
        }
    }

    if(isset($_POST['submit'])){
        $flight_number=$_POST['flight_number'];
        $total_passengers=$_POST['total_passengers'];
        $description=$_POST['description'];
        $airline_id=$_POST['airline_id'];
        //validate
        $isCheck= true;
        if(empty(trim($flight_number))){
            $isCheck= false;
            $flight_numberErr= 'Không được để trống tên chuyến bay';
        }
        if(empty(trim($description))){
            $isCheck= false;
            $descriptionErr= 'Không được để trống mô tả    ';
        }

        if(empty(trim($total_passengers))){
            $isCheck =false;
            $total_passengersErr =  "Không được để trống số lượng hàng khác";
        }else{
            if(!preg_match("/^[0-9-]*$/", $total_passengers)){
                $isCheck =false;
                $total_passengersErr =  "Không nhập các kí tự chữ";
            }else{
                if($total_passengers < 0){
                    $isCheck =false;
                    $total_passengersErr = "Số lượng hàng khách phải lớn hơn hoặc bằng 0";
                }
            }
        }

        //validate hình ảnh
        if(empty($_FILES["image"]["name"]) ){
            $isCheck= false;
            $imageErr="không được để trống hình ảnh";
        }else{
            //$file = $_FILES["image"];
            //lấy tên của file
            $imageName = time().basename($_FILES["image"]["name"]);
            $taget_files= './uploads/'.$imageName ;

            //file extension (tên đuôi của files)

            $file_extension = pathinfo($taget_files, PATHINFO_EXTENSION);
            //in thường đuôi file
            $file_extension = strtolower($file_extension);

            // validate file (chỉ cho nhập ảnh)
            $valid_extension =["png","jpeg","jpg"];
            if(!in_array($file_extension, $valid_extension)){
                $isCheck= false;
                $imageErr ="Chỉ được nhập ảnh";
            }else{
                if($isCheck){
                    if(!move_uploaded_file($_FILES["image"]["tmp_name"],$taget_files)){
                        $isCheck = false;
                        $imageErr ="Không lưu được ảnh";
                    }
                }
                
            }
        }
        if($isCheck){
            $query="INSERT INTO flights(flight_id, flight_number, image, total_passengers, 
            description, airline_id) VALUES (null,:flight_number,:image,:total_passengers
            ,:description,:airline_id)";

            $state = $db->prepare($query);
            $data=[
                ":flight_number"=> $flight_number,
                ":image"=> $imageName,
                ":total_passengers"=>$total_passengers,
                ":description"=> $description,
                ":airline_id" =>$airline_id
            ];
            // print_r($data);
            $result= $state->execute($data);
            if($result){
                header("location: index.php");
            }else{
                echo "Thêm thất bại";
            }

        }

    }

?>
<h2>Thêm thông tin cho chuyến bay mới</h2>


<form action="add.php" method="post" enctype="multipart/form-data">
    Tên chuyến bay: <input type="text" name="flight_number" value="<?= $flight_number;?>">
    <span style="color:red"><?= $flight_numberErr;?></span><br>
    Hình ảnh: <input type="file" name="image">
    <span style="color:red"><?= $imageErr;?></span><br>
    Số hành khách: <input type="text" name="total_passengers" value ="<?=$total_passengers?>">
    <span style="color:red"><?= $total_passengersErr;?></span><br>
    Mô tả: <input type="text" name="description" value ="<?=$description?>">
    <span style="color:red"><?= $descriptionErr;?></span><br>
    Hãng bay: <select name="airline_id" id="">
        <?= $option;?>
    </select><br>
    <input type="submit" name ="submit">

</form>