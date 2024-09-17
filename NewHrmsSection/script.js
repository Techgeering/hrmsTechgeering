// document.addEventListener('DOMContentLoaded', function () {
//     const experienceTabButton = document.getElementById('nav-experience-tab'); // Get the Experience tab button
//     const documentTabButton = document.getElementById('nav-document-tab'); // Get the Document tab button

//     // Initially disable the Document tab button
//     documentTabButton.disabled = true;

//     // Add event listener for when the Experience tab is shown (using Bootstrap's tab event)
//     experienceTabButton.addEventListener('shown.bs.tab', function () {
//         // Enable the Document tab when the Experience tab is shown
//         documentTabButton.disabled = false;
//     });
// });
// //--------------------------------------------------------------------
// document.getElementById('save-next-btn').addEventListener('click', function () {
//     const form = document.getElementById('personal-info-form');
//     if (form.checkValidity()) {
//         // If all fields are filled, navigate to Address tab
//         const addressTab = new bootstrap.Tab(document.getElementById('nav-address-tab'));
//         addressTab.show();
//     } else {
//         // If not all fields are filled, show validation errors
//         form.reportValidity();
//     }
// });

// document.addEventListener('DOMContentLoaded', function () {
//     const form = document.getElementById('personal-info-form');
//     const addressTabButton = document.getElementById('nav-address-tab');

//     function updateTabButtonState() {
//         addressTabButton.disabled = !form.checkValidity();
//     }

//     form.addEventListener('input', updateTabButtonState);
// });

// //------------------------------------------------------------------

// document.addEventListener('DOMContentLoaded', function () {
//     function checkAllFormsValidity() {
//         const forms = [document.getElementById('permanent-address-form'), document.getElementById('present-address-form')];
//         return forms.every(form => form.checkValidity());
//     }

//     document.getElementById('save-next-btns').addEventListener('click', function () {
//         if (checkAllFormsValidity()) {
//             // If all fields are filled in both forms, navigate to the Education tab
//             const educationTab = new bootstrap.Tab(document.getElementById('nav-education-tab'));
//             educationTab.show();
//         } else {
//             // If not all fields are filled, show validation errors
//             const forms = [document.getElementById('permanent-address-form'), document.getElementById('present-address-form')];
//             forms.forEach(form => form.reportValidity());
//         }
//     });
// });
// document.addEventListener('DOMContentLoaded', function () {
//     const permanentAddressForm = document.getElementById('permanent-address-form');
//     const presentAddressForm = document.getElementById('present-address-form');
//     const educationTabButton = document.getElementById('nav-education-tab');
//     const copyAddressCheckbox = document.getElementById('copy-address'); // Checkbox to copy the address

//     // Function to copy data from permanent to present address
//     function copyPermanentToPresent() {
//         if (copyAddressCheckbox.checked) {
//             const permanentAddressFields = permanentAddressForm.querySelectorAll('input');
//             permanentAddressFields.forEach(field => {
//                 const presentField = document.getElementById('pres-' + field.id.split('-')[1]);
//                 if (presentField) {
//                     presentField.value = field.value; // Copy the value
//                 }
//             });
//         }
//     }

//     // Function to update the "Education" tab button state
//     function updateTabButtonState() {
//         const isValid = permanentAddressForm.checkValidity() && presentAddressForm.checkValidity();
//         educationTabButton.disabled = !isValid;
//     }

//     // Add event listener to the checkbox for copying address
//     copyAddressCheckbox.addEventListener('change', function () {
//         if (this.checked) {
//             copyPermanentToPresent(); // Copy data when the checkbox is checked
//         }
//         updateTabButtonState(); // Update the button state after copying
//     });

//     // Update button state on input in both forms
//     permanentAddressForm.addEventListener('input', function () {
//         if (!copyAddressCheckbox.checked) {
//             updateTabButtonState(); // Only check validity if checkbox is not checked
//         }
//     });

//     presentAddressForm.addEventListener('input', updateTabButtonState);

//     // Initial check in case the page is loaded with some data already filled
//     updateTabButtonState();
// });

// //--------------------------------------------------------------------

// document.addEventListener('DOMContentLoaded', function () {
//     function checkAllFormsValidity() {
//         const forms = [document.getElementById('permanent-address-form'), document.getElementById('present-address-form')];
//         return forms.every(form => form.checkValidity());
//     }

//     document.getElementById('save-next-btns').addEventListener('click', function () {
//         if (checkAllFormsValidity()) {
//             // If all fields are filled in both forms, navigate to the Education tab
//             const educationTab = new bootstrap.Tab(document.getElementById('nav-education-tab'));
//             educationTab.show();
//         } else {
//             // If not all fields are filled, show validation errors
//             const forms = [document.getElementById('permanent-address-form'), document.getElementById('present-address-form')];
//             forms.forEach(form => form.reportValidity());
//         }
//     });
// });
// document.addEventListener('DOMContentLoaded', function () {
//     const pgForm = document.getElementById('pg-form');
//     const gradForm = document.getElementById('grad-form');
//     const diplomaForm = document.getElementById('diploma-form');
//     const tenthForm = document.getElementById('10th-form');
//     const experienceTabButton = document.getElementById('nav-experience-tab');

