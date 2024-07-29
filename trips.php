<?php
define('DOMAIN_URL', 'https://dudeweb.graymatterworks.com/');
define('API_URL', 'https://dudeways.com/api/');

$apiUrl = API_URL . "recent_trip";

$curl = curl_init($apiUrl);

// Define $data as an empty array
$data = [];

// Optional: If you're using POST and need to send data, you can use json_encode($data)
// curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($curl);

if ($response === false) {
    // Error in cURL request
    echo "Error: " . curl_error($curl);
} else {
    // Successful API response
    $responseData = json_decode($response, true);
    if ($responseData !== null && $responseData["success"]) {
        // Store user data
        $users = $responseData["data"];
        if (empty($users)) {
            echo "<script>alert('No trips found for the user.')</script>";
        }
    } else {
        if ($responseData !== null) {
            echo "<script>alert('" . $responseData["message"] . "')</script>";
        } else {
            echo "<script>alert('Invalid API response.')</script>";
        }
    }
}

curl_close($curl);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">

    <title>Dude Ways</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- ***** Header Start ***** -->
    <header class="header">
        <div class="logo-name">
            <img src="assets/images/dudeways.jpg" alt="Logo" class="logo">
            <img src="assets/images/tittle_img.png" alt="Logo" class="logo1" style="width:130px;">
        </div>
        <div class="menu-icon">
            <img src="assets/images/profile_placeholder.png" alt="Logo" class="logo">
        </div>
    </header>
    <!-- ***** Header End ***** -->

    <!-- ***** Buttons Section Start ***** -->
    <section class="section my-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="btn-group btn-group-toggle d-flex" role="group" aria-label="Basic example">
                <button type="button" class="btn btn-custom btn-custom-primary" style="border-radius: 10px;" onclick="window.location.href='https://play.google.com/store/apps/details?id=com.gmwapp.dudeways'">Nearby</button>&nbsp;
                <button type="button" class="btn btn-custom btn-custom-secondary" style="border-radius: 10px;" onclick="window.location.href='https://play.google.com/store/apps/details?id=com.gmwapp.dudeways'">Latest</button>
                <button type="button" class="btn btn-custom btn-custom-secondary" style="border-radius: 10px;" onclick="window.location.href='https://play.google.com/store/apps/details?id=com.gmwapp.dudeways'">Trip Date</button>

                </div>
            </div>
        </div>
    </section>
    <!-- ***** Buttons Section End ***** -->

    <!-- ***** Our Classes Start ***** -->
    <section class="section" id="our-classes">
        <div class="container">
            <div class="row">
                <?php if (!empty($users)) : ?>
                    <?php foreach ($users as $user) : ?>
                        <div class="col-md-4">
                            <div class="card mb-4" style="width: 22rem;">
                                <div class="d-flex align-items-center mb-3 logo-text-container">
                                    <img src="<?php echo htmlspecialchars($user['profile']); ?>" alt="Logo" class="card-logo">
                                    <div>
                                        <span class="overlay-name"><?php echo htmlspecialchars($user['name']); ?></span>&nbsp;&nbsp; &nbsp; &nbsp;<?php echo htmlspecialchars($user['unique_name']); ?> &nbsp; &nbsp;&nbsp; &nbsp; <?php echo htmlspecialchars($user['time']); ?>
                                        <div class="overlay-details">
                                            <?php echo htmlspecialchars($user['distance']); ?>&nbsp;
                                        </div>
                                    </div>
                                </div>
                                <img class="card-img-top" src="<?php echo htmlspecialchars($user['trip_image']); ?>" alt="Card image cap">
                                <div class="d-flex align-items-center mb-3" style="margin-top:8px;">
                                    <img src="assets/images/location_ic.png" alt="Logo" style="width:22px;">
                                    <p class="ml-1 mb-0" style="font-size:13px;"><?php echo htmlspecialchars($user['location']); ?></p>
                                </div>
                                <p class="card-text" style="font-weight:bold; margin-top:-10px;font-size:13px;"><?php echo htmlspecialchars($user['trip_type']); ?></p>
                                <div class="d-flex align-items-center mb-2">
                                    <img src="assets/images/date_ic.png" alt="Date Icon" style="width:22px;">
                                    <p class="ml-1 mb-0" style="font-size:13px;">
                                        <?php echo htmlspecialchars($user['from_date']); ?> <a href="#" style="color:blue; text-decoration:underline;">more...</a>
                                    </p>
                                </div>

                                <div class="btn-group-custom">
                                    <a href="https://play.google.com/store/apps/details?id=com.gmwapp.dudeways" style="background-color:white; color:black;font-size:13px; padding:13px;border-bottom: none; border-left:none;" class="btn btn-secondary btn-customs">
                                        <img src="assets/images/add_account.png" alt="Logo" style="width:22px;"> Add to Friend
                                    </a>
                                    <a href="https://play.google.com/store/apps/details?id=com.gmwapp.dudeways" style="background-color:#fc5082; color:white;font-size:13px;padding:13px;  border-bottom: none;  border-left:none;  border-right:none;" class="btn btn-secondary btn-customs">
                                        <img src="assets/images/chat_ic.png" alt="Logo" style="width:22px;"> Start Chat
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No trips available to display.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <!-- ***** Our Classes End ***** -->

</body>

</html>
