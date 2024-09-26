<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Riset Informatika</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Header -->
    <header>
        <div class="container header">
            <div class="logo-section">
                <img src="./images/polinema_logo 2.png" alt="Logo" class="logo">
                <span class="logo-text">IsFor Pusat Riset Informatika</span>
            </div>

            <nav class="navbar">
                <a href="#">Home</a>
                <a href="#">Jurnal</a>
                <a href="#">Galeri</a>
                <a href="#">Peneliti</a>
                <a href="#">Contacts</a>
            </nav>

            <div class="icons">
                <button class="write-btn">Write</button>
                <button class="icon-btn"><img src="./images/3119338.png" alt="Notification"></button>
                <div class="avatar"><img src="./images/png-clipart-success-kid-child-computer-icons-fist-pumping-child-face.png" alt="Avatar"></div>
            </div>
        </div>
        <section class="slideimages">
        <button class="left-arrow" onclick="changeSlide(-1)">&#8592;</button>
        <button class="right-arrow" onclick="changeSlide(1)">&#8594;</button>
            <div class="slide-image">
                <img src="./images/GT1QVFO.jpeg" alt="1st image" class="active">
                <img src="./images/THeVLo6.jpeg" alt="2nd image">
                <img src="./images/Ni05cBF.jpeg" alt="3rd image">
                <div class="nav-arrows">
                </div>
            </div>
        </section>
        <script>
            let currentIndex = 0; 
            const images = document.querySelectorAll('.slide-image img');
            function changeSlide(direction) {
                images[currentIndex].classList.remove('active'); 
                currentIndex += direction;   
              
                if (currentIndex < 0) {
                    currentIndex = images.length - 1; 
                } else if (currentIndex >= images.length) {
                    currentIndex = 0; 
                }
                images[currentIndex].classList.add('active');
            }
        </script>
    <section class="about-us">
        <h2>About Us</h2>
        <p>
            Welcome to Pusat Riset Informatika. We are dedicated to advancing research in the field of informatics. Our team is passionate about innovation and committed to providing valuable insights and solutions.
        </p>
        <p>
            Through collaboration and knowledge sharing, we strive to contribute to the academic community and drive technological advancements.
        </p>
    </section>
    <section class="recommendations">
        <h2>Recommendations</h2>
        <div class="recommendations-container">
            <div class="recommendation-card">
                <div class="recommendation-image"></div>
                <h3>Recommendation 1</h3>
                <p>Description about the first recommendation.</p>
            </div>
            <div class="recommendation-card">
                <div class="recommendation-image"></div>
                <h3>Recommendation 2</h3>
                <p>Description about the second recommendation.</p>
            </div>
            <div class="recommendation-card">
                <div class="recommendation-image"></div>
                <h3>Recommendation 3</h3>
                <p>Description about the third recommendation.</p>
            </div>
        </div>
    </section>
<script>
    const toggleButton = document.querySelector('.toggle-nav');
    const hiddenNavbar = document.querySelector('.hidden-navbar');

    toggleButton.addEventListener('click', () => {
        hiddenNavbar.classList.toggle('show');
    });
</script>
<script>
    let currentSlide = 0;

    function changeSlide(direction) {
        const images = document.querySelectorAll('.slide-image img');
        images[currentSlide].classList.remove('active');

        currentSlide = (currentSlide + direction + images.length) % images.length;
        images[currentSlide].classList.add('active');

        // Adjust transform property for smooth slide effect
        const slideImageContainer = document.querySelector('.slide-image');
        slideImageContainer.style.transform = `translateX(-${currentSlide * 100}%)`;
    }
</script>

</body>
</html>

<style>
/* Reset default styling */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* General styles */
body {
    font-family: 'Plus Jakarta Sans', sans-serif; 
    background-color: #f7f7f7;
}

/* Header Section */
header {
    background-color: white;
    border-bottom: 3px solid #002855; 
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px;
    max-width: 1200px;
    margin: 0 auto;
}

.logo-section {
    display: flex;
    align-items: center;
}

