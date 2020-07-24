<template>
    <div class='container mt-3'>
        
            
           <div class="card">
               <div class="card-header">
                  <h5>Date of marriage: {{family.family_date_from}}</h5>
               </div>

               <div class="card-body" style='min-height: 70vh;'>
                        
                       <div class="row">
                        
                        </div>
                    <hr>
                    <!-- info -->
                    <div class="row justify-content-md-center">
                       <div class="col-md-6">
                           <h4>Father: {{family.father_name}}</h4>
                       </div>
                       <div class="col-md-6">
                            <h4>Mother: {{family.mother_name}}</h4>
                        </div>
                    </div>
                
                    
                    
                </div>
           </div>
    </div>
</template>

<script>
export default {
    name: 'FamilyEdit',
    props: ['familyId'],
    data(){
        return{
            family: [],
            loading: false,
            color: '#343A40'
        }
    },
    methods: {
        getFamilyInfo(){
            const token = "Bearer " + localStorage.getItem("token");
            axios.get('/api/family/'+this.familyId, {headers: { Authorization: token }})
            .then(res => {
                this.family = res.data.family[0];
                
            })
        }
    },
    created(){
        this.getFamilyInfo()
    }
}
</script>

<style lang="scss" scoped>

</style>