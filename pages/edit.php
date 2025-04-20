<?php
    $id = $_GET['id'];

    include '../includes/connection.php';
    
    $sql = "SELECT * FROM percels WHERE track_id='$id'";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure Connection - New Shipment</title>
    <style>
        :root {
            --adventure-yellow: #FFD700;
            --adventure-blue: #1E90FF;
            --adventure-red: #E63946;
            --adventure-black: #222222;
            --adventure-white: #FFFFFF;
            --light-gray: #f5f5f5;
            --medium-gray: #e0e0e0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--light-gray);
            min-height: 100vh;
        }
        
        .header {
            background-color: var(--adventure-white);
            color: var(--adventure-white);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .logo-container {
            display: flex;
            align-items: center;
        }
        
        .logo {
            height: 50px;
            margin-right: 15px;
        }
        
        .company-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--adventure-yellow);
        }
        
        .user-nav {
            display: flex;
            align-items: center;
        }
        
        .user-icon {
            width: 40px;
            height: 40px;
            background-color: var(--adventure-blue);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-weight: bold;
            margin-left: 10px;
        }
        
        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }
        
        .page-title {
            font-size: 2rem;
            color: var(--adventure-black);
            margin-bottom: 5px;
        }
        
        .accent-line {
            height: 5px;
            background: linear-gradient(to right, var(--adventure-yellow), var(--adventure-red));
            width: 50px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .shipment-form {
            background-color: var(--adventure-white);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
        }
        
        .form-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 1.2rem;
            color: var(--adventure-blue);
            margin-bottom: 15px;
            font-weight: 600;
            display: flex;
            align-items: center;
        }
        
        .section-title::before {
            content: "";
            display: inline-block;
            width: 18px;
            height: 18px;
            background-color: var(--adventure-blue);
            border-radius: 50%;
            margin-right: 10px;
        }
        
        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .form-group {
            flex: 1;
            min-width: 250px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--adventure-black);
            font-weight: 500;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 2px solid var(--medium-gray);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--adventure-blue);
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 144, 255, 0.2);
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .required::after {
            content: "*";
            color: var(--adventure-red);
            margin-left: 3px;
        }
        
        .package-details {
            background-color: rgba(30, 144, 255, 0.05);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
        }
        
        .package-number {
            position: absolute;
            top: -15px;
            left: 20px;
            background-color: var(--adventure-yellow);
            color: var(--adventure-black);
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: bold;
        }
        
        .add-package {
            background-color: transparent;
            color: var(--adventure-blue);
            border: 2px dashed var(--adventure-blue);
            padding: 15px;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s;
            margin-bottom: 30px;
        }
        
        .add-package:hover {
            background-color: rgba(30, 144, 255, 0.1);
        }
        
        .add-package-icon {
            margin-right: 10px;
            font-size: 1.5rem;
        }
        
        .action-buttons {
            display: flex;
            justify-content: space-between;
            gap: 20px;
        }
        
        .btn {
            padding: 14px 25px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--adventure-blue);
            color: white;
            box-shadow: 0 5px 15px rgba(30, 144, 255, 0.3);
        }
        
        .btn-primary:hover {
            background-color: var(--adventure-red);
            box-shadow: 0 5px 15px rgba(230, 57, 70, 0.3);
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background-color: transparent;
            color: var(--adventure-black);
            border: 2px solid var(--medium-gray);
        }
        
        .btn-secondary:hover {
            border-color: var(--adventure-black);
            background-color: rgba(0, 0, 0, 0.05);
        }
        
        .cost-summary {
            background-color: var(--adventure-black);
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-top: 30px;
        }
        
        .summary-title {
            font-size: 1.2rem;
            margin-bottom: 15px;
            color: var(--adventure-yellow);
        }
        
        .cost-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .cost-total {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            font-weight: bold;
            font-size: 1.1rem;
        }
        
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 15px;
            }
            
            .form-group {
                min-width: 100%;
            }
            
            .action-buttons {
                flex-direction: column;
            }
            
            .header {
                flex-direction: column;
                padding: 15px;
                text-align: center;
            }
            
            .logo-container {
                margin-bottom: 10px;
            }
        }
        
        .back-link {
            color: var(--adventure-dark-gray);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .back-link:hover {
            color: var(--adventure-blue);
        }
    </style>
</head>
<body>
   <div class="container">
   <div class="receipt-nav">
            <a href="../shipments.php" class="back-link">
                &#8592; Back to Shipments
            </a>
        </div>
        <h1 class="page-title">Edit Shipment</h1>
        <div class="accent-line"></div>
        <form class="shipment-form" action="" method="POST">
            <div class="form-section">
                <h2 class="section-title">Shipment Information</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label class="required" for="shipment-type">Shipment Type</label>
                        <select id="shipment-type" name="ship_type">
                            <option value="<?php echo $row['ship_type']; ?>" disabled selected><?php echo $row['ship_type']; ?></option>
                            <option value="standard">Standard Delivery</option>
                            <option value="express">Express Delivery</option>
                            <option value="adventure">Adventure Package</option>
                            <option value="extreme">Extreme Terrain Delivery</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="required" for="service-level">Service Level</label>
                        <select id="service-level" name="service_level">
                            <option value="<?php echo $row['service_level']; ?>" disabled selected><?php echo $row['service_level']; ?></option>
                            <option value="regular">Regular</option>
                            <option value="priority">Priority</option>
                            <option value="urgent">Urgent</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tracking-id">Tracking ID</label>
                        <input type="text" id="tracking-id" readonly placeholder="Auto-generated after submission" name="track_id" value="<?php echo $row['track_id']; ?>" disabled>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="required" for="pickup-date">Pickup Date</label>
                        <input type="date" id="pickup-date" name="pickup_date" value="<?php echo $row['pickup_date']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="required" for="delivery-date">Expected Delivery Date</label>
                        <input type="date" id="delivery-date" name="expected_delivery_date" value="<?php echo $row['expected_delivery_date']; ?>">
                    </div>
                </div>
            </div>
            
            <div class="form-section">
                <h2 class="section-title">Origin Information</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label class="required" for="sender-name">Sender Name</label>
                        <input type="text" id="sender-name" placeholder="Enter full name" name="sender_name" value="<?php echo $row['sender_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="required" for="sender-phone">Phone Number</label>
                        <input type="tel" id="sender-phone" placeholder="Enter phone number" name="sender_phone_number" value="<?php echo $row['sender_phone_number']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="sender-email">Email Address</label>
                        <input type="email" id="sender-email" placeholder="Enter email address" name="sender_email" value="<?php echo $row['sender_email']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="required" for="pickup-address">Pickup Address</label>
                        <input type="text" id="pickup-address" placeholder="Street address" name="pickup_address" value="<?php echo $row['pickup_address']; ?>">
                    </div>
                </div>
            </div>
            
            <div class="form-section">
                <h2 class="section-title">Destination Information</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label class="required" for="recipient-name">Recipient Name</label>
                        <input type="text" id="recipient-name" placeholder="Enter full name" name="receiver_name" value="<?php echo $row['receiver_name']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="required" for="recipient-phone">Phone Number</label>
                        <input type="tel" id="recipient-phone" placeholder="Enter phone number" name="receiver_phone_number" value="<?php echo $row['receiver_phone_number']; ?>">
                    </div>
                    <div class="form-group">
                        <label for="recipient-email">Email Address</label>
                        <input type="email" id="recipient-email" placeholder="Enter email address" name="receiver_email" value="<?php echo $row['receiver_email']; ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="required" for="delivery-address">Delivery Address</label>
                        <input type="text" id="delivery-address" placeholder="Street address" name="delivery_address" value="<?php echo $row['delivery_address']; ?>">
                    </div>
                </div>
                
            </div>
            
            <div class="form-section">
                <h2 class="section-title">Package Details</h2>
                
                <div class="package-details">
                    <div class="package-number">Package #1</div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="required" for="package-type">Package Type</label>
                            <select id="package-type" name="package_type">
                                <option value="<?php echo $row['package_type']; ?>" disabled selected><?php echo $row['package_type']; ?></option>
                                <option value="box">Box</option>
                                <option value="envelope">Envelope</option>
                                <option value="pallet">Pallet</option>
                                <option value="tube">Tube</option>
                                <option value="custom">Custom</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="required" for="weight">Weight (kg)</label>
                            <input type="number" id="weight" placeholder="Enter weight" min="0" step="0.1" name="weight" value="<?php echo $row['weight']; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="required" for="length">Length (cm)</label>
                            <input type="number" id="length" placeholder="Enter length" min="0" name="length" value="<?php echo $row['length']; ?>">
                        </div>
                        <div class="form-group">
                            <label class="required" for="width">Width (cm)</label>
                            <input type="number" id="width" placeholder="Enter width" min="0" name="width" value="<?php echo $row['width']; ?>">
                        </div>
                        <div class="form-group">
                            <label class="required" for="height">Height (cm)</label>
                            <input type="number" id="height" placeholder="Enter height" min="0" name="height" value="<?php echo $row['height']; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="contents">Package Contents</label>
                            <input type="text" id="contents" placeholder="Enter package contents" name="content" value="<?php echo $row['content']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="declared-value">Declared Value (TZS)</label>
                            <input type="number" id="declared-value" placeholder="Enter value" min="0" step="0.01" name="value" value="<?php echo $row['value']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="declared-value">Transport Cost (TZS)</label>
                            <input type="number" id="declared-value" placeholder="Enter value" min="0" step="0.01" name="transport_cost">
                        </div>
                        <?php
                            $sql2 = "SELECT * FROM vehicles";
                            $result2 = $conn->query($sql2);
                            //$vehicle = mysqli_fetch_assoc($result2);
                        ?>
                        <div class="form-group">
                            <label for="vehicle">Vehicle</label>
                            <select name="vehicle" id="">
                                <option value="<?php echo $row['vehicle']; ?>"><?php echo $row['vehicle']; ?></option>
                                <?php 
                                    while($vehicle = mysqli_fetch_assoc($result2)){
                                        echo '<option value='.$vehicle['plate_number'].'>'.$vehicle['plate_number'].'</option>';
                                    }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="declared-value">Shipping Status</label>
                            <input type="text" id="declared-value" placeholder="Enter value" min="0" step="0.01" name="status">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="special-instructions">Special Handling Instructions</label>
                            <textarea id="special-instructions" placeholder="Enter any special handling instructions..." name="instructions" value="<?php echo $row['instructions']; ?>"><?php echo $row['instructions']; ?></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="add-package">
                    <span class="add-package-icon">+</span> Add Another Package
                </div>
            </div>
            
           <!--  <div class="form-section">
                <h2 class="section-title">Additional Services</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="insurance">Insurance</label>
                        <select id="insurance">
                            <option value="none">None</option>
                            <option value="basic">Basic Coverage</option>
                            <option value="premium">Premium Coverage</option>
                            <option value="adventure">Adventure Protection</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="signature">Signature Required</label>
                        <select id="signature">
                            <option value="none">No Signature</option>
                            <option value="standard">Standard Signature</option>
                            <option value="adult">Adult Signature</option>
                        </select>
                    </div>
                </div>
            </div> -->
            
            <div class="cost-summary">
                <h3 class="summary-title">Cost Summary</h3>
                <div class="cost-item">
                    <span>Base Shipping Cost</span>
                    <span>TZS 0.00</span>
                </div>
                <div class="cost-item">
                    <span>Additional Services</span>
                    <span>TZS 0.00</span>
                </div>
                <div class="cost-item">
                    <span>Insurance</span>
                    <span>TZS 0.00</span>
                </div>
                <div class="cost-item">
                    <span>Taxes & Fees</span>
                    <span>TZS 0.00</span>
                </div>
                <div class="cost-total">
                    <span>Estimated Total</span>
                    <span>TZS 0.00</span>
                </div>
            </div>
            
            <div class="action-buttons">
                <button type="button" class="btn btn-secondary">Save as Draft</button>
                <button type="submit" class="btn btn-primary" name='update'>Update Shipment</button>
            </div>
        </form>
    </div>

    <?php
       //require 'includes/connection.php';
       
       if(isset($_POST['update'])){
            $ship_type = $_POST['ship_type'];
            $service_level = $_POST['service_level'];
            $track_id = 'ADV-'.date('YmdHis');
            $pickup_date = $_POST['pickup_date'];
            $expected_delivery_date = $_POST['expected_delivery_date']            ;
            $sender_name = $_POST['sender_name'];
            $sender_phone_number = $_POST['sender_phone_number'];
            $sender_email = $_POST['sender_email'];
            $pickup_address = $_POST['pickup_address'];
            $receiver_name = $_POST['receiver_name'];
            $receiver_phone_number = $_POST['receiver_phone_number'];
            $receiver_email = $_POST['receiver_email'];
            $delivery_address = $_POST['delivery_address'];
            $package_type = $_POST['package_type'];
            $weight = $_POST['weight'];
            $length = $_POST['length'];
            $width = $_POST['width'];
            $height = $_POST['height'];
            $content = $_POST['content'];
            $value = $_POST['value'];
            $instructions = $_POST['instructions'];
            $ship_status = "not shipped";
            $delivery_status = "not delivered";
            $created_at = date('Y-m-d H:i:s');
            $processed_by ="admin";
            $transport_cost = $_POST['transport_cost'];
            $vehicle = $_POST['vehicle'];
            $updated_at = date('Y-m-d H:i:s');
            $updated_by = "admin";

            $sql = "UPDATE percels SET 
                    ship_type='$ship_type',
                    service_level='$service_level',
                    pickup_date='$pickup_date',
                    expected_delivery_date='$expected_delivery_date',
                    sender_name='$sender_name',
                    sender_email='$sender_email',
                    sender_phone_number='$sender_phone_number',
                    pickup_address='$pickup_address',
                    receiver_name='$receiver_name',
                    receiver_email='$receiver_email',
                    receiver_phone_number='$receiver_phone_number',
                    delivery_address='$delivery_address',
                    package_type = '$package_type',
                    `weight` = '$weight',
                    `length` = '$length',
                    `width` = '$width',
                    `height` = '$height',
                    `content` = '$content',
                    `value` = '$value',
                    `instructions` = '$instructions',
                    updated_at = '$updated_at',
                    updated_by = 'admin',
                    transport_cost = '$transport_cost',
                    vehicle = '$vehicle'
                    WHERE track_id = '$id'";
            if($conn->query($sql)){
                echo 'data updated at '.$id;
            } else {
                echo 'something went wrong';
            }
       }
    ?>