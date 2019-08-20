<template>
    <div class="social_login d-flex flex-column ">
        
        <img src="images/paginaweb/login_avatar.png" class="img-fluid m-auto rounded-circle" style="width:75px;height:75px;" alt="">
        <h6> Ingresa o registrate usando tus redes sociales</h6>
        <div class="d-flex justify-content-around align-content-md-around">
        <button @click="login('google')" type="button" class="w-25 btn btn-outline-danger btn-sm">Google</button>
        <b-button @click="login('facebook')" class="w-25 button_login" variant="outline-primary">Facebook</b-button>
        <button @click="login('github')" type="button" class="w-25 btn btn-outline-dark btn-sm">Github</button>

        </div>
    </div>
</template>

<script>
export default {
    methods:{
        login(social){
            window.location.href = 'http://localhost:8000/login/'+social;
        }
    }
}
</script>

<style lang="scss" scoped>
.button_login{
    min-width: 90px;
    font-size: 1rem;
   // font: 1em sans-serif;
}
</style>