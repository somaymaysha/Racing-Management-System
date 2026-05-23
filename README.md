# 🏎️ pGR1D — Car Racing Management System

A PHP + MySQL web application for managing car racers, cars, race schedules, and race results. Built as a university project by **Somaya Hossain **.

---

## 📌 Features

- **Racer Registration** — Add new racers with personal details (name, age, city, nationality, phone)
- **Car Management** — Insert and assign cars to registered racers with specs (speed, engine CC, color, team)
- **Edit & Delete** — Full CRUD operations for both racers and cars
- **Race Schedules** — View all upcoming and completed races with track info and dates
- **Race Results** — Detailed per-race leaderboards showing position, finish time, and points
- **Search** — Search any racer by ID and view their full profile, car, and race participation history

---

## 🗂️ Project Structure

```
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
```

---

## 🗃️ Database Schema

**Database Name:** `racing_management`

| Table          | Description                                  |
|----------------|----------------------------------------------|
| `racers`       | Stores racer personal info                   |
| `cars`         | Stores car specs, linked to a racer          |
| `tracks`       | Race track details (name, location, length)  |
| `races`        | Race events with date, track, and status     |
| `race_results` | Per-race results (position, time, points)    |

### Key Relationships

```
racers (1) ──── (many) cars
tracks (1) ──── (many) races
races  (1) ──── (many) race_results
racers (1) ──── (many) race_results
cars   (1) ──── (many) race_results
```

---

## ⚙️ Setup Instructions

### Prerequisites

- PHP 7.4+
- MySQL 5.7+ or MariaDB
- XAMPP / WAMP / LAMP (any local server)

### Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/your-username/racing-management-system.git
   ```

2. **Move files to your server's root**
   ```
   XAMPP → htdocs/racing-management/
   WAMP  → www/racing-management/
   ```

3. **Import the database**
   - Open **phpMyAdmin**
   - Create a new database named `racing_management`
   - Import `sql.txt` (run as SQL)

4. **Configure the connection** in `db.php`
   ```php
   $host = 'localhost';
   $db   = 'racing_management';
   $user = 'root';
   $pass = '';       // change if you have a MySQL password
   ```

5. **Run the app**
   ```
   http://localhost/racing-management/index.php
   ```

---

## 📸 Pages Overview

| Page | URL | Purpose |
|------|-----|---------|
| Home | `index.php` | Landing page with navigation |
| Register Racer | `register.php` | Add a new racer |
| Insert Car | `insert_car.php` | Add a car and assign to racer |
| View All | `view.php` | Full CRUD table for racers & cars |
| Edit Racer | `edit_racer.php?id=X` | Update racer details |
| Edit Car | `edit_car.php?id=X` | Update car details |
| Search | `search.php` | Search by racer ID |
| Race Schedules | `race_schedules.php` | View all races |
| Results | `results.php` | Completed race results |

---

## 🛠️ Tech Stack

| Layer | Technology |
|-------|------------|
| Frontend | HTML5, CSS3 (vanilla) |
| Backend | PHP (procedural, `mysqli`) |
| Database | MySQL |
| Fonts | Google Fonts — Bebas Neue, Oswald |
| Server | XAMPP / WAMP |

---

## 📋 Sample Data Included

The `sql.txt` file includes ready-to-use sample data:

- **6 Racers** — Saad, Abeer, Zaman, Pranto, Rayan, Somaya Hossain
- **6 Cars** — Ferrari, Red Bull, Mercedes, McLaren, Audi, Porsche
- **3 Tracks** — Dhaka Grand Circuit, Chittagong Coastal Drag, Rajshahi Ring
- **3 Races** — Bangladesh Grand Prix (Completed), Coastal Speed Festival (Completed), Rajshahi Open Cup (Upcoming)
- **Full race results** for both completed races

---

## 👩‍💻 Author

**Somaya Hossain**


---

## 📄 License

This project is for educational purposes. Free to use and modify.
