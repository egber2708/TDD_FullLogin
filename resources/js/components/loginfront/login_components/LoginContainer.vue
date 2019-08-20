<template>
    <div class="shadow w-75 p-3 m-auto bg-white rounded" style="min-width:250px">
        <div class="w-100 bg-transparent d-flex justify-content-center ">
                <h1> Ingresa a Yuipi </h1>    
        </div>
        <regitro-social/>
        <hr>
        <div class="d-flex justify-content-end">
            <a href.prevent="" @click="estado = 'registrar-usuario'" class="align-self-end"> Registro Personal  </a>
        </div>
        
        <component v-bind:is="estado"  ></component>

        <div v-if="estado === 'ingresar-manual'" class="w-100">
            <a href.prevent="" @click="estado = 'recordar-contraseña'" > Recordar contraseña  </a>
        </div>
        <div v-if="estado != 'ingresar-manual'" class="d-flex justify-content-end">
            <a href.prevent="" @click="estado = 'ingresar-manual'"  >cancelar </a>
        </div>             
    </div>
</template>

<script>
import IngresarManual from     './IngresarManual.vue';
import RecordarContraseña from './RecordarContraseña.vue';
import RegistrarUsario from    './RegistrarUsario.vue';
import RegistroSocial from     './RegistroSocial.vue';

export default {
    components:{
        'ingresar-manual': IngresarManual,
        'recordar-contraseña': RecordarContraseña,
        'registrar-usuario': RegistrarUsario,
        'regitro-social' : RegistroSocial,
    },
    data(){
        return{
             estado : 'ingresar-manual',
        }
    }
  

}
</script>

<style  scoped>



</style>