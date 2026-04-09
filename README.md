# Rural Development Programme (RDP) Score Calculator

An interactive web application developed for the **Region of Attica** to help farmers calculate their eligibility score for EU-funded agricultural grants.

## 💡 Overview
This tool automates the complex scoring logic of the Greek Rural Development Programme, specifically for Young Farmers (Sub-measure 6.1) and Investment Plans (Sub-measure 4.1).

### Key Impact
* **Official Use:** Successfully deployed on the official website of the Region of Attica.
* **Citizen Service:** Provided a user-friendly way for applicants to estimate their score based on official FEK (Government Gazette) criteria.

## 🛠 Technical Stack
* **Backend:** PHP (Procedural) using **PHP Sessions** for multi-page state management.
* **Frontend:** HTML5, CSS3, and **JavaScript (jQuery/AJAX)** for dynamic form behavior.
* **Database:** MySQL (used for population data and regional classifications).

## 🧩 Features & Logic
* **Dynamic Location Mapping:** Uses JavaScript to dynamically filter Municipalities and Communities based on the selected Region (implemented in `page_2.php`).
* **Complex Business Logic:** The `proccess.php` engine calculates scores based on:
    * **Standard Output (SO):** Economic size calculation of the holding.
    * **Geographical Criteria:** Automated detection of mountainous or insular status.
    * **Sector-Specific Rules:** Bonuses for livestock, organic farming, or specific crop types.
* **Input Validation:** Client-side and server-side checks to ensure data integrity.

## 📂 Project Structure
- `page_1.php` to `page_5.php`: The 5-stage application wizard.
- `proccess.php`: The core calculation engine.

## Development Context & Evolution
This project was developed using **Procedural PHP**, which was the standard approach at the time of its creation to meet urgent public service needs. 

Since then, I have transitioned to **Object-Oriented Programming (OOP)** and modern software architecture patterns. I keep this project in its original form as a testament to its real-world impact and my journey in software development.

## 🚀 Getting Started
To run this application locally:
1. Clone the repository.
2. Import the `points_paa.sql` file (found in the `/database` folder) into your MySQL server.
3. Configure your database credentials in `connect_db.php`.
4. Run it using a local server environment like XAMPP or WAMP.
- `fun_katoikia.js`: JavaScript logic for dynamic location selection.
- `connect_db.php`: Database connection (credentials omitted).
