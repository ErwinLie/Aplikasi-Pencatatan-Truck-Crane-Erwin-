<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!DOCTYPE html>
<html class="h-100" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Quixlab - Bootstrap Admin Dashboard Template by Themefisher.com</title>
    <link rel="icon" type="image/png" sizes="16x16" href="../../assets/images/favicon.png">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .logo-login {
            margin: 0 auto;
        }
        #offline-captcha {
            display: none;
        }
    </style>
</head>

<body class="h-100">
    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <div class="d-flex flex-column align-items-center justify-content-center mb-3">
                                    <?php if (!empty($setting->logo_login)): ?>
                                        <img src="<?= base_url('images/img/' . $setting->logo_login) ?>" alt="Login Icon"
                                             class="img-fluid mb-3 logo-login" style="max-width: 100px;">
                                    <?php endif; ?>
                                </div>

                                <a class="text-center" href="index.html"><h3>Login</h3></a>

                                <form class="mt-5 mb-5 login-input" novalidate action="<?= base_url('home/aksilogin') ?>" method="POST">
                                    <div class="form-group">
                                        <input type="username" name="username" class="form-control" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control" placeholder="Password">
                                    </div>

                                    <!-- Online CAPTCHA -->
                                    <div id="online-captcha" class="g-recaptcha" data-sitekey="6LdTGyEqAAAAAGjNpTsgDaXlfPsHLdzinrmy9vOw"></div>

                                    <!-- Offline CAPTCHA -->
                                    <div id="offline-captcha">
                                        <label for="offline-captcha-answer">What is <span id="captcha-question"></span>?</label>
                                        <input type="text" name="captcha_answer" id="offline-captcha-answer" class="form-control">
                                        <input type="hidden" name="correct_captcha_answer" id="correct-captcha-answer">
                                    </div>

                                    <button class="btn login-form__btn submit w-100" type="submit">Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function isOnline() {
            return window.navigator.onLine;
        }

        function generateOfflineCaptcha() {
            const num1 = Math.floor(Math.random() * 10) + 1;
            const num2 = Math.floor(Math.random() * 10) + 1;
            document.getElementById('captcha-question').innerText = num1 + " + " + num2;
            document.getElementById('correct-captcha-answer').value = num1 + num2;
        }

        if (isOnline()) {
            document.getElementById('offline-captcha').style.display = 'none';
            document.getElementById('online-captcha').style.display = 'block';
        } else {
            document.getElementById('offline-captcha').style.display = 'block';
            document.getElementById('online-captcha').style.display = 'none';
            generateOfflineCaptcha();
        }

        document.querySelector('form').addEventListener('submit', function (event) {
            if (isOnline()) {
                var recaptchaResponse = grecaptcha.getResponse();
                if (recaptchaResponse.length === 0) {
                    event.preventDefault();
                    alert('Please complete the CAPTCHA.');
                }
            } else {
                const userAnswer = document.getElementById('offline-captcha-answer').value;
                const correctAnswer = document.getElementById('correct-captcha-answer').value;
                if (parseInt(userAnswer) !== parseInt(correctAnswer)) {
                    event.preventDefault();
                    alert('Incorrect CAPTCHA answer.');
                }
            }
        });
    </script>
</body>
</html>
