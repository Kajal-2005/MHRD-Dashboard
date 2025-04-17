<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login_system/login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MHRD Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="script.js" defer></script>
    
    <style>
        #indiaMap {
            height: 500px; /* Adjust as needed */
        }
    </style>

</head>
<body class="bg-gray-100">
<div id="contentArea">
<!-- Login Modal -->
<div class="bg-blue-900 text-white text-sm py-2 px-4 flex justify-between content-block">
    <span id="current-time"></span> <!-- Dynamic Time -->
    <div>
    <?php
    $email = $_SESSION['user_email'];
    $username = explode("@", $email)[0];
    echo '<span class="px-2 font-semibold">Hello, ' . htmlspecialchars($username) . '</span>';
?>
    <a href="#" class="px-2">Home</a>
    <a href="#" class="px-2">Skip to main content</a>
    <a href="/project\login_system\logout.php" class="px-2 text-red-400 hover:underline">Logout</a>
    </div>
</div>
<div>



<!-- Header -->
<header class="bg-white shadow-md py-4 px-6 flex justify-between items-center h-24">
    <div class="flex items-center content-block">
        <img src="images/NE_Preview1.png" alt="MHRD Logo" class="h-24 mr-15">
        <h1 class="text-2xl font-semibold">Ministry of Education <br>
            <span class="text-2x1">Government of India</span>
        </h1>
    </div>
    <div class="relative mr-20">
        <input type="text" id="searchInput" placeholder="Search..." class="border rounded-lg px-3 py-2 pr-10">
        <button id="search-button" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-600">
            <i class="fa-solid fa-magnifying-glass text-2xl"></i>
        </button>
    </div>
</header>

<!-- Navigation Menu -->
<nav class="bg-blue-700 text-white py-2 px-6">
    <ul class="flex space-x-6">
        <li><a href="#aboutus" class="hover:underline">About Us</a></li>
        <li><a href="#initiatives" class="hover:underline">Initiatives & Reports</a></li>
        <li><a href="#schemes" class="hover:underline">Schemes</a></li>
    
        <li><a href="#statistics" class="hover:underline">Statistics</a></li>
    </ul>
</nav>

<!-- Slideshow Hero Section -->
<div class="relative w-full h-[500px] overflow-hidden content-block" id="aboutus">
    <div id="slideshow-container" class="absolute inset-0 transition-opacity duration-1000 w-full h-full">
        <a href="https://example.com/link1" target="_blank">
            <img src="images/H20230602133044.jpg" class="absolute inset-0 w-full h-full object-cover slide">
        </a>
        <a href="https://example.com/link2" target="_blank">
            <img src="images/Web-Banner-Hindi_1600X500.jpg" class="absolute inset-0 w-full h-full object-cover slide">
        </a>
        <a href="https://example.com/link3" target="_blank">
            <img src="images/impowering.jpg" class="absolute inset-0 w-full h-full object-cover slide">
        </a>
    </div>
</div>

