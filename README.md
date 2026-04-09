# 🎓 IFound MDX – Campus Lost & Found Matching System

## 📌 Overview

IFound MDX is a web-based system developed to improve how lost and found items are handled within a university environment. Instead of relying on manual reporting or physical notice boards, this system allows users to report lost or found items digitally and automatically identifies possible matches.

The goal of the project is to make the recovery process faster, more reliable, and user-friendly by combining a structured database with a simple matching mechanism.

---

## 🚀 Key Features

- User registration and secure login system  
- Report lost items with detailed information  
- Report found items with location and date  
- Automatic matching based on category and item details  
- Notification system for possible matches  
- Personal dashboard for each user  
- Clean and simple user interface  

---

## 🛠️ Technologies Used

- **PHP** – Backend logic and server-side processing  
- **MySQL** – Database management  
- **HTML & CSS** – Frontend design  
- **XAMPP** – Local development environment  

---

## 💻 How to Run the Project

This project is designed to run on a local server using XAMPP.

### Step 1: Install XAMPP  
Download and install XAMPP from:  
https://www.apachefriends.org/index.html  

---

### Step 2: Start Services  
Open the XAMPP Control Panel and start:
- Apache  
- MySQL  

---

### Step 3: Place Project Folder  
Copy the project folder into:

C:\xampp\htdocs\lost_found_system

---

### Step 4: Import the Database  

1. Open your browser and go to:  
   http://localhost/phpmyadmin  

2. Click on **Import**  

3. Select the file included in this project:  
   lost_found_system.sql  

4. Click **Go**

This will automatically create all required tables and sample data.

---

### Step 5: Check Configuration  

Open the file `config.php` and make sure the database settings match your local setup:

```php
$host = "127.0.0.1";
$user = "root";
$password = "";
$database = "lost_found_system";
```



### Step 6: Run the Application

Open your browser and go to:

http://localhost/lost_found_system

---

🧪 Testing

The system has been tested for:
	-	User registration and login
	-	Reporting lost and found items
	-	Matching functionality
	-	Notifications
	-	Multi-user usage

---

📊 System Workflow
	-	User registers and logs in
	-	User reports lost or found item
	-	Data is stored in database
	-	System compares items using matching logic
	-	If a match is found, a notification is shown
	-	User views matches in dashboard

---

⚠️ Limitations
	-	Matching is based on basic logic
	-	No image-based matching
	-	No real-time notifications
	-	Requires manual refresh

---
🚀 Future Improvements
	-   Add image upload feature
	-	Improve matching using AI
	-	Email or push notifications
	-   Admin panel for verification
	-   Mobile-friendly design

---
👨‍💻 Author

 - Yug Patel
 - M00958497
 - Final Year Project – Middlesex University