<html>

<head>
    <meta charset="UTF-8">
    <meta lang="en-US">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burak's Page</title>
    <link rel="stylesheet" type="text/css" href="../styles/styles.css">
    <style>
        form input[type='text'] {
            padding:5px;
            margin-bottom:10px;
        }
        #themeToggle {
            display: none;
        }

        form input[type='submit'] {
            background: #ffca00;
            padding: 0.7em;
            color: black;
            border-radius: 5px;
            text-decoration: none;
            border-style: none;
            font-weight: bold;
            cursor: pointer;
            margin-top:6px;
        }
        .burak-main {
             display: flex;
             justify-content: space-between;
             gap: 40px;
             margin-bottom: 30px;
        }
        .burak-main > img {
            border-radius:50px;
            width:40%;
        }
        .burak-main > div {
            width: 50%;
             overflow-wrap: break-word;
            padding: 20px;
        border-radius: 50px;
            border: black 2px;
            border-style: solid;
        }
        header {
            background-position: center center;
            background-repeat: no-repeat;
            background-image: url(../images/guelph.jpeg);
            background-size: cover;
            padding:4em 0;
        }
        .header_container {
            backdrop-filter: blur(2.5px);
            padding: 1px;
            -webkit-text-stroke: 0.2px black;
        }
	nav {
    background-color: black;
    padding: 0.5em 1em;
    display: flex;
    position: sticky;
    top: 0;
    z-index: 2000;
    box-shadow: 0 1px 2px 0 rgb(0 0 0 / 92%);
}

footer {
    background-color: black;
    color: #fff;
    text-align: center;
    padding: 1em 0;
}
nav a {
    color: white;
    text-decoration: none;
    padding: 0 1em;
    align-self: center;
}
.download-button {
    background: #ffca00;
    padding: 0.5em;
    color: black;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bolder;
}
    </style>
</head>

<body>
    <?php include '../navbar.php'; ?>
    <header id="home_header"><div class="header_container"><h1>Burak's Page</h1><p>Term GPA Calculator</p></div></header>
    <main>
        <div class='burak-main'>
            <div>
                <h2>Hello!</h2>
                <p>My name is Burak Duruk, I'm 21 years old  and I'm a 4th year Computer Science student at the University of Guelph. The cute cat you see on the right is my cat Mia. I enjoy listening
                to music and playing video games. For this sprint, I worked on the home page and general styling of this website. Using the script below, you can calculate your average for a semester
                by giving your grades and credits for taken courses, separated by a comma (e.g. "90,0.5"). I used a form with post method to implement it.</p>
            </div>
            <img src='../images/burak.jpg'/>
        </div>
        <h2>Term GPA Calculator</h2>
        <form method="post" action="burakPage">
            <input type="text" name="value[]" placeholder="Enter grade and credits separated by a comma"/>
            <br>
            <input type="text" name="value[]" placeholder="Enter grade and credits separated by a comma"/>
            <br>
            <input type="text" name="value[]" placeholder="Enter grade and credits separated by a comma"/>
            <br>
            <input type="text" name="value[]" placeholder="Enter grade and credits separated by a comma"/>
            <br>
            <input type="text" name="value[]" placeholder="Enter grade and credits separated by a comma"/>
            <br>
            <input type="text" name="value[]" placeholder="Enter grade and credits separated by a comma"/>
            <br>
            <input type="submit" name="calc-btn" value="Calculate"/>
        </form>
        <?php
            if(isset($_POST['calc-btn'])){
                $totalCredits = 0;
                $result = 0;
                $validInput = false;
                foreach($_POST['value'] as $val) {
                    if ($val != ''){
                        $str_arr = preg_split ("/\,/", $val);
                        if(isset($str_arr[0]) and isset($str_arr[1]) and is_numeric($str_arr[0]) and is_numeric($str_arr[1])) {
                            $totalCredits = $totalCredits + $str_arr[1];
                            $result = $result + ($str_arr[0] * $str_arr[1]);
                            $validInput = true;
                        }
                        else {
                            $validInput = false;
                        }
                    }
                }

                if ($validInput) {
                    if ($totalCredits == 0) {
                        echo '<p>You should have more than 0 credits.</p>';
                    }
                    else {
                        echo '<p>Your Average: ',$result/$totalCredits,'</p>';
                    }
                }
                else {
                    echo '<p>Invalid Input!</p>';
                }
            }
        ?>
    </main>
</body>
<?php include '../footer.php' ?>

</html>