<!-- Major Initiatives Section -->
<div class="w-full bg-gray-100 py-8 content-block">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-6" id="initiatives">Major Initiatives</h2>
    
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6 text-center px-4 md:px-16">
            <a href="https://www.presentations.gov.in/logos/150-years-of-celebrating-mahatma/#:~:text=In%202019%2C%20the%20nation%20has,%2Dviolence%2C%20equality%20and%20freedom." class="block" target="_blank">
                <img src="images/150-years_Preview.png" alt="150 Years of Celebrating The Mahatma" 
                    class="mx-auto w-full h-auto transform transition duration-300 hover:scale-110">
                <p class="mt-2">150 Years of Celebrating The Mahatma</p>
            </a>
    
            <a href="https://ekbharat.gov.in/" class="block" target="_blank">
                <img src="images/ek-bharat-shreshtha-bharat-ek-bharat-shreshtha-bharat-01.jpg" alt="Ek Bharat Shreshtha Bharat" 
                    class="mx-auto w-full h-auto transform transition duration-300 hover:scale-110">
                <p class="mt-2">Ek Bharat Shreshtha Bharat</p>
            </a>
    
            <a href="https://dsel.education.gov.in/hi/nkpa" class="block" target="_blank">
                <img src="images/NE_Preview1.png" alt="Nagrik Kartavya Palaan Abhiyan" 
                    class="mx-auto w-full h-auto transform transition duration-300 hover:scale-110">
                <p class="mt-2">Nagrik Kartavya Palaan Abhiyan</p>
            </a>
    
            <a href="https://dsel.education.gov.in/sbsv" class="block" target="_blank">
                <img src="images/f5545c221012645.67cd7056929bf.jpg" alt="Swachh Bharat Swachh Vidyalaya" 
                    class="mx-auto w-full h-auto transform transition duration-300 hover:scale-110">
                <p class="mt-2">Swachh Bharat Swachh Vidyalaya</p>
            </a>
    
            <a href="https://fitindia.gov.in/" class="block" target="_blank">
                <img src="images/fit-india-fit-india-01-01.jpg" alt="FIT India" 
                    class="mx-auto w-full h-auto transform transition duration-300 hover:scale-110">
                <p class="mt-2">FIT India</p>
            </a>
    
            <a href="https://ncert.nic.in/manodarpan.php" class="block" target="_blank">
                <img src="images/mygov_159529793051553221.jpg" alt="MANODARPAN for Psychosocial Support" 
                    class="mx-auto w-full h-auto transform transition duration-300 hover:scale-110">
                <p class="mt-2">MANODARPAN for Psychosocial Support</p>
            </a>
        </div>
    </div>
    <!-- InFocus and Updates Section -->
    <div class="w-full bg-blue-600 py-8 content-block">
        <div class="px-6">
        <div class="mx-0 grid grid-cols-1 md:grid-cols-3 gap-10">  <!-- Removed container & increased gap -->
            
            <!-- InFocus Section -->
            <div class="bg-blue-300 p-4 rounded-lg">
                <h3 class="text-xl font-bold text-red-600">InFocus</h3>
                <p class="mt-2 text-gray-900">
                    <a href="https://example.com/in-focus" target="_blank" class="text-blue-800 hover:underline hover:text-blue-600">
                            Special Address by PM Shri Narendra Modi | Post-Budget Panel Discussion | Investing in People
                    </a>
                </p>
            </div>

            <!-- Updates Section -->
            <div class="bg-white p-4 rounded-lg shadow-md"> 
                <div class="flex space-x-4 border-b pb-2">
                    <button class="font-semibold text-gray-800 border px-3 py-1 rounded-t-lg bg-white">Update</button>
                </div>
            
                <div class="mt-4 max-h-40 overflow-y-auto">
                    <a href="/project/MHRD/pdf file/muhas.pdf" class="block text-gray-700 hover:underline flex items-start p-2 link-confirmation" target="_blank">
                        <img src="Icon_pdf_file.svg.png" alt="PDF" class="w-5 h-5 mt-1 mr-2">
                        <span>Public Notice for Academic Programs and Opportunities offered by Muhimbili University of Health and Allied Services (MUHAS) to India students (Monday, 24-March-2025) - (9.12 MB)</span>
                    </a>
            
                    <a href="\project\MHRD\pdf file\PIB2112207.pdf" class="block text-gray-700 hover:underline flex items-start p-2 link-confirmation" target="_blank">
                        <img src="Icon_pdf_file.svg.png" alt="PDF" class="w-5 h-5 mt-1 mr-2">
                        <span>Prime Minister’s Young Authors Mentorship Scheme (YUVA) Scheme (Tuesday, 18-March-2025) - (266.53 KB)</span>
                    </a>
                </div>
            </div>
            
            <!-- Video Section -->
            <iframe width="100%" height="200" 
                src="https://www.youtube.com/embed/XbMCAC2sC7Y" 
                frameborder="0" 
                allowfullscreen>
            </iframe>

        </div>
        </div>
    </div>
    

<!-- Schemes -->
<div class="bg-gray-100 py-2 content-block" id="schemes"> 
    <div class="container mx-auto px-10 flex flex-col md:flex-row items-start">
        <!-- Left Text Section -->
        <div class="md:w-1/3 pr-6 mb-6 md:mb-0">
            <h2 class="text-2xl font-bold text-gray-900">SCHEMES</h2>
            <p class="text-gray-700 mt-2 text-4x1 leading-relaxed">
                Rashtriya Uchchatar Shiksha Abhiyan | National Research Professorship | Pandit Madan Mohan Malaviya National Mission on Teachers And Teaching
            </p>
            <a href="https://www.education.gov.in/schemes" class="text-blue-600 font-semibold mt-3 inline-block text-sm">More Schemes</a>
        </div>

        <!-- Right Grid Section -->
        <div class="md:w-2/3 grid grid-cols-2 sm:grid-cols-4 gap-6 items-center">
            <div class="text-center">
                <a href="https://www.samagrashikshajk.nic.in/" target="_blank">
                    <img src="images/samgrasiksha.png" alt="Samagra Shiksha" class="w-32 h-32 mx-auto border rounded-xl shadow">
                    <p class="mt-3 text-gray-800 hover:text-blue-600 text-sm font-medium">Samagra Shiksha</p>
                </a>
            </div>

            <div class="text-center">
                <a href="https://pmposhan.education.gov.in/" target="_blank">
                    <img src="images/poshan03.jpg" alt="PM Poshan Scheme" class="w-32 h-32 mx-auto border rounded-xl shadow">
                    <p class="mt-3 text-gray-800 hover:text-blue-600 text-sm font-medium">PM Poshan Scheme</p>
                </a>
            </div>

            <div class="text-center">
                <a href="http://rusa.nic.in/" target="_blank">
                    <img src="images/images.jpg" alt="RUSA" class="w-32 h-32 mx-auto border rounded-xl shadow">
                    <p class="mt-3 text-gray-800 hover:text-blue-600 text-sm font-medium leading-tight">Rashtriya<br>Uchchatar<br>Shiksha Abhiyan</p>
                </a>
            </div>

            <div class="text-center">
                <a href="https://unnatbharatabhiyan.gov.in/" target="_blank">
                    <img src="images/unnat_bharat_abhiyan_miranda_house_logo.jpg" alt="Unnat Bharat Abhiyan" class="w-32 h-32 mx-auto border rounded-xl shadow">
                    <p class="mt-3 text-gray-800 hover:text-blue-600 text-sm font-medium">Unnat Bharat Abhiyan</p>
                </a>
            </div>
        </div>
    </div>
