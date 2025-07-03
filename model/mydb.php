<?php
function getDBConnection() {
    $servername = "localhost";
    $username = "root";     
    $password = "";        
    $dbname = "turf_booking";
    
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    return $conn;
}


function insert_turf($conn, $data) {
    $sql = "INSERT INTO turfs 
        (username, password, turf_name, phone, email, address, sports, other_sport, image_paths, owner_name, owner_phone, owner_email, owner_nid, created_at)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        return false;
    }

    $stmt->bind_param(
        "ssssssssssssss",
        $data['username'],
        $data['password'],
        $data['turf_name'],
        $data['phone'],
        $data['email'],
        $data['address'],
        $data['sports'],
        $data['other_sport'],
        $data['image_paths'],
        $data['owner_name'],
        $data['owner_phone'],
        $data['owner_email'],
        $data['owner_nid'],
        $data['created_at']
    );

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        return true;
    } else {
        error_log("Execute failed: " . $stmt->error);
        return false;
    }
}   
    

    function getTurfByUsername($conn,$username) {
    $stmt = $conn->prepare("SELECT * FROM turfs WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    $turf = null;
    if ($result && $result->num_rows === 1) {
        $turf = $result->fetch_assoc();
    }

    $stmt->close();


    return $turf; // returns associative array or null
}   



    function getTurfById($conn, $id) {
    $stmt = $conn->prepare("SELECT * FROM turfs WHERE id = ?");
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        return null;
    }
    
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $turf = null;
    if ($result && $result->num_rows === 1) {
        $turf = $result->fetch_assoc();
    }

    $stmt->close();
    

    return $turf;
}

    function updateTurfProfile($conn, $seller_id, $data) {
    $sql = "UPDATE turfs SET
                turf_name = ?,
                phone = ?,
                email = ?,
                address = ?,
                sports = ?,
                other_sport = ?,
                owner_name = ?,
                owner_phone = ?,
                owner_email = ?,
                owner_nid = ?
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        return false;
    }

    $stmt->bind_param("ssssssssssi",
        $data['turf_name'],
        $data['phone'],
        $data['email'],
        $data['address'],
        $data['sports'],
        $data['other_sport'],
        $data['owner_name'],
        $data['owner_phone'],
        $data['owner_email'],
        $data['owner_nid'],
        $seller_id
    );

    return $stmt->execute();
}

    function deleteTurfById($conn, $seller_id) {
    $stmt = $conn->prepare("DELETE FROM turfs WHERE id = ?");
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        return false;
    }

    $stmt->bind_param("i", $seller_id);

    $result = $stmt->execute();
    if (!$result) {
        error_log("Execute failed: " . $stmt->error);
    }

    $stmt->close();

    return $result;
}
     function getSlotsForTurf($conn, $turf_id, $date) {
    $slots = ['8am-10am', '10am-12pm', '2pm-4pm', '4pm-6pm'];  // example slots
    $stmt = $conn->prepare("SELECT time_slot, status, price FROM bookings WHERE turf_id = ? AND booking_date = ?");
    $stmt->bind_param("is", $turf_id, $date);
    $stmt->execute();
    $result = $stmt->get_result();

    $booked = [];
    while ($row = $result->fetch_assoc()) {
        $booked[$row['time_slot']] = $row;
    }

    $status_array = [];
    foreach ($slots as $slot) {
        if (isset($booked[$slot])) {
            $status_array[] = [
                'time_slot' => $slot,
                'status' => $booked[$slot]['status'],
                'price' => $booked[$slot]['price']
            ];
        } else {
            $status_array[] = [
                'time_slot' => $slot,
                'status' => 'Available',
                'price' => 3000.00     // Default price here
            ];
        }
    }

    return $status_array;
}

    
    function updateSlotStatus($conn, $turf_id, $date, $time_slot, $new_status) {
    $sql = "UPDATE slots 
            SET status = ? 
            WHERE turf_id = ? AND date = ? AND time_slot = ?";
    
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        return false;
    }
    $stmt->bind_param("siss", $new_status, $turf_id, $date, $time_slot);
    $result = $stmt->execute();
    $stmt->close();

    return $result;
}

?>