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
                    <select v-model="searchType" v-on:click='emitSearchType' id="socialStatus" class='form-control'>
                        <option value="first_name">First name</option>
                        <option value="email">Email</option>
                        <option value="area">Area</option>
                        <option value="mobile_phone1">Mobile 1</option>
                        <option value="mobile_phone2">Mobile 2</option>
                    </select>
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
                search: '',
                searchType: 'first_name'
            }
        },
        methods: {
            emitToParent (event){
                this.$emit('childToParent', this.search)
            },
            emitSearchType (event) {
                this.$emit('toSearchType', this.searchType)
            }
        }
    }
</script>

<style>

</style>