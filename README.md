
# Task Management Tyro Solution

This is a Laravel 11 project whic include user authentication with sanctum, policy for role and permision task management. There are admin, maneger and employee.

## Prerequisites

Before starting need to installed on machine:
1. **PHP**: Version 8.2 or above
2. **Composer**: PHP’s dependency manager
4. **Database**: MySQL
6. **Git**: For version control

## Installation

### Step 1: Clone the Repository

```bash
git clone https://github.com/alkafi1/task-tyro.git
cd task-tyro
```
### Step 2: Install Dependencies

Run the following command to install all the PHP dependencies:
if there no vendor then run
```bash
composer install
```

## Environment Setup

### Step 3: Set Up Environment Variables
if .env not exists then
1. Duplicate the `.env.example` file and rename it to `.env`:

    ```bash
    cp .env.example .env
    ```

2. Update the following values in the `.env` file:

    - **Database Configuration**:
      ```plaintext
      DB_CONNECTION=mysql
      DB_HOST=127.0.0.1
      DB_PORT=3306
      DB_DATABASE=database_name
      DB_USERNAME=root
      DB_PASSWORD=dbpassword
      ```


## Database Migration and Seeding

### Step 4: Migrate and Seed the Database

To set up database schema and seed data, run the following commands:

```bash
php artisan migrate
php artisan db:seed
```

This will create three users:
- **Admin**: `admin@tyro.com` with password `123456`
- **Manager**: `manager@tyro.com` with password `123456`
- **Employee**: `employee@tyro.com` with password `123456`

It will also create 5 sample task.

## API Endpoints

Here is a list of available API endpoints. Authentication via sanctum token is required for certain routes.

### Public Endpoints

1. **Register**: 
   - **POST** `/api/register`
   -These endpoints require a valid token in the `X-Include-Token = true` header.
   - Sample Request Body:
     ```json
     {
         "name": "Test User",
         "email": "test@tyro.com",
         "password": "123456",
         "role": "Admin",
     }
     ```

2. **Login**: 
   - **POST** `/api/login`
   -These endpoints require a valid token in the `X-Include-Token = true` header.
   - Sample Request Body:
     ```json
     {
         "email": "admin@tyro.com",
         "password": "123456"
     }
     ```
### Authenticated User Endpoints
These endpoints require a valid token in the `Authorization: Bearer <token>` header.
Its get after successfully login

3. **Get Authenticated User Info**: 
   - **POST** `/api/user/profile`
   - Sample Request Body:
     ```json
     {
         "email": "admin@tyro.com",
         "password": "123456"
     }
     ```
4. **Logout**: 
   - **POST** `/api/user/logout`
   - Sample Request Body:
     ```json
     {
         "email": "admin@tyro.com",
         "password": "123456"
     }
     ```
### Task Management Endpoints
These endpoints require a valid token in the `Authorization: Bearer <token>` header.
Its get after successfully login
1. **task list**: 
   - **GET** `/api/task`

2. **task filter**: 
These endpoints require a valid token in the `status: pendinng/complted/in-progress` header.
   - **GET** `/api/task`

3. **task show single**: 
   - **GET** `/api/task/{id}`

4. **Task Store**: 
   - **POST** `/api/task`
   - Sample Request Body:
     ```json
     {
        "title" : "Task new 1",
        "description" : "New Task Description 1",
        "status" : "pending",
        "assigned_to_user_id" : "1"
    }
     ```

5. **Task Update**: 
   - **PUT/PATCH** `/api/task`
   - Sample Request Body:
     ```json
     {
        "title" : "Task Update 1",
        "description" : "Update Task Description 1",
        "status" : "pending",
        "assigned_to_user_id" : "1"
    }
     ```

6. **task delete**: 
   - **DELETE** `/api/task/{id}`



## Technologies Used

- **Laravel 11**: PHP framework for backend development
- **Sanctum Authentication**: Sanctum Tokens for securing API endpoints
- **MySQL**: Relational database for storing users, task
- **Composer**: Dependency manager for PHP
- **PHP**: PHP version 8.2 or above
