<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/****
 * Hi!
 * Though i'm running laravel homestead on my system so i couldn't setup xampp etc to run php files out of project
 * so i have made these endpoints for given tasks you just need to clone this repo and setup laravel project and then hit
 * these endpoints to test given tasks
 * Or alternatively you can copy paste given code against each endpoint to run within whatever php environment you are working with.
 * You can approch me if something goes wrong
 */



Route::get('/', function () {
    return view('welcome');
});

Route::get('task-1', function() {
    $inputArray = [2, 7, 8, 8, 6, 1, 6, 3]; /***** Enter your desired input here */
    $arrayLength = count($inputArray);
    $isSpecial = 1;

    for ($i=0; $i<$arrayLength; $i++) {
        switch ($i%2) {
            case 0:
                if ($inputArray[$i] % 2 != 0) {
                    $isSpecial = 0;
                    continue 2;
                }
                break;

            case 1:
                if ($inputArray[$i] % 2 == 0) {
                    $isSpecial = 0;
                    continue 2;
                }
                break;

            default:
                echo "Unprocessable entity.";
                break;
        }

        if (!$isSpecial) {
            return $isSpecial;
            break;
        }
    }

    return $isSpecial;
});

Route::get('task-2', function() {
    $input = 349; /***** Enter your desired input here */
    $stringInput = (string)$input;
    $StringLength = strlen($stringInput);

    function appendZeros($item, $index) {
        $numOfZeros = "";
        for ($i=0; $i<$index; $i++) {
            $numOfZeros = $numOfZeros . "0";
        }

        return (int)($item . $numOfZeros);
    }

    for ($i=0; $i<$StringLength; $i++) {
        $newArray[] = appendZeros($stringInput[$i], $StringLength - ($i + 1));
    }

    return $newArray;
});

Route::get('task-3', function() {
    $inputArray = array (
        "student-1" => array("id" => 1, "name" => "James", "age" => 22),
        "student-2" => array("id" => 2, "name" => "William", "age" => 26),
        "student-3" => array("id" => 3, "name" => "Henry", "age" => 18),
        "student-4" => array("id" => 4, "name" => "Isabella", "age" => 25),
        "student-5" => array("id" => 5, "name" => "Alexander", "age" => 19)
       );

    $keys = array_keys($inputArray);

    for ($j=0; $j<count($inputArray); $j++) {
        $min = $inputArray[$keys[$j]];
        $minAge = $inputArray[$keys[$j]]["age"];
        $minIndex = $keys[$j];
        for ($i=$j; $i<count($inputArray) - 1; $i++) {
            if ($i<count($inputArray)) {
                if ($minAge > $inputArray[$keys[$i+1]]["age"]) {
                    $minAge = $inputArray[$keys[$i+1]]["age"];
                    $min = $inputArray[$keys[$i+1]];
                    $minIndex = $keys[$i+1];
                } else {
                    continue;
                }
            }
        }

        // Swap items only when age is minimum than current iteration
        if ($minAge != $inputArray[$keys[$j]]["age"]) {
            $previousValue = $inputArray[$keys[$j]];
            $inputArray[$keys[$j]] = $min;
            $inputArray[$minIndex] = $previousValue;
        }
    }

    return $inputArray;
});

Route::view('task-4', 'form');  // resources\views\form.blade.php

Route::post('submit-form-data', function() {
		$num = $_REQUEST['num'];
		$directory = storage_path() ."/uploads/"; // if you're not testing code with laravel then just use "uploads/" as directory and remove storage_path() helper
        $fileName = $directory . basename($_FILES["photo"]["name"]);

        try {
            if(isset($_POST["submit"])) {
                move_uploaded_file($_FILES["photo"]["tmp_name"], $fileName);

                DB::statement("INSERT INTO users (`number`, `photo_path`)
                VALUES($num, '$fileName')");

                echo "Information added successfully.";
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }

});

/****** Retrieving information stored against given id */
Route::get('profile/{id}', function(Request $request) {
    return  DB::select("SELECT * FROM users
                where id = $request->id");
});
