<template>
    <div>
        <navbar v-if="isLogin"></navbar>
        <router-view />
    </div>
</template>

<script>
import Navbar from './components/Navbar';
export default {
    name: 'app',
    components:{
        Navbar,
    },
    data() {
        return {
            
        }
    },
    computed:{
        isLogin(){
            return this.$store.getters.isLoggedin;
        }
    },
    methods: {
        
    },
    mounted(){
       
    }
}
</script>

<style>

</style>