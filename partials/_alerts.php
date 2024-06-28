<?php
if ($showSuccessAlert) {
    echo '<div class="alert alert-success alert-dismissible fade show showAlert mt-3" role="alert">
                <strong>You have been registered successfully</strong> Kindly log in using
                the same credentials
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>
                </div>';
}
if ($showUnsuccessAlert) {
    echo '<div class="alert alert-danger alert-dismissible fade show showAlert mt-3" role="alert">
                <strong>Invalid Credentials !</strong> Kindly provide correct credentials
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>
                </div>';
}
