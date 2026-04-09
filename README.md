# Rural Development Programme (RDP) Score Calculator

This web application was developed during my tenure at the **Region of Attica** to assist potential beneficiaries of the **Rural Development Programme of Greece**.

## 💡 Project Overview
The application automates the eligibility scoring process for agricultural grants, specifically for:
* **Sub-measure 6.1:** Start-up aid for young farmers.
* **Sub-measure 4.1:** Support for investments in agricultural holdings (Improvement Plans).

### Real-World Impact
The tool was hosted on the official website of the Region of Attica, providing transparency and immediate feedback to hundreds of applicants and consultants.

## 🛠 Technical Analysis
The project is built with **Procedural PHP**, **MySQL**, and **JavaScript**.

### Key Features:
* **Multi-stage Wizard:** A 5-page form process using PHP Sessions to maintain state.
* **Complex Business Logic:** The `proccess.php` script implements sophisticated scoring algorithms based on:
    * Education and social criteria (e.g., unemployment months, agricultural degree).
    * Geographical location (Mountainous/Insular areas).
    * Economic Size (Standard Output calculation).
    * Sector-specific bonuses (e.g., livestock, organic farming).
* **Dynamic Database Integration:** Uses MySQL to fetch population data and regional classifications for location-based scoring.
* **Input Validation:** Server-side checks for data integrity (e.g., `ctype_digit` for numerical inputs).

## 📂 Project Structure
- `page_1.php` to `page_5.php`: User interface and data collection stages.
- `proccess.php`: The main calculation engine that processes session data and generates scores.
- `connect_db.php`: Database connection configuration.
- `scripts/`: Client-side logic for dynamic form elements (e.g., `fun_katoikia.js`).
