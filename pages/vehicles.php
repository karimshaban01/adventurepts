<?php
    include 'includes/connection.php';

    $sql = "SELECT * FROM vehicles";
    $result = $conn->query($sql); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure Connection - Vehicle Management</title>
    <style>
        :root {
            --adventure-yellow: #FFD700;
            --adventure-blue: #1E90FF;
            --adventure-red: #E63946;
            --adventure-black: #222222;
            --adventure-white: #FFFFFF;
            --adventure-light-gray: #f5f5f5;
            --adventure-gray: #e0e0e0;
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
            display: flex;
            flex-direction: column;
        }
        
        header {
            background-color: var(--adventure-white);
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .logo-container {
            display: flex;
            align-items: center;
        }
        
        .logo {
            height: 50px;
            margin-right: 20px;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--adventure-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: var(--adventure-black);
            cursor: pointer;
        }
        
        .notification-bell {
            position: relative;
            cursor: pointer;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--adventure-red);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .main-container {
            display: flex;
            flex: 1;
        }
        
        .sidebar {
            width: 250px;
            background-color: var(--adventure-black);
            color: var(--adventure-white);
            padding: 20px 0;
            display: flex;
            flex-direction: column;
        }
        
        .sidebar-menu {
            list-style: none;
        }
        
        .sidebar-menu li {
            padding: 15px 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .sidebar-menu li:hover {
            background-color: rgba(255,255,255,0.1);
        }
        
        .sidebar-menu li.active {
            background-color: var(--adventure-blue);
            position: relative;
        }
        
        .sidebar-menu li.active::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            width: 4px;
            height: 100%;
            background-color: var(--adventure-yellow);
        }
        
        .menu-icon {
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .content {
            flex: 1;
            padding: 30px;
            background-color: var(--adventure-light-gray);
        }
        
        .page-title {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .title {
            font-size: 24px;
            font-weight: bold;
            color: var(--adventure-black);
        }
        
        .add-vehicle-btn {
            background-color: var(--adventure-blue);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        
        .add-vehicle-btn:hover {
            background-color: #0078d4;
            transform: translateY(-2px);
        }
        
        .filters {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            margin-bottom: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .filter-group {
            flex: 1;
            min-width: 200px;
        }
        
        .filter-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .filter-group select, .filter-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid var(--adventure-gray);
            border-radius: 5px;
        }
        
        .search-group {
            position: relative;
            flex: 2;
            min-width: 300px;
        }
        
        .search-group input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            border: 1px solid var(--adventure-gray);
            border-radius: 5px;
        }
        
        .search-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        
        .vehicles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .vehicle-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .vehicle-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .vehicle-image {
            height: 180px;
            width: 100%;
            object-fit: cover;
            background-color: #eee;
        }
        
        .vehicle-details {
            padding: 20px;
        }
        
        .vehicle-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            color: var(--adventure-black);
        }
        
        .vehicle-id {
            color: #777;
            font-size: 14px;
            margin-bottom: 10px;
        }
        
        .vehicle-status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        
        .status-active {
            background-color: #e6f7ed;
            color: #0a8043;
        }
        
        .status-maintenance {
            background-color: #fef2e0;
            color: #f59e0b;
        }
        
        .status-inactive {
            background-color: #feeef0;
            color: #dc2626;
        }
        
        .vehicle-info {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .info-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            color: #555;
        }
        
        .info-label {
            font-weight: 500;
        }
        
        .vehicle-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
        }
        
        .action-btn {
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
        }
        
        .edit-btn {
            background-color: var(--adventure-blue);
            color: white;
        }
        
        .edit-btn:hover {
            background-color: #0078d4;
        }
        
        .maintenance-btn {
            background-color: #f59e0b;
            color: white;
        }
        
        .maintenance-btn:hover {
            background-color: #d97706;
        }
        
        .more-btn {
            background-color: var(--adventure-light-gray);
            color: var(--adventure-black);
        }
        
        .more-btn:hover {
            background-color: var(--adventure-gray);
        }
        
        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
        
        .dot-active {
            background-color: #0a8043;
        }
        
        .dot-maintenance {
            background-color: #f59e0b;
        }
        
        .dot-inactive {
            background-color: #dc2626;
        }
        
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 40px;
            gap: 10px;
        }
        
        .page-item {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .page-item.active {
            background-color: var(--adventure-blue);
            color: white;
        }
        
        .page-item:not(.active):hover {
            background-color: var(--adventure-gray);
        }
        
        .page-arrow {
            color: #555;
        }
        
        @media (max-width: 992px) {
            .sidebar {
                width: 80px;
            }
            
            .sidebar-menu span {
                display: none;
            }
            
            .sidebar-menu li {
                justify-content: center;
                padding: 15px;
            }
        }
        
        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                flex-direction: row;
                overflow-x: auto;
                padding: 10px;
            }
            
            .sidebar-menu {
                display: flex;
            }
            
            .sidebar-menu li {
                padding: 10px 15px;
            }
            
            .sidebar-menu li.active::before {
                width: 100%;
                height: 3px;
                top: auto;
                bottom: 0;
            }
            
            .content {
                padding: 20px;
            }
            
            .vehicles-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

