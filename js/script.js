//Inicio de sesion
document.getElementById("login-form").addEventListener("submit", function(event) {
    event.preventDefault();
    var username = document.getElementsByName("username")[0].value;
    var password = document.getElementsByName("password")[0].value;
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "../login.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response.success) {
          window.location.href = "../conexion.php";
        } else {
          document.getElementById("error-message").innerHTML = response.message;
        }
      }
    };
    xhr.send("username=" + username + "&password=" + password);
  });

  