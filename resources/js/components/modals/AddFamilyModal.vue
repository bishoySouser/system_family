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
                    <form v-on:submit.prevent="createFamily">
                        <div class="form-row justify-content-md-center">
                            <!-- husband -->
                            <div class="form-group col-md-6 hudband" v-if="step == 1">
                                <label for="inputHusband">Husband</label>
                                <i class="fas fa-mars text-primary"></i>
                                <input 
                                    class="form-control" 
                                    list="men" 
                                    v-model="husband.name"
                                    @input="getManID"
                                    v-on:keyup="getMan"
                                    placeholder="Enter Husband's Name"
                                />
                                <datalist id="men">
                                    <option 
                                        v-for="man in men" 
                                        :key="man.name" 
                                        :data-value="man.id" 
                                        :value="man.first_name+' '+man.middle_name+' '+man.last_name"
                                    />
                                </datalist>
                            </div>
                            <!-- wife -->
                            <div class="form-group col-md-6 wife" v-if="step == 2">
                                <label for="inputWife">Wife</label>
                                <i class="fas fa-venus text-primary"></i>
                                <input 
                                    class="form-control" 
                                    list="women" 
                                    v-model="wife.name"
                                    @input="getWomanID"
                                    v-on:keyup="getWoman"
                                    placeholder="Enter Wife's Name"
                                />
                                <datalist id="women">
                                    <option 
                                        v-for="woman in women" 
                                        :key="woman.name" 
                                        :data-value="woman.id" 
                                        :value="woman.first_name+' '+woman.middle_name+' '+woman.last_name"
                                    />
                                </datalist>
                            </div>
                            <!-- date -->
                            <div class="form-group col-md-6 date" v-if="step == 3">
                                <label for="inputWife">Date of married</label>
                                <input 
                                    class="form-control" 
                                    type="date"
                                    v-model="dateOfMarried"
                                    min="1950-01-01"
                                />
                            </div> 
                        </div>
                        <button class="btn btn-primary" @click.prevent="step--" :disabled='step == 1'>Back</button>
                        <button class="btn btn-primary" @click.prevent="step++" :disabled='step == 3'>
                            <div v-if="loading" class="spinner-border text-light spinner-border-sm" role="status">
                                    <span class="sr-only">loading...</span>
                            </div>
                            Next
                        </button>
                        <button 
                            v-show="step == 3"
                            type="submit"
                            class="btn btn-primary float-right"
                            :disabled="!(this.husband.id && this.wife.id && this.dateOfMarried)"
                        >Create Family</button>
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
                husband: {
                    id: '',
                    name: ''
                },
                wife: {
                    id: '',
                    name: ''
                },
                dateOfMarried: '',
                men: [],
                women: [],
                step: 1,

                loading: false
            }
        },
        methods: {
            getManID(e) {
                let value = e.target.value;
                console.log($('#men [value="' + value + '"]').data('value'));
                this.husband.id = $('#men [value="' + value + '"]').data('value');
                // alert($('#browser [value="' + value + '"]').data('customvalue'));
            },
            getWomanID(e) {
                let value = e.target.value;
                console.log($('#women [value="' + value + '"]').data('value'));
                this.wife.id = $('#women [value="' + value + '"]').data('value');
                // alert($('#browser [value="' + value + '"]').data('customvalue'));
            },
            getMan(){
                if(this.husband.name.length >= 3){
                    this.loading = true
                    axios.get('/api/individual/unmarried/'+this.husband.name+'/male')
                    .then(res => {
                        this.men = res.data.individual[0]
                        this.loading = false
                    })
                }
            },
            getWoman(){
                if(this.wife.name.length >= 3){
                    this.loading = true
                    axios.get('/api/individual/unmarried/'+this.wife.name+'/female')
                    .then(res => {
                        this.women = res.data.individual[0]
                        this.loading = false
                    })
                }
            },
            createFamily(){
                const data = {
                        father_id: this.husband.id,
                        mather_id: this.wife.id,
                        family_date_from: this.dateOfMarried,
                    }
                    const token = "Bearer " + localStorage.getItem("token");
                    axios.create({
                        baseUrl: BASE_URL
                    }).post("api/family", data, {headers: { Authorization: token }})
                    .then(response => {
                        
                        console.log(response.data)
                        $('#addFamily').modal('hide')
                        this.$router.push({ path: `/family/one/${response.data.id}` })
                        
                        
                    }).catch(error => {
                        console.log(error)
                    })
            }
            // getWomanId(id){
            //     console.log(id);
            //     this.womanId = id;
            // }
        }
    }
</script>

<style lang="scss" scoped>
 
</style>