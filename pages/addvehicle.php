<?php 
    include 'includes/connection.php';  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure Connection - Add Vehicle Popup</title>
    <style>
        
        .close-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background: none;
            border: none;
            color: var(--adventure-white);
            font-size: 22px;
            cursor: pointer;
            opacity: 0.8;
            transition: all 0.2s ease;
        }
        
        .close-btn:hover {
            opacity: 1;
            transform: scale(1.1);
        }
        
        .modal-body {
            padding: 30px;
            max-height: 65vh;
            overflow-y: auto;
        }
        
        .form-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--adventure-black);
            padding-bottom: 10px;
            border-bottom: 2px solid var(--adventure-light-gray);
            display: flex;
            align-items: center;
        }
        
        .section-title .step {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: var(--adventure-blue);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            margin-right: 10px;
        }
        
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
            margin-bottom: 15px;
        }
        
        .form-group {
            flex: 1;
            min-width: 200px;
            padding: 0 10px;
            margin-bottom: 15px;
        }
        
        .form-group.full-width {
            flex-basis: 100%;
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
            padding: 12px 15px;
            border: 1px solid var(--adventure-gray);
            border-radius: 8px;
            font-size: 15px;
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
            min-height: 100px;
            resize: vertical;
        }
        
        .image-upload {
            border: 2px dashed var(--adventure-gray);
            padding: 30px;
            text-align: center;
            border-radius: 8px;
            background-color: var(--adventure-light-gray);
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .image-upload:hover {
            border-color: var(--adventure-blue);
            background-color: rgba(30, 144, 255, 0.05);
        }
        
        .upload-icon {
            font-size: 40px;
            color: var(--adventure-blue);
            margin-bottom: 10px;
        }
        
        .upload-text {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
        }
        
        .browse-btn {
            display: inline-block;
            padding: 8px 15px;
            background-color: var(--adventure-blue);
            color: white;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }
        
        .file-types {
            font-size: 12px;
            color: #888;
            margin-top: 10px;
        }
        
        .form-help {
            font-size: 13px;
            color: #666;
            margin-top: 5px;
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }
        
        .checkbox-group input {
            width: auto;
            margin-right: 10px;
        }
        
        .status-toggle {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-top: 10px;
        }
        
        .toggle-option {
            flex: 1;
            padding: 12px;
            text-align: center;
            border: 1px solid var(--adventure-gray);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .toggle-option.active {
            background-color: var(--adventure-blue);
            color: white;
            border-color: var(--adventure-blue);
        }
        
        .toggle-option.maintenance {
            background-color: #f59e0b;
            color: white;
            border-color: #f59e0b;
        }
        
        .toggle-option.inactive {
            background-color: #dc2626;
            color: white;
            border-color: #dc2626;
        }
        
        .toggle-icon {
            font-size: 18px;
            margin-bottom: 5px;
        }
        
        .modal-footer {
            padding: 20px 30px;
            background-color: var(--adventure-light-gray);
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            border-top: 1px solid var(--adventure-gray);
        }
        
        .btn {
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-primary {
            background-color: var(--adventure-blue);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #0078d4;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(30, 144, 255, 0.3);
        }
        
        .btn-secondary {
            background-color: var(--adventure-white);
            color: var(--adventure-black);
            border: 1px solid var(--adventure-gray);
        }
        
        .btn-secondary:hover {
            background-color: var(--adventure-gray);
        }
        
        .service-records {
            margin-top: 15px;
        }
        
        .add-record {
            display: flex;
            align-items: center;
            color: var(--adventure-blue);
            cursor: pointer;
            font-weight: 500;
            margin-top: 10px;
            font-size: 14px;
        }
        
        .add-record-icon {
            margin-right: 8px;
        }
        
        @media (max-width: 768px) {
            .modal {
                width: 95%;
            }
            
            .form-group {
                flex-basis: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="modal">
        <div class="modal-header">
            <div class="header-accent"></div>
            <h2 class="modal-title">Add New Vehicle</h2>
        </div>
        
        <div class="modal-body">
            <div class="form-section">
                <h3 class="section-title">
                    <span class="step">1</span>
                    Basic Information
                </h3>
                <form action="" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="vehicleName">Vehicle Name*</label>
                        <input type="text" id="vehicleName" placeholder="e.g. Adventure Truck XL" name="vehicle_name">
                    </div>
                    <div class="form-group">
                        <label for="vehicleType">Vehicle Type*</label>
                        <select id="vehicleType" name="vehicle_type">
                            <option value="">Select Type</option>
                            <option value="truck">Truck</option>
                            <option value="van">Van</option>
                            <option value="suv">SUV</option>
                            <option value="motorcycle">Motorcycle</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="make">Make*</label>
                        <input type="text" id="make" placeholder="e.g. Toyota" name="make">
                    </div>
                    <div class="form-group">
                        <label for="model">Model*</label>
                        <input type="text" id="model" placeholder="e.g. Hilux" name="model">
                    </div>
                    <div class="form-group">
                        <label for="year">Year*</label>
                        <input type="number" id="year" placeholder="e.g. 2025" name="year">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="license">License Plate*</label>
                        <input type="text" id="license" placeholder="e.g. ADV-1045" name="plate_number">
                    </div>
                    <!-- <div class="form-group">
                        <label for="vin">VIN Number*</label>
                        <input type="text" id="vin" placeholder="Vehicle Identification Number">
                    </div> -->
                </div>
            </div>
            
            <div class="form-section">
                <h3 class="section-title">
                    <span class="step">2</span>
                    Capacity & Specifications
                </h3>
                <div class="form-row">
                    <div class="form-group">
                        <label for="capacity">Capacity*</label>
                        <input type="text" id="capacity" placeholder="e.g. 2.5 Tons" name="capacity">
                    </div>
                    <div class="form-group">
                        <label for="maxVolume">Maximum Volume</label>
                        <input type="text" id="maxVolume" placeholder="e.g. 15 cubic meters" name="max_volume">
                    </div>
                    <div class="form-group">
                        <label for="dimensions">Dimensions</label>
                        <input type="text" id="dimensions" placeholder="Length x Width x Height" name="dimensions">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="fuelType">Fuel Type</label>
                        <select id="fuelType" name="fuel_type">
                            <option value="">Select Fuel Type</option>
                            <option value="diesel">Diesel</option>
                            <option value="petrol">Petrol/Gasoline</option>
                            <option value="electric">Electric</option>
                            <option value="hybrid">Hybrid</option>
                            <option value="lpg">LPG</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="tankCapacity">Fuel Tank Capacity</label>
                        <input type="text" id="tankCapacity" placeholder="e.g. 80 liters" name="tank_capacity">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="features">Special Features</label>
                        <textarea id="features" placeholder="List any special features or equipment installed on this vehicle" name="features"></textarea>
                    </div>
                </div>
            </div>
            
            <!-- <div class="form-section">
                <h3 class="section-title">
                    <span class="step">3</span>
                    Status & Maintenance
                </h3>
                <div class="form-row">
                    <div class="form-group full-width">
                        <label>Initial Status*</label>
                        <div class="status-toggle">
                            <div class="toggle-option active">
                                <div class="toggle-icon">✓</div>
                                <div>Active</div>
                            </div>
                            <div class="toggle-option">
                                <div class="toggle-icon">🔧</div>
                                <div>Maintenance</div>
                            </div>
                            <div class="toggle-option">
                                <div class="toggle-icon">⏸</div>
                                <div>Inactive</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="mileage">Current Mileage*</label>
                        <input type="number" id="mileage" placeholder="e.g. 5000">
                    </div>
                    <div class="form-group">
                        <label for="lastService">Last Service Date</label>
                        <input type="date" id="lastService">
                    </div>
                    <div class="form-group">
                        <label for="nextService">Next Service Due</label>
                        <input type="date" id="nextService">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group full-width">
                        <label for="maintenanceNotes">Maintenance Notes</label>
                        <textarea id="maintenanceNotes" placeholder="Any notes about maintenance requirements or history"></textarea>
                        <div class="service-records">

                        </div>
                    </div>
                </div>
            </div> -->
            
            <!-- <div class="form-section">
                <h3 class="section-title">
                    <span class="step">4</span>
                    Vehicle Image
                </h3>
                <div class="form-row">
                    <div class="form-group full-width">
                        <div class="image-upload">
                            <div class="upload-icon">📷</div>
                            <p class="upload-text">Drag and drop your vehicle image here, or</p>
                            <div class="browse-btn">Browse Files</div>
                            <p class="file-types">Supported formats: JPG, PNG, GIF (max 5MB)</p>
                        </div>
                    </div>
                </div>
            </div> -->
            
            
        </div>
        
        <div class="modal-footer">
            <button class="btn btn-secondary">Cancel</button>
            <input type="submit" class="btn btn-primary" value="Add Vehicle" name="save">
        </div>
        </form>
    </div>

    <?php   
        if(isset($_POST['save'])){
            $plate_number = $_POST['plate_number'];
            $vehicle_name = $_POST['vehicle_name'];
            $vehicle_type = $_POST['vehicle_type'];
            $make = $_POST['make'];
            $model = $_POST['model'];
            $year = $_POST['year'];
            $capacity = $_POST['capacity'];
            $max_volume = $_POST['max_volume'];
            $dimensions = $_POST['dimensions'];
            $fuel_type = $_POST['fuel_type'];
            $tank_capacity = $_POST['tank_capacity'];
            $features = $_POST['features'];

            $conn->query("INSERT INTO vehicles VALUES('$plate_number','$vehicle_name', '$vehicle_type', '$make', '$model', '$year', '$capacity', '$max_volume', '$dimensions', '$fuel_type', '$tank_capacity', '$features')");
        }
    ?>