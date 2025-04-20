<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adventure Connection - Popup Card</title>
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
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
        }
        
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
            opacity: 80%;
        }
        
        /* Main Popup Container */
        .popup-card {
            background-color: var(--adventure-white);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 80%;
            position: relative;
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
    <!-- Demo Content -->
    <div class="popup-overlay">
        <div class="popup-card">
            <div class="popup-accent"></div>
            <div class="popup-header">
                <h2 class="popup-title">Schedule Maintenance</h2>
                <button class="popup-close">&times;</button>
            </div>
            <div class="popup-content">
                <!-- Alert Example -->
                <div class="popup-alert alert-info">
                    <div class="alert-icon">ⓘ</div>
                    <div class="alert-content">
                        <div class="alert-title">Maintenance Recommendation</div>
                        <p class="alert-message">This vehicle is due for regular maintenance based on its service schedule.</p>
                    </div>
                </div>
                
                <!-- Form Example -->
                <div class="form-group">
                    <label for="maintenance-type">Maintenance Type</label>
                    <select id="maintenance-type">
                        <option value="">Select type</option>
                        <option value="regular">Regular Service</option>
                        <option value="repair">Repair</option>
                        <option value="inspection">Safety Inspection</option>
                        <option value="tire">Tire Replacement</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="maintenance-date">Schedule Date</label>
                    <input type="date" id="maintenance-date">
                </div>
                
                <div class="form-group">
                    <label for="maintenance-notes">Notes</label>
                    <textarea id="maintenance-notes" placeholder="Add any specific instructions or notes..."></textarea>
                </div>
                
                <div class="divider"></div>
                
                <!-- Checklist Example -->
                <h3 style="margin-top: 0; margin-bottom: 15px; font-size: 16px;">Pre-maintenance Checklist</h3>
                <ul class="checklist">
                    <li class="checklist-item">
                        <div class="checklist-checkbox checked">✓</div>
                        <span class="checklist-label">Verify vehicle ID and registration</span>
                    </li>
                    <li class="checklist-item">
                        <div class="checklist-checkbox"></div>
                        <span class="checklist-label">Check for existing maintenance requests</span>
                    </li>
                    <li class="checklist-item">
                        <div class="checklist-checkbox"></div>
                        <span class="checklist-label">Verify service center availability</span>
                    </li>
                    <li class="checklist-item">
                        <div class="checklist-checkbox"></div>
                        <span class="checklist-label">Notify assigned driver</span>
                    </li>
                </ul>
            </div>
            <div class="popup-footer">
                <button class="popup-btn btn-secondary">Cancel</button>
                <button class="popup-btn btn-primary">Schedule Maintenance</button>
            </div>
        </div>
    </div>
    
    <!-- Other Popup Examples (These would be toggled via JavaScript in a real implementation) -->
    <div style="display: none;">
        <!-- Task Assignment Popup -->
        <div class="popup-card">
            <div class="popup-accent"></div>
            <div class="popup-header">
                <h2 class="popup-title">Assign Delivery Task</h2>
                <button class="popup-close">&times;</button>
            </div>
            <div class="popup-content">
                <div class="form-steps">
                    <div class="step-indicator completed">
                        <div class="step-circle">✓</div>
                        <div class="step-label">Select Vehicle</div>
                    </div>
                    <div class="step-indicator active">
                        <div class="step-circle">2</div>
                        <div class="step-label">Assign Driver</div>
                    </div>
                    <div class="step-indicator">
                        <div class="step-circle">3</div>
                        <div class="step-label">Schedule</div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="driver-select">Select Driver</label>
                    <select id="driver-select">
                        <option value="">Choose a driver</option>
                        <option value="driver1">John Smith</option>
                        <option value="driver2">Maria Rodriguez</option>
                        <option value="driver3">David Chen</option>
                        <option value="driver4">Sarah Johnson</option>
                    </select>
                </div>
                
                <div class="quick-actions">
                    <button class="quick-action-btn">Available Now</button>
                    <button class="quick-action-btn active">Experienced</button>
                    <button class="quick-action-btn">Same Region</button>
                </div>
                
                <div class="form-group">
                    <label for="delivery-notes">Special Instructions</label>
                    <textarea id="delivery-notes" placeholder="Add any special instructions for the driver..."></textarea>
                </div>
            </div>
            <div class="popup-footer">
                <button class="popup-btn btn-secondary">Back</button>
                <button class="popup-btn btn-primary">Next</button>
            </div>
        </div>
        
        <!-- Confirmation Popup -->
        <div class="popup-card small">
            <div class="popup-accent"></div>
            <div class="popup-header">
                <h2 class="popup-title">Confirm Deletion</h2>
                <button class="popup-close">&times;</button>
            </div>
            <div class="popup-content">
                <div class="popup-alert alert-warning">
                    <div class="alert-icon">⚠️</div>
                    <div class="alert-content">
                        <div class="alert-title">Warning</div>
                        <p class="alert-message">Are you sure you want to remove this vehicle from the fleet? This action cannot be undone.</p>
                    </div>
                </div>
            </div>
            <div class="popup-footer">
                <button class="popup-btn btn-secondary">Cancel</button>
                <button class="popup-btn btn-danger">Delete Vehicle</button>
            </div>
        </div>
        
        <!-- Success Notification Popup -->
        <div class="popup-card small">
            <div class="popup-accent"></div>
            <div class="popup-header">
                <h2 class="popup-title">Success</h2>
                <button class="popup-close">&times;</button>
            </div>
            <div class="popup-content">
                <div class="popup-alert alert-success">
                    <div class="alert-icon">✓</div>
                    <div class="alert-content">
                        <div class="alert-title">Vehicle Added Successfully</div>
                        <p class="alert-message">The new vehicle has been added to your fleet and is ready for assignment.</p>
                    </div>
                </div>
                
                <div class="quick-actions" style="margin-top: 20px;">
                    <button class="quick-action-btn">Assign Driver</button>
                    <button class="quick-action-btn">Schedule Delivery</button>
                    <button class="quick-action-btn">View Details</button>
                </div>
            </div>
            <div class="popup-footer">
                <button class="popup-btn btn-primary">Done</button>
            </div>
        </div>
    </div>
</body>
</html>