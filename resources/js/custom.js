let inputCountdownTime = $('input[name="input-countdown_login_otp_time"]');
let countdownTarget = $('#remaining-login_otp');

if (inputCountdownTime.length) {
    handleCountdownLoginOtp(countdownTarget, inputCountdownTime.val());
}

window.addEventListener('resend-otp', event => {
    // Validate time countdown
    handleCountdownLoginOtp(countdownTarget, event.detail.otp_expired_at);
})

window.addEventListener('send-otp', event => {
    if (event.detail.stt) {
        window.location.href = event.detail.redirect_url;
    }
})

/*
 * Handle show countdown OTP login
 *
 * */
function handleCountdownLoginOtp(countdownTarget, countdownTime)
{
    let btnRequestResendOtpTarget = $('#btn-request_resend_otp');

    // Validate time countdown
    let currentDateTime = new Date();
    let countdownDateTime = new Date(countdownTime);

    console.log(countdownDateTime);
    console.log(currentDateTime);
    console.log(countdownDateTime > currentDateTime);
    if (countdownDateTime > currentDateTime) {
        console.log('Begin');
        let contentCountDown = "Thời gian còn lại: <strong>%H:%M:%S</strong>";

        countdownTarget.removeClass('d-none');

        countdownTarget.countdown(countdownTime, function (event) {
            btnRequestResendOtpTarget.addClass('d-none');
            $(this).html(event.strftime(contentCountDown));
        }).on('finish.countdown', function (event) {
            btnRequestResendOtpTarget.removeClass('d-none');
            $(this).html('');
        });
    }
}