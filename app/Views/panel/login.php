<?= $this->extend('layouts/auth/main') ?>

<?= $this->section('header') ?>

<?= $this->include('layouts/auth/parts/header') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>



<div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
    <div class="container-fluid">
        <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
            <div class="col mx-auto">
                <div class="mb-4 text-center">
                    <img src="<?= base_url("panel/assets/images/logo-img.png")?>" width="180" alt="" />
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="border p-4 rounded">
                            <div class="text-center">
                                <h3 class="">Autenticação</h3>
                                <!-- <p>Don't have an account yet? <a href="authentication-signup.html">Sign up here</a> -->
                                </p>
                            </div>
                            <div class="login-separater text-center mb-4">
                                <hr />
                            </div>
                            <div class="form-body">
                                <form class="row g-3" id="loginForm">
                                    <div class="col-12">
                                        <label for="inputEmailAddress" class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" id="inputEmailAddress" placeholder="Email">
                                    </div>
                                    <div class="col-12">
                                        <label for="inputChoosePassword" class="form-label">Enter Password</label>
                                        <div class="input-group" id="show_hide_password">
                                            <input type="password" name="password" class="form-control border-end-0" id="inputChoosePassword" value="" placeholder="Senha"> <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">Manter logado</label>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6 text-end"> <a href="authentication-forgot-password.html">Forgot Password ?</a>
                                    </div> -->
                                    <div class="col-12">
                                        <div class="d-grid">
                                            <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    $(document).ready(function() {
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if ($('#show_hide_password input').attr("type") == "text") {
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass("bx-hide");
                $('#show_hide_password i').removeClass("bx-show");
            } else if ($('#show_hide_password input').attr("type") == "password") {
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass("bx-hide");
                $('#show_hide_password i').addClass("bx-show");
            }
        });

        $("#loginForm").on("submit", function(e) {
            var form = $(this);
            var form_ref = $(this).data("form-ref")
            console.log(form_ref)
            console.log("enra")
            e.preventDefault()
            $(form).find(".logitBtn").addClass('disabled')
            $(form).find(".logitBtn").attr('disabled', true)
            $(form).find(".logitBtn .textPlace").html('Autenticando')
            $(form).find(".logitBtn .iconPlace").html('<i class="fa fa-circle-o-notch fa-spin fa-1x"></i>')
            // Seu código para continuar a submissão
            // Ex: form.submit();
            var url = '<?= base_url('/logar') ?>';
            // var lb = $(this).parent('div').find(".custom-control-label")
            var data = $(form).serializeArray()
            console.log(data)
            $.ajax({
                type: "POST",
                url: url,
                data: data,
                fail: function(r){
                    console.log(r)
                    $(form).find(".logitBtn").removeClass('disabled')
                    $(form).find(".logitBtn").removeAttr('disabled')
                    $(form).find(".logitBtn .textPlace").html('Continuar')
                    $(form).find(".logitBtn .iconPlace").html('<i class="fa fa-chevron-right fa-1x"></i>')
            
                },
                success: function (response) {
                    console.log(response)
                    console.log(typeof response.error)
                    if(response.error) {
                        // if(response.error_code == 'UNAUTH' || response.error_code == 'UNAUTH_NE' ) {
                        //     $(".response_area").html("Autenticação negada. Verifique usuário e senha.")
                        // } else if(response.error_code == 'NEED_VER') {
                        // }
                        if(response.error_code == 'NEED_VER' || response.error_code == 'NEED_VER_EXP') {
                            var verBox = $(".verBox")
                            // console.log($(".optChecked .verBox .custom-message"))
                            console.log(response)
                            
                            
                            if($(".optChecked").find(".verBox").length == 0) {
                                $(verBox).clone().attr('id', 'verLForm').appendTo(".optChecked > div");
                                
                            } else {
                                console.log("Not")
                            }
                            var pp = new Promise((resolve) => {
                                $(form).find(".response_area").html(response.message)
                                $(".optChecked #verLForm .custom-message").html(response.custom_message)

                                setTimeout(() => {
                                    $(form).find(".response_area").addClass("field_error").addClass("show")
                                }, 200)    
                                setTimeout(() => {
                                    $(form).slideUp(200);
                                    $(form).find(".response_area").removeClass("show").removeClass("field_error");
                                    $(".authArea .optChecked #verLForm").addClass("show");
                                    
                                    resolve()
                                }, 4000);
                            })
                            pp.then(()=> {
                                
                                $(form).find(".logitBtn").removeClass('disabled')
                                $(form).find(".logitBtn").removeAttr('disabled')
                                $(form).find(".logitBtn .textPlace").html('Continuar')
                                $(form).find(".logitBtn .iconPlace").html('<i class="fa fa-chevron-right fa-1x"></i>')
                            })
                        }
                        if(response.error_code == 'UNAUTH' || response.error_code == 'UNAUTH_NE') {
                            // console.log($(".optChecked .verBox .custom-message"))
                            // console.log(response.custom_message)
                            var pp = new Promise((resolve) => {
                                $(".optChecked").find(".response_area").html(response.message)
                                $(".optChecked").find(".response_area").addClass("field_error").addClass("show");
                                setTimeout(() => {
                                    $(".optChecked").find(".response_area").removeClass("show").removeClass("field_error");
                                    resolve(form)
                                }, 4000);
                            })
                            pp.then((form)=> {
                                $(form).find("input:first").focus()
                                console.log($(form))
                                console.log($(form).find("input:first"))
                                // $(".optChecked .verBox .custom-message").html(response.custom_message)
                                // setTimeout(() => {
                                //     $(".optChecked").find(".verBox").addClass("show").addClass("field-error")
                                // }, 500)    
                                $(form).find(".logitBtn").removeClass('disabled')
                                $(form).find(".logitBtn").removeAttr('disabled')
                                $(form).find(".logitBtn .textPlace").html('Continuar')
                                $(form).find(".logitBtn .iconPlace").html('<i class="fa fa-chevron-right fa-1x"></i>')
                            })
                            
                        } 
                        
                        
                    } else {
                        var pp = new Promise((resolve) => {
                            $(".optChecked").find(".response_area").html(response.message)
                            $(".optChecked").find(".response_area").addClass("show");
                            setTimeout(() => {
                                
                                resolve(form)
                            }, 2000);
                        })
                        pp.then((form)=> {
                            
                            // $(".optChecked .verBox .custom-message").html(response.custom_message)
                            // setTimeout(() => {
                            //     $(".optChecked").find(".verBox").addClass("show").addClass("field-error")
                            // }, 500)    
                            // $(form).find(".logitBtn").removeClass('disabled')
                            // $(form).find(".logitBtn").removeAttr('disabled')
                            $(form).find(".logitBtn .textPlace").html(response.message)
                            $(form).find(".logitBtn .iconPlace").html('<i class="fa fa-check-circle-o fa-1x"></i>')
                            
                            setTimeout(() => {
                                $(".optChecked").find(".response_area").removeClass("show")
                            }, 300);
                            setTimeout(() => {
                                $(form).slideUp(500)
                                console.log(form_ref)
                                window.location.href = "<?= base_url('/') ?>"
                                
                            }, 600);
                        })
                    }
                    // lb.text(response)
                    // $(".custom-control-label").text(text);
                    // $('#imgPreview').attr('src', '');
                    // $('#imgPreview').slideUp(200);
                    // $(".remove-image").slideUp(100);
                    // $('#noImageBox').slideDown(250);
                    // $("#upload-box").slideDown(500);
                },
                dataType: 'json',
                // headers: {'X-Requested-With': 'XMLHttpRequest'}
            });
            if ($(this).is(":checked") ) {
                // console
            }
        })
    });
</script>
<?= $this->endSection() ?>

<?= $this->section('footer') ?>
<?= $this->include('layouts/main/parts/footer') ?>
<?= $this->endSection() ?>