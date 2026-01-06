document.getElementById("appointmentForm").addEventListener("submit", function (e) {
  e.preventDefault(); // 🚫 stop page reload

  const formData = new FormData(this);
  const msg = document.getElementById("msg");

  msg.textContent = "Booking appointment...";
  msg.style.color = "#374151";

  fetch("book_action.php", {
    method: "POST",
    body: formData
  })
    .then(res => res.text())
    .then(data => {
      msg.textContent = data;

      if (data.includes("Appointment booked")) {
        msg.style.color = "green";
        this.reset(); // optional
      } else {
        msg.style.color = "red";
      }
    })
    .catch(() => {
      msg.textContent = "Something went wrong";
      msg.style.color = "red";
    });
});
