<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>eShop | Admin | Sign In</title>

    <link rel="icon" href="resources/logo.svg" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body style="background-color: #74ebd5; background-image: linear-gradient(90deg, #74ebd5 0%, #9face6 100%);">

    <div class="container-fluid justify-content-center" style="margin-top: 100px;">
        <div class="row align-content-center">

            <!--header-->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo"></div>
                    <div class="col-12">
                        <p class="text-center title01">Hi, Welcome to eShop Admins.</p>
                    </div>
                </div>
            </div>

            <div class="col-12 p-5">
                <div class="row">
                    <div class="col-6 d-none d-lg-block background"></div>

                    <div class="col-12 col-lg-6 d-block">
                        <div class="row g-3">

                            <div class="col-12">
                                <p class="title02">Sign In to your account.</p>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input class="form-control" type="email" id="em">
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="adminVerification();">Send Verification Code to Login</button>
                            </div>

                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger">Back to Customer Login</button>
                            </div>

                            <div class="col-12 text-center d-none d-lg-block fixed-bottom">
                                <p class="fw-bold text-black-50">&copy; 20022 eShop.lk All Rights Reserved.</p>
                            </div>

                            <!--model-->
                            <div class="modal" tabindex="-1" id="verificationModal">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Admin Verification</h5>
                                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="form-label">Enter the verification code you got by an email</label>
                                            <input type="text" class="form-control" id="vcode">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--model-->

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>



    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
    <script src="bootstrap.bundle.js"></script>
</body>

</html>