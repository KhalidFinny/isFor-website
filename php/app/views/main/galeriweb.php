<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gallery</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .title-float { animation: float 6s ease-in-out infinite; }
    .gallery-item { animation: fadeIn 0.5s ease-out forwards; opacity: 0; }
    .hover-info { transform: translateY(100%); transition: transform 0.3s ease-out; }
    .gallery-item:hover .hover-info { transform: translateY(0); }
    .gallery-item:hover .image-overlay { opacity: 1; }
    .gallery-image { transition: transform 0.3s ease-out; }
    .gallery-item:active .gallery-image { transform: scale(1.05); }
    .lightbox { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.9); z-index: 1000; justify-content: center; align-items: center; }
    .lightbox.active { display: flex; }
    .lightbox img { max-width: 90%; max-height: 90vh; object-fit: contain; }
  </style>
</head>
<body class="bg-gray-50/50">
<?php if (!isset($_SESSION['user_id'])) : ?>
    <?php include_once '../app/views/assets/components/navbar.php'; ?>
<?php else : ?>
    <?php include_once '../app/views/assets/components/navbarafterlogin.php'; ?>
<?php endif; ?>

<section class="pt-24 md:pt-32 pb-16 min-h-screen">
  <div class="w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <!-- Header Section -->
    <div class="text-center space-y-6 mb-16">
      <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-purple-700 title-float">GALERI</h1>
      <div class="h-1 w-24 mx-auto bg-purple-700 rounded-full title-float"></div>
      <h2 class="text-xl md:text-2xl text-purple-600 font-medium tracking-wide">Network Management System</h2>
    </div>

    <!-- Gallery Grid -->
    <div id="gallery" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8"></div>
  </div>
</section>

<!-- Lightbox for zoomed view -->
<div id="lightbox" class="lightbox" onclick="this.classList.remove('active')">
  <img src="" alt="Zoomed image" id="lightbox-img" />
</div>

<script>
  const galleryItems = [
    {
      title: "Network Infrastructure Overview",
      author: "John Smith",
      date: "October 15, 2023",
      image: "/images/spicy1.jpg",
      alt: "Network infrastructure diagram and equipment"
    },
    {
      title: "System Performance Analysis",
      author: "Sarah Johnson",
      date: "November 3, 2023",
      image: "/images/spicy1.jpg",
      alt: "System performance graphs and metrics"
    },
    {
      title: "Security Implementation",
      author: "Mike Davis",
      date: "December 8, 2023",
      image: "/images/spicy1.jpg",
      alt: "Network security implementation diagram"
    },
    {
      title: "Network Monitoring Tools",
      author: "Emma Wilson",
      date: "January 22, 2024",
      image: "/images/spicy1.jpg",
      alt: "Network monitoring dashboard"
    },
    {
      title: "Data Center Management",
      author: "Alex Chen",
      date: "February 15, 2024",
      image: "/images/spicy1.jpg",
      alt: "Data center management interface"
    },
    {
      title: "Network Optimization",
      author: "David Park",
      date: "March 5, 2024",
      image: "/images/spicy1.jpg",
      alt: "Network optimization metrics"
    }
  ];

  document.addEventListener("DOMContentLoaded", () => {
    const galleryContainer = document.getElementById("gallery");
    galleryItems.forEach(item => {
      const galleryItem = document.createElement("div");
      galleryItem.className = "gallery-item group cursor-pointer";
      galleryItem.setAttribute("data-image", item.image);
      galleryItem.innerHTML = `
        <div class="relative overflow-hidden rounded-xl aspect-[4/3] bg-gray-100 shadow-md hover:shadow-xl transition-shadow duration-300">
          <img src="${item.image}" alt="${item.alt}" class="gallery-image absolute inset-0 w-full h-full object-cover" loading="lazy" />
          <div class="absolute inset-0 bg-black/50 opacity-0 transition-opacity duration-300 image-overlay"></div>
          <div class="absolute bottom-0 left-0 right-0 bg-black/75 p-4 hover-info">
            <h3 class="text-white font-semibold text-lg mb-2">${item.title}</h3>
            <div class="flex items-center justify-between text-sm text-gray-300">
              <p>By ${item.author}</p>
              <p>${item.date}</p>
            </div>
          </div>
        </div>
      `;
      galleryContainer.appendChild(galleryItem);
    });

    const lightbox = document.getElementById("lightbox");
    const lightboxImg = document.getElementById("lightbox-img");
    const galleryItemsElements = document.querySelectorAll(".gallery-item");
    galleryItemsElements.forEach((item) => {
      item.addEventListener("click", () => {
        const imgSrc = item.getAttribute("data-image");
        if (imgSrc) {
          lightboxImg.src = imgSrc;
          lightbox.classList.add("active");
        }
      });
    });
    lightbox.addEventListener("click", (event) => {
      if (event.target === lightbox) {
        lightbox.classList.remove("active");
      }
    });
  });
</script>

</body>
</html>

