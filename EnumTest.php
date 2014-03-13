<?
require("Enum.php");

/* 
There are 2 ways to declare a new Enum: One uses the utility function enum()
The other one is by creating a class that extends Enum and enum items are put
as constants inside the Enum
*/

/*
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
/*/
class Month extends Enum {
	const January = 1;
	const February = 2;
	const March = 3;
	const April = 4;
	const May = 5;
	const June = 6;
	const July = 7;
	const August = 8;
	const September = 9;
	const October = 10;
	const November = 11;
	const December = 12;
}
//*/





// Test code
function process (Month $enum) {
	print $enum->getName() . " => " . $enum->getValue() . "\n";
}

process(Month::December());

foreach(Month::getKeys() as $k => $v) {
	process($v);
}
