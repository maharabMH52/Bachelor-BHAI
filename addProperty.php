<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BACHELOR BHAI</title>


    <!---favicon-------------------->


    <link rel="shortcut icon" href="assets/image/logo/Bachelor-Bhai-House-Transparent-Logo-10(250x250px).png" type="image/x-icon">




    <!--icon file-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!----custom css link--->


    <link rel="stylesheet" href="./assets/css/property_style.css">



    <!--google font link-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">




</head>




<body>

    <!-- Header part work--------------------------->

    <section id="header">

        <a href="dashboard.php"><img class="logo_img" src="assets/image/logo/Bachelor-Bhai-LOGO-01-Final(500x500px).png" class="logo" alt="REBYELL LOGO"> </a>

        <div>
            <ul id="navbar">

                <li><a href="dashboard.php">Home</a></li>
                <li><a class="active" href="dashboard.php">Feature</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.php">Contact</a></li>

                <li>
                    <div class="search-box">
                        <input type="text" class="search-txt" placeholder="Search">
                        <a class="search-btn" href="#"><i class="fa-solid fa-magnifying-glass"></i></i></i></a>
                    </div>


                </li>
                <li>
                    <a id="lg-bag" href="cart.html"><i class="fa-regular fa-heart"></i></a>
                </li>
                <!--close icon-->

                <li>
                    <a onclick="toggleMenu()"><i class="fa-regular fa-user"></i></i></a>
                </li>

                <div class="sub-menu-wrap" id="subMenu">
                    <div class="sub-menu">
                    </div>
                </div>


            </ul>

    </section>

    <?php
    // Check if the user is logged in
    if (!isset($_SESSION['loggedin']) || ($_SESSION['loggedin'] != true)) {
        header("location: login.php?redirect=addProperty.php");
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        include 'essential/_dbConnect.php';

        $user_id = $_SESSION['user_id'];

        // Fetch user's email and phone number from the userinfo table
        $sql_userinfo = "SELECT email, phone FROM userinfo WHERE user_id = '$user_id'";
        $result_userinfo = mysqli_query($conn, $sql_userinfo);
        $userinfo = mysqli_fetch_assoc($result_userinfo);
        $email = $userinfo['email'];
        $phone_no = $userinfo['phone'];


        $available_from = $_POST['month'];
        $property_type = $_POST['property_type'];
        $bedrooms = $_POST['bedroom'];
        $bathrooms = $_POST['bathroom'];
        $balconies = $_POST['balcony'];
        $floor_no = $_POST['floor'];
        $rentee_gender = $_POST['gender'];
        $flat_size = $_POST['size'];
        $property_details = $_POST['property_details'];

        // Insert into properties table
        $sql_properties = "INSERT INTO properties (user_id, available_from, property_type, bedrooms, bathrooms, balconies, floor_no, rentee_gender, flat_size, property_details)
                       VALUES ('$user_id', '$available_from', '$property_type', '$bedrooms', '$bathrooms', '$balconies', '$floor_no', '$rentee_gender', '$flat_size', '$property_details')";
        $result_properties = mysqli_query($conn, $sql_properties);

        if ($result_properties) {
            $property_id = mysqli_insert_id($conn);

            $division = $_POST['division'];
            $district = $_POST['district'];
            $area = $_POST['area'];
            $sub_area = $_POST['subarea'];
            $sector_no = $_POST['sector_no'];
            $road_no = $_POST['road_no'];
            $house_no = $_POST['house_no'];
            $location_details = $_POST['location_details'];
            $latitude = $_POST['latitude']; // Capturing latitude
            $longitude = $_POST['longitude']; // Capturing longitude

            $sql_location = "INSERT INTO property_location (property_id, division, district, sub_area, area_thana, sector_no, road_no, house_no, location_details, latitude, longitude)
                         VALUES ('$property_id', '$division', '$district', '$sub_area', '$area', '$sector_no', '$road_no', '$house_no', '$location_details', '$latitude', '$longitude')";
            mysqli_query($conn, $sql_location);

            // Insert into property_pricing table
            $rent_price = $_POST['price'];
            $price_basis = $_POST['price_basis'];
            $sql_pricing = "INSERT INTO property_pricing (property_id, rent_price, price_basis)
                        VALUES ('$property_id', '$rent_price', '$price_basis')";
            mysqli_query($conn, $sql_pricing);

            // Insert into property_facilities table
            $facilities = [
                'electricity' => 0,
                'gas' => 0,
                'water' => 0,
                'lift' => 0,
                'security' => 0
            ];

            // Check if facilities are selected and update the array
            if (isset($_POST['facilities'])) {
                foreach ($_POST['facilities'] as $facility => $value) {
                    $facilities[$facility] = 1;  // Set to TRUE (1) if the checkbox is selected
                }
            }

            $sql_facilities = "INSERT INTO property_facilities (property_id, electricity, gas, water, lift, security)
                           VALUES ('$property_id', '{$facilities['electricity']}', '{$facilities['gas']}', '{$facilities['water']}', '{$facilities['lift']}', '{$facilities['security']}')";
            mysqli_query($conn, $sql_facilities);

            // Upload property images
            if (isset($_FILES['upload-photo'])) {
                // Define the directory to save images
                $target_dir = "uploads/property_images/";
                if (!is_dir($target_dir)) {
                    mkdir($target_dir, 0777, true); // Create directory if it doesn't exist
                }

                foreach ($_FILES['upload-photo']['name'] as $key => $image_name) {
                    // Get the temporary file path and error status for each file
                    $image_tmp_name = $_FILES['upload-photo']['tmp_name'][$key];
                    $image_error = $_FILES['upload-photo']['error'][$key];

                    // Ensure there is no error with the upload
                    if ($image_error === 0) {
                        // Generate a unique name for the image to prevent overwriting
                        $image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
                        $image_new_name = uniqid("img_", true) . "." . $image_ext;

                        // Move the uploaded image to the target directory
                        $target_file = $target_dir . $image_new_name;
                        if (move_uploaded_file($image_tmp_name, $target_file)) {
                            // Insert the image information into the 'property_images' table
                            $sql_image = "INSERT INTO property_images (property_id, image_location, filename)
                VALUES ('$property_id', '$target_file', '$image_new_name')";
                            mysqli_query($conn, $sql_image);
                        }
                    }
                }
            }
            // **Insert contact information into property_contact table**
            $sql_contact = "INSERT INTO property_contact (property_id, user_id, email, phone_no)
                            VALUES ('$property_id', '$user_id', '$email', '$phone_no')";
            $result_contact = mysqli_query($conn, $sql_contact);

            if (!$result_contact) {
                echo "Error saving property contact information: " . mysqli_error($conn);
            }
        }
    }
    ?>



    <form action="addProperty.php" method="POST" enctype="multipart/form-data">
        <section id="cart" class="section-p1">
            <table width="100%">
                <div class="cart-header">
                    <i class="fa fa-image"></i>
                    <h4 class="h4">Upload Photo</h4>
                </div>
                <hr>

                <div class="upload-image-container">
                    <div class="upload-photo-box">
                        <label for="upload-photo">
                            <i class="fa fa-cloud-upload"></i>
                            <p>Drag & Drop photo here or click to upload</p>
                        </label>
                        <input type="file" name="upload-photo[]" id="upload-photo" multiple accept="image/*">
                    </div>
                </div>

                <!-- Image Preview Table Section -->
                <div class="image-preview-section">
                    <table id="image-preview-table" class="image-table">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>File Name</th>
                                <th>File Size</th>
                            </tr>
                        </thead>
                        <tbody id="image-preview-body">
                            <!-- Image rows will be inserted here -->
                        </tbody>
                    </table>
                </div>



            </table>
        </section>


        <!-- Location Information----------------------------- -->
        <section id="cart" class="section-p1">
            <table width="100%">
                <div class="cart-header">
                    <i class="fa-solid fa-location-dot"></i>
                    <h4 class="h4">Location Information</h4>
                </div>
                <thead>
                    <tr>
                        <td>DIVISION</td>
                        <td>DISTRICT</td>
                        <td>AREA / THANA</td>
                        <td>SUB AREA</td>
                        <td>SECTOR NO</td>
                        <td>ROAD NO</td>
                        <td>HOUSE NO</td>
                    </tr>
                </thead>
                <tbody id="cart-items-container">
                    <!-- Dynamically added product items will go here -->
                    <tr>
                        <td class="table_info">
                            <select name="division" id="division">
                                <option value="">Select Division</option>
                                <option value="Dhaka">Dhaka</option>
                                <option value="Cumilla">Cumilla</option>
                            </select>
                        </td>
                        <td class="table_info">
                            <select name="district" id="district">
                                <option value="">Select District</option>
                                <option value="Dhaka">Dhaka</option>
                                <option value="Narayanganj">Narayanganj</option>
                                <option value="Gazipur">Gazipur</option>

                            </select>
                        </td>
                        <td class="table_info">
                            <select name="area" id="area">
                                <option value="">Select Area/Thana</option>
                                <option value="Badda">Badda</option>
                                <option value="Banani">Banani</option>
                                <option value="Vatara">Vatara</option>
                            </select>
                        </td>
                        <td class="table_info">
                            <select name="subarea" id="subarea">
                                <option value="">Select Sub-area</option>
                                <option value="100 Feet Road">100 Feet Road</option>
                                <option value="Bashundhara R/A">Bashundhara R/A</option>
                                <option value="Natun Bazar">Natun Bazar</option>
                                <option value="Nurer Chala">Nurer Chala</option>
                                <option value="Sayeed Nagar">Sayeed Nagar</option>
                            </select>
                        </td>
                        <td><input type="text" name="sector_no" id="sector_no" placeholder="Enter Sector No"></td>
                        <td><input type="text" name="road_no" id="road_no " placeholder="Enter Road No"></td>
                        <td><input type="text" name="house_no" id="house_no" placeholder="Enter House No"></td>
                    </tr>


                    <!-- Add more rows for other items -->
                </tbody>
                <tfoot>
                    <tr>
                        <td><textarea name="location_details" id="location_details" class="short_d" placeholder="Short address / house name" rows="4" cols="80"></textarea></td>
                    </tr>
                </tfoot>


            </table>
        </section>





        <!-- Basic Information----------------------------- -->
        <section id="cart" class="section-p1">
            <table width="100%">
                <div class="cart-header">
                    <i class="fa-solid fa-file-contract"></i>
                    <h4 class="h4">Basic Information</h4>
                </div>
                <thead>
                    <tr>
                        <td>AVAILABLE FROM</td>
                        <td>PROPERTY TYPE</td>
                        <td>BEDROOM</td>
                        <td>BATHROOM</td>
                    </tr>
                </thead>
                <tbody id="cart-items-container">
                    <!-- Dynamically added product items will go here -->
                    <tr>
                        <td class="table_info">
                            <select name="month" id="month">
                                <option value="">Select Month</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="May">May</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </td>
                        <td class="table_info">
                            <select name="property_type" id="property_type">
                                <option value="">House</option>
                                <option value="Unit">Unit</option>
                                <option value="Flat">Flat</option>
                                <option value="Floor">Floor</option>
                                <option value="Appartment">Appartment</option>
                                <option value="Room">Room</option>
                                <option value="Seat">Seat</option>

                            </select>
                        </td>
                        <td class="table_info">
                            <select name="bedroom" id="bedroom">
                                <option value="">Select Bedroom</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>

                            </select>
                        </td>
                        <td class="table_info">
                            <select name="bathroom" id="bathroom">
                                <option value="">Select Bathroom</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>

                            </select>
                        </td>
                    </tr>
                </tbody>

                <thead>
                    <tr>
                        <td>BALCONY</td>
                        <td>FLOOR NO</td>
                        <td>SELECT GENDER</td>
                        <td>SIZE</td>
                    </tr>
                </thead>
                <tbody id="cart-items-container">
                    <!-- Dynamically added product items will go here -->
                    <tr>
                        <td class="table_info">
                            <select name="balcony" id="balcony">
                                <option value="">Select Belcony</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                        </td>
                        <td class="table_info">
                            <select name="floor" id="floor">
                                <option value="">Select Floor</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>

                            </select>
                        </td>
                        <td class="table_info">
                            <select name="gender" id="gender">
                                <option value="">Select Gender</option>
                                <option value="Only Male">Only Male</option>
                                <option value="Only Female">Only Female</option>
                                <option value="Anyone Can Stay">Anyone Can Stay</option>

                            </select>
                        </td>
                        <td>
                            <input name="size" id="size" type="text" name="house_no" placeholder="Size (Sq feet)">
                        </td>
                    </tr>


                    <!-- Add more rows for other items -->
                </tbody>
                <!-- Add more rows for other items -->
            </table>
        </section>


        <!--Uploading Details section--------------------- -->

        <section id="cart" class="section-p1">
            <table width="100%">
                <div class="cart-header">
                    <i class="fa fa-info-circle"></i>
                    <h4 class="h4">Details</h4>
                </div>
                <hr>

                <div class="details-section">

                    <span>Contact details and website link not allowed in this section</span>

                    <div class="editor-toolbar">
                        <button type="button" title="Undo"><i class="fa fa-undo"></i></button>
                        <button type="button" title="Bold"><i class="fa fa-bold"></i></button>
                        <button type="button" title="Italic"><i class="fa fa-italic"></i></button>
                        <button type="button" title="Underline"><i class="fa fa-underline"></i></button>
                    </div>
                    <textarea id="property_details" name="property_details" rows="5" placeholder="Write something about your property!"></textarea>
                </div>
            </table>
        </section>


        <section id="cart" class="section-p1">
            <table width="100%">
                <div class="cart-header">
                    <i class="fa-solid fa-location-dot"></i>
                    <h4 class="h4">Mark in Maps (Optional)</h4>
                </div>
                <hr>

                <div class="mark-maps-section">

                    <span>Please click on the map to mark your exact location</span>

                    <!-- This div will hold the map -->
                    <div id="map"></div>

                    <!-- Hidden inputs to store latitude and longitude -->
                    <input type="hidden" id="latitude" name="latitude" />
                    <input type="hidden" id="longitude" name="longitude" />
                </div>
                <button type="submit" class="submit-property-btn">Confirm Location</button>

            </table>
        </section>

        <!-- Price Giving-------- -->

        <section id="cart" class="section-p1">
            <table width="100%">
                <div class="cart-header">
                    <i class="fa-solid fa-bangladeshi-taka-sign"></i>
                    <h4 class="h4">Price</h4>
                </div>


                <thead>
                    <tr>
                        <td>APPARTMENT PRICE</td>
                        <td>PRICE FOR</td>
                    </tr>
                </thead>

                <tbody id="cart-items-container"></tbody>
                <!-- Dynamically added product items will go here -->
                <tr>
                    <td><input type="text" name="price" id="price" placeholder="Price"></td>
                    <td class="table_info">
                        <select name="price_basis" id="price_basis">
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="monthly">Monthly</option>
                            <option value="yearly">Yearly</option>

                        </select>
                    </td>

                </tr>


                <!-- Add more rows for other items -->
                </tbody>

            </table>
        </section>


        <!-- Price included with---------------------- -->

        <section id="cart" class="section-p1">
            <table width="100%">
                <div class="cart-header">
                    <i class="fa-solid fa-plus"></i>
                    <h4 class="h4">Price Included With</h4>
                </div>
                <hr>

                <div class="form-group checkbox-group">
                    <div>
                        <input type="checkbox" id="electricity" name="facilities[electricity]" value="electricity">
                        <label for="electricity">Electricity bill</label>
                    </div>
                    <div>
                        <input type="checkbox" id="gas" name="facilities[gas]" value="gas">
                        <label for="gas">Gas bill</label>
                    </div>
                    <div>
                        <input type="checkbox" id="water" name="facilities[water]" value="water">
                        <label for="water">Water bill</label>
                    </div>
                    <div>
                        <input type="checkbox" id="lift" name="facilities[lift]" value="lift">
                        <label for="lift">Lift bill</label>
                    </div>
                    <div>
                        <input type="checkbox" id="security" name="facilities[security]" value="security">
                        <label for="security">Security bill</label>
                    </div>
                </div>

            </table>
        </section>

        <!-- Save Property button---------- -->

        <section id="save-property-section" class="section-p1">
            <div class="save-property-container">
                <button name="save-property" id="save-property" type="submit" class="save-property-btn">
                    <i class="fa-solid fa-save"></i> Save Property
                </button>
            </div>
        </section>
    </form>



    <!-- Uploaded Image preview  table section -------------------------------------------->

    <script>
        document.getElementById('upload-photo').addEventListener('change', function(event) {
            const files = event.target.files; // Get all selected files
            const tableBody = document.getElementById('image-preview-body');

            // Loop through each selected file
            Array.from(files).forEach(file => {
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        // Create a new table row for the image
                        const newRow = document.createElement('tr');

                        // Create image cell
                        const imageCell = document.createElement('td');
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.alt = file.name;
                        img.style.width = '100px'; // Set image width
                        imageCell.appendChild(img);

                        // Create file name cell
                        const nameCell = document.createElement('td');
                        nameCell.textContent = file.name;

                        // Create file size cell
                        const sizeCell = document.createElement('td');
                        sizeCell.textContent = (file.size / 1024).toFixed(2) + ' KB';

                        // Append cells to the row
                        newRow.appendChild(imageCell);
                        newRow.appendChild(nameCell);
                        newRow.appendChild(sizeCell);

                        // Append the row to the table body
                        tableBody.appendChild(newRow);
                    };
                    reader.readAsDataURL(file); // Convert the file to a data URL for preview
                }
            });
        });
    </script>







    <!-- Google  Maps API--------------------------------------------------------------- -->


    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Initialize the map centered on Bangladesh (23.6850, 90.3563) with zoom level 7
        var map = L.map('map').setView([23.6850, 90.3563], 7); // Coordinates for Bangladesh

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);

        // Initialize marker variable
        var marker;

        // Add a click event to place a marker
        map.on('click', function(e) {
            if (marker) {
                // Move the existing marker to the clicked location
                marker.setLatLng(e.latlng);
            } else {
                // Create a new marker at the clicked location
                marker = L.marker(e.latlng).addTo(map);
            }

            // Center the map to the marker
            map.setView(e.latlng);

            // Store latitude and longitude in hidden input fields
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;

            console.log("Selected location:", e.latlng.lat, e.latlng.lng); // For debugging
        });

        // Function to handle the form submission via AJAX
        $(document).ready(function() {
            $('.submit-property-btn').on('click', function(e) {
                e.preventDefault(); // Prevent the default form submission behavior

                // Get the latitude and longitude from the hidden input fields
                var latitude = document.getElementById('latitude').value;
                var longitude = document.getElementById('longitude').value;

                // Ensure latitude and longitude are not empty
                if (latitude === '' || longitude === '') {
                    alert('Please mark a location on the map before confirming.');
                    return;
                }

                // Send the data to the server via AJAX
                $.ajax({
                    url: 'saveLocation.php', // Create this PHP file to handle saving location
                    type: 'POST',
                    data: {
                        latitude: latitude,
                        longitude: longitude
                    },
                    success: function(response) {
                        // Handle success response
                        alert('Location saved successfully!');
                        console.log(response); // Log the response for debugging
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        console.log('Error:', error);
                    }
                });
            });
        });
    </script>



</body>

</html>