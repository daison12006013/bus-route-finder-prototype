# Installation

```
composer require daison/bus-router-sg
```

You need a laravel application atleast ~5.x, better to use Laravel 5.5 to have the package discovery, else you need to add this class inside your `config/app.php@providers`

```
    'providers' => [
        // ...
        Daison\BusRouterSg\BusRouterSgServiceProvider::class
    ],
```

After installing, you need to create a database table and assign to your `.env` file

Execute `php artisan migrate` and `php artisan bus-router-sg:parse-json`

# Tests

To test the package, I wrote a simple test class inside the `tests/` folder.

Run `phpunit` under this root folder.

# Pending Tasks for this Prototype

- [ ] Matching Logic
    - [x] Finding the nearest bus to take and the nearest bus to your destination.
    - [x] Using Dijkstra's Algorithm to connect each bus routes (lat and long).
    - [ ] Compile the lists of buses to based on the routes (lat and long).
    - [x] Test
- [ ] User Interface
    - [ ] User Login
    - [ ] Form that needs to put the current location or get the current user's location using the browser api.
