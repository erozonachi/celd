<?php
/** 
Author - Eneh James
Description - PHP code snipet to calculate the maximum number of tasks a military unit can accomplish in limited time, 'X'. Using the greedy algorithm.
Date/Time - 12/01/2018 / 21:12:00
**/
	define("X", 12);						//Constant 'X' holding limited time value in minutes
		
	$A = array(7, 6, 5, 3, 4, 2, 1);		//Integer array 'A' holding the time value it will take to complete different tasks

	$currentTime = 0; //Declaration and Initialization of currentTime variable

	$numberOfThings = 0; //Declaration and Initialization of numberOfThings variable

	sort($A);			//Sort A array in non-decreasing order


	for($i=0;$i<count($A);$i++) {					//Iteration block starts here

		$currentTime += $A[$i];	//Add completion time of the current to-do item to currentTime variable

		if($currentTime > X)					//Test if currentTime is greater than X

			break;								//Breaks out of the loop if currentTime is greater than X

		$numberOfThings++;						//Increment numberOfThings variable by one (1)
		
	}											//Iteration block stops here
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Maximum Tasks</title>

		<style type="text/css">

		*{
			font: 14px normal Helvetica, Arial, sans-serif;
			color: #4F5155;
		}

		body {
			background-color: #fff;
			margin: 50px;
		}

		strong {
			color: #ff4000;
			font-size: 16px;
			font-weight: bold;
		}

		span {
			font-weight: bold;
			font-style: italic;
		}
		</style>
	</head>
	<body>
			<span>The maximum number of tasks to be completed by the military unit, in limited time of 
			<?php echo X . " minutes"; ?> is: </span><strong><?php echo $numberOfThings; ?></strong>
	</body>
</html>
