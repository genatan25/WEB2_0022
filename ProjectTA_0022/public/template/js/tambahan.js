document.addEventListener("DOMContentLoaded", function () {
  // Get DOM elements
  const profileCircle = document.querySelector(".profile-circle");
  const profileDropdown = document.querySelector(".profile-dropdown");
  const settingsTrigger = document.getElementById("settings-trigger");
  const settingsSubmenu = document.querySelector(".settings-submenu");
  const themeToggle = document.getElementById("themeToggle");

  // Theme Management
  const initializeTheme = () => {
    const isDarkMode = localStorage.getItem("darkMode") === "true";
    document.body.classList.toggle("dark-mode", isDarkMode);
    if (themeToggle) {
      themeToggle.checked = isDarkMode;
    }
  };

  const toggleTheme = (checked) => {
    document.body.classList.toggle("dark-mode", checked);
    localStorage.setItem("darkMode", checked);
  };

  // Initialize theme on load
  initializeTheme();

  // Event Listeners
  if (profileCircle) {
    profileCircle.addEventListener("click", function (e) {
      e.stopPropagation();
      profileDropdown.style.display =
        profileDropdown.style.display === "block" ? "none" : "block";
      if (settingsSubmenu) {
        settingsSubmenu.style.display = "none";
      }
    });
  }

  if (settingsTrigger) {
    settingsTrigger.addEventListener("mouseenter", function () {
      settingsSubmenu.style.display = "block";
    });

    const settingsMenu = settingsSubmenu.parentElement;
    settingsMenu.addEventListener("mouseleave", function () {
      settingsSubmenu.style.display = "none";
    });
  }

  if (themeToggle) {
    themeToggle.addEventListener("change", function () {
      toggleTheme(this.checked);
    });
  }

  // Close dropdowns when clicking outside
  document.addEventListener("click", function (e) {
    if (profileDropdown && !profileDropdown.contains(e.target)) {
      profileDropdown.style.display = "none";
      if (settingsSubmenu) {
        settingsSubmenu.style.display = "none";
      }
    }
  });

  // Handle keyboard navigation
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      if (profileDropdown) {
        profileDropdown.style.display = "none";
      }
      if (settingsSubmenu) {
        settingsSubmenu.style.display = "none";
      }
    }
  });
});
