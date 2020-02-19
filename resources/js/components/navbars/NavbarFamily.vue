<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="#">Add persone</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary" href="#">Add Family</a>
                    </li>
                </ul>
                <form class="form-inline ml-auto">
                    <input v-model="search" type="text" class="form-control mr-sm-2" placeholder="Search">
                    <button type="submit" class="btn btn-outline-light">Search</button>
                </form>
            </div>
        </nav>

        <modal />
    </div>
        
   
</template>

<script>
import modal from '../modals/AddPersoneModal'
    export default {
        name: 'navFamily',
        components: {
            modal
        },
        data(){
            return{
                search: ''
            }
        },
        methods: {
            
        }
    }
</script>

<style>
    nav li{
        margin-right: 5px;
    }
</style>