// dropdown.js

document.addEventListener("DOMContentLoaded", function () {
    const customProfileIcon = document.getElementById("customProfileIcon");
    const customDropdownMenu = document.getElementById("customDropdownMenu");
    
  
    // Toggle dropdown on icon click
    customProfileIcon.addEventListener("click", function (e) {
      e.stopPropagation(); // Prevent closing when clicking the icon
      customDropdownMenu.style.display =
        customDropdownMenu.style.display === "block" ? "none" : "block";
    });
  
    window.addEventListener("click", function (e) {
      if (!customProfileIcon.contains(e.target) && !customDropdownMenu.contains(e.target)) {
        customDropdownMenu.style.display = "none";
      }
    });
    // Close dropdown if clicking outside
    document.addEventListener("click", function (e) {
      if (!document.getElementById("customProfileDropdown").contains(e.target)) {
        customDropdownMenu.style.display = "none";
      }
    });
  
    // Optional: Close dropdown when clicking on links inside it
    customDropdownMenu.querySelectorAll("a").forEach((link) => {
      link.addEventListener("click", () => {
        customDropdownMenu.style.display = "none";
      });
    });
   
  });
  
  