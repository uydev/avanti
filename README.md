# Avanti

# Setup

Just run the following commands:
```
git clone https://github.com/uydev/avanti.git
```

# Run the application

To run the application in menu mode type the following in the terminal:
```
php application.php menu
```

Alternatively, you can run a script with default fixed values by typing in the terminal:
```
php index.php
```

# Run the unit tests

```
vendor/bin/phpunit test/TestCase.php
```

# Considerations

If more time was spent on this task it would have been nice to add validation for the inputs made on the terminal such as the longitude, latitude. The addition of exception handling with try-catch blocks would be a definite welcome. And lastly, the unit tests is using real-time data, so mocking of the API response would allow for response data to be compared with expected json data and verifying the values themselves.
