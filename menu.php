<html>
<title>EHR</title>

<div class="head">
    <h1 id="header">EHR System</h1>
    <?php

    /*session_start();
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
	    header('Location: menu.php');
	exit;
}*/

    require('functions.php');

        include_once('dbconnector.php');

        $sql = "SELECT UPDATE_TIME FROM information_schema.tables WHERE TABLE_SCHEMA = 'se_20s_g01_db' AND TABLE_NAME = 'PatientDemographics'";
        $sqlresult = mysqli_query($dbconn,$sql);

         //while ($row = $sqlresult->fetch_assoc()){
           // echo "<strong>Data Refreshed:</strong> {$row['UPDATE_TIME']}";

         //}
        ?>
</div>

<body>
    <div id="body">
        <br />
        <a class="link" href=/se/se-s20-g01/advanced.php>Advanced Search</a>
        <br />
        <span title="Search By PatientId, First/Last Name, or DOB"><input class="text" type="text" name="search_text" id="search_text" placeholder="Search For Patient..." class="form-control" /></span>
        <br />
        <div id="result"></div>
    </div>


    <script>
        $(document).ready(function() {

            load_data();

            function load_data(query) {
                $.ajax({
                    url: "fetch.php",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#result').html(data);
                    }
                });
            }
            $('#search_text').keyup(function() {
                var search = $(this).val();
                if (search != '') {
                    load_data(search);
                } else {
                    load_data();
                }
            });
        });

    </script>
    <div class="head">
    </div>
</body>

</html>
