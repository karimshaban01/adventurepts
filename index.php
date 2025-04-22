<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure Connection - Track Parcels</title>
    <style>
        :root {
            --adventure-yellow: #FFD700;
            --adventure-blue: #1E90FF;
            --adventure-red: #E63946;
            --adventure-black: #222222;
            --adventure-white: #FFFFFF;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
            min-height: 100vh;
            background-image: linear-gradient(to bottom right, rgba(30, 144, 255, 0.1), rgba(230, 57, 70, 0.1));
        }

        header {
            background-color: var(--adventure-white);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .logo {
            height: 50px;
        }

        .nav-links {
            display: flex;
            gap: 25px;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--adventure-black);
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: var(--adventure-blue);
        }



        .user-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }

        .profile-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--adventure-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }
        
        main {
            max-width: 1200px;
            margin: 40px auto;
            padding: 0 20px;
        }
        
        .page-title {
            margin-bottom: 30px;
            color: var(--adventure-black);
        }

        .accent-line {
            height: 5px;
            background: linear-gradient(to right, var(--adventure-yellow), var(--adventure-red));
            width: 50px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        
        .tracking-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .tracking-header {
            background-color: var(--adventure-blue);
            padding: 25px;
            color: white;
        }
        
        .tracking-header h2 {
            margin-bottom: 20px;
        }
        
        .tracking-form {
            display: flex;
            gap: 15px;
        }
        
        .tracking-input {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
        }
        
        .tracking-input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3);
        }
        
        .btn-track {
            background-color: var(--adventure-yellow);
            color: var(--adventure-black);
            border: none;
            padding: 0 25px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .btn-track:hover {
            background-color: #e5c100;
            transform: translateY(-2px);
        }
        
        .tracking-body {
            padding: 30px;
        }
        
        .recent-tracks {
            margin-bottom: 40px;
        }
        
        .recent-tracks h3 {
            margin-bottom: 15px;
            color: var(--adventure-black);
        }
        
        .track-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
        
        .track-card {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            transition: all 0.3s ease;
            border-left: 4px solid var(--adventure-blue);
        }
        
        .track-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .track-id {
            font-weight: bold;
            color: var(--adventure-blue);
            margin-bottom: 10px;
        }
        
        .track-details {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 15px;
        }
        
        .track-status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-transit {
            background-color: #e8f4fd;
            color: var(--adventure-blue);
        }
        
        .status-delivered {
            background-color: #e6f7e6;
            color: #28a745;
        }
        
        .status-pending {
            background-color: #fff8e6;
            color: #ffc107;
        }
        
        .tracking-results {
            display: none;
            margin-top: 30px;
        }
        
        .result-visible {
            display: block;
        }
        
        .parcel-info {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .parcel-detail {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
            flex: 1;
            min-width: 250px;
        }
        
        .parcel-detail h4 {
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 10px;
        }
        
        .parcel-detail p {
            color: var(--adventure-black);
            font-weight: 500;
        }
        
        .timeline {
            position: relative;
            margin-top: 50px;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 0;
            bottom: 0;
            width: 3px;
            background-color: #e0e0e0;
        }
        
        .timeline-item {
            position: relative;
            padding-left: 60px;
            padding-bottom: 30px;
        }
        
        .timeline-dot {
            position: absolute;
            left: 12px;
            top: 0;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background-color: white;
            border: 3px solid var(--adventure-blue);
            z-index: 1;
        }
        
        .timeline-content {
            background-color: #f9f9f9;
            border-radius: 10px;
            padding: 20px;
        }
        
        .timeline-date {
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .timeline-title {
            font-weight: 600;
            margin-bottom: 10px;
            color: var(--adventure-black);
        }
        
        .timeline-desc {
            color: #555;
        }
        
        
        .completed-dot {
            background-color: var(--adventure-blue);
            border-color: var(--adventure-blue);
        }
        
        .pending-dot {
            border-color: #e0e0e0;
        }

        .login-button {            
            position: absolute;
            height : 6%;
            top :8%;
            right: 18%;
        }
        
        @media (max-width: 768px) {
            .tracking-form {
                flex-direction: column;
            }
            
            .parcel-info {
                flex-direction: column;
            }
            
            .nav-links {
                display: none;
            }
            
            .timeline::before {
                left: 15px;
            }
            
            .timeline-item {
                padding-left: 50px;
            }
            
            .timeline-dot {
                left: 7px;
                width: 16px;
                height: 16px;
            }
        }
    </style>
</head>
<body>
    
    <main>
        <div class="accent-line"></div>
        <h1 class="page-title">Track With Adventure</h1>
        <a href="./pages/login.php"><button class="login-button btn-track">Staff login</button></a>
        <div class="tracking-container">
        <form action="" method="post">
            <div class="tracking-header">
                <h2>Track Your Parcel</h2>
                <div class="tracking-form">
                    <input type="text" class="tracking-input" placeholder="Enter tracking number or reference ID" name="q">
                    <button class="btn-track" name='find'>Track Now</button>
                </div>
            </div>
        </form>

        <?php
            include 'includes/connection.php';
            if(isset($_POST['find'])){
                $q = $_POST['q'];
            
                $sql = "SELECT * FROM percels WHERE track_id='$q'";
                $result = $conn->query($sql);

                $row = mysqli_fetch_assoc($result);
                $date = date('Y-m-d H:i:s');
                echo '
                
                <div class="tracking-body">
                                
                <div class="tracking-results result-visible">
                    <h3>Tracking Results: '.$row['track_id'].'</h3>
                    
                    <div class="parcel-info">
                        <div class="parcel-detail">
                            <h4>FROM</h4>
                            <p>'.$row['pickup_address'].'</p>
                            <p>'.$row['sender_name'].'</p>
                            <p>'.$row['sender_phone_number'].'</p>
                        </div>
                        
                        <div class="parcel-detail">
                            <h4>TO</h4>
                            <p>'.$row['delivery_address'].'</p>
                            <p>'.$row['receiver_name'].'</p>
                            <p>'.$row['receiver_phone_number'].'</p>
                        </div>
                        
                        <div class="parcel-detail">
                            <h4>SERVICE</h4>
                            <p>'.$row['service_level'].'</p>
                            <p>Picked On: '.$row['pickup_date'].'</p>
                            <p>Est. Delivery: '.$row['expected_delivery_date'].'</p>
                        </div>
                        
                        <div class="parcel-detail">
                            <h4>WEIGHT</h4>
                            <p>'.$row['weight'].'</p>
                            <p>'.$row['instructions'].'</p>
                        </div>
                    </div>
                    
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-dot active-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-date">'.$date.'</div>
                                <h4 class="timeline-title">Acquisition status '.$row['delivery_status'].'</h4>
                                <p class="timeline-desc">Current package Acquisition status.</p>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-dot completed-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-date">'.$date.'</div>
                                <h4 class="timeline-title">Shipping status '.$row['ship_status'].'</h4>
                                <p class="timeline-desc">Current package shipping status.</p>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-dot completed-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-date">'.$row['expected_delivery_date'].' (Estimated)</div>
                                <h4 class="timeline-title">Package estimated to Arrive at '.$row['delivery_address'].'</h4>
                                <p class="timeline-desc">Receiver will be notified upon Arrival.</p>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-dot completed-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-date">'.$row['pickup_date'].'</div>
                                <h4 class="timeline-title">Package was processed by '.$row['processed_by'].'</h4>
                                <p class="timeline-desc">Package was received and processed by indicated staff at '.$row['created_at'].'.</p>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-dot pending-dot"></div>
                            <div class="timeline-content">
                                <div class="timeline-date">'.$row['pickup_date'].'</div>
                                <h4 class="timeline-title">Admitted at '.$row['pickup_address'].' office by '.$row['sender_name'].'</h4>
                                <p class="timeline-desc">Package admitted at the day indicated above.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                ';
                

            }
        ?>
            
            
        </div>
    </main>