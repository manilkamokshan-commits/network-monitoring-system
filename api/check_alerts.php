<?php

include 'db.php';


// Offline Device Check

$devices = mysqli_query($conn,
"SELECT * FROM devices WHERE status='Offline'");


while($device = mysqli_fetch_assoc($devices)){


    $name = $device['device_name'];


    $check = mysqli_query($conn,
    "SELECT * FROM alerts 
     WHERE alert_type='Offline Device'
     AND device_name='$name'
     AND status='Unread'");


    if(mysqli_num_rows($check)==0){


        mysqli_query($conn,

        "INSERT INTO alerts
        (alert_type,message,device_name,severity)

        VALUES

        ('Offline Device',
        'Device is offline',
        '$name',
        'High')"

        );


    }

}




// High Bandwidth Check


$bandwidth = mysqli_query($conn,

"SELECT * FROM bandwidth WHERE usage_percent > 80");


while($data=mysqli_fetch_assoc($bandwidth)){


    $device=$data['device_name'];


    $check=mysqli_query($conn,

    "SELECT * FROM alerts
     WHERE alert_type='High Bandwidth'
     AND device_name='$device'
     AND status='Unread'"

    );


    if(mysqli_num_rows($check)==0){


        mysqli_query($conn,

        "INSERT INTO alerts
        (alert_type,message,device_name,severity)

        VALUES

        ('High Bandwidth',
        'Bandwidth usage is above 80%',
        '$device',
        'Medium')"

        );


    }

}



?>