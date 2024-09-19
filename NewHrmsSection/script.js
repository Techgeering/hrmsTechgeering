//Image Signature Upload

document.getElementById('save-btn').addEventListener('click', function () {
    const fileInput = document.getElementById('image-sign');
    const file = fileInput.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onloadend = function () {
            const imageData = reader.result;
            localStorage.setItem('uploadedSignature', imageData);
            window.location.href = 'all-details.html';
        };

        reader.readAsDataURL(file);
    }
});

//Camera Access and Photo Capture

async function startCamera() {
    const video = document.getElementById('video');
    const captureButton = document.getElementById('capture');
    try {
        // Access the camera
        const stream = await navigator.mediaDevices.getUserMedia({ video: true });
        video.srcObject = stream;
        video.style.display = 'block';
        captureButton.style.display = 'inline-block'; // Show the capture button

        // Start playing the video
        video.play();
    } catch (error) {
        console.error('Error accessing camera: ', error);
    }
}

function capturePhoto() {
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const context = canvas.getContext('2d');
    const profileImage = document.getElementById('profile-image');
    const imageName = document.getElementById('image-name');

    // Draw the current video frame to the canvas
    context.drawImage(video, 0, 0, canvas.width, canvas.height);
    const imageUrl = canvas.toDataURL('image/png');

    // Generate a random file name
    const randomName = 'profile-' + Math.random().toString(36).substr(2, 9) + '.png';

    // Set the image source to the canvas data URL
    profileImage.src = imageUrl;

    // Update the image name display
    imageName.textContent = `${randomName}`;

    // Stop the video stream
    const stream = video.srcObject;
    if (stream) {
        const tracks = stream.getTracks();
        tracks.forEach(track => track.stop());
    }

    // Hide video and canvas elements
    video.style.display = 'none';
    canvas.style.display = 'none';
    document.getElementById('capture').style.display = 'none'; // Hide the capture button
}

// Image Upload Preview

function uploadPhoto() {
    const fileInput = document.getElementById('upload-photo');
    const uploadedImage = document.getElementById('uploaded-image');
    const uploadImageName = document.getElementById('upload-image-name');

    const file = fileInput.files[0];
    if (file) {
        const reader = new FileReader();

        // Display image name
        uploadImageName.textContent = file.name;

        reader.onload = function (e) {
            // Set the src of the image element to the file data URL
            uploadedImage.src = e.target.result;
            uploadedImage.style.display = 'block'; // Show the uploaded image
        };

        // Read the image file as a data URL
        reader.readAsDataURL(file);
    } else {
        // Reset if no file selected
        uploadImageName.textContent = 'No image uploaded yet';
        uploadedImage.style.display = 'none';
    }
}

// Personal Info to Address Navigation through btn and tab

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('personal-info-form');
    const addressTabButton = document.getElementById('nav-address-tab');
    const saveNextButton = document.getElementById('save-next-btn');

    function updateTabButtonState() {
        addressTabButton.disabled = !form.checkValidity();
    }

    function handleSaveNextClick() {
        if (form.checkValidity()) {
            // If all fields are filled, navigate to Address tab
            const addressTab = new bootstrap.Tab(document.getElementById('nav-address-tab'));
            addressTab.show();
        } else {
            // If not all fields are filled, show validation errors
            form.reportValidity();
        }
    }

    // Event listener for input to update button state
    form.addEventListener('input', updateTabButtonState);

    // Event listener for the save-next button
    saveNextButton.addEventListener('click', handleSaveNextClick);

    // Initial update of button state on page load
    updateTabButtonState();
});

//Address to education through tab and btn

