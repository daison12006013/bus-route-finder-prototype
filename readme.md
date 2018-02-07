# Prologue

This package uses a laravel's model, so it is not an agnostic itself, but later on I will convert this package to support other framework and not to bound the models.

# Installation

You need a laravel application atleast ~5.x, better to use Laravel 5.5 to have the package discovery.

To install this package to your laravel app, you need to run below

```
composer require daison/bus-router-sg
```

If your laravel app doesn't support a package discovery, then you need to add this class inside your `config/app.php@providers`

```
    'providers' => [
        // ...
        Daison\BusRouterSg\BusRouterSgServiceProvider::class
    ],
```

After installing, you need to create a database table and assign to your `.env` file

Execute `php artisan migrate` and `php artisan bus-router-sg:parse-json`

# Class API Test

To test the class matching logic, an example below will help you.

```
$instance = new Daison\BusRouterSg\Util\Match(
    $myLat = 1.37313809346006,
    $myLng = 103.89156818388481,
    $destLat = 1.38372439268243,
    $destLng = 103.76068878232401
);

$instance->handle();
```

As of now, the above will give you a lists of paths that you could use to render to your Google Map Api.

```
array:35 [
  0 => "1.37313809346006:103.89156818388481",
  1 => "1.37060695394614:103.89266808874676",
  2 => "1.36756333302324:103.8927594439902",
  3 => "1.36623834226067:103.89129134480065",
  // ...,
  32 => "1.37961719959059:103.76390959462616",
  33 => "1.38178063199093:103.76285898246775",
  34 => "1.38372439268243:103.76068878232401",
]
```

I'm currently working on the buses that you could take based on the routes returned, which you could find below **Pending Tasks**.

# Tests

To test the package, I wrote a simple test class inside the `tests/` folder.

Run `phpunit` under this root folder.

# Pending Tasks for this Prototype

- [x] Matching Logic
    - [x] Finding the nearest bus to take and the nearest bus to your destination.
    - [x] Using Dijkstra's Algorithm to connect each bus routes (lat and long).
    - [x] Compile the lists of buses to based on the routes (lat and long).
    - [x] Test
- [x] User Interface
    - [x] User Login
    - [x] Form that needs to put the current location or get the current user's location using the browser api.
- [ ] CRUD for buses
- [ ] CRUD for bus stations
- [ ] CRUD for locations
- [ ] Search using Postal Code
- [ ] Search using a freeform address input and determine the postal code
