<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="btn btn-primary" href="#">Add persone</a>
                    </li>
                    <li class="nav-item">
                        <button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFamily" data-whatever="@mdo">Add Family</button>
                    </li>
                    
                </ul>
                <form class="form-inline ml-auto">
                    <input v-model="search" type="text" class="form-control mr-sm-2" placeholder="Search">
                    <button type="submit" class="btn btn-outline-light">Search</button>
                </form>
            </div>
        </nav>

        <modalAddFamily />
    </div>
</template>

<script>
import modalAddFamily from '../modals/AddFamilyModal'
    export default {
        name: 'navFamily',
        components: {
            modalAddFamily
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