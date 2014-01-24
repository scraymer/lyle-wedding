<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Create Databases</title>
</head>
<body>
<?php

include("../classes/user.php");

//create user table if it does not exist
$user = new User();
$user->dbCreateTable();

//insert scraymer into the user table
// $user = User::createMax("scraymer", "sam@craymer.com", "4SC2use", 100, "Samuel", "Craymer");
// $user->dbInsertRecord();

//insert lcraymer into the user table
// $user = User::createMax("lcraymer", "lisa@craymer.com", "4LC2use", 200, "Lisa", "Craymer");
// $user->dbInsertRecord();

//insert kwatters into the user table
// $user = User::createMax("kwatters", "kylewatters@live.ca", "4KW2use", 250, "Kyle", "Watters");
// $user->dbInsertRecord();

//insert kwatters into the user table
// $user = User::createMax("lyle", "lyle@lyle.lye", "4LYLE2use", 900, "Lyle", "Lyle");
// $user->dbInsertRecord();

echo "CHECK IT!";

?>
</body>
</html>
