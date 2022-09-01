<html>

<head>
    <title>Javascript Validation</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    Username: <input type="text" id="uname" onblur="validate()">
    <div id="div1"></div> <br>
    Email: <input type="text" onblur="validate()" id="Email">
    <div id="div2"></div> <br>
    Password: <input type="password" onblur="validate()" id="password">
    <div id="div3"></div><br>
    Pattern Check: <input type="text" onblur="validate()" id="pattern">
    <div id="div4"></div><br>
    <script>
        function validate() {
            var uname = document.getElementById("uname").value;
            var Email = document.getElementById("Email").value;
            var password = document.getElementById("password").value;
            var pattern = document.getElementById("pattern").value;
            var patcheck = new RegExp("^[a-z0-9]");
            if (uname === "") {
                document.getElementById("div1").innerHTML = "Enter a value";
                document.getElementById("div1").style.color = "Red";

            } else {
                document.getElementById("div1").innerHTML = "";
            }
            if (Email.indexOf("@") > -1) {
                document.getElementById("div2").innerHTML = "";
            } else {
                document.getElementById("div2").innerHTML = "Enter the correct email address";
                document.getElementById("div2").style.color = "Red";

            }
            if (password.length <= 6) {
                document.getElementById("div3").innerHTML = "Password is weak";
                document.getElementById("div3").style.color = "Red";
            } else {
                document.getElementById("div3").innerHTML = "";
            }

            if (!patcheck.test(pattern)) {
                document.getElementById("div4").innerHTML = "Only Alphabets/Numbers";
                document.getElementById("div4").style.color = "Red";
            } else {
                document.getElementById("div4").innerHTML = "";
            }
        }
    </script>
</body>

</html>