document.addEventListener('DOMContentLoaded', function () {
    const permanentAddressForm = document.getElementById('permanent-address-form');
    const copyAddressCheckbox = document.getElementById('copy-address'); // Checkbox to copy the address
    const educationTabButton = document.getElementById('nav-education-tab'); // Education tab button
    const saveNextBtns = document.getElementById('save-next-btns'); // Button to navigate to the Education tab

    // Function to copy data from permanent to present address
    function copyPermanentToPresent() {
        if (copyAddressCheckbox.checked) {
            const fieldsToCopy = ['address', 'city', 'district', 'state', 'country', 'pin', 'post', 'police-station'];
            fieldsToCopy.forEach(field => {
                const permanentField = document.getElementById('perm-' + field);
                const presentField = document.getElementById('pres-' + field);
                if (presentField && permanentField) {
                    presentField.value = permanentField.value; // Copy value from permanent to present address
                }
            });
        }
    }

    // Function to validate the form and update the education tab button state
    function updateTabButtonState() {
        const isValid = permanentAddressForm.checkValidity(); // Validate the form
        educationTabButton.disabled = !isValid; // Enable or disable the education tab button based on form validity
    }

    // Event listener to copy address when the checkbox is checked
    copyAddressCheckbox.addEventListener('change', function () {
        if (this.checked) {
            copyPermanentToPresent(); // Copy address data when the checkbox is checked
        }
        updateTabButtonState(); // Update the tab button state
    });

    // Update the button state when any input in the form changes
    permanentAddressForm.addEventListener('input', function () {
        updateTabButtonState();
    });

    // Initial check to ensure the education tab button is in the correct state on page load
    updateTabButtonState();

    // Handle navigation to the Education tab
    saveNextBtns.addEventListener('click', function () {
        if (checkAllFormsValidity()) {
            // If all fields are filled in both forms, navigate to the Education tab
            const educationTab = new bootstrap.Tab(educationTabButton);
            educationTab.show();
        } else {
            // If not all fields are filled, show validation errors
            permanentAddressForm.reportValidity();
        }
    });

    // Function to check validity of all forms
    function checkAllFormsValidity() {
        return permanentAddressForm.checkValidity(); // Add other forms as needed
    }
});

// Address Copy and Auto-fill

document.getElementById('copy-address').addEventListener('change', function () {
    const isChecked = this.checked;
    if (isChecked) {
        // Copy Permanent Address to Present Address
        document.getElementById('pres-address').value = document.getElementById('perm-address').value;
        document.getElementById('pres-city').value = document.getElementById('perm-city').value;
        document.getElementById('pres-district').value = document.getElementById('perm-district').value;
        document.getElementById('pres-state').value = document.getElementById('perm-state').value;
        document.getElementById('pres-country').value = document.getElementById('perm-country').value;
        document.getElementById('pres-pin').value = document.getElementById('perm-pin').value;
        document.getElementById('pres-post').value = document.getElementById('perm-post').value;
        document.getElementById('pres-police-station').value = document.getElementById('perm-police-station').value;
    } else {
        // Clear Present Address if checkbox is unchecked
        document.getElementById('present-address-form').reset();
        document.getElementById('pres-state').selectedIndex = 0; // Reset state dropdown
    }
});

// Auto-fill Present Address on change of Permanent Address
const permanentAddressFields = document.querySelectorAll('#permanent-address-form input, #permanent-address-form select');
permanentAddressFields.forEach(field => {
    field.addEventListener('input', function () {
        if (document.getElementById('copy-address').checked) {
            const targetField = document.getElementById('pres-' + this.id.split('-')[1]);
            if (targetField) {
                // Handle dropdowns specifically
                if (this.tagName === 'SELECT') {
                    targetField.value = this.value;
                } else {
                    targetField.value = this.value;
                }
            }
        }
    });
});

// Education to Experience Navigation

