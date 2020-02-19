<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav">
                    
                    <button type="button" class="nav-item nav-link btn btn-primary" data-toggle="modal" data-target="#addPersoneModal">
                        Add Persone
                    </button>
    
                </div>
                <form class="form-inline ml-auto">
                    <input v-model="search" v-on:keyup="emitToParent" type="text" class="form-control mr-sm-2" placeholder="Search">
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
        name: 'navindividual',
        components: {
            modal
        },
        data(){
            return{
                search: ''
            }
        },
        methods: {
            emitToParent (event){
                this.$emit('childToParent', this.search)
            }
        }
    }
</script>

<style>

</style>