<?
require("Enum.php");

/* 
Declare a new Enum using the function enum()
*/

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



// Test code
function process (Month $enum) {
	print $enum->getName() . " => " . $enum->getValue() . "\n";
}

process(Month::December());

foreach(Month::getKeys() as $k => $v) {
	process($v);
}
