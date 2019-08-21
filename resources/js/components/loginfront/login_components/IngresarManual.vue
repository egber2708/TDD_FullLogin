<template>
    <div class="manual_login">
        <div class="form-group">
        <label >Email</label>
        <input type="email" class="form-control"  v-model="user.email"  v-validate="'required|email'" name="email" placeholder="mimail@proveedor.com">
        <span class="span_login_validation">{{ errors.first('email') }}</span>      
        </div>
        <div class="form-group">
          <label >Contraseña</label>
        <input class="form-control" v-validate="'required'" name="password" type="password" placeholder="Password" v-model="user.password"  ref="password">
        <span class="span_login_validation"> {{ errors.first('password') }}</span>       
        </div>
        <div class="form-check">
        <label class="form-check-label">
            <input type="checkbox" class="form-check-input"  v-model="user.remenber"   value="checkedValue" checked>
            Recuerdame
        </label>
        </div>
        <div class="d-flex w-100 ">
        <button type="submit" @click="login" class="btn btn-primary w-50 m-auto btn-sm">Ingresar</button>
        </div>
        <hr>

    </div>
</template>

<script>
export default {
    data(){
        return{
            user: {email:'', password:'', remenber:false}
        }
    },
      methods:{
        login(){
            this.$validator.validate().then(valid => {
                if(valid){
                axios.post('/login', {
                        email: this.user.email,
                        password : this.user.password,
                        remenber : this.user.remenber,
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

</style>