var recap = new Vue({
    el: '#recap',
    data: {
        name: null,
        surname: null,
        phone: null,
        email: null,
        msg: null,
        check: true,
        captcha:  false,
        hasAlert: false,
        alertType: null,
        alertMsg: null,
        csrf: $('meta[name="csrf-token"]').attr('content'),
    },
    methods: {
        setName: function(e){
            this.name = e.target.value
        },
        setSurname: function(e){
            this.surname = e.target.value
        },
        setPhone: function(e){
            this.phone = e.target.value
        },
        setMail: function(e){
            this.email = e.target.value
        },
        setMsg: function(e){
            this.msg = e.target.value
        },
        setCheckbox: function(e){
            if(e.target.checked) {
                this.check = true;
            } else {
                this.check = false;
            }
        },
        setRecaptcha: function(e){
            this.captcha = e.target.value
        },
        submitRequestForm: function() {
            if(this.name == null || this.name == "" || this.name.trim() == "") {
                this.hasAlert = true;
                this.alertType = 'error';
                this.alertMsg = 'Lütfen isminizi giriniz.';
            } else if(this.surname == null || this.surname == "" || this.surname.trim() == "") {
                this.hasAlert = true;
                this.alertType = 'error';
                this.alertMsg = 'Lütfen soyisminizi giriniz.';
            } else if(this.phone == null || this.phone == "" || this.phone.trim() == "") {
                this.hasAlert = true;
                this.alertType = 'error';
                this.alertMsg = 'Lütfen telefon numaranızı giriniz.';
            } else if(this.email == null || this.email == "" || this.email.trim() == "") {
                this.hasAlert = true;
                this.alertType = 'error';
                this.alertMsg = 'Lütfen e-posta adresinizi giriniz.';
            } else if(this.msg == null || this.msg == "" || this.msg.trim() == "") {
                this.hasAlert = true;
                this.alertType = 'error';
                this.alertMsg = 'Lütfen mesajınızı giriniz.';
            } else if(!this.check) {
                this.hasAlert = true;
                this.alertType = 'error';
                this.alertMsg = 'Lütfen "Gizlilik Sözleşmesi, KVKK Aydınlatma Metni, ve iletişim formu sürecine ilişkin aydınlatma metnini okuyup onayladığınızı belirtiniz"';
            } else if(this.captcha == 'error') {
                this.hasAlert = true;
                this.alertType = 'error';
                this.alertMsg = 'Lütfen "Ben robot değilim" kısmını işaretleyiniz.';
            } else {
                this.hasAlert = false;
                this.alertType = null;
                this.alertMsg = null;

                if(!this.hasAlert) {
                    $('.demoReqButton').attr("disabled", true);
                    var postdata = new FormData();
                    postdata.append('_token',this.csrf);
                    postdata.append('name', this.name);
                    postdata.append('surname', this.surname);
                    postdata.append('phone', this.phone);
                    postdata.append('email', this.email);
                    postdata.append('msg', this.msg);
                    axios.post(window.location.origin+'/demo-talep-form-gonder', postdata).then((d) => {
                        $('.demoReqButton').attr("disabled", false);
                        if(d.data.result == 200) {
                            this.hasAlert = true;
                            this.alertType = 'success';
                            this.alertMsg = d.data.msg;

                            setTimeout(() => {
                                this.hasAlert = false;
                                this.alertType = null;
                                this.alertMsg = null;

                                $('#modalComponent').modal("hide");
                            }, 1200);
                        } else {
                            this.hasAlert = true;
                            this.alertType = 'error';
                            this.alertMsg = d.data.msg;
                        }
                    }).catch((err) => {
                        $('.demoReqButton').attr("disabled", false);
                        this.hasAlert = true;
                        this.alertType = 'error';
                        this.alertMsg = "İşlem sırasında bir sorun oluştu. Lütfen daha sonra tekrar deneyiniz.";
                    })
                }
            }
        }
    },
    mounted() {
        setTimeout(() => {
            this.captcha = $('#recapVal').val();
        }, 400);
    }
});