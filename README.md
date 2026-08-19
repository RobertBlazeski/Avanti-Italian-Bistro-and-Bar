# Avanti Italian Bistro & Bar

A full-featured restaurant web application built with PHP Laravel, featuring role-based access for restaurant owners and customers, with a custom-designed gold-and-black interface.

## Features

**For customers (Users):**
- Browse the menu and place food orders
- Make table reservations

**For restaurant owners:**
- Create, update, and delete menu items
- Manage and review reservations
- View incoming orders and update their status (e.g. pending → preparing → completed)

## Design
Custom UI with a sleek gold-and-black color scheme and hand-made icons for each food category, rather than generic stock icons.

## Stack
- PHP / Laravel
- MySQL

## Testing
This project includes performance and load testing using k6, covering smoke, load, and stress test scenarios, run both locally and against a Dockerized deployment on Render.

## Setup
1. `composer install`
2. Copy `.env.example` to `.env` and configure your database credentials
3. `php artisan migrate`
4. `php artisan serve`

## Status
Built as a software testing course project. The hosted instance is not currently active — clone and run locally to try it out.