//     function updateTabButtonState() {
//         // Check if gradForm, diplomaForm, and tenthForm are valid
//         const isValid = gradForm.checkValidity() && diplomaForm.checkValidity() && tenthForm.checkValidity();
//         experienceTabButton.disabled = !isValid;
//     }

//     // Update button state on input in all relevant forms
//     gradForm.addEventListener('input', updateTabButtonState);
//     diplomaForm.addEventListener('input', updateTabButtonState);
//     tenthForm.addEventListener('input', updateTabButtonState);

//     // Initial check in case the page is loaded with some data already filled
//     updateTabButtonState();
// });

// //------------------------------------------------------------------------------

// document.addEventListener('DOMContentLoaded', function () {
//     // Function to check the validity of specific forms excluding pg-form
//     function checkAllFormsValidity() {
//         // Get only the forms that need to be validated
//         const forms = [
//             document.getElementById('grad-form'),
//             document.getElementById('diploma-form'),
//             document.getElementById('10th-form')
//         ];
//         // Check if all forms are valid
//         return forms.every(form => form.checkValidity());
//     }

//     // Add event listener to the "Save & Next" button
//     document.getElementById('save-next-btnss').addEventListener('click', function () {
//         if (checkAllFormsValidity()) {
//             // If all fields are filled in the relevant forms, navigate to the Education tab
//             const educationTab = new bootstrap.Tab(document.getElementById('nav-experience-tab'));
//             educationTab.show();
//         } else {
//             // If not all fields are filled, show validation errors
//             const forms = [
//                 document.getElementById('grad-form'),
//                 document.getElementById('diploma-form'),
//                 document.getElementById('10th-form')
//             ];
//             forms.forEach(form => form.reportValidity());
//         }
//     });
// });

// //--------------------------------------------------------------------------------------------
// //------------------------------------------------------------------------------

// document.getElementById('save-next-btnsss').addEventListener('click', function () {
//     // Directly navigate to the Document tab without validating the Experience form
//     const documentTab = new bootstrap.Tab(document.getElementById('nav-document-tab'));
//     documentTab.show();
// });

// //--------------------------------------------------------------------------------------------

// async function startCamera() {
//     const video = document.getElementById('video');
//     const captureButton = document.getElementById('capture');
//     try {
//         // Access the camera
//         const stream = await navigator.mediaDevices.getUserMedia({ video: true });
//         video.srcObject = stream;
//         video.style.display = 'block';
//         captureButton.style.display = 'inline-block'; // Show the capture button

//         // Start playing the video
//         video.play();
//     } catch (error) {
//         console.error('Error accessing camera: ', error);
//     }
// }

// function capturePhoto() {
//     const video = document.getElementById('video');
//     const canvas = document.getElementById('canvas');
//     const context = canvas.getContext('2d');
//     const profileImage = document.getElementById('profile-image');
//     const imageName = document.getElementById('image-name');

//     // Draw the current video frame to the canvas
//     context.drawImage(video, 0, 0, canvas.width, canvas.height);
//     const imageUrl = canvas.toDataURL('image/png');

//     // Generate a random file name
//     const randomName = 'profile-' + Math.random().toString(36).substr(2, 9) + '.png';

//     // Set the image source to the canvas data URL
//     profileImage.src = imageUrl;

//     // Update the image name display
//     imageName.textContent = `${randomName}`;

//     // Stop the video stream
//     const stream = video.srcObject;
//     if (stream) {
//         const tracks = stream.getTracks();
//         tracks.forEach(track => track.stop());
//     }

//     // Hide video and canvas elements
//     video.style.display = 'none';
//     canvas.style.display = 'none';
//     document.getElementById('capture').style.display = 'none'; // Hide the capture button
// }

// // IMAGE PREVIEW
// function uploadPhoto() {
//     const fileInput = document.getElementById('upload-photo');
//     const uploadedImage = document.getElementById('uploaded-image');
//     const uploadImageName = document.getElementById('upload-image-name');

//     const file = fileInput.files[0];
//     if (file) {
//         const reader = new FileReader();

//         // Display image name
//         uploadImageName.textContent = file.name;

//         reader.onload = function (e) {
//             // Set the src of the image element to the file data URL
//             uploadedImage.src = e.target.result;
//             uploadedImage.style.display = 'block'; // Show the uploaded image
//         };

//         // Read the image file as a data URL
//         reader.readAsDataURL(file);
//     } else {
//         // Reset if no file selected
//         uploadImageName.textContent = 'No image uploaded yet';
//         uploadedImage.style.display = 'none';
//     }
// }

// //----------------------------------------------------------------------------------------
// document.addEventListener('DOMContentLoaded', function () {
//     // Function to check if Post Graduation fields are filled
//     function hasPostGradFields() {
//         return document.getElementById('pg-university').value || // Example university field
//             document.getElementById('pg-year').value;      // Example degree field
//     }

