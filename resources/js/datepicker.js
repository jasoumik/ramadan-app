import flatpickr from "flatpickr"; // Import Flatpickr
import "flatpickr/dist/flatpickr.css"; // Import Flatpickr CSS

document.addEventListener("DOMContentLoaded", function () {
    let dateInput = document.getElementById("datepicker");

    if (dateInput) {
        flatpickr(dateInput, {
            dateFormat: "Y-m-d",
            defaultDate: dateInput.value || new Date(), // Set the default date
            onChange: function (selectedDates, dateStr) {
                let url = new URL(window.location.href);
                url.searchParams.set("date", dateStr); // Update the URL with the selected date
                window.location.href = url.toString();
            }
        });
    }
});
