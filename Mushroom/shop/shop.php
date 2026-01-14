<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MushShop</title>
    <link rel="stylesheet" href="shop.css">
    <script src="script.js"></script>
</head>

<body>
    <div class="container">
        <section class="first-section">
            <header>
                <div class="logo">
                    <h2>MushShop</h2>
                </div>
                <nav>
                    <ul class="main-ul">
                        <li class="main-li"><a href="#prod">Products</a></li>
                        <li class="main-li"><a href="#vou">Vouchers</a></li>
                        <li class="main-li"><a href="#fea">About Us</a></li>
                        <li class="main-li"><a href="#foo">Contacts</a></li>
                        <li class="main-li other"><a>≡</a></li>
                        <div class="menu">
                            <div class="menu-container">
                                <div class="menu-img">
                                    <img src="Images/menu.png" class="menu-img2" alt="menu photo">
                                </div>
                                <div class="menu-list">
                                    <ul>
                                        <li><a href="#tes"><img src="Images/reviews.png">Reviews</a></li>
                                        <li><a href="#lat"><img src="Images/calendar.png">Events</a></li><br>
                                        <li class="main-li"><a href="retrieve_data.php" id="retrieveLink">🛒 Cart</a></li>
                                        <li class="main-li"><a href="order.php">My Orders</a></li>
                                        <?php

                                        session_start();

                                        //sa logout
                                        if (isset($_POST['logout'])) {

                                            unset($_SESSION['username']);
                                            unset($_SESSION['firstname']);
                                            unset($_SESSION['lastname']);
                                            unset($_SESSION['email']);
                                            unset($_SESSION['address']);
                                            unset($_SESSION['phonenumber']);


                                            header("Location: shop.php");
                                            exit();
                                        }

                                        //ito ung naghohold ng data
                                        if (isset($_SESSION['username'])) {

                                            $username = $_SESSION['username'];
                                            $firstname = $_SESSION['firstname'];
                                            $lastname = $_SESSION['lastname'];
                                            $email = $_SESSION['email'];
                                            $address = $_SESSION['address'];
                                            $phonenumber = $_SESSION['phonenumber'];

                                            //ito nmn ung nagdidisplay sa browser halimbawa id is fullname pero laman nya ay fisrtname at lastname value
                                            echo '<li class="p-info" id="fullname">' . ucfirst($firstname) . ' ' . ucfirst($lastname) . '</li><br>';
                                            echo '<li class="p-info">' . $email . '</li>';
                                            echo '<li class="p-info" id="address">' . $address . '</li>';
                                            echo '<li class="p-info" id="phonenumber">' . $phonenumber . '</li>';
                                            echo '<form method="post">';
                                            echo '<li class="p-info"><img src="Images/signout.png"><button type="submit" name="logout">SignOut</button></li>';
                                            echo '</form>';
                                        } else {
                                            echo '<li class="main-li"><a href="../index.php"><img src="Images/login.png">Log in</a></li>';
                                        } ?>
                                      
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </ul>
                </nav>
            </header>
            <section class="inner-section">
                <div class="back-ground"></div>
                <div class="text">
                    <h2> Welcome to MushShop,</h2>
                    <p>"Our shop offers high-quality products, expert guidance, and a commitment to customer satisfaction, making MushShop your ultimate source for mushroom cultivation supplies and knowledge."</p>
                </div>
                <img src="Images/logo.png" class="animation-img" alt="photo">
            </section>
            <a href="#art" class="scroll-down"></a>
        </section>
        <br>
        <!--product-->
        <section class="second-section">
            <h2 id="prod" class="title">Shop Now</h2>

            <div class="card-container">
                <!--paddy straw -->
                <div class="card" data-content="content1">
                    <img src="Images/paddy-straw.png" alt="card photo">
                    <div class="card-text">
                        <h3 class="card-title">Paddy Straw</h3>
                        <p>Delicate and ivory-colored, a subtle nutty flavor to stir-fries and soups.</p>
                    </div>
                    <hr>
                    <div class="card-footer">
                        <a href="#art">₱ 250.00 / kg</a>
                        <a href="#art" class="arrow"></a>
                    </div>
                </div>
                <!--oyster mushroom -->
                <div class="card" data-content="content2">
                    <img src="Images/oyster-mushroom.png" alt="card photo">
                    <div class="card-text">
                        <h3 class="card-title">Oyster mushroom</h3>
                        <p>Resembling delicate fans, perfect for vegan dishes or enhancing meaty flavors.</p>
                    </div>
                    <hr>
                    <div class="card-footer">
                        <a href="#art">₱ 180.00 / kg</a>
                        <a href="#art" class="arrow"></a>
                    </div>
                </div>
                <!--shiitake -->
                <div class="card" data-content="content3">
                    <img src="Images/shiitake-mushroom.png" alt="card photo">
                    <div class="card-text">
                        <h3 class="card-title">Shiitake mushroom</h3>
                        <p>With a rich, smoky flavor and a meaty texture, prized in for their versatility and umami depth.</p>
                    </div>
                    <hr>
                    <div class="card-footer">
                        <a href="#art">₱ 500.00 / kg</a>
                        <a href="#art" class="arrow"></a>
                    </div>
                </div>
                <!--button mush-->
                <div class="card" data-content="content4">
                    <img src="Images/button-mushroom.png" alt="card photo">
                    <div class="card-text">
                        <h3 class="card-title">Button mushroom</h3>
                        <p>Offer a mild, slightly sweet taste, ideal for salads, pasta dishes, or as a pizza topping.</p>
                    </div>
                    <hr>
                    <div class="card-footer">
                        <a href="#art">₱ 190.00 / kg</a>
                        <a href="#art" class="arrow"></a>
                    </div>
                </div>
                <!--milky-->
                <div class="card" data-content="content5">
                    <img src="Images/milky-mushroom.png" alt="card photo">
                    <div class="card-text">
                        <h3 class="card-title">Milky mushroom</h3>
                        <p>Creamy white in appearance with a delicate flavor, add beauty to creamy sauces.</p>
                    </div>
                    <hr>
                    <div class="card-footer">
                        <a href="#art">₱ 175.00 / kg</a>
                        <a href="#art" class="arrow"></a>
                    </div>
                </div>
                <!--reishi-->
                <div class="card" data-content="content6">
                    <img src="Images/reishi-mushroom.png" alt="card photo">
                    <div class="card-text">
                        <h3 class="card-title">Reishi mushroom</h3>
                        <p>Revered for its health benefits, often brewed into teas, or used into herbal remedies.</p>
                    </div>
                    <hr>
                    <div class="card-footer">
                        <a href="#art">₱ 600.00 / kg</a>
                        <a href="#art" class="arrow"></a>
                    </div>
                </div>
                <!--Lion-->
                <div class="card" data-content="content7">
                    <img src="Images/lion-mane-mushroom.png" alt="card photo">
                    <div class="card-text">
                        <h3 class="card-title">Lion's mane mushroom</h3>
                        <p>Offer a seafood-like taste and a stringy texture, a unique addition to vegetarian dishes.</p>
                    </div>
                    <hr>
                    <div class="card-footer">
                        <a href="#art">₱ 400.00 / kg</a>
                        <a href="#art" class="arrow"></a>
                    </div>
                </div>
                <!--king tuber-->
                <div class="card" data-content="content8">
                    <img src="Images/king-tuber-oyster.png" alt="card photo">
                    <div class="card-text">
                        <h3 class="card-title">King tuber oyster</h3>
                        <p>A name to match its size, perfect for grilling or roasting to bring out its savory notes.</p>
                    </div>
                    <hr>
                    <div class="card-footer">
                        <a href="#art">₱ 300.00 / kg</a>
                        <a href="#art" class="arrow"></a>
                    </div>
                </div>
            </div>
            <!--floating window-->
            <div id="floating-window"></div>
            <script src="script.js"></script>
        </section>

        <!--Reviews-->
        <section class="fifth-section">
            <div class="back-ground3"></div>
            <h2 id="tes" class="title">Reviews</h2>
            <div class="jobs-container">
            </div>

            <!-- retrieve comments in php-->
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "productrating";

            try {
                // Create connection
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // Set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // SQL statement to select comments from the database
                $sql = "SELECT name, rating, comment, warning FROM comments";
                $stmt = $conn->query($sql);
                $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            } ?>
            <!--display comments from php-->
            <div class="cparent">
                <div class="rts-container">
                    <?php foreach ($comments as $comment) : ?>
                        <div class="comment">
                            <div id="warnings"><?php echo $comment['warning']; ?></div>
                            <div id="displayname"><?php echo $comment['name']; ?></div>
                            <div id="displayrating"><?php echo $comment['rating']; ?></div>
                            <div id="displaycomment"><?php echo $comment['comment']; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!--comment form-->
            <div class="comment-container">
                <form id="commentForm">
                    <textarea id="comment" name="comment" placeholder="Log in first to add Comment & Ratings" class="tbox"></textarea><br>
                    <label for="rating">Ratings:</label><br>
                    <select id="rating" name="rating" class="ratebtn" title="Ratings">
                        <option value="★✰✰✰✰">1/5★</option>
                        <option value="★★✰✰✰">2/5★</option>
                        <option value="★★★✰✰">3/5★</option>
                        <option value="★★★★✰">4/5★</option>
                        <option value="★★★★★">5/5★</option>
                    </select>
                    <button type="button" onclick="addComment()" id="addCommentButton" class="cmtbutton">Add Comment</button>
                </form>
            </div>
        </section>

        <!--Voucher-->
        <section class="third-section">

            <div class="back-ground3"></div>
            <h2 id="vou" class="title">Coming Soon!</h2>
            <div class="img-container">
                <div class="img">
                    <img src="Images/free-shipping-no-min.png" class="img-3" alt="web design photo">
                </div>
                <div class="img">
                    <img src="Images/free-shipping-min.png" class="img-3" alt="web design photo">
                </div>
                <div class="img">
                    <img src="Images/off-5.png" class="img-3" alt="web design photo">
                </div>
                <div class="img">
                    <img src="Images/off-10.png" class="img-3" alt="web design photo">
                </div>
                <div class="img">
                    <img src="Images/cashback-5.png" class="img-3" alt="web design photo">
                </div>
                <div class="img">
                    <img src="Images/cashback-10.png" class="img-3" alt="web design photo">
                </div>
            </div>
        </section>

        <!--About us-->
        <section class="fourth-section">
            <h2 id="fea" class="title">About Us</h2>
            <div class="abus">
                <p>At MushShop, we're more than just a mushroom shop, we're cultivators of curiosity, champions of quality, and stewards of sustainability. </p>
                <br>
                <p>Born from a shared love for fungi and a passion for sustainable living, MushShop sprouted from humble beginnings in [2024]. Since then, we've grown into a trusted hub for mushroom enthusiasts.</p><br>
                <p><b>OUR MISSION:</b></p>
                <br>
            </div>
            <div class="feature-container">
                <div class="quality feature">
                    <div class="overly">
                        <img src="Images/quality.png" class="img-feature" alt="feature photo">
                    </div>
                    <div class="feature-part2">
                        <h1 class="feature-title">Quality</h1>
                        <p>Upholding the highest standards of excellence in our products, services, and customer interactions.</p>
                        <br>
                    </div>
                </div>

                <div class="time feature">
                    <div class="overly">
                        <img src="Images/time.png" class="img-feature" alt="feature photo">
                    </div>
                    <div class="feature-part2">
                        <h1 class="feature-title">Time</h1>
                        <p>Honoring the natural rhythms of fungi cultivation and fostering patience and mindfulness in our practices.</p>
                        <br>
                    </div>
                </div>

                <div class="passion feature">
                    <div class="overly">
                        <img src="Images/passion.png" class="img-feature" alt="feature photo">
                    </div>
                    <div class="feature-part2">
                        <h1 class="feature-title">Passion</h1>
                        <p>Fueling our work with boundless enthusiasm, creativity, and a deep reverence for the miraculous world of mushrooms.</p>
                        <br>
                    </div>
                </div>
            </div>
        </section>



        <!--Events-->
        <section class="tenth-section">
            <h2 id="lat" class="title">Latest Events</h2>
            <div class="events-container">
                <div class="event-section">
                    <div class="img-container2">
                        <img src="Images/events.png" class="event-img" alt="event photo">
                    </div>
                    <div class="date-text">
                        <div class="date-container">
                            <div class="event-date">
                                <span class="event-number">15</span>
                                <hr class="hr-date">
                                <span class="date">Days</span>
                            </div>
                            <div class="event-date">
                                <span class="event-number">08</span>
                                <hr class="hr-date">
                                <span class="date">Hours</span>
                            </div>
                            <div class="event-date">
                                <span class="event-number">45</span>
                                <hr class="hr-date">
                                <span class="date">Minutes</span>
                            </div>
                            <div class="event-date">
                                <span class="event-number">55</span>
                                <hr class="hr-date">
                                <span class="date">Seconds</span>
                            </div>
                        </div>
                        <div class="event-text">
                            <h3 class="event-title">Upcoming Event 2024</h3>
                            <p class="event-details">As a subscriber, you'll be the first to know about our flash sales, clearance events, and limited-time offers. Say goodbye to FOMO (fear of missing out) because you'll always be in the loop!</p>
                        </div>
                    </div>
                </div>
                <form method="post" class="event-section2" action="#lat">
                    <input type="email" name="email" placeholder="Enter Your Email" class="mail" required>
                    <input type="submit" value="subscribe" class="subscribe">
                </form>
            </div>
        </section>


        <!--Footer-->
        <footer id="foo">
            <div class="footer-container">
                <div class="footer-details">
                    <h3 class="footer-title">Contacts</h3>
                    <div class="social-footer">

                        <a href="https://www.facebook.com/profile.php?id=61568879219572"><img src="Images/facebook-icon.png" class="fab fa-facebook-f social-icon facebook"></a>
                        <a href="https://twitter.coms"><img src="Images/twitter-icon.png" class="fab fa-twitter social-icon twitter"></a>
                        <a href="https://www.youtube.com/@MushShop-spc"><img src="Images/youtube-icon.png" class="fab fa-youtube social-icon youtube"></i></a>
                    </div>
                    <div class="details-text">Feel free to reach out to us if you have any additional questions, either by sending us a message or locating us through the provided links above</div>
                </div>
                <div class="footer-link">
                    <a href="#foo" class="link">Emails:</a>
                    <a href="#foo" class="link">delacruzaljon@gmail.com</a>
                    <a href="#foo" class="link">chavezjhonmark@gmail.com</a>
                    <a href="#foo" class="link">magnayeluther@gmail.com</a>
                </div>
                <div class="footer-conection">
                    <div>
                        <i class="fas fa-map-marker-alt conection-icon"></i>
                        <div>Philippines, Laguna, San Pablo City</div>
                    </div>
                    <div>
                        <i class="far fa-clock conection-icon"></i>
                        <div>Business Hours: From 10:00 To 18:00</div>
                    </div>
                    <div>
                        <i class="fas fa-phone-volume conection-icon"></i>
                        <div>+09297020048<br>+09917848163</div>
                    </div>
                </div>
                <div class="footer-img">
                    <img src="Images/design1.png" class="footer-img1" alt="photo">
                    <img src="Images/design2.png" class="footer-img1" alt="photo">
                    <img src="Images/design3.jpg" class="footer-img1" alt="photo">
                    <img src="Images/design4.png" class="footer-img1" alt="photo">
                    <img src="Images/design5.jpg" class="footer-img1" alt="photo">
                    <img src="Images/design6.png" class="footer-img1" alt="photo">
                </div>
            </div>
            <div class="text-footer">Copyrights 2024 By MushShop</div>
        </footer>
    </div>

    
</body>

</html>