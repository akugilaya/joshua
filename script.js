document.addEventListener("DOMContentLoaded", function() {
  fetch('get_user_profile.php')
      .then(response => response.json())
      .then(data => {
          if (data.error) {
              console.error("Error:", data.error);
          } else {
              // Menampilkan data pengguna di elemen HTML
              document.getElementById("profile-picture").src = data.profile_picture || "default-profile.png";
              document.getElementById("username").textContent = data.username;
          }
      })
      .catch(error => console.error("Error fetching user data:", error));
});