document.addEventListener('DOMContentLoaded', function () {
    const educationForm = document.getElementById('education-form');
    const experienceTabButton = document.getElementById('nav-experience-tab');
    const saveNextButton = document.getElementById('save-next-btnss');

    // Function to check if other sections (excluding Post Graduation) are complete
    function areOtherSectionsComplete() {
        // Post Graduation section fields (to be excluded from validation)
        const excludedFields = [
            'pg-course', 'pg-stream', 'pg-year', 'pg-results',
            'pg-university', 'pg-institute', 'pg-location'
        ];

        // Get all input and select elements
        const allFields = [...educationForm.querySelectorAll('input, select')];

        // Check if all fields except excluded ones are filled
        return allFields.every(field => {
            if (!excludedFields.includes(field.id) && field.required) {
                return field.value.trim() !== '';
            }
            return true;
        });
    }

    // Function to update the state of the Experience tab button
    function updateTabButtonState() {
        // Enable the Experience tab button only if all other sections are complete
        experienceTabButton.disabled = !areOtherSectionsComplete();
    }

    // Function to handle the button click and navigate to the Experience tab
    function handleSaveNextButtonClick() {
        if (areOtherSectionsComplete()) {
            // If all fields are filled in the relevant forms, navigate to the Experience tab
            const experienceTab = new bootstrap.Tab(experienceTabButton);
            experienceTab.show();
        } else {
            // If not all fields are filled, show validation errors
            educationForm.reportValidity();
        }
    }

    // Event listeners
    educationForm.addEventListener('input', updateTabButtonState);
    saveNextButton.addEventListener('click', handleSaveNextButtonClick);

    // Initial check to set the correct state of the Experience tab button
    updateTabButtonState();
});

//Experience to document Navigation

document.addEventListener('DOMContentLoaded', function () {
    const experienceForm = document.getElementById('experience-form');
    const otherDetailsTabButton = document.getElementById('nav-document-tab');

    function updateTabButtonState() {
        const isValid = experienceForm.checkValidity();
        otherDetailsTabButton.disabled = !isValid;
    }

    experienceForm.addEventListener('input', updateTabButtonState);
    updateTabButtonState();
});

//REVIEW TO CHECK IF EXPERIENCE AND PG IS UPLOADED OR NOT 

