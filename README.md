🏎️ pGR1D — Car Racing Management System
A PHP + MySQL web application for managing car racers, cars, race schedules, and race results. Built as a university project by Somaya Hossain (ID: 24203030).

📌 Features

Racer Registration — Add new racers with personal details (name, age, city, nationality, phone)
Car Management — Insert and assign cars to registered racers with specs (speed, engine CC, color, team)
Edit & Delete — Full CRUD operations for both racers and cars
Race Schedules — View all upcoming and completed races with track info and dates
Race Results — Detailed per-race leaderboards showing position, finish time, and points
Search — Search any racer by ID and view their full profile, car, and race participation history


🗂️ Project Structure
racing_management/
│
├── db.php                  # Database connection
├── header.php              # Shared navbar + banner
├── footer.php              # Shared footer
│
├── index.php               # Home / landing page
├── register.php            # Register a new racer
├── insert_car.php          # Add a car and assign to racer
├── view.php                # View + manage all racers and cars (CRUD)
├── edit_racer.php          # Edit a racer's details
├── edit_car.php            # Edit a car's details
├── search.php              # Search racer by ID
├── race_schedules.php      # View all race schedules
├── upcoming_races.php      # Upcoming + completed race results
├── results.php             # Completed race results (detailed)
│
└── sql.txt                 # Full SQL schema + sample data

🗃️ Database Schema
Database Name: racing_management
TableDescriptionracersStores racer personal infocarsStores car specs, linked to a racertracksRace track details (name, location, length)racesRace events with date, track, and statusrace_resultsPer-race results (position, time, points)
Key Relationships
racers (1) ──── (many) cars
tracks (1) ──── (many) races
races  (1) ──── (many) race_results
racers (1) ──── (many) race_results
cars   (1) ──── (many) race_results

⚙️ Setup Instructions
Prerequisites

PHP 7.4+
MySQL 5.7+ or MariaDB
XAMPP / WAMP / LAMP (any local server)

Steps

Clone the repository

bash   git clone https://github.com/your-username/racing-management-system.git

Move files to your server's root

   XAMPP → htdocs/racing-management/
   WAMP  → www/racing-management/

Import the database

Open phpMyAdmin
Create a new database named racing_management
Import sql.txt (run as SQL)


Configure the connection in db.php

php   $host = 'localhost';
   $db   = 'racing_management';
   $user = 'root';
   $pass = '';       // change if you have a MySQL password

Run the app

   http://localhost/racing-management/index.php

📸 Pages Overview
PageURLPurposeHomeindex.phpLanding page with navigationRegister Racerregister.phpAdd a new racerInsert Carinsert_car.phpAdd a car and assign to racerView Allview.phpFull CRUD table for racers & carsEdit Raceredit_racer.php?id=XUpdate racer detailsEdit Caredit_car.php?id=XUpdate car detailsSearchsearch.phpSearch by racer IDRace Schedulesrace_schedules.phpView all racesResultsresults.phpCompleted race results

🛠️ Tech Stack
LayerTechnologyFrontendHTML5, CSS3 (vanilla)BackendPHP (procedural, mysqli)DatabaseMySQLFontsGoogle Fonts — Bebas Neue, OswaldServerXAMPP / WAMP

📋 Sample Data Included
The sql.txt file includes ready-to-use sample data:

6 Racers — Saad, Abeer, Zaman, Pranto, Rayan, Somaya Hossain
6 Cars — Ferrari, Red Bull, Mercedes, McLaren, Audi, Porsche
3 Tracks — Dhaka Grand Circuit, Chittagong Coastal Drag, Rajshahi Ring
3 Races — Bangladesh Grand Prix (Completed), Coastal Speed Festival (Completed), Rajshahi Open Cup (Upcoming)
Full race results for both completed races


👩‍💻 Author
Somaya Hossain
Student ID: 24203030

📄 License
This project is for educational purposes. Free to use and modify.
