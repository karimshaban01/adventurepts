<?php
    require 'includes/connection.php';

    $address = $_SESSION['address'];
    
    $result = $conn->query("SELECT * FROM percels WHERE pickup_address='$address' OR delivery_address='$address' ORDER BY pickup_date DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure Connection - Shipments</title>
    <link rel="stylesheet" href="../fontawesome/css/all.css">
    <style>
        :root {
            --adventure-yellow: #FFD700;
            --adventure-blue: #1E90FF;
            --adventure-red: #E63946;
            --adventure-black: #222222;
            --adventure-white: #FFFFFF;
            --adventure-gray: #f3f4f6;
            --adventure-border: #e0e0e0;
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
        }
        
        .navbar {
            background-color: var(--adventure-black);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        .logo {
            height: 40px;
        }
        
        .nav-links {
            display: flex;
            gap: 30px;
        }
        
        .nav-links a {
            color: var(--adventure-white);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .nav-links a:hover, .nav-links a.active {
            color: var(--adventure-yellow);
        }
        
        .profile-menu {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--adventure-white);
            cursor: pointer;
        }
        
        .profile-menu img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .page-title {
            color: var(--adventure-black);
            font-size: 1.8rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .accent-line {
            height: 5px;
            background: linear-gradient(to right, var(--adventure-yellow), var(--adventure-red));
            width: 50px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        
        .controls {
            display: flex;
            gap: 15px;
        }
        
        .btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary {
            background-color: var(--adventure-blue);
            color: white;
            box-shadow: 0 2px 5px rgba(30, 144, 255, 0.3);
        }
        
        .btn-primary:hover {
            background-color: #1a7ed9;
            transform: translateY(-2px);
        }
        
        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--adventure-border);
            color: var(--adventure-black);
        }
        
        .btn-outline:hover {
            background-color: #f0f0f0;
        }
        
        .filters {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
            margin-bottom: 20px;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .search-box {
            flex: 1;
            min-width: 300px;
            position: relative;
        }
        
        .search-box input {
            width: 100%;
            padding: 12px 40px 12px 15px;
            border: 1px solid var(--adventure-border);
            border-radius: 8px;
            font-size: 0.9rem;
        }
        
        .search-box input:focus {
            border-color: var(--adventure-blue);
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 144, 255, 0.1);
        }
        
        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        
        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .filter-group select {
            padding: 10px 15px;
            border: 1px solid var(--adventure-border);
            border-radius: 8px;
            background-color: white;
            min-width: 150px;
        }
        
        .shipments-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .shipments-table th {
            background-color: var(--adventure-gray);
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: var(--adventure-black);
            border-bottom: 1px solid var(--adventure-border);
        }
        
        .shipments-table td {
            padding: 15px;
            border-bottom: 1px solid var(--adventure-border);
            color: #444;
        }
        
        .shipments-table tr:last-child td {
            border-bottom: none;
        }
        
        .shipments-table tr:hover {
            background-color: rgba(30, 144, 255, 0.03);
        }
        
        .status {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
        }
        
        .status-delivered {
            background-color: #e6f7e6;
            color: #2e7d32;
        }
        
        .status-transit {
            background-color: #e3f2fd;
            color: #1976d2;
        }
        
        .status-pending {
            background-color: #fff8e1;
            color: #f57c00;
        }
        
        .status-issue {
            background-color: #ffebee;
            color: #c62828;
        }
        
        .qrcode {
            width: 60px;
            height: 60px;
        }
        
        .action-icons {
            display: flex;
            gap: 15px;
        }
        
        .action-icons button {
            background: none;
            border: none;
            cursor: pointer;
            color: #777;
            transition: color 0.3s ease;
        }
        
        .action-icons button:hover {
            color: var(--adventure-blue);
        }
        
        .pagination {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
            padding: 15px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .pagination-info {
            color: #666;
        }
        
        .pagination-controls {
            display: flex;
            gap: 10px;
        }
        
        .pagination-controls button {
            padding: 8px 12px;
            border: 1px solid var(--adventure-border);
            border-radius: 8px;
            background-color: white;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .pagination-controls button:hover {
            background-color: var(--adventure-gray);
        }
        
        .pagination-controls button.active {
            background-color: var(--adventure-blue);
            color: white;
            border-color: var(--adventure-blue);
        }
        
        .weight-unit {
            color: #888;
            font-size: 0.85rem;
        }
        
        .priority-high {
            color: var(--adventure-red);
            font-weight: 600;
        }
        
        .priority-medium {
            color: #f57c00;
            font-weight: 600;
        }
        
        .priority-normal {
            color: #2e7d32;
            font-weight: 600;
        }
        
        @media (max-width: 1200px) {
            .shipments-table {
                display: block;
                overflow-x: auto;
            }
        }
        
        @media (max-width: 768px) {
            .navbar {
                padding: 15px;
            }
            
            .container {
                padding: 15px;
            }
            
            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .filters {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-box {
                min-width: auto;
            }
            
            .action-icons {
                gap: 10px;
            }
        }
    </style>
</head>
<body>
<!--     <nav class="navbar">
        <img src="/api/placeholder/150/40" alt="Adventure Connection Logo" class="logo">
        <div class="nav-links">
            <a href="#">Dashboard</a>
            <a href="#" class="active">Shipments</a>
            <a href="#">Tracking</a>
            <a href="#">Reports</a>
            <a href="#">Settings</a>
        </div>
        <div class="profile-menu">
            <img src="/api/placeholder/35/35" alt="User Profile">
            <span>John Doe</span>
        </div>
    </nav> -->
    
    <div class="container">
        <div class="page-header">
            <div>
                <div class="accent-line"></div>
                <h1 class="page-title">All Shipments</h1>
            </div>
            <div class="controls">
                <button class="btn btn-outline">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    Export
                </button>
                <a href="new.php"><button class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    New Shipment
                </button></a>
            </div>
        </div>
        
        <div class="filters">
            <div class="search-box">
                <input type="text" placeholder="Search by tracking number, name, or destination...">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="search-icon">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
            </div>
            <div class="filter-group">
                <label for="status-filter">Status:</label>
                <select id="status-filter">
                    <option value="all">All Statuses</option>
                    <option value="delivered">Delivered</option>
                    <option value="transit">In Transit</option>
                    <option value="pending">Pending</option>
                    <option value="issue">Issues</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="date-filter">Date Range:</label>
                <select id="date-filter">
                    <option value="all">All Time</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="custom">Custom Range</option>
                </select>
            </div>
            <button class="btn btn-outline">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="4" y1="21" x2="4" y2="14"></line>
                    <line x1="4" y1="10" x2="4" y2="3"></line>
                    <line x1="12" y1="21" x2="12" y2="12"></line>
                    <line x1="12" y1="8" x2="12" y2="3"></line>
                    <line x1="20" y1="21" x2="20" y2="16"></line>
                    <line x1="20" y1="12" x2="20" y2="3"></line>
                    <line x1="1" y1="14" x2="7" y2="14"></line>
                    <line x1="9" y1="8" x2="15" y2="8"></line>
                    <line x1="17" y1="16" x2="23" y2="16"></line>
                </svg>
                More Filters
            </button>
        </div>
        
        <table class="shipments-table">
            <thead>
                <tr>
                    <th>Tracking #</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Sender</th>
                    <th>Recipient</th>
                    <th>Weight</th>
                    <th>Service level</th>
                    <th>Ship Date</th>
                    <th>ETA</th>
                    <th>Status</th>
                    <th>QR Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            <?php         
                while($row = mysqli_fetch_assoc($result)){
                    echo '<tr>
                    <td>'.$row['track_id'].'</td>
                    <td>'.$row['pickup_address'].'</td>
                    <td>'.$row['delivery_address'].'</td>
                    <td>'.$row['sender_name'].'</td>
                    <td>'.$row['receiver_name'].'</td>
                    <td>'.$row['weight'].'kg</span></td>
                    <td>'.$row['service_level'].'</td>
                    <td>'.$row['pickup_date'].'</td>
                    <td>'.$row['expected_delivery_date'].'</td>
                    <td><span class="status status-transit">'.$row['ship_status'].'</span></td>
                    <td><a href="pages/qrcode.php?id='.$row['track_id'].'"><i class="fa fa-qrcode"></i>"</td>
                    <td>
                        <div class="action-icons">
                            <a href="pages/view.php?id='.$row['track_id'].'"> <button title="View Details">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button></a>
                            <a href="pages/edit.php?id='.$row['track_id'].'"><button title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                </svg>
                            </button></a>
                            <a href="pages/print.php?id='.$row['track_id'].'"><button title="Print Label">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                                    <rect x="6" y="14" width="12" height="8"></rect>
                                </svg>
                            </button></a>
                        </div>
                    </td>
                </tr>';
                }
                ?>
                