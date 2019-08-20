<template>
      <div class="shadow w-75 p-3 m-auto bg-white rounded" style="min-width:250px">
        <div class="w-100 bg-transparent d-flex justify-content-center ">
                <h1> Restablecer Contraseña  </h1>          
        </div>
      <div class="form-group">
        <label >Correo</label>
        <input type="email" class="form-control"  :value="user.email"  v-validate="'required|email'" name="email" placeholder="mimail@proveedor.com">
      </div>
      <div class="form-group">
        <label >Contraseña</label>   <br>
        <input v-validate="'required|min:8'" name="password" type="password" placeholder="Password" v-model="user.password"  ref="password">
        <small id="emailHelpId" class="form-text text-muted"> debe contener minimo 8 digitos.</small>
        <span class="span_login_validation"> {{ errors.first('password') }}</span>       
      </div>
      <div class="form-group">
        <label >Confirmar Contraseña</label>   <br>
        <input v-validate="'required|confirmed:password'" name="password_confirmation" type="password" v-model="user.c_password" placeholder="Password, Again" data-vv-as="password">
        <br>
        <span class="span_login_validation">{{ errors.first('password_confirmation') }}</span>
      </div>
      <div>
        <button @click="registrar" > Guardar </button>
      </div>
        
        <b-modal  ref="wrong-token" hide-footer>
            <template slot="modal-title">
            Error
            </template>
            <div class="d-block text-center">
            <h5> Upss... al parecer tu tiempo se a exedido, te recomiendo volver a intentarlo nuevamente </h5>
            <p>  <a href="http://localhost:8000/login"> ir a registro </a></p>
            </div>
        </b-modal>

    </div>
</template>

<script>
export default {
    data(){
        return{
        user : { token : "", email : "", password : "", c_password : ""},
        e_register : [],
        }
    },
    created(){

        this.getpageInf();
    },
    methods:{
        registrar(){
            this.$validator.validate().then(valid => {
                if(valid){
                axios.post('/password/reset', {
                        token: this.user.token,
                        email: this.user.email,
                        password : this.user.password,
                        password_confirmation : this.user.c_password,
                        })
                        .then(response =>  {
                            window.location.href = response.request.responseURL
                        })
                        .catch(error => {
                            console.log(error);
                        });
                        }

            });

        },
        getpageInf(){
             var token = window.location.pathname;
             var email = window.location.search;
             email = email.replace(/%40/gi, "@"); 
             this.user.email = email.replace(/\?email=/gi, "");
             this.user.token = token.replace(/\/password\/reset\//gi, "");
        }
    }
}
</script>

<style>

</style>