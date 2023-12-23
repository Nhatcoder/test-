<?php
    if(!isset($_COOKIE["login"])){
        echo '<a href="login.php">Đăng nhập</a>';
    }else{
        echo '<a href="login.php">Đăng xuất</a>';
        echo ' | Xin chào '.$_COOKIE["login"];
    }

    require_once './connectDB.php';
    $query ="SELECT flights.flight_id, flights.flight_number, flights.image, flights.total_passengers,
    flights.description, flights.airline_id , airlines.airline_name
    FROM db_plane1.flights INNER JOIN db_plane1.airlines ON flights.airline_id = airlines.airline_id";
    $state= $db->prepare($query);
    $state->execute();
    $listPlane = $state->fetchAll(PDO::FETCH_ASSOC);
    $row='';
    if($listPlane ){
       foreach($listPlane as $key=>$item){
            $row .= '
            <tr>
                <td>'.($key+1).'</td>
                <td>'.$item['flight_number'].'</td>
                <td><img style= "width:100px" src="./uploads/'.$item['image'].'" alt=""></td>
                <td>'.$item['total_passengers'].'</td>
                <td>'.$item['description'].'</td>
                <td>'.$item['airline_name'].'</td>
                <td><a href="edit.php?id='.$item['flight_id'].'">Sửa</a>|
                <a href="delete.php?id='.$item['flight_id'].'">Xóa</a></td>
            </tr>
            ';
       }
    }
?>


<hr>
<h2>Danh sách chuyến bay</h2>
<a href="add.php">Thêm chuyến bay</a>
<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên chuyến bay</th>
            <th>Hình ảnh</th>
            <th>số hành khách</th>
            <th>Mô tả</th>
            <th>Hãng bay</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?=$row;?>
    </tbody>
</table>