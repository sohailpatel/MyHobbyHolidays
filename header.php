
<div id='page'>
    <nav class='colorlib-nav remove-image' role='navigation'>
        <div class='container'>
            <div class='row'>
                <div class='top-menu'>
                    <div class='container-fluid'>
                        <div class='row'>
                            <div class='col-xs-3'>
                                <div id='colorlib-logo'><a href='tours.php'>My Hobby Holidays</a></div>
                            </div>
                            <div class='col-xs-9 text-right menu-1'>
                                <ul>
                                    <?php
                                        if($_SESSION['login_user']){
                                            if($_SESSION['UserType'] == 'ADMIN'){
                                                echo "<li><a href='admindashboard.php'>Home</a></li>";
                                            }
                                            else{
                                                echo "<li><a href='userdashboard.php'>Home</a></li>";
                                            }
                                        }
                                    ?>
                                    <li><a href='tours.php'>Tours</a></li>   
                                    <li><a href='about.php'>About</a></li>
                                    <li><a href='contact.php'>Contact</a></li>
                                    <li class='has-dropdown'>
                                    <?php
                                        if($_SESSION['login_user']){
                                            if($_SESSION['UserType'] != 'ADMIN'){
                                                echo "<li><a href='groupchat.php'>Group Chat</a></li>";
                                            }
                                        }
                                        if($_SESSION['login_user']){
                                            echo "<a href='#'>Welcome, ". $_SESSION['firstName'] ."</a>";
                                            echo "<a href='logout.php'> Logout</a>";
                                        }
                                        else{
                                            echo"
                                            <a href='login.php'>Login</a>
                                            <ul class='dropdown'>
                                                <li><a href='login.php'>Login</a></li>
                                                <li><a href='signup.php'>Sign Up</a></li>
                                            </ul>";
                                        }
                                    echo"</li>";
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