<style>
        
        /* Backdrop Overlay */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        
        /* Main Popup Container */
        .popup-card {
            background-color: var(--adventure-white);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            height : 90%;
            width: 80%;
            max-height : 90%;
            max-width: 80%;
            position: relative;
            left : 15%;
            top : 5%;
            overflow: hidden;
            animation: popup-appear 0.3s ease-out forwards;
        }
        
        @keyframes popup-appear {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        
        /* Popup Header */
        .popup-header {
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--adventure-light-gray);
            position: relative;
        }
        
        .popup-title {
            font-size: 20px;
            font-weight: 600;
            color: var(--adventure-black);
            margin: 0;
        }
        
        .popup-close {
            background: none;
            position: absolute;
            right : 2%;
            border: none;
            font-size: 22px;
            color: #777;
            cursor: pointer;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.2s ease;
        }
        
        .popup-close:hover {
            background-color: var(--adventure-light-gray);
            color: var(--adventure-black);
        }
        
        /* Popup Content */
        .popup-content {
            padding: 25px;
        }
        
        /* Popup Footer */
        .popup-footer {
            padding: 20px 25px;
            border-top: 1px solid var(--adventure-light-gray);
            display: flex;
            justify-content: flex-end;
            gap: 15px;
        }
        
        /* Popup Button Styles */
        .popup-btn {
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            font-size: 14px;
        }
        
        .btn-primary {
            background-color: var(--adventure-blue);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #0078d4;
        }
        
        .btn-secondary {
            background-color: var(--adventure-light-gray);
            color: var(--adventure-black);
        }
        
        .btn-secondary:hover {
            background-color: var(--adventure-gray);
        }
        
        .btn-danger {
            background-color: var(--adventure-red);
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #cc2936;
        }
        
        /* Popup Accent */
        .popup-accent {
            height: 5px;
            background: linear-gradient(to right, var(--adventure-blue), var(--adventure-yellow));
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
        }
        
        /* Form Styles */
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--adventure-black);
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--adventure-gray);
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s ease;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--adventure-blue);
            outline: none;
            box-shadow: 0 0 0 3px rgba(30, 144, 255, 0.2);
        }
        
        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }
        
        /* Alert Styles */
        .popup-alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 15px;
        }
        
        .alert-icon {
            font-size: 20px;
            flex-shrink: 0;
            margin-top: 2px;
        }
        
        .alert-content {
            flex-grow: 1;
        }
        
        .alert-title {
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .alert-message {
            margin: 0;
            font-size: 14px;
        }
        
        .alert-info {
            background-color: rgba(30, 144, 255, 0.1);
            color: var(--adventure-blue);
        }
        
        .alert-warning {
            background-color: rgba(255, 215, 0, 0.1);
            color: #f59e0b;
        }
        
        .alert-danger {
            background-color: rgba(230, 57, 70, 0.1);
            color: var(--adventure-red);
        }
        
        .alert-success {
            background-color: rgba(39, 174, 96, 0.1);
            color: #27ae60;
        }
        
        /* Checklist Styles */
        .checklist {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .checklist-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 0;
            border-bottom: 1px solid var(--adventure-light-gray);
        }
        
        .checklist-item:last-child {
            border-bottom: none;
        }
        
        .checklist-checkbox {
            width: 20px;
            height: 20px;
            border-radius: 4px;
            border: 2px solid var(--adventure-gray);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            flex-shrink: 0;
        }
        
        .checklist-checkbox.checked {
            background-color: var(--adventure-blue);
            border-color: var(--adventure-blue);
            color: white;
        }
        
        .checklist-label {
            font-size: 14px;
            flex-grow: 1;
        }
        
        /* Multi-step form indicators */
        .form-steps {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        
        .step-indicator {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
        }
        
        .step-indicator:not(:last-child)::after {
            content: '';
            position: absolute;
            width: calc(100% - 30px);
            height: 2px;
            background-color: var(--adventure-gray);
            top: 15px;
            left: calc(50% + 15px);
            z-index: 1;
        }
        
        .step-indicator.completed:not(:last-child)::after {
            background-color: var(--adventure-blue);
        }
        
        .step-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: var(--adventure-light-gray);
            color: #777;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }
        
        .step-indicator.active .step-circle {
            background-color: var(--adventure-blue);
            color: white;
        }
        
        .step-indicator.completed .step-circle {
            background-color: var(--adventure-blue);
            color: white;
        }
        
        .step-label {
            font-size: 12px;
            color: #777;
            text-align: center;
        }
        
        .step-indicator.active .step-label {
            color: var(--adventure-black);
            font-weight: 500;
        }
        
        /* Additional Styles */
        .divider {
            height: 1px;
            background-color: var(--adventure-light-gray);
            margin: 20px 0;
        }
        
        /* Popup Variants */
        .popup-card.small {
            max-width: 400px;
        }
        
        .popup-card.large {
            max-width: 700px;
        }
        
        /* Quick Action Buttons */
        .quick-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 20px;
        }
        
        .quick-action-btn {
            padding: 8px 15px;
            background-color: var(--adventure-light-gray);
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            color: var(--adventure-black);
            cursor: pointer;
            border: none;
            transition: all 0.2s ease;
        }
        
        .quick-action-btn:hover {
            background-color: var(--adventure-gray);
        }
        
        .quick-action-btn.active {
            background-color: var(--adventure-blue);
            color: white;
        }
        
        /* Media query for mobile devices */
        @media (max-width: 576px) {
            .popup-card {
                width: 95%;
                max-width: none;
                margin: 10px;
            }
            
            .popup-header, 
            .popup-content, 
            .popup-footer {
                padding: 15px;
            }
            
            .form-steps {
                display: none;
            }
            
            .popup-footer {
                flex-direction: column;
            }
            
            .popup-footer .popup-btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<div class="popup-overlay" style="display : none " id="card">
        <div class="popup-card">
            <div class="popup-accent"></div>
            <div class="popup-header">
                <button class="popup-close" id="close">&times;</button>
            </div>
            <div class="popup-content">
                
                

                
                <?php include 'pages/addvehicle.php'; ?>
                
               
                
                <!-- Checklist Example -->

            </div>

        </div>
    </div>
    <div class="main-container">
       <main class="content">
            <div class="page-title">
                <h1 class="title">Vehicle Management</h1>
                <button class="add-vehicle-btn" id="add-button">
                    <span>&#43;</span>
                    <span>Add New Vehicle</span>
                </button>
            </div>
            
            <div class="filters">
                <div class="search-group">
                    <input type="text" placeholder="Search vehicles...">
                    <span class="search-icon">&#128269;</span>
                </div>
                <div class="filter-group">
                    <label>Vehicle Type</label>
                    <select>
                        <option value="">All Types</option>
                        <option value="truck">Truck</option>
                        <option value="van">Van</option>
                        <option value="suv">SUV</option>
                        <option value="motorcycle">Motorcycle</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Status</label>
                    <select>
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="maintenance">Maintenance</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label>Sort By</label>
                    <select>
                        <option value="newest">Newest First</option>
                        <option value="oldest">Oldest First</option>
                        <option value="name">Name A-Z</option>
                        <option value="status">Status</option>
                    </select>
                </div>
            </div>
            
            <div class="vehicles-grid">

            <?php 
                while($row=mysqli_fetch_assoc($result)){
                    echo '<div class="vehicle-card">
                    <img src="/api/placeholder/400/180" alt="Adventure Truck" class="vehicle-image">
                    <div class="vehicle-details">
                        <h3 class="vehicle-title">'.$row['vehicle_name'].'</h3>
                        <p class="vehicle-id">Make: '.$row['make'].'</p>
                        <span class="vehicle-status status-active">
                            <span class="status-dot dot-active"></span>Active
                        </span>
                        <div class="vehicle-info">
                            <div class="info-item">
                                <span class="info-label">Type:</span>
                                <span>'.$row['vehicle_type'].'</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Capacity:</span>
                                <span>'.$row['capacity'].' Tons</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">License:</span>
                                <span>'.$row['plate_number'].'</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Last Service:</span>
                                <span>Mar 15, 2025</span>
                            </div>
                        </div>
                        <div class="vehicle-actions">
                            <button class="action-btn edit-btn">Edit</button>
                            <button class="action-btn maintenance-btn">Maintenance</button>
                            <button class="action-btn more-btn">More</button>
                        </div>
                    </div>
                </div>';
                }

            ?>

                
                

<!--                 <div class="vehicle-card">
                    <img src="/api/placeholder/400/180" alt="Delivery Van" class="vehicle-image">
                    <div class="vehicle-details">
                        <h3 class="vehicle-title">Express Delivery Van</h3>
                        <p class="vehicle-id">ID: VAN-2024-2187</p>
                        <span class="vehicle-status status-active">
                            <span class="status-dot dot-active"></span>Active
                        </span>
                        <div class="vehicle-info">
                            <div class="info-item">
                                <span class="info-label">Type:</span>
                                <span>Van</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Capacity:</span>
                                <span>1 Ton</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">License:</span>
                                <span>ADV-2187</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Last Service:</span>
                                <span>Apr 02, 2025</span>
                            </div>
                        </div>
                        <div class="vehicle-actions">
                            <button class="action-btn edit-btn">Edit</button>
                            <button class="action-btn maintenance-btn">Maintenance</button>
                            <button class="action-btn more-btn">More</button>
                        </div>
                    </div>
                </div>
                
               
                <div class="vehicle-card">
                    <img src="/api/placeholder/400/180" alt="Motorcycle" class="vehicle-image">
                    <div class="vehicle-details">
                        <h3 class="vehicle-title">Quick Delivery Bike</h3>
                        <p class="vehicle-id">ID: MTR-2024-3356</p>
                        <span class="vehicle-status status-maintenance">
                            <span class="status-dot dot-maintenance"></span>Maintenance
                        </span>
                        <div class="vehicle-info">
                            <div class="info-item">
                                <span class="info-label">Type:</span>
                                <span>Motorcycle</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Capacity:</span>
                                <span>50 kg</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">License:</span>
                                <span>ADV-3356</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Last Service:</span>
                                <span>Apr 10, 2025</span>
                            </div>
                        </div>
                        <div class="vehicle-actions">
                            <button class="action-btn edit-btn">Edit</button>
                            <button class="action-btn maintenance-btn">Maintenance</button>
                            <button class="action-btn more-btn">More</button>
                        </div>
                    </div>
                </div>
                
                
                <div class="vehicle-card">
                    <img src="/api/placeholder/400/180" alt="SUV" class="vehicle-image">
                    <div class="vehicle-details">
                        <h3 class="vehicle-title">Adventure SUV</h3>
                        <p class="vehicle-id">ID: SUV-2023-9987</p>
                        <span class="vehicle-status status-inactive">
                            <span class="status-dot dot-inactive"></span>Inactive
                        </span>
                        <div class="vehicle-info">
                            <div class="info-item">
                                <span class="info-label">Type:</span>
                                <span>SUV</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Capacity:</span>
                                <span>500 kg</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">License:</span>
                                <span>ADV-9987</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Last Service:</span>
                                <span>Jan 28, 2025</span>
                            </div>
                        </div>
                        <div class="vehicle-actions">
                            <button class="action-btn edit-btn">Edit</button>
                            <button class="action-btn maintenance-btn">Maintenance</button>
                            <button class="action-btn more-btn">More</button>
                        </div>
                    </div>
                </div>
                
                
                <div class="vehicle-card">
                    <img src="/api/placeholder/400/180" alt="Heavy Truck" class="vehicle-image">
                    <div class="vehicle-details">
                        <h3 class="vehicle-title">Heavy Transport Truck</h3>
                        <p class="vehicle-id">ID: TRK-2024-6544</p>
                        <span class="vehicle-status status-active">
                            <span class="status-dot dot-active"></span>Active
                        </span>
                        <div class="vehicle-info">
                            <div class="info-item">
                                <span class="info-label">Type:</span>
                                <span>Truck</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Capacity:</span>
                                <span>5 Tons</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">License:</span>
                                <span>ADV-6544</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Last Service:</span>
                                <span>Mar 30, 2025</span>
                            </div>
                        </div>
                        <div class="vehicle-actions">
                            <button class="action-btn edit-btn">Edit</button>
                            <button class="action-btn maintenance-btn">Maintenance</button>
                            <button class="action-btn more-btn">More</button>
                        </div>
                    </div>
                </div>
                
                
                <div class="vehicle-card">
                    <img src="/api/placeholder/400/180" alt="Compact Van" class="vehicle-image">
                    <div class="vehicle-details">
                        <h3 class="vehicle-title">Compact Delivery Van</h3>
                        <p class="vehicle-id">ID: VAN-2024-5512</p>
                        <span class="vehicle-status status-maintenance">
                            <span class="status-dot dot-maintenance"></span>Maintenance
                        </span>
                        <div class="vehicle-info">
                            <div class="info-item">
                                <span class="info-label">Type:</span>
                                <span>Van</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Capacity:</span>
                                <span>800 kg</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">License:</span>
                                <span>ADV-5512</span>
                            </div>
                            <div class="info-item">
                                <span class="info-label">Last Service:</span>
                                <span>Apr 08, 2025</span>
                            </div>
                        </div>
                        <div class="vehicle-actions">
                            <button class="action-btn edit-btn">Edit</button>
                            <button class="action-btn maintenance-btn">Maintenance</button>
                            <button class="action-btn more-btn">More</button>
                        </div>
                    </div>
                </div> -->
            </div>
            
            <div class="pagination">
                <div class="page-item page-arrow">&#8592;</div>
                <div class="page-item active">1</div>
                <div class="page-item">2</div>
                <div class="page-item">3</div>
                <div class="page-item">4</div>
                <div class="page-item">...</div>
                <div class="page-item">8</div>
                <div class="page-item page-arrow">&#8594;</div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById("add-button").addEventListener('click', ()=>{
             if(card.style.display=='none'){
             document.getElementById('card').style.display='block';
             } else {
                card.style.display='none';
             }
        });

        document.getElementById('close').addEventListener('click', ()=>{
            if(card.style.display=='block'){
             document.getElementById('card').style.display='none';
             } else {
                card.style.display='block';
             }
        });

        document.getElementById('cancel').addEventListener('click', ()=>{
            if(card.style.display=='block'){
             document.getElementById('card').style.display='none';
             } else {
                card.style.display='block';
             }
        });
    </script>