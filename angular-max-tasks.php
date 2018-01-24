<?php
/** 
Author - Eneh James
Description - Angular App to calculate the maximum number of tasks a military unit can accomplish in limited time. Using the greedy algorithm.
Date/Time - 23/01/2018 / 21:12:00
**/
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Maximum Tasks</title>
        <style>
            table, th , td {
                border: 1px solid grey;
                border-collapse: collapse;
                padding: 5px;
            }
            table tr:nth-child(odd) {
                background-color: #f2f2f2;
            }
            table tr:nth-child(even) {
                background-color: #ffffff;
            }
        </style>
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.15/angular.min.js"></script>
    </head>
    <body>
        <h2>Angular Maximum Tasks Application</h2>
        <h3 style="color:#ff4000">Welcome, Military Strategist!</h3>
        <h4 style="color:#ff0040;font-style:italic; margin-top:-15px">Feel free to change the preloaded values to your choice values.<h4>
        <div ng-app="" ng-controller="taskController">
            <form name="taskForm" novalidate>
                <table border="0">
                    <tr>
                        <td>Time Limit in Minutes:</td>
                        <td><input name="timelimit" type="number" min="1" ng-model="timeLimit" required>
                            <span style="color:red" ng-show="taskForm.timelimit.$dirty && taskForm.timelimit.$invalid">
                                <span ng-show="taskForm.timelimit.$error.required">Time Limit is required. Must be Number greater than 0</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Task(1) Finish Time in Minutes:</td>
                        <td><input name="tasktime1" type="number" min="1" ng-model="taskTime[0]" required>
                            <span style="color:red" ng-show="taskForm.tasktime1.$dirty && taskForm.tasktime1.$invalid">
                                <span ng-show="taskForm.tasktime1.$error.required">Task(1) Finish Time is required. Must be Number greater than 0</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Task(2) Finish Time in Minutes:</td>
                        <td><input name="tasktime2" type="number" min="1" ng-model="taskTime[1]" required>
                            <span style="color:red" ng-show="taskForm.tasktime2.$dirty && taskForm.tasktime2.$invalid">
                                <span ng-show="taskForm.tasktime2.$error.required">Task(2) Finish Time is required. Must be Number greater than 0</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Task(3) Finish Time in Minutes:</td>
                        <td><input name="tasktime3" type="number" min="1" ng-model="taskTime[2]" required>
                            <span style="color:red" ng-show="taskForm.tasktime3.$dirty && taskForm.tasktime3.$invalid">
                                <span ng-show="taskForm.tasktime3.$error.required">Task(3) Finish Time is required. Must be Number greater than 0</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Task(4) Finish Time in Minutes:</td>
                        <td><input name="tasktime4" type="number" min="1" ng-model="taskTime[3]" required>
                            <span style="color:red" ng-show="taskForm.tasktime4.$dirty && taskForm.tasktime4.$invalid">
                                <span ng-show="taskForm.tasktime4.$error.required">Task(4) Finish Time is required. Must be Number greater than 0</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Task(5) Finish Time in Minutes:</td>
                        <td><input name="tasktime5" type="number" min="1" ng-model="taskTime[4]" required>
                            <span style="color:red" ng-show="taskForm.tasktime5.$dirty && taskForm.tasktime5.$invalid">
                                <span ng-show="taskForm.tasktime5.$error.required">Task(5) Finish Time is required. Must be Number greater than 0</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Task(6) Finish Time in Minutes:</td>
                        <td><input name="tasktime6" type="number" min="1" ng-model="taskTime[5]" required>
                            <span style="color:red" ng-show="taskForm.tasktime6.$dirty && taskForm.tasktime6.$invalid">
                                <span ng-show="taskForm.tasktime6.$error.required">Task(6) Finish Time is required. Must be Number greater than 0</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td>Task(7) Finish Time in Minutes:</td>
                        <td><input name="tasktime7" type="number" min="1" ng-model="taskTime[6]" required>
                            <span style="color:red" ng-show="taskForm.tasktime7.$dirty && taskForm.tasktime7.$invalid">
                                <span ng-show="taskForm.tasktime7.$error.required">Task(7) Finish Time is required. Must be Number greater than 0</span>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td><button ng-click="reset()">Reset</button></td>
                        <td><button ng-disabled="taskForm.timelimit.$dirty && taskForm.timelimit.$invalid || taskForm.tasktime1.$dirty && taskForm.tasktime1.$invalid || taskForm.tasktime2.$dirty && taskForm.tasktime2.$invalid || taskForm.tasktime3.$dirty && taskForm.tasktime3.$invalid || taskForm.tasktime4.$dirty && taskForm.tasktime4.$invalid || taskForm.tasktime5.$dirty && taskForm.tasktime5.$invalid || taskForm.tasktime6.$dirty && taskForm.tasktime6.$invalid || taskForm.tasktime7.$dirty && taskForm.tasktime7.$invalid" ng-click="calculate()">
                                Calculate
                            </button>
                        </td>
                    </tr>
                </table>
                <h3>Result: </h3>
                <strong style="color:#ff4000">{{result}}</strong>
            </form>
        </div>
        <script>
            function taskController($scope) {   //taskController function starts here
                $scope.taskTime = [];
                $scope.reset = function(){      //reset function loads model data with default values.
                    $scope.timeLimit = 12;
                    $scope.taskTime[0] = 7;
                    $scope.taskTime[1] = 6;
                    $scope.taskTime[2] = 5;
                    $scope.taskTime[3] = 3;
                    $scope.taskTime[4] = 4;
                    $scope.taskTime[5] = 2;
                    $scope.taskTime[6] = 1;
                    $scope.result = "";
                }

                $scope.calculate = function(){     //calculate function computes maximum number of tasks to be completed, using greedy algorithm.
                    $scope.taskTime.sort(function(a, b){return a - b});
                    var currentTime = 0;
                    var numberOfThings = 0;

                    for(var i=0; i<$scope.taskTime.length; i++){
                        currentTime += $scope.taskTime[i];
                        if(currentTime > $scope.timeLimit){
                            break;
                        }
                        numberOfThings++;
                    }
                    $scope.result = "The maximum number of tasks to be completed by the military unit, in limited time of " + $scope.timeLimit + " minutes is: " + numberOfThings;

                }

                $scope.reset();         //Preloads model with default values.

            }                                   //taskController function stops here
        </script>
    </body>
</html>
