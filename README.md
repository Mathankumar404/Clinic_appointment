# Clinic Appointment Management System

## 📌 Project Description
The Clinic Appointment Management System is a web-based application developed to manage clinic appointments efficiently. It provides separate panels for **Admin** and **Patient**, allowing smooth handling of doctors, appointments, and patient records.

The frontend of this project is built using **JavaScript**, while the backend is developed using **PHP**. The application uses a **MySQL** database to store and manage data securely. This system helps reduce manual work and improves appointment scheduling and tracking.

---

## 🛠️ Technologies Used
- **Frontend:** HTML, CSS, JavaScript  
- **Backend:** PHP  
- **Database:** MySQL  
- **Server:** Apache (XAMPP / WAMP)

---

## 👥 User Roles & Features

### 🔑 Admin Panel
- Admin login authentication  
- Doctor management (add, update, view doctors)  
- Appointment management (view and manage all appointments)

### 👤 Patient Panel
- Patient registration and login  
- Book appointments with available doctors  
- View booked appointments in *My Appointments*

---

## 🗄️ Database Configuration

When using this project on your local system, create a database named:

### Create Database

CREATE DATABASE clinic_app;
USE clinic_app;

### 📋 Table Structures

#### admins

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);
#### patients

CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
#### doctors

  CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    specialization VARCHAR(100) NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

#### appointments

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (doctor_id) REFERENCES doctors(id)
);

---


## ▶️ How to Run the Project
1. Install **XAMPP** or **WAMP**
2. Copy the project folder into the `htdocs` directory
3. Open **phpMyAdmin**
4. Create the database `clinic_app`
5. Create the required tables with the given structure
6. Start Apache and MySQL services
7. Open your browser and run:



---

## 🔐 Authentication
- Admin and Patient have separate login pages
- Passwords should be stored securely (recommended: password hashing)

---

## ✅ Advantages
- Simple and user-friendly interface  
- Efficient appointment scheduling  
- Organized admin and patient workflow  
- Suitable for small to medium clinics  

---

## 📌 Note
Make sure your database connection details in PHP files match your local server configuration.

---

## 📄 License
This project is created for learning and academic purposes.