//     // Function to check if any Experience fields are filled
//     function hasExperienceFields() {
//         return document.getElementById('company1-name').value ||
//             document.getElementById('company2-name').value ||
//             document.getElementById('company3-name').value;
//     }

//     // Function to validate the documents
//     function validateDocuments() {
//         const isPostGradFilled = hasPostGradFields();
//         const isExperienceFilled = hasExperienceFields();

//         // Validate Post Graduation Document if any Post Graduation fields are filled
//         if (isPostGradFilled && document.getElementById('pg-doc').files.length === 0) {
//             // alert('Post Graduation document is required.');
//             return false;
//         }

//         // Validate Experience Document if any Experience fields are filled
//         if (isExperienceFilled && document.getElementById('experience-doc').files.length === 0) {
//             // alert('Experience document is required.');
//             return false;
//         }

//         // Validate other mandatory documents (these are mandatory regardless)
//         const requiredDocs = ['grad-doc', 'class12-doc', 'class10-doc', 'aadhar-doc', 'pan-doc', 'blood-group-doc', 'image-sign'];
//         for (let doc of requiredDocs) {
//             if (document.getElementById(doc).files.length === 0) {
//                 // alert(`${document.querySelector(`label[for="${doc}"]`).textContent} is required.`);
//                 return false;
//             }
//         }

//         return true;
//     }

//     // Add event listener to the submit button
//     document.querySelector('.button-submit').addEventListener('click', function (event) {
//         if (!validateDocuments()) {
//             event.preventDefault(); // Prevent form submission if validation fails
//         }
//     });
// });

// //-----------------------------------------------------------------------------------------------------------

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

//For Camera

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

//1st Part Personal Info To Address//

document.getElementById('save-next-btn').addEventListener('click', function () {
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
    
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('personal-info-form');
        const addressTabButton = document.getElementById('nav-address-tab');
    
        function updateTabButtonState() {
            addressTabButton.disabled = !form.checkValidity();
        }
    
        form.addEventListener('input', updateTabButtonState);
    });

//Address Copy//

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

//Address To Education

document.addEventListener('DOMContentLoaded', function () {
    const permanentAddressForm = document.getElementById('permanent-address-form');
    const copyAddressCheckbox = document.getElementById('copy-address'); // Checkbox to copy the address
    const educationTabButton = document.getElementById('nav-education-tab'); // Education tab button

    // Function to copy data from permanent to present address
    function copyPermanentToPresent() {
        if (copyAddressCheckbox.checked) {
            // Copy permanent address fields to present address fields
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
});

// Education To Experience
document.addEventListener('DOMContentLoaded', function () {
    const educationForm = document.getElementById('education-form');
    const experienceTabButton = document.getElementById('nav-experience-tab');

    // Optional fields that shouldn't affect form validity
    const optionalFields = ['pg-course', 'pg-stream', 'pg-year', 'pg-results', 'pg-university', 'pg-institute', 'pg-location'];
    
    // Function to check if required fields are valid
    function updateExperienceTabState() {
        // Create a flag that assumes form is valid
        let isFormValid = true;
        
        // Loop through all input fields in the form
        Array.from(educationForm.elements).forEach(function (field) {
            // Skip optional fields by checking their ID
            if (!optionalFields.includes(field.id)) {
                // Check if the field is required and not valid
                if (field.required && !field.checkValidity()) {
                    isFormValid = false;
                }
            }
        });

        // Enable/disable the experience tab based on required field validity
        experienceTabButton.disabled = !isFormValid;
    }

    // Add event listener to check form validity as the user types
    educationForm.addEventListener('input', updateExperienceTabState);
});

//Buttons

document.getElementById('save-next-btns').addEventListener('click', function () {
            if (checkAllFormsValidity()) {
                // If all fields are filled in both forms, navigate to the Education tab
                const educationTab = new bootstrap.Tab(document.getElementById('nav-education-tab'));
                educationTab.show();
            } else {
                // If not all fields are filled, show validation errors
                const forms = [document.getElementById('permanent-address-form')];
                forms.forEach(form => form.reportValidity());
            }
        });

    document.getElementById('save-next-btnss').addEventListener('click', function () {
                if (checkAllFormsValidity()) {
                    // If all fields are filled in the relevant forms, navigate to the Education tab
                    const educationTab = new bootstrap.Tab(document.getElementById('nav-experience-tab'));
                    educationTab.show();
                } else {
                    // If not all fields are filled, show validation errors
                    const forms = [
                        document.getElementById('education-form')
                    ];
                    forms.forEach(form => form.reportValidity());
                }
            });

        document.getElementById('save-next-btnsss').addEventListener('click', function () {
    // Directly navigate to the Document tab without validating the Experience form
    const documentTab = new bootstrap.Tab(document.getElementById('nav-document-tab'));
    documentTab.show();
});
