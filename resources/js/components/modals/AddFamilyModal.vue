<template>
    <div class="modal fade" id="addFamily" tabindex="-1" role="dialog" aria-labelledby="modalAddFamily" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddFamily">Create Family</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputHusband">the husband</label>
                                <input class="form-control" list="husbands" v-model="man" name='husbands'>
                                <datalist id="husbands">
                                    <option value="Bishoy">Bishoy</option>
                                    
                                </datalist>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputWife">The wife</label>
                                <input type="text" v-model="woman" class="form-control" id="inputWife" v-on:keyup='getWoman' list='wifes'>
                                
                                    <datalist id="wifes" v-for="(woman, index) in womanAll" :key="index">
                                        <option :value="woman.first_name+' '+woman.middle_name+' '+woman.last_name">
                                            {{woman.first_name+' '+woman.middle_name+' '+woman.last_name}}
                                        </option>
                                    </datalist>
                                
                               
                                
                            </div>
                            <div class='form-group col-md-6 m-auto'>
                                <label for="inputDate">Date of married</label>
                                <input type="date" class='form-control' id="inputDate">

                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary float-right">Create Family</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'addFamilyModal',
        data(){
            return{
               man: '',
               woman: '',
               manSearch: '',
               womanAll: '',
               womanId: ''
            }
        },
        methods: {
            getMan(event){
                axios.get('/api/search/individual/young/male/'+search)
                .then(res => {
                    this.man = res.data.individual
                })
            },
            getWoman(event){
                axios.get('/api/search/individual/young/female/'+this.woman)
                .then(res => {
                    
                    this.womanAll = res.data.individuals
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
 
</style>