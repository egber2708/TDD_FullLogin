<template>
  <div>
      <div class="form-group">
        <label >Nombre</label>
        <input type="text" v-model="user.name"
          class="form-control"  v-validate="'required|alpha_spaces'"  name="username" placeholder="nombre">
          <span class="span_login_validation">{{ errors.first('username') }}</span>
      </div>
      <div class="form-group">
        <label >Correo</label>
        <input type="email" class="form-control"  v-model="user.email"  v-validate="'required|email'" name="email" placeholder="mimail@proveedor.com">
        <span class="span_login_validation">{{ errors.first('email') }}</span>
      </div>
      <div class="form-group">
        <label >Contraseña</label>
        <input class="form-control"  v-validate="'required|min:8'" name="password" type="password" placeholder="Password" v-model="user.password"  ref="password">
          <small id="emailHelpId" class="form-text text-muted"> debe contener minimo 8 digitos.</small>
        <span class="span_login_validation"> {{ errors.first('password') }}</span>       
      </div>
      <div class="form-group">
        <label >Confirmar Contraseña</label>
        <input class="form-control"  v-validate="'required|confirmed:password'" name="password_confirmation" type="password" v-model="user.c_password" placeholder="Password, Again" data-vv-as="password">
        <br>
        <span class="span_login_validation">{{ errors.first('password_confirmation') }}</span>
      </div>
      <div>
        <button @click="registrar" > Registrarte </button>
      </div>
  </div>
</template>

<script>
export default {
  data(){
    return{
       user : { name : "", email : "", password : "", c_password : ""},
       e_register : []
    }
  },
  methods:{
    registrar(){
      this.$validator.validate().then(valid => {
        if(valid){
        axios.post('/register', {
                  name: this.user.name,
                  email: this.user.email,
                  password : this.user.password,
                  password_confirmation : this.user.c_password,
                })
                .then(function (response) {
              
                  console.log(response.request.responseURL);
                  window.location.href = response.request.responseURL
                })
                .catch(function (error) {
                  console.log(error);
                });
                }
      });

    }

  }  
}
</script>

<style>
.span_login_validation{
  color: red;
  font-size: 0.8em;
}
</style>