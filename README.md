# Citruse App

A modern web application built with Laravel 12, Vue 3, and Inertia.js, featuring a beautiful UI powered by Tailwind CSS.

## Tech Stack

- **Backend**: Laravel 12
- **Frontend**: Vue 3 + Inertia.js
- **Styling**: Tailwind CSS
- **Database**: SQLite (development)
- **Testing**: Pest PHP

## Prerequisites

- PHP 8.2 or higher
- Node.js 18 or higher
- Composer
- npm or yarn

## Installation

1. Clone the repository:
```bash
git clone https://github.com/DevinNorgarb/citruse
cd citruse
```

2. Install PHP dependencies:
```bash
composer install
```

3. Install JavaScript dependencies:
```bash
npm install
```

4. Set up environment:
```bash
cp .env.example .env
php artisan key:generate
```

5. Set up the database:
```bash
php artisan migrate
```

## Development

To start the development server with all necessary services:

```bash
composer dev
```


## Testing

Run the test suite:

```bash
composer test
```


## TODO List

Add Logic to the app in the controllers and services.

1. **Testing**
   - [ ] Write unit tests
   - [ ] Add feature tests
   - [ ] Set up CI/CD pipeline

2. **Documentation**
   - [ ] Add API documentation
   - [ ] Create user guide
   - [ ] Document deployment process


## License

This project is licensed under the MIT License - see the LICENSE file for details.
