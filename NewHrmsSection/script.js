
//--------------------------------------------------------------------
document.getElementById('save-next-btn').addEventListener('click', function() {
    const form = document.getElementById('personal-info-form');
    if (form.checkValidity()) {
        // If all fields are filled, navigate to Address tab
        const addressTab = new bootstrap.Tab(document.getElementById('nav-address-tab'));
        addressTab.show();
    } else {
        // If not all fields are filled, show validation errors
        form.reportValidity();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('personal-info-form');
    const addressTabButton = document.getElementById('nav-address-tab');

    function updateTabButtonState() {
        addressTabButton.disabled = !form.checkValidity();
    }

    form.addEventListener('input', updateTabButtonState);
});

//------------------------------------------------------------------

document.addEventListener('DOMContentLoaded', function() {
    function checkAllFormsValidity() {
        const forms = [document.getElementById('permanent-address-form'), document.getElementById('present-address-form')];
        return forms.every(form => form.checkValidity());
    }

    document.getElementById('save-next-btns').addEventListener('click', function() {
        if (checkAllFormsValidity()) {
            // If all fields are filled in both forms, navigate to the Education tab
            const educationTab = new bootstrap.Tab(document.getElementById('nav-education-tab'));
            educationTab.show();
        } else {
            // If not all fields are filled, show validation errors
            const forms = [document.getElementById('permanent-address-form'), document.getElementById('present-address-form')];
            forms.forEach(form => form.reportValidity());
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const permanentAddressForm = document.getElementById('permanent-address-form');
    const presentAddressForm = document.getElementById('present-address-form');
    const educationTabButton = document.getElementById('nav-education-tab');
    const copyAddressCheckbox = document.getElementById('copy-address'); // Checkbox to copy the address

    // Function to copy data from permanent to present address
    function copyPermanentToPresent() {
        if (copyAddressCheckbox.checked) {
            const permanentAddressFields = permanentAddressForm.querySelectorAll('input');
            permanentAddressFields.forEach(field => {
                const presentField = document.getElementById('pres-' + field.id.split('-')[1]);
                if (presentField) {
                    presentField.value = field.value; // Copy the value
                }
            });
        }
    }

    // Function to update the "Education" tab button state
    function updateTabButtonState() {
        const isValid = permanentAddressForm.checkValidity() && presentAddressForm.checkValidity();
        educationTabButton.disabled = !isValid;
    }

    // Add event listener to the checkbox for copying address
    copyAddressCheckbox.addEventListener('change', function() {
        if (this.checked) {
            copyPermanentToPresent(); // Copy data when the checkbox is checked
        }
        updateTabButtonState(); // Update the button state after copying
    });

    // Update button state on input in both forms
    permanentAddressForm.addEventListener('input', function() {
        if (!copyAddressCheckbox.checked) {
            updateTabButtonState(); // Only check validity if checkbox is not checked
        }
    });

    presentAddressForm.addEventListener('input', updateTabButtonState);

    // Initial check in case the page is loaded with some data already filled
    updateTabButtonState();
});

//--------------------------------------------------------------------

document.addEventListener('DOMContentLoaded', function() {
    function checkAllFormsValidity() {
        const forms = [document.getElementById('permanent-address-form'), document.getElementById('present-address-form')];
        return forms.every(form => form.checkValidity());
    }

    document.getElementById('save-next-btns').addEventListener('click', function() {
        if (checkAllFormsValidity()) {
            // If all fields are filled in both forms, navigate to the Education tab
            const educationTab = new bootstrap.Tab(document.getElementById('nav-education-tab'));
            educationTab.show();
        } else {
            // If not all fields are filled, show validation errors
            const forms = [document.getElementById('permanent-address-form'), document.getElementById('present-address-form')];
            forms.forEach(form => form.reportValidity());
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const pgForm = document.getElementById('pg-form');
    const gradForm = document.getElementById('grad-form');
    const diplomaForm = document.getElementById('diploma-form');
    const tenthForm = document.getElementById('10th-form');
    const experienceTabButton = document.getElementById('nav-experience-tab');

    function updateTabButtonState() {
        // Check if all forms are valid
        const isValid = pgForm.checkValidity() && gradForm.checkValidity() && diplomaForm.checkValidity() && tenthForm.checkValidity();
        experienceTabButton.disabled = !isValid;
    }

    // Update button state on input in all forms
    pgForm.addEventListener('input', updateTabButtonState);
    gradForm.addEventListener('input', updateTabButtonState);
    diplomaForm.addEventListener('input', updateTabButtonState);
    tenthForm.addEventListener('input', updateTabButtonState);

    // Initial check in case the page is loaded with some data already filled
    updateTabButtonState();
});

//------------------------------------------------------------------------------

document.addEventListener('DOMContentLoaded', function() {
    // Function to check the validity of all forms
    function checkAllFormsValidity() {
        // Get all forms that need to be validated
        const forms = [document.getElementById('pg-form'), document.getElementById('grad-form'), 
                       document.getElementById('diploma-form'), document.getElementById('10th-form')];
        // Check if all forms are valid
        return forms.every(form => form.checkValidity());
    }

    // Add event listener to the "Save & Next" button
    document.getElementById('save-next-btnss').addEventListener('click', function() {
        if (checkAllFormsValidity()) {
            // If all fields are filled in all forms, navigate to the Education tab
            const educationTab = new bootstrap.Tab(document.getElementById('nav-document-tab'));
            educationTab.show();
        } else {
            // If not all fields are filled, show validation errors
            const forms = [document.getElementById('pg-form'), document.getElementById('grad-form'), 
                           document.getElementById('diploma-form'), document.getElementById('10th-form')];
            forms.forEach(form => form.reportValidity());
        }
    });
});
document.addEventListener('DOMContentLoaded', function() {
    const experienceForm = document.getElementById('experience-form'); // Get the experience form
    const documentTabButton = document.getElementById('nav-document-tab'); // Get the "Document" tab button

    // Function to update the "Document" tab button state
    function updateTabButtonState() {
        // Check if the experience form is valid
        const isValid = experienceForm.checkValidity();
        documentTabButton.disabled = !isValid;
    }

    // Update button state on input in the experience form
    experienceForm.addEventListener('input', updateTabButtonState);

    // Initial check in case the page is loaded with some data already filled
    updateTabButtonState();
});

//--------------------------------------------------------------------------------------------
//------------------------------------------------------------------------------

document.getElementById('save-next-btnsss').addEventListener('click', function() {
    const form = document.getElementById('experience-form');
    if (form.checkValidity()) {
        // If all fields are filled, navigate to Address tab
        const addressTab = new bootstrap.Tab(document.getElementById('nav-document-tab'));
        addressTab.show();
    } else {
        // If not all fields are filled, show validation errors
        form.reportValidity();
    }
});

//--------------------------------------------------------------------------------------------

document.getElementById('copy-address').addEventListener('change', function() {
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
    }
});

// Auto-fill Present Address on change of Permanent Address
const permanentAddressFields = document.querySelectorAll('#permanent-address-form input');
permanentAddressFields.forEach(field => {
    field.addEventListener('input', function() {
        if (document.getElementById('copy-address').checked) {
            const targetField = document.getElementById('pres-' + this.id.split('-')[1]);
            if (targetField) {
                targetField.value = this.value;
            }
        }
    });
});

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

// IMAGE PREVIEW
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

//----------------------------------------------------------------------------------------
