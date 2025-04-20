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
    <title>Adventure Connection - Shipment Receipt</title>
    <script src="./qrcode.min.js"></script>

    <style>
        :root {
            --adventure-yellow: #FFD700;
            --adventure-blue: #1E90FF;
            --adventure-red: #E63946;
            --adventure-black: #222222;
            --adventure-white: #FFFFFF;
            --adventure-light-gray: #f5f5f5;
            --adventure-gray: #e0e0e0;
            --adventure-dark-gray: #555555;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: var(--adventure-light-gray);
            min-height: 100vh;
            padding: 30px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }
        
        .receipt-container {
            width: 100%;
            max-width: 900px;
            background-color: var(--adventure-white);
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        
        .receipt-header {
            background: linear-gradient(135deg, var(--adventure-blue), #1565C0);
            color: white;
            padding: 25px;
            position: relative;
        }
        
        .receipt-title {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .receipt-title-icon {
            font-size: 24px;
        }
        
        .receipt-subtitle {
            font-size: 16px;
            opacity: 0.9;
        }
        
        .receipt-actions {
            position: absolute;
            top: 25px;
            right: 25px;
            display: flex;
            gap: 15px;
        }
        
        .action-btn {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 6px;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .action-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
        }
        
        .print-btn {
            background-color: var(--adventure-yellow);
            color: var(--adventure-black);
        }
        
        .print-btn:hover {
            background-color: #e6c200;
        }
        
        .receipt-body {
            padding: 0;
        }
        
        .tabs {
            display: flex;
            border-bottom: 1px solid var(--adventure-gray);
        }
        
        .tab {
            padding: 15px 25px;
            font-weight: 600;
            color: var(--adventure-dark-gray);
            cursor: pointer;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .tab.active {
            color: var(--adventure-blue);
        }
        
        .tab.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--adventure-blue);
        }
        
        .tab:hover:not(.active) {
            background-color: rgba(0,0,0,0.02);
        }
        
        .receipt-content {
            padding: 25px;
        }
        
        .section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--adventure-black);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .section-icon {
            color: var(--adventure-blue);
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .info-item {
            margin-bottom: 15px;
        }
        
        .info-label {
            font-size: 14px;
            color: var(--adventure-dark-gray);
            margin-bottom: 5px;
        }
        
        .info-value {
            font-size: 16px;
            font-weight: 500;
            color: var(--adventure-black);
        }
        
        .editable-value {
            border: 1px solid transparent;
            padding: 5px 10px;
            border-radius: 4px;
            transition: all 0.2s ease;
            cursor: text;
        }
        
        .editable-value:hover {
            border-color: var(--adventure-gray);
            background-color: var(--adventure-light-gray);
        }
        
        .editable-value:focus {
            border-color: var(--adventure-blue);
            outline: none;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(30, 144, 255, 0.2);
        }
        
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .status-delivered {
            background-color: #e6f7ed;
            color: #0a8043;
        }
        
        .status-transit {
            background-color: #e6f1ff;
            color: #1a73e8;
        }
        
        .status-processing {
            background-color: #fef2e0;
            color: #f59e0b;
        }
        
        .timeline {
            margin: 30px 0;
            position: relative;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 24px;
            height: 100%;
            width: 2px;
            background-color: var(--adventure-gray);
        }
        
        .timeline-item {
            display: flex;
            margin-bottom: 20px;
            position: relative;
        }
        
        .timeline-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: white;
            border: 2px solid var(--adventure-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            position: relative;
            z-index: 2;
        }
        
        .timeline-icon.completed {
            background-color: var(--adventure-blue);
            color: white;
        }
        
        .timeline-content {
            flex: 1;
            background-color: white;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        .timeline-title {
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 5px;
        }
        
        .timeline-date {
            font-size: 14px;
            color: var(--adventure-dark-gray);
            margin-bottom: 10px;
        }
        
        .timeline-description {
            font-size: 14px;
            color: #444;
        }
        
        .payment-details {
            background-color: var(--adventure-light-gray);
            border-radius: 8px;
            padding: 20px;
        }
        
        .price-breakdown {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        
        .price-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed var(--adventure-gray);
        }
        
        .price-row:last-child {
            border-bottom: none;
        }
        
        .price-row.total {
            margin-top: 10px;
            border-top: 2px solid var(--adventure-gray);
            border-bottom: none;
            padding-top: 15px;
            font-weight: 700;
            font-size: 18px;
        }
        
        .payment-method {
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .payment-icon {
            font-size: 24px;
            color: var(--adventure-dark-gray);
        }
        
        .payment-info {
            font-size: 15px;
        }
        
        .divider {
            height: 1px;
            background-color: var(--adventure-gray);
            margin: 30px 0;
        }
        
        .package-details {
            display: flex;
            gap: 30px;
            margin-bottom: 20px;
        }
        
        .package-image {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            background-color: var(--adventure-light-gray);
        }
        
        .package-info {
            flex: 1;
        }
        
        .barcode-section {
            margin: 30px 0;
            text-align: center;
        }
        
        .barcode {
            height: 70px;
            margin-bottom: 10px;
        }
        
        .barcode-number {
            font-size: 16px;
            font-weight: 600;
            color: var(--adventure-black);
            letter-spacing: 2px;
        }
        
        .receipt-footer {
            padding: 20px 25px;
            background-color: #f8f9fa;
            text-align: center;
            border-top: 1px solid var(--adventure-gray);
            color: var(--adventure-dark-gray);
        }
        
        .footer-logo {
            height: 40px;
            margin-bottom: 15px;
        }
        
        .footer-text {
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .support-info {
            font-size: 14px;
            margin-top: 15px;
        }
        
        .edit-mode-toggle {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: var(--adventure-blue);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 100;
        }
        
        .edit-mode-toggle:hover {
            transform: scale(1.05);
            background-color: #1976D2;
        }
        
        .qr-code {
            width: 100px;
            height: 100px;
            background-color: var(--adventure-light-gray);
            margin-bottom: 10px;
        }
        
        .contact-methods {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 15px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
        }
        
        .map-container {
            height: 200px;
            background-color: var(--adventure-light-gray);
            border-radius: 8px;
            margin-top: 20px;
            position: relative;
            overflow: hidden;
        }
        
        .map-placeholder {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .receipt-nav {
            background-color: var(--adventure-white);
            padding: 15px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
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
        
        @media print {
            body {
                background-color: white;
                padding: 0;
            }
            
            .receipt-container {
                box-shadow: none;
                max-width: 100%;
            }
            
            .receipt-actions, .edit-mode-toggle, .tab:not(.active) {
                display: none;
            }
            
            .editable-value {
                border: none;
                padding: 0;
            }
            
            .editable-value:hover {
                background-color: transparent;
                border-color: transparent;
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding: 0;
            }
            
            .receipt-container {
                border-radius: 0;
            }
            
            .package-details {
                flex-direction: column;
            }
            
            .package-image {
                width: 100%;
                height: 200px;
            }
            
            .receipt-actions {
                position: static;
                margin-top: 20px;
            }
            
            .receipt-header {
                text-align: center;
                padding: 20px;
            }
            
            .tabs {
                overflow-x: auto;
                white-space: nowrap;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
        }
        #qrcode {
            position:sticky;
            margin-left: 110%;
        }
        a{
            text-decoration : none;
        }
    </style>
</head>
<body>

    <div class="receipt-container">
        <div class="receipt-nav">
            <a href="../shipments.php" class="back-link">
                &#8592; Back to Shipments
            </a>
            <div><?php echo $row['track_id'] ?></div>
        </div>
        
        <div class="receipt-header">
            <h1 class="receipt-title">
                <span class="receipt-title-icon">&#128230;</span>
                Shipment Receipt
            </h1>
            <p class="receipt-subtitle">Created on <?php echo $row['created_at'] ?> • Last updated <?php echo $row['updated_at'] ?></p>
            
            <div class="receipt-actions">
                <a href="./edit.php?id=<?php echo $id; ?>"><button class="action-btn">
                    <span>&#9998;</span>
                    <span>Edit</span>
                </button></a>
                <form action="" method="post">
                <button class="action-btn" name="email">
                    <span>&#128233;</span>
                    <span>Email</span>
                </button>
                </form>
                <a href="./print.php?id=<?php echo $id; ?>"><button class="action-btn print-btn">
                    <span>&#128424;</span>
                    <span>Print</span>
                </button></a>
            </div>
        </div>
        
        <div class="receipt-body">
            <div class="tabs">
                <div class="tab active">Receipt</div>
                <div class="tab">Tracking</div>
                <div class="tab">History</div>
                <div class="tab">Notes</div>
            </div>
            
            <div class="receipt-content">
                <div class="section">
                    <h2 class="section-title">
                        <span class="section-icon">&#128462;</span>
                        Shipment Information
                    </h2>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Tracking Number</div>
                            <div class="info-value"><?php echo $row['track_id'] ?></div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Status</div>
                            <div class="info-value">
                                <span class="status-badge status-transit"><?php echo $row['ship_status'] ?></span>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Estimated Delivery</div>
                            <div class="info-value editable-value" contenteditable="true"><?php echo $row['expected_delivery_date'] ?></div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Service Type</div>
                            <div class="info-value editable-value" contenteditable="true"><?php echo $row['service_level'] ?></div>
                        </div>
                       
                    <div id="qrcode"></div>
                
                    </div>
                </div>
                
                <div class="section">
                    <h2 class="section-title">
                        <span class="section-icon">&#128205;</span>
                        Origin & Destination
                    </h2>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-label">Sender</div>
                            <div class="info-value editable-value" contenteditable="true"><?php echo $row['sender_name'] ?></div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Recipient</div>
                            <div class="info-value editable-value" contenteditable="true"><?php echo $row['receiver_name'] ?></div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Origin Address</div>
                            <div class="info-value editable-value" contenteditable="true"><?php echo $row['pickup_address'] ?></div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Destination Address</div>
                            <div class="info-value editable-value" contenteditable="true"><?php echo $row['delivery_address'] ?></div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Contact Email</div>
                            <div class="info-value editable-value" contenteditable="true"><?php echo $row['receiver_email'] ?></div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-label">Contact Phone</div>
                            <div class="info-value editable-value" contenteditable="true"><?php echo $row['receiver_phone_number'] ?></div>
                        </div>
                    </div>
                    
                    
                </div>
                
                <div class="section">
                    <h2 class="section-title">
                        <span class="section-icon">&#128230;</span>
                        Package Details
                    </h2>
                    
                    <div class="package-details">
                        <img src="/api/placeholder/120/120" alt="Package" class="package-image">
                        <div class="package-info">
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-label">Package Type</div>
                                    <div class="info-value editable-value" contenteditable="true"><?php echo $row['package_type'] ?></div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-label">Weight</div>
                                    <div class="info-value editable-value" contenteditable="true"><?php echo $row['weight'] ?> kg</div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-label">Dimensions</div>
                                    <div class="info-value editable-value" contenteditable="true"><?php echo $row['length'] ?> × <?php echo $row['width'] ?> × <?php echo $row['height'] ?></div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-label">Items Declared</div>
                                    <div class="info-value editable-value" contenteditable="true"><?php echo $row['content'] ?></div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-label">Special Instructions</div>
                                    <div class="info-value editable-value" contenteditable="true"><?php echo $row['instructions'] ?></div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-label">Item value</div>
                                    <div class="info-value editable-value" contenteditable="true"><?php echo $row['value'] ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="barcode-section">
                    <img src="/api/placeholder/300/70" alt="Barcode" class="barcode">
                    <div class="barcode-number"><?php echo $row['track_id'] ?></div>
                </div>
                                
                <div class="divider"></div>
                
                <div class="section">
                    <h2 class="section-title">
                        <span class="section-icon">&#128176;</span>
                        Payment Information
                    </h2>
                    
                    <div class="payment-details">
                        <div class="price-breakdown">
                            <div class="price-row">
                                <div>Base Shipping Fee</div>
                                <div>TZS <?php echo $row['transport_cost']; ?></div>
                            </div>
                            
                            <div class="price-row total">
                                <div>Total</div>
                                <div>TZS <?php echo $row['transport_cost']; ?></div>
                            </div>
                        </div>
                        
                        <!-- <div class="payment-method">
                            <div class="payment-icon">💳</div>
                            <div class="payment-info">
                                Payment Method: Credit Card (•••• 5678)<br>
                                Payment Status: <strong>Paid</strong> on April 15, 2025
                            </div>
                        </div> -->
                    </div>
                </div>
                
                <div class="section">
                    <h2 class="section-title">
                        <span class="section-icon">&#128668;</span>
                        Delivery Updates
                    </h2>
                    
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon completed">✓</div>
                            <div class="timeline-content">
                                <div class="timeline-title">Package Received</div>
                                <div class="timeline-date"><?php echo $row['created_at'] ?></div>
                                <div class="timeline-description">Package admitted at Adventure Connection <?php echo $row['pickup_address']; ?> Office</div>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-icon completed">✓</div>
                            <div class="timeline-content">
                                <div class="timeline-title">Package Processed</div>
                                <div class="timeline-date"><?php echo $row['updated_at'] ?></div>
                                <div class="timeline-description">Package sorted and prepared for delivery.</div>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-icon completed">✓</div>
                            <div class="timeline-content">
                                <div class="timeline-title">Transit status</div>
                                <div class="timeline-date"><?php echo date('Y-m-d H:i:s'); ?></div>
                                <div class="timeline-description">Package is on the way with Adventure Truck (<?php echo $row['vehicle'] ?>).</div>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-icon">⌛</div>
                            <div class="timeline-content">
                                <div class="timeline-title">Expected Delivery</div>
                                <div class="timeline-date"><?php echo $row['expected_delivery_date'] ?></div>
                                <div class="timeline-description">Package will be delivered to <?php echo $row['delivery_address'] ?>.</div>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-icon">📦</div>
                            <div class="timeline-content">
                                <div class="timeline-title">Acquisition</div>
                                <div class="timeline-date"><?php echo date('Y-m-d H:i:s'); ?></div>
                                <div class="timeline-description">Package taken by <?php echo $row['receiver_name'] ?>.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="receipt-footer">
                <img src="/api/placeholder/200/40" alt="Adventure Connection Logo" class="footer-logo">
                <div class="footer-text">
                    Thank you for choosing Adventure Connection for your delivery needs!
                </div>
                <div class="footer-text">
                    Track your shipment anytime at <strong>http://localhost/adventurepts/</strong>
                </div>
                
                <div class="contact-methods">
                    <div class="contact-item">
                        <span>📞</span>
                        <span>+255785817222</span>
                    </div>
                    <div class="contact-item">
                        <span>✉️</span>
                        <span>karimxhaban@gmail.com</span>
                    </div>
                </div>
                
                <div class="support-info">
                    For support, quote shipment Track ID (<?php echo $row['track_id'] ?>)
                </div>
            </div>
        </div>
    </div>
    
    <div class="edit-mode-toggle">✏️</div>

<script>
        new QRCode(document.getElementById("qrcode"), {
            text: "<?php echo 'http://192.168.68.132/adventurepts/pages/qrcode.php?id='.$row['track_id']; ?>",
            width: 150,
            height: 150,
        });

        /* document.getElementById('print').addEventListener("click", ()=>{
            window.print();
        }); */
</script>



<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require '../vendor/autoload.php';

    if(isset($_POST['email'])){

            

            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';   // SMTP server
                $mail->SMTPAuth   = true;
                $mail->Username   = 'karimxhaban@gmail.com';   // SMTP username
                $mail->Password   = 'szua wsjf txyo kpmd ';       // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Recipients
                $mail->setFrom('k-tronics@gmail.com', 'ADVENTURE CONNECTION');
                $mail->addAddress($row['sender_email'], $row['sender_name']);
                $mail->addAddress($row['receiver_email'], $row['receiver_name']);

                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Percel notification service';
                $mail->Body    =    "PERCEL DETAILS : <br>
                                        TRACK ID :  ".$row['track_id']."<br>
                                        SENDER :    ".$row['sender_name']."<br>
                                        RECEIVER :  ".$row['receiver_name']."<br>
                                        ORIGIN :    ".$row['pickup_address']."<br>
                                        DESTINATION : ".$row['delivery_address']."<br>
                                        VALUE :     ".$row['value']."<br>
                                        TRANSPORT COST :    ".$row['transport_cost']."<br>
                                        SENT ON :    ".$row['pickup_date']."<br>
                                        EXPECTED DELIVERY : ".$row['expected_delivery_date']."
                                    ";
                $mail->AltBody = 'This is official email from Adventure connection';
                //$mail->addAttachment('/home/karim/Downloads/GA.pdf');
                //for($i=0; $i<=2; $i++){
                $mail->send();
                //echo 'Message has been sent'.$i;
                
            } catch (Exception $e) {
                echo "Message failed. Mailer Error: {$mail->ErrorInfo}";
            }


    }
?>