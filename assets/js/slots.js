document.getElementById("appointment_date").addEventListener("change", loadSlots);
document.getElementById("doctor_id").addEventListener("change", loadSlots);

function loadSlots() {
  const doctorId = document.getElementById("doctor_id").value;
  const date = document.getElementById("appointment_date").value;
 console.log(doctorId,date)
  if (!doctorId || !date) return;

  fetch(`get_slots.php?doctor_id=${doctorId}&date=${date}`)
    .then(res => res.json())
    .then(data => {
      const slotSelect = document.getElementById("appointment_time");
      slotSelect.innerHTML = '<option value="">Select Slot</option>';

      data.forEach(time => {
        slotSelect.innerHTML += `<option value="${time}">${time}</option>`;
      });
    });
}
