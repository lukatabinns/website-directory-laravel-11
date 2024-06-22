# Laravel Web Directory API

This is a proof-of-concept Restful API built using Laravel, functioning as a web directory. A web directory is an online catalogue where various websites are listed, categorized, and ranked based on user actions. This project includes features such as user authentication, searching, submitting, voting on websites, and administrative controls.

## Project Overview

The purpose of this project is to create a web directory API that allows users to browse, search, submit, and vote on their favorite websites. The API is built with Laravel and uses Laravel Sanctum for authentication.

## Features

1. **Categorized Presentation of Websites**: 
    - Websites are presented in a categorized manner, making it easy for users to find content relevant to their interests.

2. **Search Functionality**:
    - Users can search for websites based on a search term. The search works in combination with categories and ranking and is optimized to handle queries efficiently even with a large number of records.

3. **User Authentication**:
    - Users can log in and log out, with their interactions being identifiable and linked to them. 

4. **Submit Favorite Websites**:
    - Authenticated users can submit their favorite websites to the directory.

5. **Voting System**:
    - Authenticated users can vote/unvote their favorite websites. Categories will show websites in order of how many votes they have, ensuring the most relevant content is always at the top.

6. **Administrative Controls**:
    - Administrators can delete websites when needed.

## Functional Requirements

- **User Tiers**: 
    - Three tiers of access: unauthenticated users, authenticated users, and administrators.
- **Categorized Display**: 
    - Websites are displayed in a categorized format for easy navigation.
- **Search Capability**: 
    - Users can search for websites efficiently, even with a large dataset.
- **Submission and Voting**: 
    - Users can submit and vote on websites. Votes determine the ranking within categories.
- **Administrative Actions**: 
    - Admins have the ability to delete websites.
- **Data Relationships**: 
    - A website can belong to multiple categories.
- **Vote Limitation**: 
    - Users can only vote for a website once.

## Technical Requirements

- **Production-grade Code**: 
    - Code should be written as if for a production system.
- **Efficiency**: 
    - Database migrations should consider structure, indexing, and optimizations.
- **Integration**: 
    - Consider how a client would consume the API (e.g., a JavaScript SPA).
- **Documentation**: 
    - Code should be easy to follow and understand, with appropriate comments.
- **Scalability**: 
    - The solution should handle heavy loads and large amounts of data effectively.

## Installation

1. **Clone the repository:**

   ```sh
   git clone https://github.com/your-username/web-directory-api.git
   cd web-directory-api
   
2. **Install dependencies:**

   composer install
   npm install

3. **Setup environment variables:**

   Copy the .env.example file to .env and configure your environment variables, especially the database settings.
   cp .env.example .env

4. **Generate application key:**

    php artisan key:generate

5. **Run migrations and seeders:**

   php artisan migrate --seed
   
6. **Serve the application:**

   php artisan serve

**Usage**

**API Endpoints**

**Public Endpoints**

    . GET /api/categories - List all categories
    . GET /api/categories/{id} - Get a single category

**Authenticated Endpoints**

    ' POST /api/categories - Create a new category
    ' PUT /api/categories/{id} - Update a category
    .DELETE /api/categories/{id} - Delete a category
    
**Authentication**

This project uses Laravel Sanctum for API authentication. You can generate tokens and authenticate users using Sanctum's built-in methods.



