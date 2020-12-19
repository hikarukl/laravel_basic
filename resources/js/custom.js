let inputCountdownTime = $('input[name="input-countdown_login_otp_time"]');
let countdownTarget = $('#remaining-login_otp');

if (inputCountdownTime.length) {
    handleCountdownLoginOtp(countdownTarget, inputCountdownTime.val());
}

window.addEventListener('resend-otp', event => {
    // Validate time countdown
    handleCountdownLoginOtp(countdownTarget, inputCountdownTime.val());
})

window.addEventListener('send-otp', event => {
    let wrapOtpErrorTarget = $('#wrap-otp_error');

    if (event.detail.stt) {
        window.location.href = event.detail.redirect_url;
    } else {
        if (event.detail.redirect_url) {
            window.location.href = event.detail.redirect_url;
        } else {
            wrapOtpErrorTarget.removeClass('hidden');
            let contentError = '<p>_MESSAGE_</p><p>_REMAINING_</p>';
            wrapOtpErrorTarget.html(contentError.replace(/_MESSAGE_/, event.detail.message).replace(/_REMAINING_/, event.detail.remaining_times));
        }
    }
})

/*
 * Handle show countdown OTP login
 *
 * */
function handleCountdownLoginOtp(countdownTarget, countdownTime)
{
    let btnRequestLoginOtpTarget = $('#btn-request_login_otp');

    // Validate time countdown
    let currentDateTime = new Date();
    let countdownDateTime = new Date(countdownTime);

    if (countdownDateTime > currentDateTime) {
        let contentCountDown = "Thời gian còn lại: <strong>%H:%M:%S</strong>";

        countdownTarget.removeClass('hidden');

        countdownTarget.countdown(countdownTime, function (event) {
            btnRequestLoginOtpTarget.addClass('hidden');
            $(this).html(event.strftime(contentCountDown));
        }).on('finish.countdown', function (event) {
            btnRequestLoginOtpTarget.removeClass('hidden');
            $(this).html('');
        });
    }
}