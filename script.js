$(document).ready(function() {
    // Update preview on form input
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
    
    // Update preview on every input
    $('input, select, textarea').on('input change', updatePreview);
    
    // Form validation
    $('#registrationForm').submit(function(e) {
        let isValid = true;
        
        // Clear previous errors
        $('.error').text('');
        $('input, textarea').removeClass('shake');
        
        // Name validation
        const name = $('#name').val().trim();
        if (name.length < 2) {
            $('#nameError').text('Name must be at least 2 characters');
            $('#name').addClass('shake');
            isValid = false;
        }
        
        // Email validation
        const email = $('#email').val().trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            $('#emailError').text('Please enter a valid email address');
            $('#email').addClass('shake');
            isValid = false;
        }
        
        // Phone validation
        const phone = $('#phone').val().trim();
        const phoneRegex = /^[\+]?[0-9\s\-\(\)]{10,}$/;
        if (!phoneRegex.test(phone)) {
            $('#phoneError').text('Please enter a valid phone number');
            $('#phone').addClass('shake');
            isValid = false;
        }
        
        // Address validation
        const address = $('#address').val().trim();
        if (address.length < 10) {
            $('#addressError').text('Please enter a complete address (min 10 characters)');
            $('#address').addClass('shake');
            isValid = false;
        }
        
        // Terms validation
        if (!$('#terms').is(':checked')) {
            $('#termsError').text('You must agree to the terms and conditions');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault(); // Stop form submission
            
            // Show alert for errors
            alert('Please fix the errors in the form before submitting.');
        } else {
            // Show loading state
            $('.submit-btn').html('Processing...');
            $('.submit-btn').prop('disabled', true);
        }
    });
    
    // Reset form handler
    $('.reset-btn').click(function() {
        setTimeout(updatePreview, 100);
        $('.error').text('');
        $('input, textarea').removeClass('shake');
    });
    
    // Initialize preview
    updatePreview();
});