</div>


<!-- Notifications Section -->
<section class="p-6 bg-white rounded-2xl shadow-lg mt-8">
  <h2 class="text-2xl font-bold text-gray-800 mb-5 flex items-center gap-2">
    📢 <span>Important Notifications / Announcements</span>
  </h2>

  <div class="space-y-4 content-block">
    <!-- Notification 1 -->
    <div class="p-4 bg-blue-50 border-l-4 border-blue-400 rounded-lg shadow-sm">
        <a href="https://www.education.gov.in/nep/regulations-guidelines-framework" target="_blank">
      <h3 class="text-lg font-semibold text-blue-800">📝 Circular: New NEP Guidelines Released</h3>
      <p class="text-sm text-blue-700">Updated NEP 2025 guidelines are now available. <span class="block text-xs text-blue-500 mt-1">[April 10, 2025]</span></p></a>
    </div>

    <!-- Notification 2 -->
    <div class="p-4 bg-green-50 border-l-4 border-green-400 rounded-lg shadow-sm content-block">
      <a href="https://dsel.education.gov.in/ncte" target="_blank"><h3 class="text-lg font-semibold text-green-800">📘 Upcoming Policy Change: Teacher Training Mandate</h3>
      <p class="text-sm text-green-700">Digital training for teachers is mandatory by June 2025. <span class="block text-xs text-green-500 mt-1">[April 5, 2025]</span></p></a>
    </div>

    <!-- Notification 3 -->
    <div class="p-4 bg-purple-50 border-l-4 border-purple-400 rounded-lg shadow-sm">
        <a href="https://minorityaffairs.gov.in/show_content.php?lang=1&level=1&ls_id=777&lid=825" target="_blank">
      <h3 class="text-lg font-semibold text-purple-800">🎓 Scholarship Deadline: Pre-Matric Applications</h3>
      <p class="text-sm text-purple-700">Last date for submission: May 15, 2025. <span class="block text-xs text-purple-500 mt-1">[March 30, 2025]</span></p> </a>
    </div>

    <!-- Notification 4 -->
    <div class="p-4 bg-red-50 border-l-4 border-red-400 rounded-lg shadow-sm">
        <a href="https://cbseit.in/cbse/web/regn/pvtadmcard.aspx" target="_blank">
      <h3 class="text-lg font-semibold text-red-800">📅 Exam Alert: CBSE Class 10 & 12 Final Exams</h3>
      <p class="text-sm text-red-700">Exams start May 1st. Hall tickets release April 20th. <span class="block text-xs text-red-500 mt-1">[April 12, 2025]</span></p></a>
    </div>
  </div>
</section>

<section class="bg-white p-6 rounded-2xl shadow-lg mt-8 flex" id="statistics" >
    <div class="w-1/2 pr-4">
        <h2 class="text-2xl font-bold mb-4 dark:text-white">📍 Interactive India Map</h2>
        <h1 class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-300">Check literacy rate of your state</h1>
        <div id="indiaMap" class="w-full h-[500px] rounded-xl border border-gray-300 dark:border-gray-700"></div>
    </div>
    <div class="w-1/2 pl-4">
        <h2 style="padding-top: 50px;" class="text-lg font-semibold mb-2 text-gray-700 dark:text-gray-300">Top 5 Most Literate states of india</h2>
        <img src="https://pwonlyias.com/wp-content/uploads/2023/09/132-65cafdd58b3a9.webp" alt="Top 5 Most Literate States" class="w-full rounded-xl shadow-md" style="margin-top: 40px;">
        <!-- <p class="text-sm text-gray-500 mt-2">Source: [Insert your data source here]</p> -->
    </div>
</section>

</div>

<!-- Footer -->
<footer class="bg-gray-800 text-white text-center py-4 mt-8">
    <p>© 2025 Ministry of Education, Government of India. All Rights Reserved.</p>
</footer>

</body>
</html>

