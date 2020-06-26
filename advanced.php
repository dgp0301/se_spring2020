<html>

<head>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="script.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<title>Advanced Search</title>

<div class="head">
    <h1>Advanced Search</h1>
</div>

<body>
    <div id=body>
        <form id="form_search" action="search.php" method="POST"><br>
            <span title="Patient ID"><input class="search" type="text" name="PatientId" placeholder="Patient Id"></span>
            <span title="First Name"><input class="search" type="text" name="FirstName" placeholder="First Name"></span><br>
            <span title="Last Name"><input class="search" type="text" name="LastName" placeholder="Last Name"></span>
            <span title="Address"><input class="search" type="text" name="DOB" placeholder="DOB"></span><br>
            <input class="search_btn" name="search" type="submit" value="Search" />
        </form>
    </div>
    <div class="head">
        <h2>Contact Us</h2>
        <h3 class="detail">

        </h3>
    </div>
</body>

</html>
