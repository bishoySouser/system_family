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
                                <input class="form-control" list="husbands" v-model="man" v-on:keyup='getMan' name='husbands'>
                                <datalist id="husbands">
                                    <option  v-for="(man, index) in men" :key="index">
                                        {{man.first_name+" "+man.middle_name+" "+man.last_name}}
                                    </option>
                                    
                                </datalist>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputWife">
                                    The wife
                                    <moon-loader class="m-auto" :color="color" :loading="true" :size="10"></moon-loader>
                                </label>
                                <input type="text" v-model="woman" class="form-control" id="inputWife" v-on:keyup='getWoman' list='wifes'>
                                
                                    <datalist id="wifes">
                                        <option  v-for="(woman, index) in womanAll" :key="index" data-value="sd" :value="woman.first_name +' '+woman.middle_name+' '+woman.last_name" />
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
import { MoonLoader } from '@saeris/vue-spinners'
    export default {
        name: 'addFamilyModal',
        components:{
            MoonLoader
        },
        data(){
            return{
               man: '',
               woman: '',
               manSearch: '',
               womanAll: '',
               men: '',
               womanId: '',
               loading: false,
               color: '#1a486e'
            }
        },
        methods: {
            getMan(event){
                axios.get('/api/individual/unmarried/'+this.man+'/male')
                .then(res => {
                    console.log(res.data.individual[0])
                    this.men = res.data.individual[0]
                })
            },
            getWoman(event){
                this.loading = true;
                axios.get('/api/individual/unmarried/'+this.woman+'/female')
                .then(res => {
                    this.loading = false;
                    this.womanAll = res.data.individual[0]
                })
            },
            getWomanId(id){
                console.log(id);
                this.womanId = id;
            }
        }
    }
</script>

<style lang="scss" scoped>
 
</style>