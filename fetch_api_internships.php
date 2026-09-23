<?php
include 'db.php';

$app_id  = "8c789886";
$app_key = "4e9e313013a44c38a4cb8a368a91a61a";

$url = "https://api.adzuna.com/v1/api/jobs/in/search/1?app_id=$app_id&app_key=$app_key&results_per_page=20&what=internship&content-type=application/json";

// cURL starts here
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if(curl_errno($ch)){
    echo "Curl error: " . curl_error($ch);
    exit();
}

curl_close($ch);

$data = json_decode($response, true);

foreach ($data['results'] as $job) {

    $title       = mysqli_real_escape_string($conn, $job['title']);
    $company     = mysqli_real_escape_string($conn, $job['company']['display_name']);
    $location    = mysqli_real_escape_string($conn, $job['location']['display_name']);
    $description = mysqli_real_escape_string($conn, $job['description']);
    $apply_link  = mysqli_real_escape_string($conn, $job['redirect_url']);

    $min_year = '3rd Year';
    $branch   = 'CSE';
    $min_cgpa = 6.0;

    // -------- Auto-detect extra fields for filters --------

// Detect stipend from description
$stipend = (stripos($description, 'stipend') !== false) ? 'Yes' : 'No';

// Detect mode (online/offline)
if(stripos($description, 'remote') !== false || stripos($description, 'online') !== false){
    $mode = 'Online';
} else {
    $mode = 'Offline';
}

// Detect domain from title
if(stripos($title, 'web') !== false){
    $domain = 'Web Development';
}
elseif(stripos($title, 'data') !== false){
    $domain = 'Data Science';
}
elseif(stripos($title, 'ai') !== false){
    $domain = 'Artificial Intelligence';
}
elseif(stripos($title, 'java') !== false){
    $domain = 'Java Development';
}
else{
    $domain = 'General';
}


    // Check if internship already exists (by title + company)
$check = mysqli_query($conn, "
    SELECT id FROM internships 
    WHERE title='$title' 
    AND company='$company'
");

if(mysqli_num_rows($check) > 0){
    continue; // Skip duplicate
}



    mysqli_query($conn, "INSERT INTO internships
    (title, company, location, description, apply_link, min_year, branch, min_cgpa,
     stipend, domain, mode, status)
    VALUES
    ('$title', '$company', '$location', '$description', '$apply_link',
     '$min_year', '$branch', '$min_cgpa',
     '$stipend', '$domain', '$mode', 'Pending')");
}

echo "<script>alert('New internships loaded from API');</script>";
?>