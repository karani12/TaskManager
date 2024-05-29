## Task Manager

This is a simple task manager that manages tasks for a user.

## Features
- Add a task
- Delete a task
- List all tasks
- Filter tasks by status & priority
- Update a task
- Google login
- Email login
- Swipe to delete on tasks on mobile

## Tech Stack
- Laravel
- Inertia && Livewire(blade templates atm-no intercation needed for landing page)
- Vue.js

## Installation
1. Clone the repository
2. Run `composer install`
3. Run `npm install`
4. create a `.env` file and copy the contents of `.env.example` to it
5. Connect to a database by modifying the values depending on the port assigned, user and password(Make sure the user is granted the priviledges to access the database you create)
6. Run `php key:generate`
7. Run `php artisan migrate --seed`
8. Add the following keys to your `.env` file
    - `GOOGLE_CLIENT_ID`
    - `GOOGLE_CLIENT_SECRET`
    - `GOOGLE_REDIRECT-URI`
    to get these keys, visit the google developer console and create a new project.(This will enable google login)


9. Run `npm run dev`
10. Run `php artisan serve`

## usage
- Visit `http://localhost:8000` to view the application
- Click login or regsiter to create an account
- Choose whether to signin by email or google
- Add a task
- Delete a task


> Acess generated data by logging in with the email `test@example.com` and password `password`
