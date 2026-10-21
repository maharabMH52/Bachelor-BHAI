# Bachelor Bhai 🏠

### An All-in-One Living Solution for Bachelors, Students, and Young Professionals

Bachelor Bhai is a web-based platform designed to make independent living easier, more convenient, and more affordable. It brings together essential everyday services, including house rentals, used home appliances, roommate matching, meal services, and home-shifting assistance, under one platform.

Finding accommodation, purchasing household essentials, arranging meals, and relocating to a new place can be challenging, particularly for students and young professionals living independently. Bachelor Bhai aims to simplify these tasks by providing a centralized platform where users can explore services, publish advertisements, connect with other users, and manage their daily living needs.

The project was developed as part of the **System Analysis and Design Laboratory (CSE 3412)** at United International University.

---

## 📌 Table of Contents

- [Project Overview](#-project-overview)
- [Problem Statement](#-problem-statement)
- [Project Objectives](#-project-objectives)
- [Key Features](#-key-features)
- [How the Platform Works](#-how-the-platform-works)
- [User Roles](#-user-roles)
- [Credit-Based System](#-credit-based-system)
- [Technology Stack](#-technology-stack)
- [System Architecture](#-system-architecture)
- [Database Design](#-database-design)
- [Security and Quality Considerations](#-security-and-quality-considerations)
- [Project Scope](#-project-scope)
- [Future Improvements](#-future-improvements)
- [Project Team](#-project-team)
- [Academic Information](#-academic-information)

---

## 🌟 Project Overview

Bachelor Bhai is designed specifically for people who need convenient and affordable solutions for independent living. Rather than requiring users to visit multiple websites, marketplaces, or service providers, the platform aims to bring several essential services together in one place.

Users can search for rental properties, publish property advertisements, buy or sell used household appliances, find roommates, request home-shifting services, and order meals or meal packages.

The platform also incorporates user authentication, property and advertisement management, reviews, complaints, and an administrative dashboard to support the management of platform activities.

**The core idea is simple: make independent living more manageable by connecting essential services through a single digital platform.**

## ❗ Problem Statement

Students, bachelors, and young professionals who live away from their families often face several practical challenges:

- **Finding accommodation:** Locating suitable rental houses or apartments within a preferred location and budget can be time-consuming.
- **Buying household essentials:** Purchasing new appliances can be expensive, while finding suitable second-hand products can be difficult.
- **Finding compatible roommates:** People may struggle to find available rooms, suitable roommates, or shared accommodation.
- **Managing daily meals:** Preparing meals every day can be challenging for people with busy academic or professional schedules.
- **Relocating to a new home:** Moving furniture and other household belongings requires planning, transportation, and coordination.
- **Managing multiple services:** Using separate platforms for housing, appliances, meals, and relocation creates additional effort.

Bachelor Bhai addresses these challenges by integrating the corresponding services into a centralized web-based solution.

## 🎯 Project Objectives

The primary objectives of Bachelor Bhai are to:

1. Provide a centralized platform for essential bachelor-friendly services.
2. Simplify the process of finding and advertising rental properties.
3. Facilitate the buying and selling of used household appliances.
4. Help users find roommates and shared accommodation.
5. Provide access to convenient and budget-friendly meal services.
6. Make home relocation easier through a dedicated shifting service.
7. Introduce a credit-based mechanism for selected platform activities.
8. Improve trust through user verification, advertisement management, reviews, and complaints.
9. Reduce the time and effort required to manage everyday living arrangements.

## ✨ Key Features

### 1. 🏠 House Rental Management

The house rental module connects people searching for accommodation with users who want to rent out their properties.

**For property owners and advertisers:**
- Publish rental advertisements.
- Upload property images.
- Provide property location and descriptions.
- Include rental prices, utilities, and relevant property details.
- Provide contact information through the platform's intended workflow.

**For people searching for accommodation:**
- Browse available rental properties.
- Search for properties based on their preferences and location.
- Review property information before deciding to contact the advertiser.
- Access advertiser contact details through the credit-based system.

The module is intended to make finding and advertising bachelor-friendly accommodation more straightforward.

### 2. 🛋️ Used Home Appliances Marketplace

The home appliances module provides a marketplace where users can buy and sell pre-owned household products.

Its intended features include:

- Publishing product advertisements.
- Uploading product images.
- Adding product descriptions and categories.
- Providing price and seller contact information.
- Searching for desired products.
- Negotiating prices through a bargaining facility.

The project presentation also describes free home delivery as part of the intended service offering. The actual availability of delivery depends on the implemented functionality and operational arrangements.

This module helps sellers find potential buyers while allowing users to explore more affordable alternatives to purchasing new appliances.

### 3. 🚚 Home-Shifting Service

Moving to a new home can involve considerable time, effort, and logistical planning. Bachelor Bhai includes a dedicated module intended to simplify this process.

Users can submit a home-shifting request by providing relevant information, including:

- Name and contact details.
- Current location.
- Destination location.
- An estimated list of items that need to be moved.

According to the project report, a representative is intended to contact the user within one hour to gather additional information and explain the service's distance-based pricing policy.

This module aims to connect users with assistance for relocating their household belongings.

### 4. 🍱 Meal Service

The meal service module is designed for users who need convenient, affordable food options while living independently.

Its intended capabilities include:

- Ordering individual meals.
- Exploring available food options.
- Choosing monthly meal packages.
- Selecting customized meal plans where offered.
- Managing relevant order information.

The system is intended to accommodate users who prefer occasional meal orders as well as those who need a more regular meal arrangement.

### 5. 🤝 Roommate Matching

The roommate module helps users find shared accommodation and connect with people seeking roommates.

**For users looking for roommates:**
- Publish roommate-seeking advertisements.
- Provide information about their accommodation and preferred location.
- Review applications from potential roommates.
- View relevant applicant information.
- Accept or reject roommate requests.

**For users seeking a shared room:**
- Browse available roommate opportunities.
- Explore property and location details.
- Submit a request to join a shared accommodation arrangement.
- Provide the information required for an application.

This feature aims to make finding shared accommodation more organized and convenient.

### 6. 💳 Credit-Based Transaction System

Bachelor Bhai introduces a platform credit mechanism for selected activities.

According to the project report, the proposed credit requirements are:

| Activity | Credit requirement |
|---|---:|
| Publish a house rental advertisement | 10 credits |
| Access a property's contact details | 5 credits |

The report also describes purchasing credits through payment methods such as bKash, Nagad, and bank cards.

These values describe the project's documented business rules. Actual payment gateway integration, credit purchasing, and transaction processing should be verified against the implemented source code.

### 7. ⭐ Reviews and Complaints

The platform's intended feedback system allows users to share their experiences and report issues.

Its documented capabilities include:

- Submitting service reviews.
- Reporting problems or submitting complaints.
- Forwarding complaints to the administrative dashboard.
- Supporting administrative review of user feedback.

This functionality is intended to help improve service quality, accountability, and user confidence.

### 8. 🛡️ Administrative Dashboard

The administrative dashboard is intended to provide centralized management of the platform.

Administrators are expected to manage activities such as:

- Reviewing and verifying advertisements.
- Approving or rejecting advertisements.
- Managing registered users.
- Reviewing complaints and feedback.
- Monitoring reviews.
- Identifying and removing fraudulent accounts or advertisements where appropriate.
- Overseeing the platform's major service modules.

Administrative controls help maintain the quality and reliability of the platform.

---

## 🔄 How the Platform Works

The general user journey is designed around the following process:

1. **Register or log in:** Users create an account or access their existing account.
2. **Choose a service:** Users navigate to house rentals, appliances, roommate matching, meal services, or home shifting.
3. **Search or submit information:** Users search for available listings or provide the details needed to publish an advertisement or request a service.
4. **Review relevant details:** Users explore listings, product information, service options, or roommate applications.
5. **Complete the relevant action:** Depending on the service, users can contact advertisers, submit requests, purchase products, or place meal orders.
6. **Provide feedback:** Users can submit reviews or complaints through the intended feedback workflow.
7. **Administrative review:** Administrators oversee listings, user activities, and reported issues.

The exact workflow and availability of each step depend on the implemented version of the application.

## 👥 User Roles

The project documentation identifies three main types of platform participants.

| Role | Responsibilities |
|---|---|
| General User | Registers, searches listings, explores services, and submits relevant requests. |
| Advertiser or Service Requester | Publishes property or appliance advertisements, seeks roommates, or requests meals and shifting services. |
| Administrator | Manages users, advertisements, verification, reviews, complaints, and other administrative activities. |

A single registered user may perform different activities depending on their needs.

## 🧰 Technology Stack

The project presentation lists the following technologies and tools.

| Technology | Intended role |
|---|---|
| HTML | Structures the web pages. |
| CSS | Styles the user interface. |
| JavaScript | Supports client-side interactions. |
| Bootstrap | Provides responsive layout and interface components. |
| PHP | Supports server-side application logic. |
| MySQL | Stores application data in a relational database. |
| phpMyAdmin | Provides a graphical interface for managing the MySQL database. |
| Laravel | Listed as a framework in the project presentation. |
| Express | Also listed in the project presentation. |

**Important:** The presentation lists both Laravel and Express, but the documents do not establish exactly how these frameworks are used together or whether both are present in the final implementation. The actual repository should be checked before presenting every listed technology as a confirmed dependency.

## 🏗️ System Architecture

The project report describes a client-server architecture.

At a conceptual level, the system consists of the following components:

- **Client layer:** The browser-based interface through which users interact with the platform.
- **Application layer:** The server-side logic responsible for processing requests and applying business rules.
- **Database layer:** The relational data store used to maintain user information, property listings, appliance advertisements, roommate requests, meal orders, shifting requests, credits, reviews, and complaints.
- **Administration layer:** The management interface through which administrators oversee users and platform activities.

The intended request flow is:

```text
             User / Administrator
                      |
                      v
               Web Browser
                      |
                      v
            User Interface Layer
            HTML / CSS / Bootstrap
                      |
                      v
             Application Server
              PHP / JavaScript
                      |
                      v
                MySQL Database
                      |
                      v
             Stored Application Data
```

This diagram illustrates the documented architectural concept, not a verified diagram of the repository's actual implementation.

## 🗄️ Database Design

The project report describes a relational database structure for managing the platform's primary data.

The documented data categories include:

- **User information:** Usernames, email addresses, phone numbers, hashed passwords, identity-verification information, and credit balances.
- **Administrator information:** Administrative names, contact details, email addresses, and hashed passwords.
- **House rental information:** Property images, locations, descriptions, rental prices, utilities, and advertiser details.
- **Home appliance information:** Product categories, images, descriptions, pricing, and seller contact information.
- **Home-shifting information:** User details, current and destination locations, and lists of items to be moved.
- **Roommate information:** Seeker details, property information, advertisements, applications, and request statuses.
- **Meal service information:** User details, order identifiers, ordered meals, quantities, and subscription information.
- **Feedback information:** Reviews and complaints.
- **Credit information:** User credits and related transaction data.

The report also discusses entity-relationship diagrams, entities, attributes, relationships, and relational database normalization as part of the database design process.

The exact table names, relationships, schema, and normalization level should be confirmed from the actual database files.

## 🔐 Security and Quality Considerations

The project documentation identifies several important system-quality considerations.

### Authentication and Data Protection
- User and administrator accounts require authentication.
- The report specifies storing hashed passwords.
- User identity and account information are intended to be handled through controlled access.

### Verification and Moderation
- Advertisements are intended to undergo administrative verification.
- Administrators can review reported issues and take action against fraudulent users or listings.

### Availability and Usability
- The platform is designed for browser-based access.
- Search and filtering are intended to help users locate relevant properties, products, and services.
- The system is intended to support access to services throughout the day.

### Data Recovery
- The report discusses database backups and recovery procedures to reduce the risk of data loss.

These are documented design goals and requirements; they should not be interpreted as proof that every security, backup, or availability mechanism is currently implemented or tested.

## 📦 Project Scope

Bachelor Bhai focuses on integrating essential services for independent living into a single web platform.

**Included in the documented scope:**
- House rental advertisements and property searches.
- Used home appliance advertisements and marketplace activities.
- Home-shifting requests.
- Individual and subscription-based meal services.
- Roommate advertisements and applications.
- Credit-based access to selected platform activities.
- Reviews and complaints.
- User authentication and administrative management.

**Outside the confirmed scope of the documentation:**
- A dedicated native Android or iOS application.
- A production-ready online payment gateway.
- Automated real-time roommate recommendations.
- AI-powered property or product recommendations.
- Verified commercial delivery and relocation operations.

These additional capabilities should only be claimed if they have been independently implemented.

## 🚀 Future Improvements

Potential improvements that could extend Bachelor Bhai include:

- **Advanced property search:** Add more detailed filters for rental prices, room types, facilities, and preferred locations.
- **Improved roommate matching:** Introduce preference-based matching for budgets, lifestyle, and accommodation requirements.
- **Online payment integration:** Implement secure payment processing and transaction verification for credit purchases.
- **Notifications:** Notify users about new listings, roommate requests, advertisement approvals, and order updates.
- **Messaging:** Allow users to communicate more conveniently with advertisers and potential roommates.
- **Enhanced verification:** Strengthen identity verification and listing moderation.
- **Mobile-friendly experience:** Improve responsive design and explore dedicated mobile applications.
- **Analytics dashboard:** Provide administrators with insights into user activity, service usage, and reported issues.
- **Stronger security:** Apply appropriate authorization, input validation, secure session management, and data-protection practices.
- **Testing and documentation:** Expand automated tests, document database setup, and provide clearer deployment instructions.

These are suggestions for future development rather than claims about existing functionality.

## 👨‍💻 Project Team

Bachelor Bhai was developed collaboratively by the following team members:

- **Md. Rakibur Rahman Lipu**
- **Abdullah Abrar Labib**
- **Zawed Bishwas**
- **Maharab Hossain**

The project was prepared as part of a university laboratory course in Computer Science and Engineering.

## 🎓 Academic Information

- **Project Name:** Bachelor Bhai
- **Course:** System Analysis and Design Laboratory
- **Course Code:** CSE 3412
- **Institution:** United International University
- **Project Type:** Web-based service platform
- **Domain:** Housing, marketplaces, and independent-living services

## 📄 Conclusion

Bachelor Bhai aims to make independent living easier by bringing essential lifestyle services together in one centralized platform. By combining house rentals, used household appliances, roommate matching, meal services, and home-shifting assistance, the project addresses several practical challenges faced by students, bachelors, and young professionals.

Beyond its service modules, the project explores important software engineering concepts, including client-server architecture, relational database design, authentication, administrative management, and functional and non-functional requirements.

The project represents an effort to apply web development and system analysis principles to a practical, user-oriented problem.

---

**Bachelor Bhai — Simplifying Independent Living, One Service at a Time.**
