INTRODUCTION

This report outlines the design and implementation of the Adventure Parcel Transportation System (Adventurepts), developed to address inefficiencies in manual parcel handling for bus companies and other cargo logistics companies. 
The system enhances transparency, tracking accuracy, and user accessibility across all parcel logistics processes.

PROBLEM STATEMENT

The current operation of many parcel transportation systems, especially in developing regions, is hindered by outdated and inefficient methods of management. One of the most significant challenges is manual record-keeping, which often leads to errors, misplaced parcel information, and time-consuming administrative tasks. This traditional approach not only slows down operations but also reduces the reliability and transparency of parcel tracking.

Another major concern is poor customer communication. Customers are frequently left in the dark about the status of their parcels due to the lack of automated updates or real-time tracking systems. This gap in communication leads to dissatisfaction, mistrust, and an increased workload for support teams dealing with frequent inquiries.

In addition, data inconsistency or loss is a recurring problem. Without a centralized and secure digital system, parcel data is often stored in physical files or unstructured digital formats, making it vulnerable to loss, duplication, or manipulation. This compromises both accountability and decision-making.

Furthermore, there is currently no effective way to monitor delivery staff. Without a system to track deliveries in real-time or log staff activities, management lacks the visibility needed to ensure timely deliveries, optimize routes, and prevent misconduct or inefficiency.

Together, these challenges highlight the urgent need for a web-based parcel transportation system that enhances data accuracy, customer interaction, staff monitoring, and overall operational efficiency.

DEFINITION OF TERMS

SENDER

An individual or organization that initiates the shipment of a parcel through the system.

    Responsibilities:

        Register and log in to the system.

        Create parcel delivery requests.

        Provide details of the receiver and parcel (e.g., destination, weight, description).

        Track the parcel status.

        Receive notifications about delivery progress.

RECEIVER

The intended recipient of the parcel who receives updates and confirmation of delivery.

    Responsibilities:

        View parcel details and tracking status (if access is granted).

        Confirm receipt of parcel (optional feature).

        Provide feedback or complaint about service.

STAFF

Operational personnel responsible for handling, updating, and managing     parcels during transit.

    Responsibilities:

        Log in to manage assigned delivery tasks.

        Update parcel status (e.g., received, in transit, delivered).

        Scan parcels at different stations.

        Generate daily or location-specific parcel reports.

        Communicate with senders or receivers if needed.


ADMIN

The system supervisor with full access and control over system operations, users, and data.

    Responsibilities:

        Manage user accounts (sender, staff, etc.).

        Assign parcels or routes to staff.

        Monitor system activity and generate reports.

        Maintain parcel records and resolve disputes.

        Configure system settings (e.g., branch locations, pricing rules).

OBJECTIVES

    To eliminate manual record-keeping by implementing a digital platform that automates parcel data entry, storage, and retrieval.

    To enhance customer communication through integrated real-time notifications via email or SMS, and a user-friendly parcel tracking interface.

    To ensure data consistency and reliability by using centralized cloud-based databases with built-in validation, backup, and recovery mechanisms.

    To enable real-time monitoring of delivery staff by integrating staff activity logging and delivery status updates within the system.

SOFTWARE REQUIREMENTS SPECIFICATION

Functional Requirements

    FR1: The system shall allow staff to log in.
    FR2: The system shall allow staff to register parcel.
    FR3: The system shall allow receivers to track parcels via a tracking ID.
    FR4: The system shall allow staff to update parcel status.
    FR5: The system shall notify senders and receivers about parcel progress.
    FR6: The system shall allow admins to manage staff.
    FR7: The system shall generate reports on parcel delivery and staff activity.
    FR8: The system shall allow real-time monitoring of delivery staff activities.
    FR9: The system shall allow staff to print parcel receipt.

Non-Functional Requirements (Will be implemented at production stage)

    NFR1: The system shall be accessible 24/7 through any modern web browser.
    NFR2: The system shall respond to user actions within 3 seconds.
    NFR3: The system shall use SSL to encrypt data transmission.
    NFR4: The system shall store backups automatically every 24 hours.
    NFR5: The system shall be scalable to support over 10,000 users concurrently.

Technologies Used

Frontend: 

    HTML, CSS, JavaScript
    
Backend:
    
    PHP
    
Database:

    MySQL
Deployment:

    Localhost via Apache2
    
Mailer :

    PHPMailer
SMS Gateway :

    Beem bulk SMS
QR Code :

    JavaScript


Future Enhancements

    Vehicles management module
    Warehouse management module
    Add mobile app version
    Integrate GPS-based tracking
    Enable payment gateway for parcel billing
    Use AI to estimate delivery times based on traffic/route
