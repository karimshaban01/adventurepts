<?php 
    session_start();
    if(!isset($_SESSION['id'])){
    header("Location: ./pages/login.php");
    }
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
            <a href="dashboard.php"><div class="menu-item">
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
            <a href="vehicles.php"><div class="menu-item active">
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
        
        <?php include './pages/vehicles.php'; ?>
    </div>
    
    <script>
        // Simple toggle for mobile menu
        document.querySelector('.menu-toggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>