<template>
  <div>
      <div class="w-100">
          <h4> Recordar Contraseña </h4>
      </div>
      <div class="form-group">
        <label >Correo</label>
        <input type="email" class="form-control"  v-model="user.email"  v-validate="'required|email'" name="email" placeholder="mimail@proveedor.com">
        <span class="span_login_validation">{{ errors.first('email') }}</span>
      </div>
      <div>
         <button @click="recordar" > Enviar </button> 
      </div>

  

  <b-modal  ref="reset-link" hide-footer>
    <template slot="modal-title">
      Recordar Contraseña
    </template>
    <div class="d-block text-center">
      <h5>Ingreas a {{user.email}} donde encontraras el link para restablecer tu contraseña </h5>
      <p> El link se desabilitara en una hora</p>
    </div>
  </b-modal>


  </div>
</template>

<script>
export default {

  data(){
    return{
      user:{ email:''},
    }
  },
  methods:{
    recordar(){
   
      this.$validator.validate().then(valid => {
        if(valid){
        axios.post('/password/email', {
                  email: this.user.email,
                })
                .then(response => {
                  this.$refs['reset-link'].show()
          
                })
                .catch(error => {
                  console.log(error);
                });
                }
      });
    },
  }
}
</script>

<style>

</style>