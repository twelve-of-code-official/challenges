<?php
header('Content-Type: application/json; charset=utf-8');

$errors = array(
    'INVALID_SEED' => 'Make sure your seed is the seed given to you by the website and that you are passing it with the seed GET parameter.',
    'INVALID_INPUT' => 'Make sure that your input is one of the brands listed on the website.',
    'MISSING_INPUT' => 'Make sure that you are passing your input in the data GET parameter.',
    'NO_PARAMS' => "Please make sure that you enter your seed with the seed GET parameter and your input with the data GET parameter.",
    'IMPROPER_REQUEST_TYPE' => "Make sure that you are using a GET request."
);
function returnErrorStatusCode($error) {
    global $errors;
    $response = array('error' => $error, 'type' => 'error', 'message' => $errors[$error]);
    switch ($error) {
        case 'INVALID_SEED':
            header("HTTP/1.1 400 Bad Request");
            $response['status_code'] = 400;
            break;
        case 'INVALID_INPUT':
            header("HTTP/1.1 404 Not Found");
            $response['status_code'] = 404;
            break;
        case 'MISSING_INPUT':
            header("HTTP/1.1 400 Bad Request");
            $response['status_code'] = 400;
            break;
        case 'NO_PARAMS':
            header("HTTP/1.1 400 Bad Request");
            $response['status_code'] = 400;
            break;
        case 'IMRPOPER_REQEST_TYPE':
            header("HTTP/1.1 405 Not Allowed");
            $response['status_code'] = 405;
            break;
    }
}

$seed = $_GET["seed"];
$input = $_GET["input"];

$nachoToppingBrands = array(
    "Amy's",
    "Applegate Organics",
    "Artesano",
    "Balaji Wafers",
    "Banana Chips",
    "Beehive Cheese",
    "Bel Brand",
    "BelGioioso",
    "Black Creek",
    "Boar's Head",
    "Borden",
    "Boulder Canyon",
    "Breakstone's",
    "Bugles",
    "Cabo Fresh",
    "Cabot",
    "Calavo",
    "California Sun-Dry",
    "Cape Cod",
    "Cento",
    "Cheetos",
    "Chex Mix",
    "Chi-Chi's",
    "Cilantro Crisps",
    "Clint's",
    "Colavita",
    "Contadina",
    "Cracker Barrel",
    "Cypress Grove",
    "Dairyland",
    "Daisy",
    "Darigold",
    "Dean's",
    "Deep River",
    "Del Monte",
    "Delallo",
    "Desert Pepper Trading Co.",
    "Dirty",
    "Dona apria",
    "Doritos",
    "Dragone",
    "El Pato",
    "Elma Chips",
    "Embasa",
    "Friendly Farms",
    "Friendship Dairies",
    "Frigo",
    "Fritos",
    "Frontera",
    "Funyuns",
    "Garden Time",
    "Gay Lea",
    "Giant",
    "Golden Wonder",
    "Good & Gather",
    "Good Foods",
    "Good Health",
    "Goya",
    "Great Midwest",
    "Great Value",
    "Green Mountain Gringo",
    "H-E-B",
    "Happy Harvest",
    "Herdez",
    "Herr's",
    "Homeboy",
    "Hood",
    "Horizon Organic",
    "Hunt's",
    "Jays Foods",
    "Joan of Arc",
    "Kalona",
    "Kemps",
    "Kerrygold",
    "Kerrygold",
    "Kettle Brand",
    "Kirkland Signature",
    "Knudsen",
    "Kraft",
    "Kroger",
    "L'oven Fresh",
    "La Costena",
    "La Victoria",
    "Land O' Lakes",
    "Las Palmas",
    "Late July Snacks",
    "Lay's",
    "Lucerne",
    "aprket Pantry",
    "aprketside",
    "Meijer",
    "Mi Rancho",
    "Miss Vickie's",
    "Monster Munch",
    "Montchevre",
    "Muir Glen Organic",
    "Munchos",
    "Murray's Private Label",
    "Mutti",
    "NatureSweet",
    "Newman's Own",
    "Nikos",
    "On the Border",
    "Organic Valley",
    "Pace",
    "Park Street Deli",
    "Plantain Chips",
    "Pom-Bear",
    "Pop Chips",
    "Popchips",
    "President",
    "Pringles",
    "Private Selection",
    "Publix",
    "Quavers",
    "Rancho La California",
    "Red Gold",
    "Ro-Tel",
    "Rock Deli",
    "Rotel",
    "Ruffles",
    "S&W",
    "Sabra",
    "Sabritas",
    "Salemville",
    "Samboy",
    "San aprcos",
    "Santa Sweets",
    "Saputo",
    "Sargento",
    "Sartori",
    "Sea Salt Chips",
    "Shop Rite",
    "Signature Brands",
    "Simba Chips",
    "Simple Truth Organic",
    "Sprouts",
    "Stacy's Pita Chips",
    "Stella",
    "Sun Chips",
    "Sunset",
    "Sweet Charms",
    "Symphony",
    "Take Root Organics",
    "Takis",
    "Tangy Toms",
    "Taste of Inspirations",
    "Terra",
    "Tillamook",
    "Tostitos",
    "Tostitos",
    "Trader Joe's",
    "Treasure Cave",
    "Turtle Chips",
    "Uncle Chipps",
    "Uplands Cheese",
    "Utz",
    "Val Vita",
    "Veggie Straws",
    "Velveeta",
    "Village Farms",
    "Vitalite",
    "Walkers",
    "We Love Guac",
    "Whole Foods",
    "Wholly Guacamole",
    "Wise",
    "Wise Foods",
    "Wotsits",
    "Yucatan",
    "Zaaschila",
    "Zapp's"
);
$randomValues2024apr1 = array();
$FINAL_BRANDS_NUMBER = floor(count($nachoToppingBrands) * (3 / 4));

for ($i = 0; $i < $FINAL_BRANDS_NUMBER; $i++) {
    array_push($randomValues2024apr1, "randomValue".$i);
}

array_push($randomValues2024apr1, "startingBrand");

$state = $seed;
function nextFloat() {
	global $state;
	$m = 0x80000000;
	$a = 1103515245;
	$c = 12345;
	$state = ($a * $state + $c) % $m;
	return $state / ($m - 1);
}

foreach ($random_values as $var_name) {
    $$var_name = nextFloat();
}

$finalBrandNames = array();

# Please turn this code to an array mapping input to output.
if ($seed == "TEST_SEED") {
    if ($input == 'Lay\'s') {
        $output = 'Doritos';
    } else if ($input == 'Doritos') {
        $output = 'Wholly Guacamole';
    } else if ($input == 'Wholly Guacamole') {
        $output = 'Fritos';
    } else if ($input == 'Fritos') {
        $output = 'Whole Foods';
    } else if ($input == 'Whole Foods') {
        $output = 'Wholly Guacamole';
    } else {
        $output = array('error' => $errors["INVALID_INPUT"]);
    }
} else {
    
}

# I will change the format of this later.
$data = array('input' => array('seed' => $seed, 'input' => $input), 'output' => $output);
echo json_encode($data);