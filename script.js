$(document).ready(function () {

    // -----------------------------
    // LIVE PREVIEW FUNCTION
    // -----------------------------
    function updatePreview() {
        const name = $('#name').val();
        const email = $('#email').val();
        const phone = $('#phone').val();
        const address = $('#address').val();
        const gender = $('#gender').val();
        const course = $('#course').val();

        let preview = '=== REGISTRATION DETAILS ===\n\n';

        if (name) preview += `Name: ${name}\n`;
        if (email) preview += `Email: ${email}\n`;
        if (phone) preview += `Phone: ${phone}\n`;
        if (address) preview += `Address: ${address}\n`;
        if (gender) preview += `Gender: ${gender}\n`;
        if (course) preview += `Course Interest: ${course}\n`;

        if (!name && !email && !phone && !address) {
            preview = 'Your details will appear here...';
        }

        $('#formPreview').text(preview);
    }

    $('input, select, textarea').on('input change', updatePreview);
    updatePreview();


    // -----------------------------
    // SIMPLE VALIDATION (NO BLOCKING)
    // -----------------------------
    $('#registrationForm').on('submit', function (e) {

        let hasError = false;

        $('.error').text('');
        $('input, textarea').removeClass('shake');

        // Name
        const name = $('#name').val().trim();
        if (name.length < 2) {
            $('#nameError').text('Enter a valid name');
            $('#name').addClass('shake');
            hasError = true;
        }

        // Email
        const email = $('#email').val().trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            $('#emailError').text('Invalid email format');
            $('#email').addClass('shake');
            hasError = true;
        }

        // Phone
        const phone = $('#phone').val().trim();
        if (phone.length < 10) {
            $('#phoneError').text('Phone must be at least 10 digits');
            $('#phone').addClass('shake');
            hasError = true;
        }

        // Address
        const address = $('#address').val().trim();
        if (address.length < 10) {
            $('#addressError').text('Address too short');
            $('#address').addClass('shake');
            hasError = true;
        }

        // Terms
        if (!$('#terms').is(':checked')) {
            $('#termsError').text('You must accept the terms');
            hasError = true;
        }

        // If errors exist → STILL allow PHP submit
        if (hasError) {
            alert('Please correct highlighted fields.');
            // Do NOT block form submission with preventDefault.
            // Browser will enforce "required" fields anyway.
        }

        // Button loading animation
        $('.submit-btn').html('Processing...');
        $('.submit-btn').prop('disabled', true);

        return true; // Always allow submit
    });


    // -----------------------------
    // RESET BUTTON
    // -----------------------------
    $('.reset-btn').on('click', function () {
        setTimeout(updatePreview, 200);
        $('.error').text('');
        $('input, textarea').removeClass('shake');
    });

});
