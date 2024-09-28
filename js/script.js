let navbar = document.querySelector(".header .flex .navbar");

document.querySelector("#menu-btn").onclick = () => {
  navbar.classList.toggle("active");
  profile.classList.remove("active");
  searchForm.classList.remove("active");
};

let profile = document.querySelector(".header .flex .profile");

document.querySelector("#user-btn").onclick = () => {
  profile.classList.toggle("active");
  navbar.classList.remove("active");
  searchForm.classList.remove("active");
};

let searchForm = document.querySelector(".header .flex .search-form");

document.querySelector("#search-btn").onclick = () => {
  searchForm.classList.toggle("active");
  navbar.classList.remove("active");
  profile.classList.remove("active");
};

function toggleMode() {
  const lightModeBtn = document.getElementById("lightmode-btn");
  const darkModeBtn = document.getElementById("darkmode-btn");

  if (lightModeBtn.classList.contains("hidden")) {
    lightModeBtn.classList.remove("hidden");
    darkModeBtn.classList.add("hidden");

    // Change CSS variables for light mode
    document.documentElement.style.setProperty("--white", "#fff");
    document.documentElement.style.setProperty("--light-bg", "#f5f5f5");
    document.documentElement.style.setProperty("--light-color", "#999");
    document.documentElement.style.setProperty("--black", "#34495e");
  } else {
    lightModeBtn.classList.add("hidden");
    darkModeBtn.classList.remove("hidden");

    // Change CSS variables for dark mode
    document.documentElement.style.setProperty("--white", "black");
    document.documentElement.style.setProperty("--light-bg", "black");
    document.documentElement.style.setProperty("--light-color", "#c2c0c0");
    document.documentElement.style.setProperty("--black", "#728ba3");
  }
}

window.onscroll = () => {
  navbar.classList.remove("active");
  searchForm.classList.remove("active");
};

document.querySelectorAll(".content-150").forEach((content) => {
  if (content.innerHTML.length > 150)
    content.innerHTML = content.innerHTML.slice(0, 150);
});
