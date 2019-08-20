<template>
  <div class="container_login">
        <div class="image_login" >
        </div>
        <div class="form_login pt-3  overflow-auto"> 
            <component v-bind:is="login_request" />
        </div>

  </div>
</template>

<script>

import LoginContainerVue from './login_components/LoginContainer.vue';
import ResetPasswordVue from './login_components/ResetPassword.vue';


export default {
    components:{
        'login-container': LoginContainerVue,
        'reset-password' : ResetPasswordVue,
    },
    props:{
        login_request :{type : String,
                        default : 'login-container' }
        
    }


}
// href='/auth/google'
</script>

<style>
html, body{
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
}

#app{
    width: 100%;
    height: 100%;
}

a {
    cursor: pointer;
    color: blue !important;
}

a:hover {
    text-decoration-line: underline;

}

.span_login_validation{
  color: red;
  font-size: 0.8em;
}

.container_login{
    height: 100%;
    display: grid;
    grid-template-columns: 8% 42% 42% 8%;
    grid-template-rows: 100%;
}

.image_login{
    grid-column: 1/5;
    grid-row: 1/2;
    z-index: -1;
    background: url(~/images/paginaweb/login.jpg);
   
    opacity: .9;
      /* Full height */
    height: 100%; 

    /* Center and scale the image nicely */
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.form_login{
    height: 100%;
    grid-column: 2/5;
    grid-row: 1/2;
    z-index: 1;
}




@media screen  and (min-width: 576px)  {

.image_login{
    grid-column: 1/5;
    grid-row: 1/2;
    z-index: -1;
}

.form_login{
    grid-column: 3/5;
    grid-row: 1/2;
    z-index: 1;
}

}


</style>