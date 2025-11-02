<!-- resources/views/contact.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="manifest" href="site.webmanifest">
		<link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

		<!-- CSS here -->
            <link rel="stylesheet" href="assets/css/bootstrap.min.css">
            <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
            <link rel="stylesheet" href="assets/css/flaticon.css">
            <link rel="stylesheet" href="assets/css/price_rangs.css">
            <link rel="stylesheet" href="assets/css/slicknav.css">
            <link rel="stylesheet" href="assets/css/animate.min.css">
            <link rel="stylesheet" href="assets/css/magnific-popup.css">
            <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
            <link rel="stylesheet" href="assets/css/themify-icons.css">
            <link rel="stylesheet" href="assets/css/slick.css">
            <link rel="stylesheet" href="assets/css/nice-select.css">
            <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
 @include('layouts/header')
<div class="container my-5">
    <h2>Contact Us</h2>
    <p>If you have any questions, feel free to reach out to us.</p>

    <form id="contactForm" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name">Your Name</label>
        <input type="text" name="name" id="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="email">Your Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="message">Message</label>
        <textarea name="message" id="message" class="form-control" rows="5" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Send</button>

    <div id="responseMsg" class="mt-3"></div>
</form>
<a href="{{ route('contact.messages') }}" class="btn btn-primary mt-4" id="allMsgBtn">📋 List All Messages</a>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $("#allMsgBtn").hide();
    $('#contactForm').on('submit', function(e) {
        e.preventDefault(); // prevent default form submission

        $.ajax({
            url: "{{ route('contact.submit') }}",
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                $('#responseMsg').html('<div class="alert alert-success">' + response.message + '</div>');
                $('#contactForm')[0].reset(); // clear form
                 $("#allMsgBtn").show();
            },
            error: function(xhr) {
                let err = xhr.responseJSON.errors;
                let errHtml = '<div class="alert alert-danger"><ul>';
                $.each(err, function(key, value) {
                    errHtml += '<li>' + value[0] + '</li>';
                });
                errHtml += '</ul></div>';
                $('#responseMsg').html(errHtml);
            }
        });
    });
</script>

</body>
</html>
