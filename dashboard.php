<?php 
session_start();
if(!isset($_SESSION['id'])){
    header("Location: ./pages/login.php");
}

$address = $_SESSION['address'];

include './includes/connection.php';


$sql = "SELECT * FROM percels WHERE pickup_address='$address' OR delivery_address='$address' ORDER BY track_id DESC LIMIT 5";
$result=$conn->query($sql);

$sql1 = "SELECT * FROM percels WHERE pickup_address='$address' OR delivery_address='$address' ORDER BY updated_at DESC LIMIT 10";
$delivered = $conn->query($sql1);

$sql2 = "SELECT * FROM percels";
$total = mysqli_num_rows($conn->query($sql2));

$sql3 = "SELECT * FROM percels";
$on_transit = mysqli_num_rows($conn->query($sql3));

$sql4 = "SELECT * FROM percels";
$active = mysqli_num_rows($conn->query($sql4));

$sql5 = "SELECT * FROM percels";
$pending = mysqli_num_rows($conn->query($sql5));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure Connection - Dashboard</title>
    <style>
        :root {
            --adventure-yellow: #FFD700;
            --adventure-blue: #1E90FF;
            --adventure-red: #E63946;
            --adventure-black: #222222;
            --adventure-white: #FFFFFF;
            --sidebar-width: 250px;
            --header-height: 70px;
            --light-gray: #f5f5f5;
            --medium-gray: #e0e0e0;
            --dark-gray: #9e9e9e;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f8f9fa;
            color: var(--adventure-black);
            min-height: 100vh;
            display: flex;
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
        
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--adventure-black);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            transition: transform 0.3s ease;
            z-index: 100;
        }
        
        .sidebar-header {
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-logo {
            max-width: 180px;
        }
        
        .sidebar-menu {
            padding: 20px 0;
        }
        
        .menu-item {
            padding: 12px 25px;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s;
            color: rgba(255, 255, 255, 0.7);
        }
        
        .menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .menu-item.active {
            background-color: var(--adventure-blue);
            color: white;
            position: relative;
        }
        
        .menu-item.active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background-color: var(--adventure-yellow);
        }
        
        .menu-icon {
            margin-right: 15px;
            font-size: 1.2rem;
            width: 20px;
            text-align: center;
        }
        
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            display: flex;
            flex-direction: column;
        }
        
        .header {
            height: var(--header-height);
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 90;
        }
        
        .search-bar {
            display: flex;
            align-items: center;
            background-color: var(--light-gray);
            border-radius: 20px;
            padding: 5px 15px;
            max-width: 300px;
        }
        
        .search-bar input {
            border: none;
            background-color: transparent;
            padding: 8px;
            flex: 1;
            outline: none;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
        }
        
        .notification-icon {
            position: relative;
            margin-right: 25px;
            cursor: pointer;
        }
        
        .notification-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--adventure-red);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--adventure-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 10px;
        }
        
        .user-info {
            display: flex;
            flex-direction: column;
        }
        
        .user-name {
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .user-role {
            font-size: 0.8rem;
            color: var(--dark-gray);
        }
        
        .dashboard-content {
            padding: 30px;
            flex: 1;
        }
        
        .dashboard-title {
            margin-bottom: 25px;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--adventure-black);
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-right: 15px;
            color: white;
        }
        
        .icon-blue {
            background-color: var(--adventure-blue);
        }
        
        .icon-yellow {
            background-color: var(--adventure-yellow);
        }
        
        .icon-red {
            background-color: var(--adventure-red);
        }
        
        .icon-green {
            background-color: #4CAF50;
        }
        
        .stat-info h3 {
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .stat-info p {
            color: var(--dark-gray);
            font-size: 0.9rem;
        }
        
        .dashboard-sections {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
        }
        
        .section-card {
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .section-title {
            font-size: 1.2rem;
            font-weight: 600;
        }
        
        .view-all {
            color: var(--adventure-blue);
            font-size: 0.9rem;
            cursor: pointer;
        }
        
        .shipment-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .shipment-table th, .shipment-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid var(--medium-gray);
        }
        
        .shipment-table th {
            color: var(--dark-gray);
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        .shipment-table tbody tr:hover {
            background-color: var(--light-gray);
        }
        
        .status {
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 500;
            display: inline-block;
        }
        
        .status-delivered {
            background-color: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
        }
        
        .status-transit {
            background-color: rgba(255, 215, 0, 0.1);
            color: #FFA000;
        }
        
        .status-pending {
            background-color: rgba(30, 144, 255, 0.1);
            color: var(--adventure-blue);
        }
        
        .btn-action {
            background-color: transparent;
            border: none;
            color: var(--adventure-blue);
            cursor: pointer;
            font-size: 0.9rem;
            padding: 5px;
        }
        
        .notification-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid var(--medium-gray);
        }
        
        .notification-item:last-child {
            border-bottom: none;
        }
        
        .notification-dot {
            width: 10px;
            height: 10px;
            background-color: var(--adventure-red);
            border-radius: 50%;
            margin-right: 15px;
        }
        
        .notification-content {
            flex: 1;
        }
        
        .notification-text {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }
        
        .notification-time {
            font-size: 0.8rem;
            color: var(--dark-gray);
        }
        
        .menu-toggle {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
        }
        
        .quick-action-btn {
            padding: 15px;
            background-color: var(--adventure-blue);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: transform 0.2s;
        }
        
        .quick-action-btn:hover {
            transform: translateY(-5px);
            background-color: var(--adventure-red);
        }
        
        .quick-action-icon {
            font-size: 24px;
            margin-bottom: 10px;
        }
        
        .map-container {
            height: 350px;
            border-radius: 8px;
            overflow: hidden;
            position: relative;
        }
        
        .parcel-card {
            display: flex;
            padding: 15px;
            border-bottom: 1px solid var(--medium-gray);
            cursor: pointer;
            transition: background-color 0.2s;
        }
        
        .parcel-card:hover {
            background-color: var(--light-gray);
        }
        
        .parcel-card:last-child {
            border-bottom: none;
        }
        
        .parcel-icon {
            width: 40px;
            height: 40px;
            background-color: rgba(30, 144, 255, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-right: 15px;
            color: var(--adventure-blue);
        }
        
        .parcel-info {
            flex: 1;
        }
        
        .parcel-title {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .parcel-meta {
            display: flex;
            align-items: center;
            font-size: 0.8rem;
            color: var(--dark-gray);
        }
        
        .parcel-meta span {
            margin-right: 15px;
        }
        
        .progress-container {
            height: 4px;
            background-color: var(--medium-gray);
            border-radius: 2px;
            margin-top: 10px;
            overflow: hidden;
        }
        
        .progress-bar {
            height: 100%;
            background-color: var(--adventure-blue);
        }
        
        .stats-chart {
            height: 250px;
            margin-top: 10px;
        }

        a {
            text-decoration : none;
        }
        
        @media (max-width: 1024px) {
            .dashboard-sections {
                grid-template-columns: 1fr;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
        
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .header {
                padding: 0 15px;
            }
            
            .search-bar {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            
        </div>
        <div class="sidebar-menu">
            <a href="dashboard.php"><div class="menu-item active">
                <span class="menu-icon">📊</span>
                <span>Dashboard</span>
            </div></a>
            <a href="shipments.php"><div class="menu-item">
                <span class="menu-icon">📦</span>
                <span>Shipments</span>
            </div></a>
            <a href="track.php"><div class="menu-item">
                <span class="menu-icon">🚚</span>
                <span>Track Parcels</span>
            </div></a>
            <a href="new.php"><div class="menu-item">
                <span class="menu-icon">➕</span>
                <span>New Shipment</span>
            </div></a>
            <a href="vehicles.php"><div class="menu-item">
                <span class="menu-icon">🏠</span>
                <span>Vehicles</span>
            </div></a>
            <!-- <a href=""><div class="menu-item">
                <span class="menu-icon">💵</span>
                <span>Billing</span>
            </div></a>
            <a href=""><div class="menu-item">
                <span class="menu-icon">🔄</span>
                <span>Returns</span>
            </div></a> -->
            <a href="./pages/register.php"><div class="menu-item">
                <span class="menu-icon">⚙️</span>
                <span>Add user</span>
            </div></a>
            <a href=""><div class="menu-item">
                <span class="menu-icon">❓</span>
                <span>Help & Support</span>
            </div></a>
            <a href="./pages/logout.php"><div class="menu-item">
                <span class="menu-icon">🚪</span>
                <span>Logout</span>
            </div></a>
        </div>
    </div>
    
    <div class="main-content">
        <div class="header">
            <div class="left-section">
                <div class="menu-toggle">☰</div>
                <div class="search-bar">
                    <span>🔍</span>
                    <input type="text" placeholder="Search...">
                </div>
            </div>
            <div class="user-menu">
                <div class="notification-icon">
                <?php echo $_SESSION['address']." OFFICE"; ?>
                </div>
                <div class="user-profile">
                    <div class="avatar"><?php echo $_SESSION['name'][0]; ?></div>
                    <div class="user-info">
                        <span class="user-name"><?php echo $_SESSION['name']; ?></span>
                        <span class="user-role"><?php echo $_SESSION['role'] ?></span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="dashboard-content">
            <h1 class="dashboard-title">Dashboard</h1>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon icon-blue">📦</div>
                    <div class="stat-info">
                        <h3><?php echo $active; ?></h3>
                        <p>Active Shipments</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-yellow">🚚</div>
                    <div class="stat-info">
                        <h3><?php echo $on_transit; ?></h3>
                        <p>In Transit</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-green">✓</div>
                    <div class="stat-info">
                        <h3><?php echo $total; ?></h3>
                        <p>Total Delivered</p>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon icon-red">⏰</div>
                    <div class="stat-info">
                        <h3><?php echo $pending; ?></h3>
                        <p>Pending Pickup</p>
                    </div>
                </div>
            </div>
            
            <div class="dashboard-sections">
                <div class="left-sections">
                    <div class="section-card">
                        <div class="section-header">
                            <h2 class="section-title">Recent Shipments</h2>
                            <a href="./shipments.php"><span class="view-all">View All</span></a>
                        </div>
                        <table class="shipment-table">
                            <thead>
                                <tr>
                                    <th>Tracking ID</th>
                                    <th>Destination</th>
                                    <th>Ship Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo '
                                        
                                        <tr>
                                            <td>'.$row['track_id'].'</td>
                                            <td>'.$row['delivery_address'].'</td>
                                            <td>'.$row['pickup_date'].'</td>
                                            <td><span class="status status-transit">'.$row['ship_status'].'</span></td>
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
                                        </tr>
                                        
                                        ';
                                    }
                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="section-card">
                        <div class="section-header">
                            <h2 class="section-title">Quick Actions</h2>
                        </div>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
                            <a href="./new.php"><button class="quick-action-btn">
                                <span class="quick-action-icon">📦</span>
                                <span>New Shipment and Shipments Management</span>
                            </button></a>
                            <a href="./track.php"><button class="quick-action-btn">
                                <span class="quick-action-icon">🔍</span>
                                <span>Track Parcel and Other percel activities</span>
                            </button></a>
                            
                            <a href="./vehicles.php"><button class="quick-action-btn">
                                <span class="quick-action-icon">🏠</span>
                                <span>Vehicles management and Planning tasks</span>
                            </button></a>
                        </div>
                    </div>
                    
                    <div class="section-card">
                        <div class="section-header">
                            <h2 class="section-title">Shipment Activity</h2>
                        </div>
                        <div class="stats-chart">
                            <img src="/api/placeholder/800/250" alt="Shipment Activity Chart">
                        </div>
                    </div>
                    
                    <div class="section-card">
                        <div class="section-header">
                            <h2 class="section-title">Shipment Locations</h2>
                        </div>
                        <div class="map-container">
                            <img src="/api/placeholder/800/350" alt="Shipment Map">
                        </div>
                    </div>
                </div>
                
                <div class="right-sections">
                    <div class="section-card">
                        <div class="section-header">
                            <h2 class="section-title">Notifications</h2>
                            <span class="view-all">Mark All Read</span>
                        </div>
                        <?php 
                                    while($row2 = mysqli_fetch_assoc($delivered)){
                                        echo '
                                        <div class="notification-item">
                                            <div class="notification-dot"></div>
                                            <div class="notification-content">
                                                <div class="notification-text">Shipment '.$row2['track_id'].' has arrived at '.$row2['delivery_address'].' office.</div>
                                                <div class="notification-time">'.$row2['updated_at'].'</div>
                                            </div>
                                        </div>

                                        ';
                                    }
                        ?>
                    
                    <!-- <div class="section-card">
                        <div class="section-header">
                            <h2 class="section-title">Active Tracking</h2>
                        </div>
                        <div class="parcel-card">
                            <div class="parcel-icon">📦</div>
                            <div class="parcel-info">
                                <div class="parcel-title">Climbing Gear</div>
                                <div class="parcel-meta">
                                    <span>AC-78934</span>
                                    <span>MBEYA</span>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-bar" style="width: 65%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="parcel-card">
                            <div class="parcel-icon">📦</div>
                            <div class="parcel-info">
                                <div class="parcel-title">Mountain Bike</div>
                                <div class="parcel-meta">
                                    <span>AC-78933</span>
                                    <span>MWANZA</span>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-bar" style="width: 40%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="parcel-card">
                            <div class="parcel-icon">📦</div>
                            <div class="parcel-info">
                                <div class="parcel-title">Camping Equipment</div>
                                <div class="parcel-meta">
                                    <span>AC-78930</span>
                                    <span>ARUSHA</span>
                                </div>
                                <div class="progress-container">
                                    <div class="progress-bar" style="width: 85%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="section-card">
                        <div class="section-header">
                            <h2 class="section-title">Recent Invoices</h2>
                            <span class="view-all">View All</span>
                        </div>
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr>
                                    <th style="text-align: left; padding: 10px 0; border-bottom: 1px solid #e0e0e0; color: #9e9e9e; font-size: 0.9rem;">Invoice #</th>
                                    <th style="text-align: left; padding: 10px 0; border-bottom: 1px solid #e0e0e0; color: #9e9e9e; font-size: 0.9rem;">Amount</th>
                                    <th style="text-align: left; padding: 10px 0; border-bottom: 1px solid #e0e0e0; color: #9e9e9e; font-size: 0.9rem;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0;">INV-2025-042</td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0;">TZS 157.50</td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0;">
                                        <span style="color: #4CAF50; background-color: rgba(76, 175, 80, 0.1); padding: 3px 8px; border-radius: 12px; font-size: 0.8rem;">Paid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0;">INV-2025-041</td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0;">TZS 89.25</td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0;">
                                        <span style="color: #4CAF50; background-color: rgba(76, 175, 80, 0.1); padding: 3px 8px; border-radius: 12px; font-size: 0.8rem;">Paid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0;">INV-2025-040</td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0;">TZS 235.00</td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e0e0e0;">
                                        <span style="color: #FFA000; background-color: rgba(255, 160, 0, 0.1); padding: 3px 8px; border-radius: 12px; font-size: 0.8rem;">Pending</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div> -->
                    
                    <div class="section-card">
                        <div class="section-header">
                            <h2 class="section-title">Customer Support</h2>
                        </div>
                        <div style="text-align: center; padding: 15px 0;">
                            <div style="font-size: 3rem; margin-bottom: 10px;">🎧</div>
                            <h3 style="margin-bottom: 10px;">Need Help?</h3>
                            <p style="margin-bottom: 20px; color: #9e9e9e;">Our adventure specialists are available 24/7</p>
                            <button style="background-color: var(--adventure-blue); color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer; font-weight: 600;">Contact Support</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Simple toggle for mobile menu
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>