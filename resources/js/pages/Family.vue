<template>  
       <div class='container mt-3'>
        <!-- navbar -->
        <navFamily />
           <div class="card">
               <div class="card-header">
                   Familes
               </div>

               <div class="card-body">
                   <div class="col-12">
                       <grid-loader v-if='loading' class="m-auto" :color="color" :loading="loading" :size="15"></grid-loader>
                       <div v-else style='direction: rtl;'>
                           <table class='table'>
                            <tbody>
                                <!-- if individual.length > 0 -->
                                <tr class="click-row"  v-for="(family, index) in families" :key='index'>
                                <!-- <router-link :to="{ name: 'individual_edit', params: { individualId: individual.id }}">  -->
                                    <td v-on:click.stop="">
                                        <input type="checkbox" :value="family.id" aria-label="Checkbox for following text input" >
                                    </td>
                                    <td class='font-weight-bold'>{{ (family.father.first_name+' '+family.father.middle_name+' '+family.father.last_name).toUpperCase() }}</td>

                                    <td class='font-weight-bold'>{{ (family.mather.first_name+' '+family.mather.middle_name+' '+family.mather.last_name).toUpperCase() }}</td>

                                    <td class='font-weight-bold'>{{ family.family_date_from }}</td>
                                    
                                       
                                    
                                  
                                    <!-- </router-link> -->
                                </tr>
                            </tbody>
                        </table>
                       </div>
                   </div>
               </div>
           </div>
       </div>
</template>

<script>
import navFamily from '../components/navbars/NavbarFamily';
import { GridLoader } from '@saeris/vue-spinners'
export default {
    name:'family',
    components: {
        navFamily,
        GridLoader
    },
    data(){
        return{
            families: [],
            page: 1,
            loading: false,
            color: '#343A40',
        }
    },
    methods:{
        getFamilies(){
            this.loading = true;
            const token = "Bearer " + localStorage.getItem("token");
            axios.get('api/family?page=' + this.page, {headers: { Authorization: token }})
            .then(res => {
                this.families = res.data.data;
                console.log(res.data);
                this.loading = false;
            })
        }
    },
    created(){
        this.getFamilies();
    }
}
</script>

<style lang="scss" scoped>
    table{
        width: 100% !important;
        text-align: right;
    }

    .click-row:hover{
        box-shadow: 1px 1px 1px 2px #e0d6d68c;
        cursor: pointer;
    }

    thead th {
        position:sticky;
        top:0px;
        background-color:grey;
    }
</style>