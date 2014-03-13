PHP_Enum
========

An Enum class to write safer PHP code. So, instead of using strings or constants it is safer to use Enums. 

Sample Usage
-------------
    
    <?
    require('Enum.php');
    
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
    
    ////// Or
    
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
    
    // Safe usage of the Enum
    function process (Month $enum) {
        print $enum->getName() . " => " . $enum->getValue() . "\n";
    }
    