.logo {
    width: 50px;
    margin-right: 15px;
}

.logo-text {
    font-size: 18px;
    color: #002855; /* Dark blue */
    font-weight: bold;
}

/* Navbar */
.navbar {
    display: flex;
    justify-content: center;
    flex: 1;
    gap: 30px; /* Spacing between links */
}

.navbar a {
    font-size: 18px;
    text-decoration: none;
    color: #2E3A59; /* Blue */
    font-weight: bold;
}

.navbar a:hover {
    color: #5B3EAA; /* Purple hover effect */
}

.icons {
    display: flex;
    align-items: center;
}

.write-btn {
    padding: 10px 20px;
    border: 1px solid #0056b3;
    border-radius: 25px;
    background-color: white;
    color: #0056b3;
    cursor: pointer;
}

.write-btn:hover {
    background-color: #e8f0fe; /* Light blue on hover */
}

.icon-btn img {
    width: 24px;
}

.avatar img {
    width: 40px;
    border-radius: 50%;
    margin-left: 15px;
}

.slideimages {
    margin-top: 100px;
    position: relative;
    width: 100%;
    max-width: 600px; /* Adjust the max-width as needed */
    margin: 0 auto; /* Center the carousel */
    overflow: hidden;
}

.slide-image {
    display: flex;
    transition: transform 0.5s ease-in-out; /* Smooth transition */
}

.slide-image img {
    width: 100%; /* Each image takes full width */
    flex: 0 0 100%; /* Each image is 100% of the carousel's width */
    opacity: 0; /* Initially invisible */
    transition: opacity 0.5s ease-in-out; /* Smooth fade transition */
}

.slide-image img.active {
    opacity: 1; /* Only show the active image */
}

.nav-arrows {
    position: absolute;
    top: 50%;
    width: 100%;
    display: flex;
    justify-content: space-between;
    transform: translateY(-50%);
}

.left-arrow, .right-arrow {
    background: rgba(255, 255, 255, 0.7); /* Semi-transparent background */
    border: none;
    padding: 10px;
    cursor: pointer;
    font-size: 20px; /* Adjust the size of the arrows */
}

/* About Us Section */
.about-us {
    max-width: 800px;
    margin: 40px auto;
    padding: 20px;
    text-align: center;
}

.about-us h2 {
    font-size: 28px;
    margin-bottom: 30px;
    color: #5B3EAA; /* Purple */
}

.about-us p {
    font-size: 18px;
    color: #2E3A59; /* Dark blue */
    line-height: 1.8; /* Improved readability */
    margin-bottom: 20px;
}

/* Recommendations Section */
.recommendations {
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.recommendations h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: #5B3EAA; /* Purple */
}

.recommendations-container {
    display: flex;
    justify-content: space-between;
}

.recommendation-card {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 32%;
    transition: transform 0.3s;
}

.recommendation-card:hover {
    transform: translateY(-5px);
}

.recommendation-image {
    background-color: #b0b0b0;
    height: 150px;
    border-radius: 8px;
    margin-bottom: 15px;
}

.recommendation-card h3 {
    font-size: 18px;
    margin-bottom: 10px;
    color: #E05A00; /* Orange */
}

.recommendation-card p {
    color: #6d6d6d;
}

/* Hidden Navbar for Mobile */
.hidden-navbar {
    display: none;
}

/* Mobile Toggle Button */
.toggle-nav {
    display: none;
    cursor: pointer;
    padding: 10px;
    background-color: #0056b3;
    color: white;
    border: none;
    border-radius: 5px;
}

/* Mobile Responsiveness */
@media (max-width: 768px) {
    .hidden-navbar {
        display: block;
        position: absolute;
        top: 60px;
        right: 0;
        background-color: white;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 10px;
        border-radius: 5px;
        z-index: 10;
    }

    .navbar {
        display: none;
    }

    .toggle-nav {
        display: block;
    }

    .recommendations-container {
        flex-direction: column;
    }

    .recommendation-card {
        width: 100%;
        margin-bottom: 20px;
    }
}
</style>
