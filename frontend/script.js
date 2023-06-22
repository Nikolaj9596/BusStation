document.addEventListener("DOMContentLoaded", function() {
  const scheduleLink = document.getElementById("schedule-link");
  const tiketLink = document.getElementById("tiket-link");

  const scheduleContent = document.getElementById("schedule-content");
  const mainContent = document.getElementById("main-content");
  const tiketsContent = document.getElementById("tikets-content");

  function evalScripts(container) {
    const scripts = container.getElementsByTagName("script");
    for (let i = 0; i < scripts.length; i++) {
      eval(scripts[i].innerText);
    }
  }

  scheduleLink.addEventListener("click", function(event) {
    event.preventDefault();

    fetch("http://localhost:80/schedule.html")
      .then(function(response) {
        return response.text();
      })
      .then(function(data) {
        scheduleContent.innerHTML = data;
        mainContent.style.display = "none";
        tiketsContent.style.display = "none";
        evalScripts(scheduleContent);
      })
      .catch(function(error) {
        console.log("Error loading schedule file:", error);
      });
  });

  tiketLink.addEventListener("click", function(event) {
    event.preventDefault();

    fetch("http://localhost:80/tikets.html")
      .then(function(response) {
        return response.text();
      })
      .then(function(data) {
        tiketsContent.innerHTML = data;
        scheduleContent.style.display = "none";
        mainContent.style.display = "none";
      })
      .catch(function(error) {
        console.log("Error loading schedule file:", error);
      });
  });
});