document.addEventListener('DOMContentLoaded', function () {

    // Function to check if the Post Graduation field is filled
    function isPostGradFieldFilled() {
        return document.getElementById('pg-university').value.trim() !== '';
    }

    // Function to check if the Experience field is filled
    function isExperienceFieldFilled() {
        return document.getElementById('company1-name').value.trim() !== '';
    }

    // Function to add an error message below the input field
    function showError(elementId, message) {
        const element = document.getElementById(elementId);

        if (element) {
            // Scroll the element into view
            element.scrollIntoView({ behavior: 'smooth', block: 'center' });

            // Remove any existing error message
            const existingError = document.querySelector(`#${elementId} + .error-message`);
            if (existingError) {
                existingError.remove();
            }

            // Create and insert the error message
            const errorElement = document.createElement('div');
            errorElement.className = 'error-message';
            errorElement.style.color = 'red';
            errorElement.style.marginTop = '4px';
            errorElement.textContent = message;
            element.parentElement.insertBefore(errorElement, element.nextSibling);
        }
    }

    // Function to clear all previous error messages
    function clearErrors() {
        document.querySelectorAll('.error-message').forEach(el => el.remove());
    }

    // Function to validate the documents
    function validateDocuments() {
        const postGradFieldFilled = isPostGradFieldFilled();
        const experienceFieldFilled = isExperienceFieldFilled();
        let isValid = true;

        // Clear previous errors
        clearErrors();

        // Check if Post Graduation document is mandatory
        if (postGradFieldFilled && !document.getElementById('pg-doc').files.length) {
            showError('pg-doc', 'Post Graduation document is required.');
            isValid = false;
        }

        // Check if Experience document is mandatory
        if (experienceFieldFilled && !document.getElementById('experience-doc').files.length) {
            showError('experience-doc', 'Experience document is required.');
            isValid = false;
        }

        // Validate all other mandatory documents
        const otherDocuments = ['grad-doc', 'class12-doc', 'class10-doc', 'aadhar-doc', 'pan-doc', 'blood-group-doc', 'image-sign'];
        for (let doc of otherDocuments) {
            if (!document.getElementById(doc).files.length) {
                showError(doc, `${document.querySelector(`label[for="${doc}"]`).textContent} is required.`);
                isValid = false;
            }
        }

        return isValid;
    }

    // Add event listener to the submit button
    document.querySelector('.submit-btn').addEventListener('click', function (event) {
        if (validateDocuments()) {
            // Redirect to the new page if validation is successful
            window.location.href = 'all-details.html';
        } else {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});

//FOR CHECKING WHEN CLICK BACK ALL WILL BE ENABLED 

document.addEventListener("DOMContentLoaded", function () {
    const personalTabButton = document.getElementById('nav-personal-tab');
    const addressTabButton = document.getElementById('nav-address-tab');
    const educationTabButton = document.getElementById('nav-education-tab');
    const experienceTabButton = document.getElementById('nav-experience-tab');
    const documentTabButton = document.getElementById('nav-document-tab');

    // Function to enable a tab button
    function enableTab(tabButton) {
        tabButton.disabled = false;
    }

    // Check sessionStorage to see if tabs were visited before
    if (sessionStorage.getItem('addressTabVisited')) {
        enableTab(addressTabButton);
    }

    if (sessionStorage.getItem('educationTabVisited')) {
        enableTab(educationTabButton);
    }

    if (sessionStorage.getItem('experienceTabVisited')) {
        enableTab(experienceTabButton);
    }

    // Event listener to mark a tab as visited when clicked
    personalTabButton.addEventListener('click', function () {
        enableTab(addressTabButton);
        sessionStorage.setItem('addressTabVisited', 'true'); // Mark as visited
    });

    addressTabButton.addEventListener('click', function () {
        enableTab(educationTabButton);
        sessionStorage.setItem('educationTabVisited', 'true'); // Mark as visited
    });

    educationTabButton.addEventListener('click', function () {
        enableTab(experienceTabButton);
        sessionStorage.setItem('experienceTabVisited', 'true'); // Mark as visited
    });

    // Keep the Document tab always enabled
    documentTabButton.disabled = false;
});

//FORM VALIDATION

document.addEventListener('DOMContentLoaded', function () {
    // Function to validate phone number (10 digits) - only digits
    function validatePhoneNumber(value) {
        return /^\d{10}$/.test(value);
    }

    // Function to validate Aadhaar number (12 digits) - only digits
    function validateAadhaarNumber(value) {
        return /^\d{12}$/.test(value);
    }

    // Function to validate PAN number (10 alphanumeric characters)
    function validatePanNumber(value) {
        return /^[A-Z]{5}\d{4}[A-Z]{1}$/.test(value);
    }

    // Function to validate email
    function validateEmail(value) {
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
    }

    // Function to add an error message below the input field
    function showError(elementId, message) {
        const element = document.getElementById(elementId);

        if (element) {
            // Remove any existing error message
            const existingError = document.querySelector(`#${elementId} + .error-message`);
            if (existingError) {
                existingError.remove();
            }

            // Create and insert the error message
            const errorElement = document.createElement('div');
            errorElement.className = 'error-message';
            errorElement.style.color = 'red';
            errorElement.style.marginTop = '4px';
            errorElement.textContent = message;
            element.parentElement.insertBefore(errorElement, element.nextSibling);
        }
    }

    // Function to clear error message
    function clearError(elementId) {
        const existingError = document.querySelector(`#${elementId} + .error-message`);
        if (existingError) {
            existingError.remove();
        }
    }

    // Function to validate each field on input
    function validateOnInput(event) {
        const id = event.target.id;
        const value = event.target.value.trim();

        switch (id) {
            case 'whatsappNumber':
            case 'emergencyContact':
                if (!validatePhoneNumber(value)) {
                    showError(id, 'Phone Number must be exactly 10 digits.');
                } else {
                    clearError(id);
                }
                break;

            case 'aadharNumber':
                if (!validateAadhaarNumber(value)) {
                    showError(id, 'Aadhaar Number must be exactly 12 digits.');
                } else {
                    clearError(id);
                }
                break;

            case 'panNumber':
                if (!validatePanNumber(value)) {
                    showError(id, 'PAN Number must be exactly 10 alphanumeric characters.');
                } else {
                    clearError(id);
                }
                break;

            case 'email':
                if (!validateEmail(value)) {
                    showError(id, 'Invalid email address.');
                } else {
                    clearError(id);
                }
                break;
        }
    }

    // Attach input event listeners to each field
    document.getElementById('whatsappNumber').addEventListener('input', validateOnInput);
    document.getElementById('emergencyContact').addEventListener('input', validateOnInput);
    document.getElementById('aadharNumber').addEventListener('input', validateOnInput);
    document.getElementById('panNumber').addEventListener('input', validateOnInput);
    document.querySelector('input[type="email"]').addEventListener('input', validateOnInput);

    // Function to handle form validation on submit
    function validateForm() {
        const phoneNumber = document.getElementById('whatsappNumber').value.trim();
        const emergencyContactnumber = document.getElementById('emergencyContact').value.trim();
        const aadhaarNumber = document.getElementById('aadharNumber').value.trim();
        const panNumber = document.getElementById('panNumber').value.trim();
        const email = document.querySelector('input[type="email"]').value.trim();
        let isValid = true;

        // Validate Phone Number
        if (!validatePhoneNumber(phoneNumber)) {
            showError('whatsappNumber', 'Whatsapp Number must be exactly 10 digits.');
            isValid = false;
        }

        // Validate Emergency Contact Number
        if (!validatePhoneNumber(emergencyContactnumber)) {
            showError('emergencyContact', 'Emergency Contact Number must be exactly 10 digits.');
            isValid = false;
        }

        // Validate Aadhaar Number
        if (!validateAadhaarNumber(aadhaarNumber)) {
            showError('aadharNumber', 'Aadhaar Number must be exactly 12 digits.');
            isValid = false;
        }

        // Validate PAN Number
        if (!validatePanNumber(panNumber)) {
            showError('panNumber', 'PAN Number must be exactly 10 alphanumeric characters.');
            isValid = false;
        }

        // Validate Email
        if (!validateEmail(email)) {
            showError('email', 'Invalid email address.');
            isValid = false;
        }

        return isValid;
    }

    // Add event listener to the Save & Next button
    document.getElementById('save-next-btn').addEventListener('click', function (event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});

//PIN VERIFICATION

document.addEventListener('DOMContentLoaded', function () {
    // Function to validate PIN (6 digits)
    function validatePin(value) {
        return /^\d{6}$/.test(value);
    }

    // Function to add an error message below the input field
    function showError(elementId, message) {
        const element = document.getElementById(elementId);

        if (element) {
            // Remove any existing error message
            const existingError = document.querySelector(`#${elementId} + .error-message`);
            if (existingError) {
                existingError.remove();
            }

            // Create and insert the error message
            const errorElement = document.createElement('div');
            errorElement.className = 'error-message';
            errorElement.style.color = 'red';
            errorElement.style.marginTop = '4px';
            errorElement.textContent = message;
            element.parentElement.insertBefore(errorElement, element.nextSibling);
        }
    }

    // Function to clear error message
    function clearError(elementId) {
        const existingError = document.querySelector(`#${elementId} + .error-message`);
        if (existingError) {
            existingError.remove();
        }
    }

    // Function to validate each field on input
    function validateOnInput(event) {
        const id = event.target.id;
        const value = event.target.value.trim();

        switch (id) {
            // Add validation for PIN fields
            case 'perm-pin':
            case 'pres-pin':
                if (!validatePin(value)) {
                    showError(id, 'PIN must be exactly 6 digits.');
                } else {
                    clearError(id);
                }
                break;

            // Handle other fields if needed (e.g., phone numbers, email)
            // Add your other validation functions and logic here
        }
    }

    // Attach input event listeners to PIN fields
    document.getElementById('perm-pin').addEventListener('input', validateOnInput);
    document.getElementById('pres-pin').addEventListener('input', validateOnInput);

    // Function to handle form validation on submit
    function validateForm() {
        const permPin = document.getElementById('perm-pin').value.trim();
        const presPin = document.getElementById('pres-pin').value.trim();
        let isValid = true;

        // Validate Permanent Address PIN
        if (!validatePin(permPin)) {
            showError('perm-pin', 'PIN must be exactly 6 digits.');
            isValid = false;
        }

        // Validate Present Address PIN
        if (!validatePin(presPin)) {
            showError('pres-pin', 'PIN must be exactly 6 digits.');
            isValid = false;
        }

        return isValid;
    }

    // Add event listener to the Save & Next button
    document.getElementById('save-next-btn').addEventListener('click', function (event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });
});
