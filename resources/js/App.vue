<template>
    <div>
        <navbar ></navbar>
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
    mounted(){
        // this.token ? '' : this.init();
    },
    methods: {
        
    }
}
</script>

<style>

</style>