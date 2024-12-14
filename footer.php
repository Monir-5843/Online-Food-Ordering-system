<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        .footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 20px 0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .footer a {
            color: #ffffff;
            text-decoration: none;
        }
        .footer a:hover {
            color: #ff6f61;
            text-decoration: underline;
        }
        .footer .social-icons a {
            margin: 0 10px;
            font-size: 1.2rem;
            display: inline-block;
        }
        .footer .social-icons a:hover {
            color: #ff6f61;
        }
    </style>
</head>
<body>
    <footer class="footer">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-4 mb-3">
                    <h5>About Us</h5>
                    <p>
                        We are committed to delivering your favorite meals fast and fresh!
                        Experience the best online food ordering system today.
                    </p>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="about.php">About Us</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h5>Follow Us</h5>
                    <div class="social-icons">
                        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <hr class="bg-light">
            <div class="row">
                <div class="col text-center">
                    <p class="mb-0">&copy; <?php echo date('Y'); ?> Online Food Ordering System. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- FontAwesome for Social Icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
