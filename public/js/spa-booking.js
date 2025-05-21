document.addEventListener("DOMContentLoaded", () => {
    // Handle booking button click
    const bookingBtns = document.querySelectorAll(".bookingBtn")
  
    bookingBtns.forEach((btn) => {
      btn.addEventListener("click", function () {
        const spaId = this.getAttribute("data-spa-id")
  
        // Fetch services from the server for this specific spa
        fetch(`/api/spas/${spaId}/services`)
          .then((response) => response.json())
          .then((services) => {
            if (services.length === 0) {
              // If no services found, show a message
              Swal.fire({
                title: "No Services Available",
                text: "This spa does not have any services available for booking.",
                icon: "info",
                confirmButtonText: "OK",
              })
              return
            }
  
            // Generate HTML for services
            let servicesHTML = ""
            services.forEach((service) => {
              servicesHTML += `
                              <div class="border rounded-lg p-4 mb-3 hover:bg-gray-50 cursor-pointer service-option" data-id="${service.id}" data-price="${service.price}">
                                  <div class="flex justify-between items-start">
                                      <div>
                                          <h3 class="font-bold text-lg">${service.name}</h3>
                                          <p class="text-sm text-gray-500">${service.duration || ""}</p>
                                          <p class="text-sm text-gray-500">${service.description || ""}</p>
                                      </div>
                                      <div class="text-xl font-bold">+</div>
                                  </div>
                                  <div class="mt-2 font-semibold">Rp ${new Intl.NumberFormat("id-ID").format(service.price)}</div>
                              </div>
                          `
            })
  
            Swal.fire({
              title: "Select Services",
              html: `
                              <div class="text-left">
                                  ${servicesHTML}
                                  
                                  <div class="mt-4">
                                      <div class="flex justify-between items-center font-bold text-lg">
                                          <span>Total</span>
                                          <span id="service-total">Rp 0</span>
                                      </div>
                                  </div>
                              </div>
                          `,
              showCancelButton: true,
              confirmButtonText: "Continue",
              cancelButtonText: "Cancel",
              width: "600px",
              didOpen: () => {
                const serviceOptions = document.querySelectorAll(".service-option")
                const serviceTotal = document.getElementById("service-total")
                let total = 0
                let selectedServices = []
  
                serviceOptions.forEach((option) => {
                  option.addEventListener("click", function () {
                    this.classList.toggle("selected")
  
                    const serviceId = this.getAttribute("data-id")
  
                    if (this.classList.contains("selected")) {
                      this.style.backgroundColor = "#f0f9ff"
                      this.style.borderColor = "#3b82f6"
  
                      // Extract price
                      const price = Number.parseFloat(this.getAttribute("data-price"))
                      total += price
  
                      // Add to selected services
                      selectedServices.push(serviceId)
                    } else {
                      this.style.backgroundColor = ""
                      this.style.borderColor = ""
  
                      // Extract price
                      const price = Number.parseFloat(this.getAttribute("data-price"))
                      total -= price
  
                      // Remove from selected services
                      selectedServices = selectedServices.filter((id) => id !== serviceId)
                    }
  
                    // Update total
                    serviceTotal.textContent = `Rp ${new Intl.NumberFormat("id-ID").format(total)}`
                  })
                })
              },
            }).then((result) => {
              if (result.isConfirmed) {
                // Get all selected services
                const selectedServices = Array.from(document.querySelectorAll(".service-option.selected")).map((el) =>
                  el.getAttribute("data-id"),
                )
  
                if (selectedServices.length === 0) {
                  Swal.fire({
                    title: "No Services Selected",
                    text: "Please select at least one service to continue.",
                    icon: "warning",
                    confirmButtonText: "OK",
                  })
                  return
                }
  
                // Show date and time selection
                Swal.fire({
                  title: "Select Date and Time",
                  html: `
                                      <div class="text-left">
                                          <div class="mb-4">
                                              <label for="booking-date" class="block text-sm font-medium text-gray-700 mb-1">Date</label>
                                              <input type="date" id="booking-date" class="w-full px-3 py-2 border border-gray-300 rounded-md" min="${new Date().toISOString().split("T")[0]}" required>
                                          </div>
                                          <div class="mb-4">
                                              <label for="booking-time" class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                                              <select id="booking-time" class="w-full px-3 py-2 border border-gray-300 rounded-md" required>
                                                  <option value="">Select a time</option>
                                                  <option value="09:00">09:00 AM</option>
                                                  <option value="10:00">10:00 AM</option>
                                                  <option value="11:00">11:00 AM</option>
                                                  <option value="13:00">01:00 PM</option>
                                                  <option value="14:00">02:00 PM</option>
                                                  <option value="15:00">03:00 PM</option>
                                                  <option value="16:00">04:00 PM</option>
                                              </select>
                                          </div>
                                      </div>
                                  `,
                  showCancelButton: true,
                  confirmButtonText: "Continue to Checkout",
                  cancelButtonText: "Cancel",
                  preConfirm: () => {
                    const date = document.getElementById("booking-date").value
                    const time = document.getElementById("booking-time").value
  
                    if (!date || !time) {
                      Swal.showValidationMessage("Please select both date and time")
                      return false
                    }
  
                    return { date, time }
                  },
                }).then((result) => {
                  if (result.isConfirmed) {
                    // Create a form to submit the data
                    const form = document.createElement("form")
                    form.method = "POST"
                    form.action = "/booking/checkout"
  
                    // Add CSRF token
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                    const csrfInput = document.createElement("input")
                    csrfInput.type = "hidden"
                    csrfInput.name = "_token"
                    csrfInput.value = csrfToken
                    form.appendChild(csrfInput)
  
                    // Add spa_id
                    const spaIdInput = document.createElement("input")
                    spaIdInput.type = "hidden"
                    spaIdInput.name = "spa_id"
                    spaIdInput.value = spaId
                    form.appendChild(spaIdInput)
  
                    // Add selected services
                    selectedServices.forEach((serviceId) => {
                      const serviceInput = document.createElement("input")
                      serviceInput.type = "hidden"
                      serviceInput.name = "services[]"
                      serviceInput.value = serviceId
                      form.appendChild(serviceInput)
                    })
  
                    // Add date and time
                    const dateInput = document.createElement("input")
                    dateInput.type = "hidden"
                    dateInput.name = "date"
                    dateInput.value = result.value.date
                    form.appendChild(dateInput)
  
                    const timeInput = document.createElement("input")
                    timeInput.type = "hidden"
                    timeInput.name = "time"
                    timeInput.value = result.value.time
                    form.appendChild(timeInput)
  
                    // Append form to body and submit
                    document.body.appendChild(form)
                    form.submit()
                  }
                })
              }
            })
          })
          .catch((error) => {
            console.error("Error fetching services:", error)
            Swal.fire({
              title: "Error",
              text: "Unable to load services. Please try again later.",
              icon: "error",
              confirmButtonText: "OK",
            })
          })
      })
    })
  })
  