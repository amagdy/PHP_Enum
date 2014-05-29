PHP_Enum
========

An Enum class to write safer PHP code. So, instead of using strings or constants it is safer to use Enums. 

Sample Usage
-------------

    <?
    require('Enum.php');

    // Enum with numeric values
    enum('Month', array(
        'January' => 1,
        'February' => 2,
        'March' => 3,
        'April' => 4,
        'May' => 5,
        'June' => 6,
        'July' => 7,
        'August' => 8,
        'September' => 9,
        'October' => 10,
        'November' => 11,
        'December' => 12
        )
    );

    // Enum with NULL values
    enum('Car', array('BMW', 'Toyota', 'Fiat', 'Nissan'));

    // Safe usage of the Enum
    function processMonth (Month $month) {
        print $month->getName() . " => " . $month->getValue() . "\n";
    }

    function processCar (Car $car) {
        print $car->getName() . "\n";
    }

    processMonth(Month::December());
    processCar(Car::BMW());

