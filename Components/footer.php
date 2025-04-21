<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /*-------Footer open-----------*/
        #footer {
            background: #1d3557; /* Updated background color */
            padding: 0.4rem 0; /* Reduced padding */
            color: var(--white_color);
            font-size: 0.9rem; /* Reduced font size */
            border-top-left-radius: 15px; /* Curved top left corner */
    border-top-right-radius: 15px; /* Curved top right corner */
        }
        
        #footer-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 1rem; /* Reduced gap */
        }
        
        #contact,
        #contact-us,
        #address,
        #opening-hours {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: left;
        }
        
        #contact img {
            max-width: 40%; /* Reduced width */
            margin: 0 auto;
        }
        
        #contact-us li,
        #address li,
        #opening-hours li {
            line-height: 1.5; /* Reduced line height */
            padding-bottom: 1rem; /* Reduced padding */
        }
        
        #contact-us a {
            color: rgb(255, 255, 255);
        }
        
        #footer-container h2 {
            padding-bottom: 1rem; /* Reduced padding */
            color: #f1faee;
            font-size: 1.2rem; /* Reduced header size */
        }
        
        .footer-span {
            color: #ffffff; /* Changed span color to white */
        }
        
        footer {
            background: #685454;
            text-align: center;
            padding: 1rem 0; /* Reduced padding */
            font-size: 0.9rem; /* Reduced font size */
            color: var(--white_color);
        }
        
        footer a {
            color: rgb(255, 255, 255);
        }
        /*-------Footer close-----------*/
    </style>
</head>
<body>
    
<section id="footer">
    <div id="container1">
        <div id="footer-container">
            <div id="contact">
                <h2>
                    <img src="Images/logo.png" alt="Logo">
                </h2>
            </div>
            <div id="contact-us">
                <h2>Contact Us</h2>
                <ul>
                    <li>Hotline: <span class="footer-span">+9876543210</span></li>
                    <li id="email">Email address: <span class="footer-span"><a href="mailto:signaturecuisine@gmail.com" target="_blank">signaturecuisine@gmail.com</a></span></li>
                </ul>
            </div>
            <div id="address">
                <h2>Address</h2>
                <ul>
                    <li>Colombo 01 outlet:<span class="footer-span"> Signature Cuisine, Colombo 01, 00100, Sri Lanka</span></li>
                    <li>Dehiwala-Mount Lavinia outlet: <span class="footer-span">Signature Cuisine, Dehiwala, 00600, Sri Lanka</span></li>
                    <li>Negombo Outlet:<span class="footer-span"> Signature Cuisine, Negombo, 11534, Sri Lanka</span></li>
                </ul>
            </div>
            <div id="opening-hours">
                <h2>Opening hours</h2>
                <ul>
                    <li id="day">Sunday-Thursday:<span class="footer-span"> 10:00 AM-10:00 PM</span></li>
                    <li id="day">Friday:<span class="footer-span"> 10:00 AM-5:30 PM</span></li>
                    <li id="day">Saturday:<span class="footer-span"> 6:30 PM-12:00 AM</span></li>
                </ul>
            </div>
        </div>
        
        <div id="social-media">
            <div class="icons">
                <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </div>
</section>

</body>
</html>